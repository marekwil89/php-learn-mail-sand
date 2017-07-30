<?php 

/**
* Validate
*/

// $validate = new Validate;
// var_dump( $validate->text('qwekk', 10) );
// var_dump( $validate->email('mail@mail.com') );
// var_dump( $validate->phone('+888444555') );
// var_dump( $validate->date('25/02/1998') );
// var_dump( $validate->year('25/02/1999', '+18') );


class Validate
{
	public $text_length = 5; // minimalna ilość znaków 

	function __construct()
	{

	}


	/*
	* @value - metody do zwalidowania
	* return array
	*/
	function test($data)
	{
		$output = [];

		foreach ($data as $key=>$value) {
			if( !$value ){
				$output[$key] = false;
			}
		}

		return $output;
	}


	/*
	* @value - wartość do zwalidowania
	* @length - opcjonalny parametr długości wyrażenia, gdy nie jest podany przyjmuje wartość $text_length
	* return true/false
	*/
	function text( $value, $length = 0 )
	{
		$value = trim($value);

		if( $length == 0 ){
			$length = $this->text_length;
		}

		if( $this->length($value) < $length ){
			return false;
		}else{
			return true;
		}
	}


	/*
	* Walidacja Custom - walidowanie według podanego patternu
	* return true/false
	*/
	function custom( $value, $pattern )
	{
		$value = trim($value);
		return $this->match( $value, $pattern );
	}


	/*
	* Walidacja Email
	* return true/false
	*/
	function email( $value )
	{
		$value = trim($value);

		$pattern = '/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/';
		return $this->match( $value, $pattern );
	}	


	/*
	* Walidacja Telefon
	* return true/false
	*/
	function phone( $value )
	{
		$value = $this->clear($value);

		$pattern = '/^[0-9+]{9,13}$/';
		return $this->match( $value, $pattern );
	}	


	/*
	* Walidacja Daty
	* return true/false
	*/
	function date( $value )
	{
		$value = trim($value);
		
		$pattern = '/^[0-9]{1,2}[-\/.][0-9]{1,2}[-\/.][0-9]{4}$/';

		// jeśli pattern się zgadza sprawdź czy podana data istnieje
		if( $this->match( $value, $pattern ) )
		{
			$exploded = $this->multiexplode([".","/","-"], $value);

			// checkdate format - month,day,year
			return $date = checkdate($exploded[1],$exploded[0],$exploded[2]);
		}else
		{
			return false;
		}
	}


	/*
	* Walidacja wieku
	* @value - data urodzenia w formacie dd[/-.]mm[/-.]yyyy
	* @pattern - +18 / -18 / =18
	* return true/false
	*/
	function year( $value, $pattern )
	{
		$output = false;
		
		$value = trim($value);
		$value = preg_replace('/[.\/-]/', '-', $value);
		$timestamp = DateTime::createFromFormat('d-m-Y', $value)->getTimestamp();

		$now = new DateTime();
		$od = new DateTime( date('Y-m-d', $timestamp) );
		$wiek = $now->diff($od)->y;

		$test = preg_replace('/[-=+]/', '', $pattern);

		if( $pattern[0] == '=' ){
			if( $wiek == $test ){
				$output = true;
			}
		}
		if( $pattern[0] == '+' ){
			if( $wiek >= $test ){
				$output = true;
			}
		}
		if( $pattern[0] == '-' ){
			if( $wiek <= $test ){
				$output = true;
			}
		}

		return $output;
	}


	/*
	* Walidacja pesel
	* @value - numer pesel
	* return true/false
	*/
	function pesel( $value, $return = false )
	{
		$str = trim($value);

		if( !preg_match('/^[0-9]{11}$/',$str) ){
			return false;
		}
	
		// tablica z odpowiednimi wagami
		$arrSteps = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
		
		$intSum = 0;
		
		for ($i = 0; $i < 10; $i++){
			//mnożymy każdy ze znaków przez wagć i sumujemy wszystko
			$intSum += $arrSteps[$i] * $str[$i];
		}
		
		//obliczamy sumć kontrolną
		$int = 10 - $intSum % 10; 
		
		$intControlNr = ($int == 10)?0:$int;
		
		//sprawdzamy czy taka sama suma kontrolna jest w ciągu
		if( $intControlNr == $str[10] ){
			
			if( $return == false )
			{
				return true;
			}
			else
			{
				// zwrócenie dodatkowych informacji z numeru pesel
				$status = [
					'status' => 'true',
					'birth_day' => $this->birth_day($str),
					'age' => $this->age( $this->birth_day($str) ),
					'sex' => $this->sex($str),
				];
				
				return $status;
			}

		}

		return false;
	}	



	private function birth_day($pesel)
	{
		$day = $pesel[4].$pesel[5];
		$month = $pesel[2].$pesel[3];
		$year = $pesel[0].$pesel[1];

		if( $month > 12 ){
			$month = $month - 20;

			if( $month < 10 ){
				$month = '0'.$month;
			}
		}

		$datetime = DateTime::createFromFormat('d/m/y', $day.'/'.$month.'/'.$year);
		return $datetime->format('Y-m-d');
	}

	private function sex($pesel)
	{
		return $pesel[9] % 2 ? 'm' : 'k';
	}

	private function age($birth)
	{
		$timestamp = DateTime::createFromFormat('Y-m-d', $birth)->getTimestamp();
		$now = new DateTime();
		$od = new DateTime( date('Y-m-d', $timestamp) );
		$wiek = $now->diff($od)->y;
		return $wiek;
	}

	private function length( $value )
	{
		return strlen($value);
	}

	private function clear( $str )
	{
		$str = trim($str);
		$str = preg_replace('/\s+/', '', $str);
		return $str;
	}

	private function match( $value, $pattern )
	{
		if ( preg_match($pattern, $value) ) {
			return true;
		} else {
			return false;
		}
	}

	function multiexplode($delimiters, $string)
	{
	    $ready = str_replace($delimiters, $delimiters[0], $string);
	    $launch = explode($delimiters[0], $ready);
	    return  $launch;
	}
}