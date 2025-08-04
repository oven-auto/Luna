docker-build:
	sudo docker compose up -d --build

docker-up:
	sudo docker compose up -d

composer-update:
	sudo docker exec php-fpm_cli composer update

migrate:
	sudo docker exec php-fpm_cli php artisan migrate

migrate-rollback:
	sudo docker exec php-fpm_cli php artisan migrate:rollback

db-seed:
	sudo docker exec php-fpm_cli php artisan db:seed

key-gen:
	sudo docker exec php-fpm_cli php artisan key:generate

create-env:
	sudo docker exec php-fpm_cli cp .env.example .env

