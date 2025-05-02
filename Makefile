# project installation
install:
	docker-compose up -d --build

# run test cases
run-all: run-des run-rsa run-md5 run-signature
run-des:
	docker-compose run php php 'src/des/tests.php'
run-rsa:
	docker-compose run php php 'src/rsa/tests.php'
run-md5:
	docker-compose run php php 'src/rsa/tests.php'
run-signature:
	docker-compose run php php 'src/signature/tests.php'
