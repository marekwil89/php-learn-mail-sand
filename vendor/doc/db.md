# DB (CRUD)

### Konfiguracja

Konfiguracja bazy znajduje się w pliku ***config.php*** w sekcji DATABASE.

--

### Podniesienie klasy

```php
$db = new Db;
```

--

### Create

**$table** - *string* : nazwa tabeli w bazie danych  
**$data** - *array* : dane do zapisania w bazie danych  
***@return - id zapisanej pozycji / false***

```php
$db = new Db;
$db->create( $table, $data );
```

##### Przykład implementacji

```php
$data = [
	'imie' => 'Jan',
	'nazwisko' => 'Kowalski',
	'telefon' => '888888888',
];

$db = new Db;<br>
$db->create( 'nazwa_tabeli', $data );
```

--

### Read

**$table** - *string* : nazwa tabeli w bazie danych  
***@return - wszystkie rekordy z tabeli***

```php
$db = new Db;
$db->read( $table );
```

--

### Where

**$table** - *string* : nazwa tabeli w bazie danych  
**$data** - *array* : zapytanie SQL, klucz to nazwa tabeli value to wartość  
***@return - array : wszystkie wyniki zapytania***

```php
$db = new Db;
$db->where( $table, $data );
```

##### Przykład implementacji

```php
// Stworzy zapytanie " SELECT * FROM `nazwa_tabeli` WHERE imie=`Jan` AND miasto=`Warszawa` "
$data = [
	'imie' => 'Jan',
	'miasto' => 'Warszawa',
];

$db = new Db;
$db->where( 'nazwa_tabeli', $data );
```

--

### Update

**$table** - *string* : nazwa tabeli w bazie danych  
**$data** - *array* : dane do zapisania w tabeli
**$where** - *array* : zapytanie SQL, klucz to nazwa tabeli value to wartość

```php
$db = new Db;
$db->update( $table, $data, $where );
```

##### Przykład implementacji

```php
// Stworzy zapytanie " UPDATE `nazwa_tabeli` SET imie=`Jan` miasto=`Warszawa` WHERE id=`4` "
$data = [
	'imie' => 'Jan',
	'miasto' => 'Warszawa',
];

$where = [
	'id' => '4',
];	

$db = new Db;<br>
$db->update( 'nazwa_tabeli', $data, $where );	
```

--

### Delete

**$table** - *string* : nazwa tabeli w bazie danych  
**$where** - *array* : zapytanie SQL, klucz to nazwa tabeli value to wartość

```php
$db = new Db;
$db->delete( $table, $where );
```

##### Przykład implementacji

```php
// Stworzy zapytanie " DELETE FROM `nazwa_tabeli` WHERE id=`4` "
$where = [
	'id' => '4',
];	

$db = new Db;
$db->delete( 'nazwa_tabeli', $where );	
```