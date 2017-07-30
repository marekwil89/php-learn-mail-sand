# Logs

### Podniesienie klasy

```php
$logs = new Logs;
```

--

### Metoda - txt

**$file** - *string* : nazwa pliku  
**$data** - *string* : treść danych do zapisania

```php
$logs->txt( $file, $data );
```

--

### Przykład implementacji

```php
$logs = new Logs;
$logs->txt( 'test.txt', 'Dane do zapisania w pliku txt' );
```