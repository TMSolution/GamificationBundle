
------------------OPIS INSTALACJI FIXTURES I GENERATORBUNDLE DO TWORZENIA TESTOW-------------------------------------

Opis procesu instalacji fixtures 

W celu utworzenie fixtures'ow należy w bundlu utworzyć folder DataFixtures, a w nim folder ORM. 
W folderze ORM dodaje się pliki - fixturesy - w zależności od zapotrzebowania, np. załadowanie danych do bazy danych - loadery.
.....................................................................................

Opis procesu instalacji biblioteki Faker - generator losowych danych

W celu instalacji biblioteki Faker należy do composer.json dodaź następujący wpis: 
  "require-dev": 
"fzaninotto/faker" : "~1.5"
.....................................................................................

Opis instalcji GeneratorBundle

Do composer.json dodać wpis:
repositories": [
        {
{
            "type": "vcs",
            "url": "https://github.com/TMSolution/GeneratorBundle"
        }
oraz
  "require-dev": 
  "doctrine/doctrine-fixtures-bundle": "dev-master",
       


Do AppKernel dodać wpis:  new TMSolution\GeneratorBundle\TMSolutionGeneratorBundle()
.....................................................................................


Opis procesu instalacji testowej bazy danych.

W pliku config_test.yml znajdującym się na ścieżce /app/config/config_test.yml należy dodac następujący wpis:
doctrine:
    dbal:
        driver:   pdo_mysql
        host:     localhost
        port:     3306
        dbname:   %database_name%_test
        user:     root
        password: 
        charset:  UTF8
        
gdzie dbname - to nazwa bazy do której będzie skopiowana istniejąca juz baza danych.
 
Nastepnie w katalogu /app/ należy stworzyc plik bootstrap.php, w ktorym następuje odpowiednia konfiguracja, dt. np. czyszczenia bazy testowej, tworzenie bazy testowej.
Cały proces będzie się odbywał po wywołaniu wcześniej napisanych testów. W pliku  bootstrap.php znajduje się także spis wywoływanych komend.
........................................................................................    
    
    
Wynik działania powyższych procesów.

W rezultacie otrzymuje się kopie istniejącej już bazy danych - bazę testową - można ją wypełnic losowymi danymi dzięki bibliotece Faker. 
Opisane wyżej zagadnienia znajdują sie w przykładowych plikach w niniejszym folderze.
.........................................................................................    