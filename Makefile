
start:
	docker-compose up --build -d

destroy:
	docker-compose down --rmi=local --remove-orphans --volumes
