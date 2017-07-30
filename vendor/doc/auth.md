# Autoryzacja


### Konfiguracja

Konfiguracja bazy znajduje się w pliku ***config.php*** w sekcji DATABASE.  

Plik ***login.php*** który znajduje się w folderze auth najlepiej umieścić w głównym folderze aplikacji. W pliku trzeba zmienić wartość zmiennej ***$assets_dir*** - odpowiada ona za linkowanie do styli i grafik.

--

### Podniesienie klasy

***$url_formularza*** - (opcjonalnie) zmienna wskazująca plik z formularzem, nadpisuje adres który znajduje się w pliku config.php

```php
$auth = new Auth( $url_formularza );
```

--

### Sprawdzanie zalogowania

```php
$auth = new Auth;
$auth->is_logged();
```

##### Przykład wykorzystania

```php
if ( $auth->is_logged() ) {
	echo 'Jesteś zalogowany';
}
```

--

### Przekierowanie na formularz logowania

**$redirect** - (opcjonalnie) wskazuje plik przekierowania po poprawnym zalogowaniu, nadpisuje adres z pliku ***confog.php***  
**$form_file** - (opcjonalnie) wskazuje plik z formularzem, nadpisuje adres który znajduje się w pliku ***config.php***

```php
$auth = new Auth;
$auth->login_form( $redirect, $form_file );
```

##### Przykład wykorzystania

```php
// sprawdzenie czy użytkownik jest zalogowany, jeśli tak wyswietla tekst, jeśli nie przekierowuje na stronę logowania
if( !$auth->is_logged() ) {
	$auth->login_form('strona_po_zalogowaniu.php'); 
}
else {
	echo 'ZALOGOWANY';
}
```

--

### Wylogowywanie

**$url** - (opcjonalnie) wyświetla link do strony wylogowania  
**$redirect** - (opcjonalnie) link do przekierowania po wylogowaniu / jeśli false to domyślny  
**$class** - (opcjonalnie) klasy elementu &lt;a>

```php
$auth = new Auth;
$auth->logout( $url, $redirect, $class );
```

##### Przykład wykorzystania

```php
$auth->logout(true, false, 'btn btn-primary');
```