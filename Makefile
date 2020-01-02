
.PHONY: destroy build build_test test dev_logs logs_base

# Brings down all containers.
destroy:
	@docker-compose -f base.yml -f dev.yml down \
		--remove-orphans --volumes

# Builds all of the dev containers and starts the server.  
# In your browser go to http://localhost to view webpage.
build:
	@docker-compose -f base.yml -f dev.yml up \
		--build -d

# Builds all of the test containers and starts the server.    
# In your browser go to http://localhost to view webpage.
# build_test:
# 	@docker-compose -f base.yml -f dev.yml up \
# 		--build -d

# Runs functional tests.  Successfull tests show up as green, 
# errors are red and warnings are blue. This command requires 
# make build-test to be run first.  After building please wait 
# for a few seconds because composer may still be downloading
# dependencies.  Run make test again if command fails.
test:
	@docker-compose -f base.yml -f dev.yml exec application sh -c "APP_ENV=test && vendor/bin/behat"

dev_logs:
	@docker-compose \
		-f base.yml -f dev.yml \
		logs ${AREA}

test_logs:
	@docker-compose \
		-f base.yml -f dev.yml -f test.yml \
		logs \${AREA}
