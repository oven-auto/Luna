#BACK UP
dump-base:
	sudo docker exec mysql /mnt/mysql/backup/scripts.sh

migrate:
	sudo docker exec php-fpm_test php artisan migrate

migrate-rollback:
	sudo docker exec php-fpm_test php artisan migrate:rollback

