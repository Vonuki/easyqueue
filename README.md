<p align="center">
    <h1 align="center">Easyqueue project</h1>
</p>

INSTALLATION
------------
If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

Get last version
~~~
php composer.phar create-project --prefer-source --stability=dev vonuki/easyqueue easyqueue
~~~
Get stable version
~~~
php composer.phar create-project --prefer-source --stability=stable vonuki/easyqueue easyqueue
~~~

As rsult you will have geet access via:
~~~
http://localhost/basic/web/
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.

### Migrations

All migrations by one transaction:
```
./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations --interactive=0 && ./yii migrate/up --migrationPath=@yii/rbac/migrations --interactive=0 && ./yii migrate/up --migrationPath=migrations --interactive=0
```
Admin user will be created automatically.

| Name          | Value         |
| ------------- | ------------- |
| id:           | 1             |
| UserName:     | admin         |
| Password:     | 123456        |


1. User migration:
```
$ ./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
```

2. For dectrium/rbac apllay migration:

```
$ ./yii migrate/up --migrationPath=@yii/rbac/migrations
```

3. For Queue apllay project migration:
```
$ ./yii migrate/up --migrationPath=migrations
```