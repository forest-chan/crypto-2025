# crypto-2025

![PHP Version](https://img.shields.io/badge/PHP-8.4+-brightgreen.svg)
![License](https://img.shields.io/badge/License-MIT-blue.svg)
![Composer](https://img.shields.io/badge/Composer-Compatible-orange.svg)

Implementations of cryptographic algorithms for a university course

## Implemented cryptographic algorithms:

| Altorithm | Category          |
|-----------|-------------------|
| DES       | Symmetric         | 
| RSA       | Asymmetric        |
| MD5       | Hash function     |
| MD5 + RSA | Digital Signature |

## Requirements:
```
1. Docker version >= 25.0.3
2. Docker Compose version >= v2.24.5-desktop.1
```

## Installation:
```bash
git clone git@github.com:forest-chan/crypto-2025.git
cd crypto-2025
make install
```

## Usage:
1. Run all cryptographic algorithms test cases:
```bash
make run-all
```
2. Run DES cryptographic algorithm test cases:
```bash
make run-des
```
3. Run RSA cryptographic algorithm test cases:
```bash
make run-rsa
```
4. Run MD5 cryptographic algorithm test cases:
```bash
make run-rsa
```
5. Run Digital Signature cryptographic algorithm test cases:
```bash
make run-signature
```
