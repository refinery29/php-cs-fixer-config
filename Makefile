composer:
	composer validate
	composer install

test: composer
	vendor/bin/phpunit --configuration=phpunit.xml
