run-all: run-des run-rsa
run-des:
	php './src/des/tests.php'
run-rsa:
	php './src/rsa/tests.php'