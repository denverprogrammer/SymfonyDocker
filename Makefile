IMAGES = docker images -aq

destroy:
	docker-compose down
	docker volume prune
	docker container prune
	docker network prune
	@docker rmi -f $(IMAGES)
