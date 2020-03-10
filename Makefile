# @see https://gist.github.com/prwhite/8168133
help: ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

up: ## This will run `docker-compose up -d`
	docker-compose up -d

down: ## This will run `docker-compose down`
	docker-compose down

remove: ## This will run `docker-compose down --rmi all -v`
	docker-compose down --rmi all -v

connect: ## This will run `docker-compose exec app bash`
	docker-compose exec app bash

build: ## This will run `docker-compose build app` and set credentials from .env
	php docker/setCredentials.php
	docker-compose build app

exec: ## This command will exec any args inside application container
	docker-compose exec app cd /app && $(ARGS)
