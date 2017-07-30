# Function
Zestaw pomocniczych funkcji

### Generowanie UUID
generate_uuid()

**$space** - parametr opcjonalny domyślnie "-" jak false to nie wyświetla odstępów

```php
echo generate_uuid($space);
```

### Sortowanie tablicy wielowymiarowej
array_sort_by_column()

**$array** - tablica która ma zostać posortowana  
**$column** - klucz kolumny po której ma zostać posortowana  
**$asc** - opcjonalny (default true) : sortowanie od najmniejszego do największego

```php
array_sort_by_column($array, $column, $asc);
```

#### Przykład wykorzystania

```php
$array = [
	0 => [
		'id' => 1,
		'glosy' => 20
	],
	1 => [
		'id' => 2,
		'glosy' => 4
	],
	2 => [
		'id' => 3,
		'glosy' => 11
	],
];

array_sort_by_column($array, 'glosy');

echo '<pre>';
print_r( $array );
echo '</pre>';
```

### Daty
Operacje na datach

#### time_data_to_timestamp()
Zwraca timestamp z dowolnego formatu daty

**$data** - data  
**$format** - opcjonalny (defatult 'd.m.Y'): format podanej daty

```php
echo time_data_to_timestamp( $data, $format );
```

#### time_format()
Zmiana formatu daty z dowolnego na dowolny

**$data** - data  
**$input_format** - wejściowy format daty  
**$output_format** - wyjściowy format daty  

```php
echo time_format( '10.02.2018', 'd.m.Y', 'Y.m.d' );
```

#### time_add()
Dodawanie czasu do daty - np. dodanie 1 roku do konkretnej daty

**$data** - data
**$time** - ile ma być dodane np: ***'+ 1 month'***, ***'- 1 day'***, ***'+ 2 year'***  
**$input_format** - opcjonalny (defatult 'd.m.Y'): wejściowy format daty  
**$output_format** - opcjonalny (defatult 'd.m.Y'): wyjściowy format daty  

```php
echo time_add( $data, '+ 1 month' );
```

#### time_difference()
czas który upłynął między datami (np wiek)

**$data1** - data 1  
**$data2** - data 2  
**$output_format** - opcjonalny (default '%d'): format który ma zostać zwrócony np: ***'%y'***, ***'%d'***, ***'%m'***  
**$format1** - opcjonalny (default 'd.m.Y'): format daty ***$data1***  
**$format2** - opcjonalny (default 'd.m.Y'): format daty ***$data2***  

```php
echo time_difference( $data1, $data2, $output_format, $format1, $format2 );
```