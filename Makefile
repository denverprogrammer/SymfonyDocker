
dev-up:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml down \
		--remove-orphans --volumes && \
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml up \
		--build -d

dev-down:
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml down \
		--remove-orphans --volumes

test-up:
	docker-compose -f docker-compose.yml -f docker-compose.test.yml down \
		--remove-orphans --volumes && \
	docker-compose -f docker-compose.yml -f docker-compose.test.yml up \
		--build -d

test-down:
	docker-compose -f docker-compose.yml -f docker-compose.test.yml down \
		--remove-orphans --volumes

test:
	@docker-compose exec application sh -c "vendor/bin/behat"
