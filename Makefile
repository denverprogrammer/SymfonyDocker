#!make
# include .env
# export $(shell sed 's/=.*//' .env)

.PHONY: NUKE_IT_NUKE_IT destroy logs initial_start start build run_functional_tests wrapper push psr-check

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
SETUP_TRANSPORT_CMD  = '/usr/src/backend/bin/console messenger:setup-transports --no-interaction'
START_SUPERVISOR_CMD = 'supervisord --configuration /etc/supervisor/*.conf'

# Need a way to cover up your mistakes?
# Does it need to be fast so that nobody will notice?
# Or do you need to just start from scratch ... a lot.
# Then this target is made for you.
NUKE_IT_NUKE_IT:
	make destroy
	docker volume prune --force
	docker network prune --force
	docker container prune --force
	docker rmi -f `$(docker images -aq)`

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
	composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi --working-dir=backend
	timeout 30s build/DatabaseWait.sh
	backend/bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing
	make wrapper ENV="${ENV}" COMMAND="exec backend sh -c ${SETUP_TRANSPORT_CMD} --user ${USER}"
	make wrapper ENV="${ENV}" COMMAND="exec backend sh -c ${START_SUPERVISOR_CMD} --user ${USER}"

# Generic docker-compose start command for any environment.
start:
	make wrapper ENV="${ENV}" COMMAND="up -d"

# Generic docker-compose build command for any environment.
build:
	make wrapper ENV="${ENV}" COMMAND="build"

# Runs unit tests against a the backend.
run_unit_tests:
	make wrapper ENV="${ENV}" COMMAND="exec backend sh -c ${UNIT_TEST_CMD} --user ${USER}"

# Runs functional tests against a the backend.
# Successfull tests show up as green, errors are red and warnings are blue.
run_functional_tests:
	cd backend && bin/console doctrine:database:create --env=test --if-not-exists
	cd backend && vendor/bin/behat --config=tests/functional/behat.yml --colors

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
	backend/vendor/bin/phpcs --standard=./backend/tests/sniffer/phpcs.xml ./backend/src
