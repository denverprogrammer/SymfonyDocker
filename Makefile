#!make
include .env
export $(shell sed 's/=.*//' .env)

.PHONY: NUKE_IT_NUKE_IT destroy logs initial_dev_start initial_test_start initial_start start_test start_dev start build_test build_dev build run_local_tests wrapper

# Common git commands
CURRENT_BRANCH = `git rev-parse --abbrev-ref HEAD`
CURRENT_COMMIT = `git log -n 1 ${CURRENT_BRANCH} --pretty=format:"%H"`

# Common docker-compose files that describe container orchestration/environment.
BUILD_ENV      = -f base.yml
DEV_ENV        = ${BUILD_ENV} -f dev.yml
TEST_ENV       = ${DEV_ENV} -f test.yml

# Common commands run inside the docker container.
TEST_CMD       = "vendor/bin/behat --colors"
MIGRATE_CMD    = 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing'
COMPOSER_CMD   = 'composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi'
DB_WAIT_CMD    = 'timeout 300s /usr/local/bin/DatabaseWait.sh'

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
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="down --remove-orphans --volumes"

# Displays container logs.  Areas match names defined in base.yml file
logs:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="logs ${AREA}"

# Sets up and starts all of the dev containers for the first time.
# Go to http://localhost in your browser to view webpage.
initial_dev_start:
	make initial_start ENV_FILES="${DEV_ENV}"

# Sets up and starts all of the test containers for the first time.
# Go to http://localhost in your browser to view webpage.
initial_test_start:
	make initial_start ENV_FILES="${TEST_ENV}"

# Gereric start command when running for the first time.
# This target sets up the initial folders, builds containers, 
# starts containers, installs composer dependencies and migrates data.
initial_start:
	build/InitialSetup.sh
	make build ENV_FILES="${ENV_FILES}"
	make start ENV_FILES="${ENV_FILES}"
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${COMPOSER_CMD}"
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${DB_WAIT_CMD}"
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${MIGRATE_CMD}"

# Starts all of the test containers.
# Go to http://localhost in your browser to view webpage.
start_test:
	make start ENV_FILES="${TEST_ENV}"

# Starts all of the dev containers.
# Go to http://localhost in your browser to view webpage.
start_dev:
	make start ENV_FILES="${DEV_ENV}"

# Generic docker-compose start command for any environment.
start:
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="start -d"

# Builds all of the test containers.
build_test:
	make build ENV_FILES="${TEST_ENV}"

# Builds all of the dev containers.
build_dev:
	make build ENV_FILES="${DEV_ENV}"

# Generic docker-compose build command for any environment.
build:
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="build"

# Runs functional tests against a the application.
# Successfull tests show up as green, errors are red and warnings are blue.
run_local_tests:
	make wrapper ENV_FILES="${TEST_ENV}" COMMAND="exec application sh -c ${TEST_CMD}"

# Generic wrapper command
wrapper:
	docker-compose ${ENV_FILES} ${COMMAND}
