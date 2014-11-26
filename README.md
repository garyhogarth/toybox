Toy Box
======

An ever growing sample application to demonstrate coding ability

To set up run the following

    php composer.phar install

You will be asked for various parameters. The most important being the DB location & username/password.

In a production app I would have used migrations however for something this small this is fine

    php app/console doctrine:database:create

    php app/console doctrine:schema:create

    php app/console doctrine:fixtures:load

Tests can be run using the following command.

    php phpunit.phar -c app
