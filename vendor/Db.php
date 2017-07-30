<?php 

/**
* Db
*	
*	Klucz w tableli taki jak nazwa kolumny w bazie
*
*	create( $database_table_name, $array_data_to_save );
*	read( $database_table_name );
*	where( $database_table_name, $where_array );
*	update( $database_table_name, $data_array, $where_array );
*	delete( $database_table_name, $where_array );
*
*/

class Db
{
	public $pdo;

	function __construct()
	{
		try
		{
			$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';encoding='.DB_CHARSET, DB_USER, DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //włączenie obsługi będów przy zapytaniach sql
		} catch ( PDOException $e ){
			echo $e->getMessage();
		}

		$this->pdo = $pdo;
	}

	function create( $table, $data )
	{
		$sql = [
			0 => null, 
			1 => null
		];

		$last_key = end(array_keys($data));
		
		foreach ($data as $key => $value){
			$separator = $key != $last_key ? ', ' : '';

			$sql[0] .= '`'.$key.'`'.$separator;
			$sql[1] .= ":" . $key . $separator;
		}

		$sql = " INSERT INTO $table ( $sql[0] ) VALUES ( $sql[1] ) ";

		$statement = $this->pdo->prepare( $sql );

		foreach ($data as $key => $value) {
		    $statement->bindValue($key, $value);
		}
		
		if( $statement -> execute() ){
			return $this->pdo->lastInsertId();
		}else{
			return false;
		}
	}

	function read( $table )
	{
		$statement = $this->pdo->prepare(" SELECT * FROM $table WHERE 1 ");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	function where( $table, $where )
	{
		$sql = '';	
		$last_key = end(array_keys($where));
		
		foreach ($where as $key => $value) {
			$separator = $key != $last_key ? ' AND ' : '';
			$sql .= $key."="."'".$value."'".$separator;
		}

		$statement = $this->pdo->prepare(" SELECT * FROM $table WHERE $sql ");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	function update( $table, $data, $where )
	{
		$sql = array('','');
		$last_key = end(array_keys($data));
		
		foreach ($data as $key => $value) {
			$separator = $key != $last_key ? ', ' : '';
			$sql[0] .= $key."="."'".$value."'".$separator;
		}

		$last_key = end(array_keys($where));
		
		foreach ($where as $key => $value) {
			$separator = $key != $last_key ? ' AND ' : '';
			$sql[1] .= $key."="."'".$value."'".$separator;
		}

		$statement = $this->pdo->prepare(" UPDATE $table SET $sql[0] WHERE $sql[1] ");
		$statement->execute();

		$count = $statement->rowCount();

		if($count == '0'){
			return false;
		}
		else{
			return true;
		}
	}
	
	function delete( $table, $where )
	{
		foreach ($where as $key => $value) {
			$where = $key.'='."'".$value."'";
		}

		$statement = $this->pdo->prepare(" DELETE FROM $table WHERE $where ");
		$statement->execute();
	}
}