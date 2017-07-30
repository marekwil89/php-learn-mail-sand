# Mail

### Konfiguracja

Konfiguracja poczty znajduje się w pliku ***config.php*** w sekcji PHPMailer.

--

### Podniesienie klasy

```php
$mail = new Mail;
```

--

### Wysyłka

```php
mail->smtp( $data );
```

--

### Przykład implementacji
Załącznik może być bezpośrednim linkiem lub tablicą z wieloma linkami

```php
$data = [
	'nadawca_imie' => '',
	'odpowiedz' => '', //opcjonalnie
	'odpowiedz_imie' => '', //opcjonalnie
	'odbiorca' => '',
	'odbiorca_imie' => '',
	'tytul' => '',
	'tresc' => '',
	
	/*
	//pojedyńczy załącznik
	'attach' => __DIR__.'exapmle.pdf',
	
	//tablica załączników
	'attach' => array(
		__DIR__.'exapmle1.pdf',
		__DIR__.'exapmle2.pdf',
	),
	*/
];

$mail = new Mail;
$mail->smtp( $data );
```