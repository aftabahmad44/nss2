<?php
require_once("MysqlConnection.php");

class SupplierDAL {
    private $conn = null;

    public function __construct(){
        /*$this->conn = DBConnection::getInstance();*/
		$this->conn = new MysqlConnection();
    }

    public function getSuppliers(){
        $qry = "select SupplierID, Name from Suppliers order by Name";
        $suppliers = array();
        $res = $this->conn->executeQuery($qry);
        while(($row = mysql_fetch_assoc($res))){
            $suppliers[] = $row;
        }
        mysql_free_result($res);
        return $suppliers;
    }

    public function __destruct(){
        $this->conn->close();
    }
}
