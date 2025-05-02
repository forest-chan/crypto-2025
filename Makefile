run-all: run-des run-rsa run-md5
run-des:
	php './src/des/tests.php'
run-rsa:
	php './src/rsa/tests.php'
run-md5:
	php './src/md5/tests.php'