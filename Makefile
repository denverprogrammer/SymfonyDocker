
start:
	docker-compose up --build -d

destroy:
	docker-compose down --rmi=all --remove-orphans --volumes
