# project containers manipulation
build:
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down

# run test cases
run-all: run-des run-rsa run-md5 run-signature
run-des:
	docker-compose exec php php 'src/des/tests.php'
run-rsa:
	docker-compose exec php php 'src/rsa/tests.php'
run-md5:
	docker-compose exec php php 'src/md5/tests.php'
run-signature:
	docker-compose exec php php 'src/signature/tests.php'
