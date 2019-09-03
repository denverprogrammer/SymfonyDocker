destroy:
	docker-compose down
	docker volume prune
	docker container prune
	docker network prune
	docker rmi -f $(docker images -aq)
