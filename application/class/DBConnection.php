<?php

require_once( "config\settings.php");
require_once( "MysqlConnection.php");

abstract class DBConnection {

    public static function getInstance(){
        //select your proper db connection
        $connObj = new MysqlConnection();
        return $connObj;
    }

    //public abstract function executeQuery($qry);
    //public abstract function executeScaler($qry);
    //public abstract function updateData($table,$key_col_name,$id,$update_vals);
    //public abstract function getLastInsertId();
    //public abstract function close();
}

?>