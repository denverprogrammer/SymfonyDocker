#!make
include .env
export $(shell sed 's/=.*//' .env)

.PHONY: wrapper destroy logs setup start_test start_dev build_test build_dev run_test run_initialize run_migrations run_composer run_wait

CURRENT_BRANCH = `git rev-parse --abbrev-ref HEAD`
CURRENT_COMMIT = `git log -n 1 ${CURRENT_BRANCH} --pretty=format:"%H"`
BUILD_ENV      = -f base.yml
DEV_ENV        = ${BUILD_ENV} -f dev.yml
TEST_ENV       = ${DEV_ENV} -f test.yml
TEST_CMD       = "vendor/bin/behat"
MIGRATE_CMD    = 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing'
COMPOSER_CMD   = 'composer install --no-interaction --prefer-dist --no-suggest'
DB_WAIT_CMD    = 'timeout 300s /usr/local/bin/DatabaseWait.sh'

# Generic wrapper command
wrapper:
	docker-compose ${ENV_FILES} ${COMMAND}

# Brings down all containers.
destroy:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="down --remove-orphans --volumes"

# Displays container logs.  Areas match names defined in base.yml file
logs:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="logs ${AREA}"

initial_dev_start:
	make initial_start ENV_FILES="${DEV_ENV}"

initial_test_start:
	make initial_start ENV_FILES="${TEST_ENV}"

initial_start:
	build/InitialSetup.sh
	make build ENV_FILES="${ENV_FILES}"
	make start ENV_FILES="${ENV_FILES}"
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${COMPOSER_CMD}"
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${DB_WAIT_CMD}"
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${MIGRATE_CMD}"

# This cannot be used when a dev build is running.  Builds all 
# of the test containers and starts the server.  In your browser
# go to http://localhost to view webpage.
start_test:
	make start ENV_FILES="${TEST_ENV}"

# This cannot be used when a test build is running.  Builds all 
# of the dev containers and starts the server.  In your browser 
# go to http://localhost to view webpage.
start_dev:
	make start ENV_FILES="${DEV_ENV}"

start:
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="up -d"

# This cannot be used when a dev build is running.  Builds all 
# of the test containers and starts the server.  In your browser
# go to http://localhost to view webpage.
build_test:
	make build ENV_FILES="${TEST_ENV}"

# This cannot be used when a test build is running.  Builds all 
# of the dev containers and starts the server.  In your browser 
# go to http://localhost to view webpage.
build_dev:
	make build ENV_FILES="${DEV_ENV}"

build:
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="build"

# This command requires a test build.  Runs functional tests.  
# Successfull tests show up as green, errors are red and warnings 
# are blue.
run_test:
	make wrapper ENV_FILES="${TEST_ENV}" COMMAND="exec application sh -c ${TEST_CMD}"
