<?php 


/**
* Csv
*
* save( $file_name, $data_array, $key = true/false, $bom = true/false ); // jeśli arrayKey true to zapisuje dane razem z kluczami
*
*/

class Csv
{
	private $file;
	private $data;
	private $arrayKey;
	private $bom;

	function __construct( $file, $data, $arrayKey=false, $bom=true )
	{
		$this->file = $file;
		$this->data = $data;
		$this->arrayKey = $arrayKey;
		$this->bom = $bom;

		$this->prepare();
	}

	// zapisuje dane do csv
	public function save()
	{
		if( !file_exists( $this->file ) ) {
			$this->createFile();
		}

		// $output = false;

		$fp = fopen( $this->file, 'a' );

		// jezeli pierwszy element to tablica
		if ( is_array( current($this->data) ) ){
			foreach ($this->data as $key => $value) {
				fputcsv($fp, $value);
			}
		}
		else{
			fputcsv($fp, $this->data);
		}

		fclose($fp);

		// return $output;
	}

	// zapisuje dane i pobiera csv
	public function download()
	{	
		// $output = false;

		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=" . $this->file);

		$fp = fopen('php://output', 'w');

		if ( is_array( current($this->data) ) ){
			foreach ($this->data as $key => $value) {
				fputcsv($fp, $value);
			}
		}
		else{
			fputcsv($fp, $this->data);
		}

		fclose($fp);
				
		// return $output;
	}


	// przygotowanie danych
	private function prepare(){
		if( $this->arrayKey == true ) {
			$this->addKey();
		}
	}
	

	// dodawanie kluczy tablicy
	private function addKey()
	{
		$Putdata = array();
		
		foreach ( $this->data as $key => $value ) {
			$Putdata[] .= $key.' = '.$value;
		}

		$this->data = $Putdata;
	}	


	// tworzenie nowego pliku
	private function createFile()
	{
		if( $this->bom === true )
		{
			$fp = fopen( $this->file, 'w' );
			$BOM = "\xEF\xBB\xBF"; // UTF-8 BOM
			fwrite($fp, $BOM);
			fclose($fp);
		}
		else
		{
			$fp = fopen($this->file, "w");
			fclose($fp);
		}
	}

}