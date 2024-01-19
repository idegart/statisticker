build:
	@docker-compose run --build --rm --entrypoint composer core install

up:
	@docker-compose up -d --build --remove-orphans

up.prod:
	@docker-compose -f docker-compose.yml -f docker-compose.production.override.yml -d up --build --remove-orphans

down:
	@docker-compose down

down.prod:
	@docker-compose -f docker-compose.yml -f docker-compose.production.override.yml down

prod.performance.hit:
	@docker-compose exec ab ab -p "/var/www/post.data" -T "application/x-www-form-urlencoded" -c 1000 -n 10000 http://webserver:80/

prod.performance.list:
	@docker-compose exec ab ab -c 1000 -n 10000 http://webserver:80/