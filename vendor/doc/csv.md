# CSV

### Podniesienie klasy

**$file_name** - *string* : nazwa pliku csv  
**$data_array** - *array* : tablica danych które mają zostać zapisan w pliku CSV  
**$array_key** - *true/false default = false* : czy dane z tablicy mają zostać zapisane razem z kluczami tablicy  
**$bom** - *true/false default = true* : czy plik CSV ma zostać zapisany z BOM  

```php
$csv = new Csv( $file_name, $data_array, $array_key, $bom );
```
--

### Zapis danych na serwerze

```php
$csv = new Csv( $file_name, $data_array, $array_key, $bom );
$csv->save();
```
--

### Przykład implementacji

```php
$data = [
	'id' => '1',
	'imie' => 'Jan',
	'nazwisko' => 'Kowalski'
];

$csv = new Csv( 'test.csv', $data);
$csv->save();
```

### Zapis danych w tymczasowym pliku i pobranie jej na dysk komputera

```php
$csv = new Csv( $file_name, $data_array, $array_key, $bom );
$csv->download();
```
--