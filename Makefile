
.PHONY: wrapper destroy build_test build_dev run_test logs

DEV_ENV="-f base.yml -f dev.yml"
TEST_ENV="-f base.yml -f dev.yml -f test.yml"

# Generic wrapper command
wrapper:
	docker-compose ${ENV_FILES} ${COMMAND}

# Brings down all containers.
destroy:
	make wrapper ENV_FILES=${DEV_ENV} COMMAND="down --remove-orphans --volumes"

# Displays container logs.  Areas match names defined in base.yml file
logs:
	make wrapper ENV_FILES=${DEV_ENV} COMMAND="logs ${AREA}"

# This cannot be used whena dev build is running.  Builds all 
# of the test containers and starts the server.  In your browser
# go to http://localhost to view webpage.
build_test:
	make wrapper ENV_FILES=${TEST_ENV} COMMAND="up --build -d"

# This cannot be used when a test build is running.  Builds all 
# of the dev containers and starts the server.  In your browser 
# go to http://localhost to view webpage.
build_dev:
	make wrapper ENV_FILES=${DEV_ENV} COMMAND="up --build -d"

# This command requires a test build.  Runs functional tests.  
# Successfull tests show up as green, errors are red and warnings 
# are blue.
run_test:
	make wrapper ENV_FILES=${TEST_ENV} COMMAND="exec application sh -c 'vendor/bin/behat'"
