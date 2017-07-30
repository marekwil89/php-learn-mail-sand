# Walidacja

### Podniesienie klasy

```php
$validate = new Validate;
```

### Metoda test

```php
$field = [
	'pesel' => $validate->pesel('64110203799'),
    'kod' => $validate->custom('04-218', '/^[0-9]{2}-[0-9]{3}$/'),
];

var_dump( $validate->test($field) );
//zwraca tablicę array(0){}
//jeżeli wystąpiło by błędne pole zwróciłby array(1) { ["kod"]=> bool(false) }
```
---



### Pole tekstowe
    
**$string** - treść do zwalidowania  
**$min_length** - minimalna minimalna długość treści  
***@return true/false***

```php
$validate->text( $string, $min_length );

//przykład użycia
var_dump( $validate->text('qwekk', 10) );
```
--


### Pole custom

**$string** - treść do zwalidowania  
**$pattern** - regex pattern  
***@return true/false***

```php
$validate->custom( $string, $pattern );

//Kod pocztowy
var_dump( $validate->custom('01-100, '/^[0-9]{2}-[0-9]{3}$/') );
```
--


### Pole email

**$string** - treść do zwalidowania  
***@return true/false***

```php
$validate->email( $string );

// przykład wykorzystania
var_dump( $validate->email('mail@mail.com') );
```
--


### Pole telefon

**$string** - treść do zwalidowania  
***@return true/false***

```php
$validate->phone( $string );

// przykład wykorzystania
var_dump( $validate->phone('+888444555') );
```
--


### Pole data

Sprawdza czy podana data zgadza się z formatem **dd [ / - . ] mm [ / - . ] yyyy**  
Jeśli format się zgadza sprawdza czy podana data faktycznie istnieje **30/02/2000 = false**

**$string** - data do zwalidowania  
***@return true/false***

```php
$validate->date( $string );

// przykład wykorzystania
var_dump( $validate->date('25/02/1998') );
```
--


### Pole wiek

Sprawdza czy od podanej daty upłynoł wskazany czas  
**+xx** - czy upłyneło więcej niż xx lat  
**-xx** - czy upłyneło mniej niż xx lat  
**=xx** - czy upłyneło dokładnie xx lat

**$string** - data do zwalidowania  
**$years** - (+|-|=) wiek (np. +18, -18)  
***@return true/false***

```php
$validate->year( $string, $years );

// przykład wykorzystania
var_dump( $validate->year('25/02/1999', '+18') );
```
--


### Pole pesel

Sprawdza poprawność numeru PESEL

**$string** - 11 cyfrowy numer PESEL
**$output** - true/false: domyślnie false - jeżeli true zwraca tablicę z datą urodzenia, wiekiem, płcią
***@return true/false***

```php
$validate->pesel( $string, $output );

// przykład wykorzystania
var_dump( $validate->pesel('46120803514', true) );

//Zwraca
Array
(
	[status] => true
	[birth_day] => 2002-07-19
	[age] => 14
	[sex] => k
)
```
--