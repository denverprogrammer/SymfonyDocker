#!make

include ./app/.env
export $(shell sed 's/=.*//' ./app/.env)

.PHONY: NUKE_IT_NUKE_IT destroy logs initial_start start_dev start build run_unit_tests run_functional_tests wrapper push

# Common git commands
CURRENT_BRANCH = `git rev-parse --abbrev-ref HEAD`
CURRENT_COMMIT = `git log -n 1 ${CURRENT_BRANCH} --pretty=format:"%H"`

# Common docker-compose files that describe container orchestration/environment.
BUILD_ENV      = -f base.yml
DEV_ENV        = ${BUILD_ENV} -f dev.yml
USER_ID        = `id -u`
GROUP_ID       = `id -g`
CURRENT_UID    = ${USER_ID}:${GROUP_ID}

# Common commands run inside the docker container.
UNIT_TEST_CMD  = 'rm -irf tests/Unit/results && bin/phpunit'
FUNCT_TEST_CMD = 'rm -irf tests/Functional/results && vendor/bin/behat --colors'

MIGRATE_CMD    = 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing'
COMPOSER_CMD   = 'composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi'
WORKER_CMD     = 'timeout 300s /usr/src/bin/WorkerSetup.sh'
INIT_CMD       = 'timeout 300s /usr/src/bin/InitialSetup.sh'
DB_WAIT_CMD    = 'timeout 300s /usr/src/bin/DatabaseWait.sh'
WORKER_CMD     = 'timeout 300s /usr/src/bin/WorkerSetup.sh'
PSR_CHECK_CMD  = 'vendor/bin/phpcs --standard=tests/Sniffer/phpcs.xml .'

# Need a way to cover up your mistakes?
# Does it need to be fast so that nobody will notice?
# Or do you need to just start from scratch ... a lot.
# Then this target is made for you.
NUKE_IT_NUKE_IT:
	make destroy
	docker volume prune --force
	docker network prune --force
	docker container prune --force
	docker rmi -f $(`docker images -aq`)

# Brings down all containers.
destroy:
	make wrapper ENV="dev" COMMAND="down --remove-orphans --volumes"

# Displays container logs.  Areas match names defined in base.yml file
logs:
	make wrapper ENV="dev" COMMAND="logs ${AREA}"

# Gereric start command when running for the first time.
# This target sets up the initial folders, builds containers, 
# starts containers, installs composer dependencies and migrates data.
initial_start:
	make build ENV="dev"
	make start ENV="dev"
	make wrapper ENV="dev" COMMAND="exec application sh -c ${INIT_CMD} --user ${CURRENT_UID}"
	make wrapper ENV="dev" COMMAND="exec application sh -c ${COMPOSER_CMD} --user ${CURRENT_UID}"
	make wrapper ENV="dev" COMMAND="exec application sh -c ${DB_WAIT_CMD} --user ${CURRENT_UID}"
	make wrapper ENV="dev" COMMAND="exec application sh -c ${MIGRATE_CMD} --user ${CURRENT_UID}"
	make wrapper ENV="dev" COMMAND="exec application sh -c ${WORKER_CMD} --user ${CURRENT_UID}"

# Generic docker-compose start command for any environment.
start:
	make wrapper ENV="dev" COMMAND="up -d"

# Generic docker-compose build command for any environment.
build:
	make wrapper ENV="dev" COMMAND="build"

# Runs unit tests against a the application.
run_unit_tests:
	make wrapper ENV="dev" COMMAND="exec application sh -c ${UNIT_TEST_CMD} --user ${CURRENT_UID}"

# Runs functional tests against a the application.
# Successfull tests show up as green, errors are red and warnings are blue.
run_functional_tests:
	make wrapper ENV="dev" COMMAND="exec application sh -c ${FUNCT_TEST_CMD} --user ${CURRENT_UID}"

# Generic wrapper command
wrapper:
ifeq ($(ENV),prod)
	docker-compose ${BUILD_ENV} ${COMMAND}
else ifeq ($(ENV),staging)
	docker-compose ${DEV_ENV} ${COMMAND}
else
	docker-compose ${DEV_ENV} ${COMMAND}
endif

# Common way to push to github.
push:
	git push -u origin ${CURRENT_BRANCH}

# Check for psr issues.
psr-check:
	make wrapper ENV="dev" COMMAND="exec application sh -c ${PSR_CHECK_CMD} --user ${CURRENT_UID}"
