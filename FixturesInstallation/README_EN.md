# Fixtures installation description

by Damian Piela

---

In order to create fixtures, make a new `DataFixtures` folder in your bundle, and `ORM` inside him.
You add fixtures into the `ORM` folder, depending on your needs, e.g. loading data into a data base - loaders.


## Faker library installation - random data generator

In order to install the Faker library, add `"fzaninotto/faker" : "~1.5"` to your `composer.json`.


## Test database installation description

Append the following text into your `/app/config/config_test.yml`:

doctrine:
    dbal:
        driver:   pdo_mysql
        host:     localhost
        port:     3306
        dbname:   %database_name%_test
        user:     root
        password: 
        charset:  UTF8

where dbname is the database name, where and existing one will be copied.
Next, create `bootstrap.php` file in your `/app/` directory, where configuration pertaining to e.g. clearing or creating a test database takes place.
The whole process will take place after running the previously-written tests. Commands description is located in the file.

## Result of the aforementioned processes

As a result, you will obtain a copy of the existing database - the test database. You can fill it up with random data generated with the Faker library.
The aforementioned issues are located in the exemplary files in the folder.
