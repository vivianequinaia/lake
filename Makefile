# Load .env file if it exists
include .env

CURRENT_DIRECTORY := $(shell pwd)

start up:
	@docker-compose up -d

stop:
	@docker-compose stop

status:
	@docker-compose ps

restart: stop start

clean:
	@docker-compose rm --force
	@find . -name \*.pyc -delete

build:
	@docker-compose up -d --build

tail:
	@docker-compose logs -f

php:
	@docker-compose exec php-fpm bash

test:
	docker exec -ti lake-php-fpm ./vendor/phpunit/phpunit/phpunit tests

coverage:
	docker exec -ti lake-php-fpm ./vendor/phpunit/phpunit/phpunit --whitelist core/ --coverage-html cover

.PHONY: up stop status restart clean build tail exec test
