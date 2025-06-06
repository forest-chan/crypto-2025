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
	docker-compose exec php vendor/bin/phpunit ./tests/CryptoAlgorithm/DES/DESTest.php --testdox
	docker-compose exec php vendor/bin/phpunit ./tests/CryptoAlgorithm/DES/DESTextDecoratorTest.php --testdox
run-rsa:
	docker-compose exec php vendor/bin/phpunit ./tests/CryptoAlgorithm/RSA/RSATest.php --testdox
	docker-compose exec php vendor/bin/phpunit ./tests/CryptoAlgorithm/RSA/RSATextDecoratorTest.php --testdox
run-md5:
	docker-compose exec php vendor/bin/phpunit ./tests/HashFunction/MD5/MD5Test.php --testdox
run-signature:
	docker-compose exec php vendor/bin/phpunit ./tests/DigitalSignature/DigitalSignatureMD5RSA/DigitalSignatureMD5RSATest.php --testdox
