#!make
# include .env
# export $(shell sed 's/=.*//' .env)

.PHONY: NUKE_IT_NUKE_IT destroy logs initial_start start build run_unit_tests run_functional_tests wrapper push psr-check

# Common git commands
CURRENT_BRANCH = `git rev-parse --abbrev-ref HEAD`
CURRENT_COMMIT = `git log -n 1 ${CURRENT_BRANCH} --pretty=format:"%H"`

# Common docker-compose files that describe container orchestration/environment.
BUILD_ENV = -f base.yml
DEV_ENV   = ${BUILD_ENV} -f dev.yml
TEST_ENV  = ${DEV_ENV} -f test.yml
USER_ID   = `id -u`
GROUP_ID  = `id -g`
USER      = ${USER_ID}:${GROUP_ID}

# Common commands run inside the docker container.
# UNIT_TEST_CMD  = 'rm -irf tests/unit/results && vendor/bin/simple-phpunit -c tests/phpunit.xml'
# FUNCT_TEST_CMD = 'rm -irf tests/functional/results && vendor/bin/behat --colors --config tests/behat.yaml'
MIGRATE_CMD    = 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing'
COMPOSER_CMD   = 'composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi'
# INITIALIZE_CMD = 'timeout 300s /usr/local/bin/InitialSetup.sh'
DB_WAIT_CMD    = 'timeout 300s /usr/src/bin/DatabaseWait.sh'
PSR_CHECK_CMD  = 'vendor/bin/phpcs --standard=tests/phpcs.xml .'

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
	make wrapper ENV="${ENV}" COMMAND="down --remove-orphans --volumes"

# Displays container logs.  Areas match names defined in base.yml file
logs:
	make wrapper ENV="${ENV}" COMMAND="logs ${AREA}"

# Gereric start command when running for the first time.
# This target sets up the initial folders, builds containers, 
# starts containers, installs composer dependencies and migrates data.
initial_start:
	make build ENV="${ENV}"
	make start ENV="${ENV}"
	make wrapper ENV="${ENV}" COMMAND="exec application sh -c ${COMPOSER_CMD} --user ${USER}"
	make wrapper ENV="${ENV}" COMMAND="exec application sh -c ${DB_WAIT_CMD} --user ${USER}"
	make wrapper ENV="${ENV}" COMMAND="exec application sh -c ${MIGRATE_CMD} --user ${USER}"

# Generic docker-compose start command for any environment.
start:
	make wrapper ENV="${ENV}" COMMAND="up -d"

# Generic docker-compose build command for any environment.
build:
	make wrapper ENV="${ENV}" COMMAND="build"

# Runs unit tests against a the application.
run_unit_tests:
	make wrapper ENV="${ENV}" COMMAND="exec application sh -c ${UNIT_TEST_CMD} --user ${USER}"

# Runs functional tests against a the application.
# Successfull tests show up as green, errors are red and warnings are blue.
run_functional_tests:
	make wrapper ENV="${ENV}" COMMAND="exec application sh -c ${FUNCT_TEST_CMD} --user ${USER}"

# Generic wrapper command
wrapper:
ifeq ($(ENV),test)
	docker-compose ${TEST_ENV} ${COMMAND}
else
	docker-compose ${DEV_ENV} ${COMMAND}
endif

# Common way to push to github.
push:
	git push -u origin ${CURRENT_BRANCH}

# Check for psr issues.
psr-check:
	make wrapper ENV="${ENV}" COMMAND="exec application sh -c ${PSR_CHECK_CMD} --user ${USER}"
