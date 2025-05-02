run-all: run-des run-rsa run-md5 run-signature
run-des:
	php './src/des/tests.php'
run-rsa:
	php './src/rsa/tests.php'
run-md5:
	php './src/md5/tests.php'
run-signature:
	php './src/signature/tests.php'