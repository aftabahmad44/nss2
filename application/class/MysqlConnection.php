<?php
require_once($_SERVER['DOCUMENT_ROOT'].'nss2/config/settings.php');

class MysqlConnection 
{
		protected $conn = null;
	
		public function __construct()
		{   
			//$this->conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
			//mysql_select_db(DB_NAME);
			$this->conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("\Could not make connection to MySQL");        
			 mysql_select_db(DB_NAME) or die ("Could not open database: ". $this->database_name);
		}
	
	
		public function executeQuery($qry)
		{
			return mysql_query($qry);
		}

	
		public function executeScaler($qry)
		{
			$this->executeQuery($qry);
			return mysql_affected_rows($this->conn);
		}


	
		public function getLastInsertId()
		{
			return mysql_insert_id($this->conn);
		}



		 public function select($table) {
			if($table == 'supervisors')
				$qry = 'select * from ' . $table. ' order by first_name' ;
			else 
				$qry = 'select * from ' . $table. ' order by name' ;
				
			$result = $this->executeQuery($qry);
			while ($row = mysql_fetch_assoc($result))
			{
				$records[] = $row;
			}
	
			if ($records == null) {
				echo "No employee is added ! Please add an employee";
			}
			else
			{
				return $records;
			}
		}
	
	
	
		 public function selectFields($table, $parameters) {
			$qry = 'select ';
	 
			// build column names
			foreach ($parameters as $key => $value) {
			$qry .= $value;
			 
			if($key != end(array_keys($parameters))){
			$qry .= ', ';
			}
			}
			 
			$qry .= ' from ' . $table;
			 
			// execute query
		    $result = $this->executeQuery($qry);
			while ($row = mysql_fetch_assoc($result))
			{
				$records[] = $row;
			}
	
			if ($records == null) {
				echo "No employee is added ! Please add an employee";
			}
			else
			{
				return $records;
			}

		}	
	
	
	
		 public function selectById($table, $idName, $idValue) {
			$qry = 'select * from '
			. $table
			. ' where '
			. $idName
			. ' = '
			. $idValue;
			 
			// execute query
			return $this->query($qry);
		}
 
 
		public function selectByIdOrder($table, $idName, $idValue, $order) {
			$qry = 'select * from '
			. $table
			. ' where '
			. $idName
			. ' = '
			. $idValue
			. ' order by ' . $order;
			 
			// execute query
			return $this->executeQuery($qry);
		}

 
		public function selectWhere($table, $parameters, $where) {
			$qry = 'select ';
			 
			// build column names
			foreach ($parameters as $key => $value) {
			$qry .= $value;
			 
			if($key != end(array_keys($parameters))){
			$qry .= ', ';
		 }
	    }
 
		$qry .= ' from ' . $table
		.= ' where ' . $where;
		 
		// execute query
		return $this->executeQuery($qry);
		}

 
		public function selectWhereOrder($table, $where, $order) {
			$qry = 'select *'
			. ' from ' . $table
			. ' where ' . $where
			. ' order by ' . $order;
			 
			// execute query
			return $this->executeQuery($qry);
		}
 

		public function selectFieldsWhereOrder($table, $parameters, $where, $order) {
			$qry = 'select ';
			 
			// build column names
			foreach ($parameters as $key => $value) {
			$qry .= $value;
			 
			if($key != end(array_keys($parameters))){
			$qry .= ', ';
			}
		  }
 
			$qry .= ' from ' . $table
			. ' where ' . $where
			. ' order by ' . $order;
			 
			// execute query
			return $this->executeQuery($qry);
		}

 
		public function selectOrder($table, $order) {
			$qry = 'select * from '
			. $table
			. ' order by ' . $order;
			 
			// execute query
			return $this->executeQuery($qry);
		}
 
 
		public function selectFieldsOrder($table, $parameters, $order) {
		$qry = 'select ';
		 
		// build column names
		foreach ($parameters as $key => $value) {
		$qry .= $value;
		 
		if($key != end(array_keys($parameters))){
		$qry .= ', ';
		}
		}
		 
		$qry .= ' from ' . $table
		.= ' order by ' . $order;
		 
		// execute query
		return $this->executeQuery($qry);
		}
 
		//public function selectWhereOrder($table, $parameters, $where, $order)
		 
