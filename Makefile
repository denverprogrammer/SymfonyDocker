
.PHONY: wrapper destroy build_test build_dev run_test logs

CURRENT_BRANCH = `git rev-parse --abbrev-ref HEAD`
CURRENT_COMMIT = `git log -n 1 ${CURRENT_BRANCH} --pretty=format:"%H"`

BUILD_ENV =-f base.yml
DEV_ENV =${BUILD_ENV} -f dev.yml
TEST_ENV =${DEV_ENV} -f test.yml

TEST_CMD = "vendor/bin/behat"
MIGRATE_CMD = "bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing"
WAIT_CMD = "/usr/local/bin/Wait.sh"

# Generic wrapper command
wrapper:
	docker-compose ${ENV_FILES} ${COMMAND}

# Brings down all containers.
destroy:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="down --remove-orphans --volumes"

# Displays container logs.  Areas match names defined in base.yml file
logs:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="logs ${AREA}"

# This cannot be used when a dev build is running.  Builds all 
# of the test containers and starts the server.  In your browser
# go to http://localhost to view webpage.
start_test:
	make wrapper ENV_FILES="${TEST_ENV}" COMMAND="up --build -d"

# This cannot be used when a test build is running.  Builds all 
# of the dev containers and starts the server.  In your browser 
# go to http://localhost to view webpage.
start_dev:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="up --build -d"

# This cannot be used when a dev build is running.  Builds all 
# of the test containers and starts the server.  In your browser
# go to http://localhost to view webpage.
build_test:
	make wrapper ENV_FILES="${TEST_ENV}" COMMAND="build"

# This cannot be used when a test build is running.  Builds all 
# of the dev containers and starts the server.  In your browser 
# go to http://localhost to view webpage.
build_dev:
	make wrapper ENV_FILES="${DEV_ENV}" COMMAND="build"

# This command requires a test build.  Runs functional tests.  
# Successfull tests show up as green, errors are red and warnings 
# are blue.
run_test:
	make wrapper ENV_FILES="${TEST_ENV}" COMMAND="exec application sh -c ${TEST_CMD}"

run_migrations:
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${MIGRATE_CMD}"

run_wait:
	make wrapper ENV_FILES="${ENV_FILES}" COMMAND="exec application sh -c ${WAIT_CMD}"
