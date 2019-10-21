
destroy:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml down \
		--remove-orphans --volumes

build-dev:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml up \
		--build -d

build-test:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml -f docker-compose.test.yml up \
		--build -d

test:
	@docker-compose exec application sh -c "vendor/bin/behat"