		// search query
		public function search($table, $fieldsToSearch, $search) {
			$searchWords = explode(' ', $search);
			 
			$qry = 'select *';
			 
			$qry .= ' from ' . $table . ' where ';
			 
			// search columns for a match
			foreach($searchWords as $wKey => $wValue) {
			$qry .= '(';
			 
			foreach ($fieldsToSearch as $key => $value) {
			$qry .= $value . ' like \'%' . $wValue . '%\'';
			 
			if($key != end(array_keys($fieldsToSearch))){
			$qry .= ' or ';
			}
			}
			 
			if($wKey != end(array_keys($searchWords))){
			$qry .= ') and ';
			} else {
			$qry .= ')';
			}
		}
		 
			// execute query
			return $this->executeQuery($qry);
		}

 
		// search by fields query
		public function searchFields($table, $fields, $fieldsToSearch, $search) {
			$searchWords = explode(' ', $search);
			 
			$qry = 'select ';
			 
			// build column names
			foreach ($fields as $key => $value) {
			$qry .= $value;
			 
			if($key != end(array_keys($fields))){
			$qry .= ', ';
			}
			}
			 
			$qry .= ' from ' . $table . ' where ';
			 
			// search columns for a match
			foreach($searchWords as $wKey => $wValue) {
			$qry .= '(';
			 
			foreach ($fieldsToSearch as $key => $value) {
			$qry .= $value . ' like \'%' . $wValue . '%\'';
			 
			if($key != end(array_keys($fieldsToSearch))){
			$qry .= ' or ';
			}
			}
	 
			if($wKey != end(array_keys($searchWords))){
			$qry .= ') and ';
			} else {
			$qry .= ')';
			}
		}
 
			// execute query
			return $this->executeQuery($qry);
		}

 
		// search query
		public function searchKeyConstrain($table, $fieldsToSearch, $search, $keyId, $keyValue) {
			$searchWords = explode(' ', $search);
			 
			$qry = 'select *';
			 
			$qry .= ' from ' . $table . ' where ';
			 
			// search columns for a match
			foreach($searchWords as $wKey => $wValue) {
			$qry .= '(';
			 
			foreach ($fieldsToSearch as $key => $value) {
			$qry .= $value . ' like \'%' . $wValue . '%\'';
			 
			if($key != end(array_keys($fieldsToSearch))){
			$qry .= ' or ';
			}
			}
			 
			if($wKey != end(array_keys($searchWords))){
			$qry .= ') and ';
			} else {
			$qry .= ')';
			}
			}
			 
			$qry .= ' and ' . $keyId . ' = ' . $keyValue;
			 
			// execute query
			return $this->executeQuery($qry);
		}
 
 
		// search custom query
		public function searchQuery($qry, $fieldsToSearch, $search) {
			$searchWords = explode(' ', $search);
			 
			$qry .= ' where ';
			 
			// search columns for a match
			foreach($searchWords as $wKey => $wValue) {
			$qry .= '(';
			 
			foreach ($fieldsToSearch as $key => $value) {
			$qry .= $value . ' like \'%' . $wValue . '%\'';
			 
			if($key != end(array_keys($fieldsToSearch))){
			$qry .= ' or ';
			}
			}
			 
			if($wKey != end(array_keys($searchWords))){
			$qry .= ') and ';
			} else {
			$qry .= ')';
			}
		}
 
			// execute query
			return $this->executeQuery($qry);
		}
 


		// search custom query
		public function searchQueryOrder($qry, $fieldsToSearch, $search, $order) {
			$searchWords = explode(' ', $search);
			 
			$qry .= ' where ';
			 
			// search columns for a match
			foreach($searchWords as $wKey => $wValue) {
			$qry .= '(';
			 
			foreach ($fieldsToSearch as $key => $value) {
			$qry .= $value . ' like \'%' . $wValue . '%\'';
			 
			if($key != end(array_keys($fieldsToSearch))){
			$qry .= ' or ';
			}
			}
			 
			if($wKey != end(array_keys($searchWords))){
			$qry .= ') and ';
			} else {
			$qry .= ')';
			}
			}
			 
			$qry .= $order;
			 
			// execute query
			return $this->executeQuery($qry);
		}


 
		// todo: add trim function to values
		public function insert($table, $parameters) {
		 
			$qry = 'insert into '
			. $table
			. ' (';
			 
			// build column names
			foreach ($parameters as $key => $value) {
			$qry .= $key;
			 
			if($key != end(array_keys($parameters))){
			$qry .= ', ';
			}
			}
			 
			$qry .= ') values (';
			 
			// build values for columns
			foreach ($parameters as $key => $value) {
				$qry .= '\'' . $value . '\'';
				 
				if($key != end(array_keys($parameters))){
				$qry .= ', ';
				}
			}
			 
			$qry .= ') ';
			
			// execute query
			$result = $this->executeScaler($qry);
			 
			return $result;
			}
			 
		
		
			
		/* use the updateMethod in the following way,
	
		   $this->updateData('tablename','key column name','row id',array('column_name'=> value),);
		*/
		public function updateData($table, $key_col_name, $id, $update_vals)
		{
			foreach ($update_vals as $key => $val)
			{
				$sets[] = $key . '=\'' . $val . '\'';
			}
	
			$sets = implode(',', $sets);
			$qry = "UPDATE $table SET $sets WHERE $key_col_name = '$id'";
			return $this->executeQuery($qry);
		}


		 public function deleteById($table, $idName, $idValue) {
			$qry = 'delete from '
			. $table
			. ' where '
			. $idName . ' = ' . $idValue;
			 
			// execute query
			$this->executeQuery($qry);
			 
			//return $this->_conn->affected_rows;
		}


}

?>