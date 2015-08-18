# Fixtures installation description

>by Damian Piela

---

In order to create fixtures, make a new `DataFixtures\ORM` folder in your bundle.
You add fixtures into the `ORM` folder, e.g. loading data into a data base (loaders), as required.


### Faker library installation

Faker is a library providing tools for randomly generating data, allowing you to fill you database with test - nevertheless somewhat meaningful data.
In order to install the Faker library, add `"fzaninotto/faker" : "~1.5"` to your `composer.json`.


### Test database installation description

Append the following text into your `/app/config/config_test.yml`:

```doctrine:
    dbal:
        driver:   pdo_mysql
        host:     localhost
        port:     3306
        dbname:   %database_name%_test
        user:     root
        password: 
        charset:  UTF8```

where *dbname* is the database name, where the existing one will be copied.
Subsequently, create a `bootstrap.php` file in your `/app/` directory, where configuration pertaining to - for instance - clearing or creating a test database takes place.
The whole process will happen after running the previously-written tests. Commands descriptions are located in the file.

### Results

As a result, you will obtain a copy of the existing database - the test database. You can fill it up with random data generated with the Faker library.
The aforementioned issues are included in the exemplary files in the folder. 
