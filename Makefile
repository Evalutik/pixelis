# Makefile for common tasks
.PHONY: install up down test lint setup-db fix

install:
	composer install

up:
	docker-compose up -d --build

down:
	docker-compose down

setup-db:
	docker-compose exec php php src/setup_db.php --seed=dev:dev

test:
	vendor/bin/phpunit --configuration phpunit.xml

lint:
	composer run-script check

fix:
	composer run-script fix
