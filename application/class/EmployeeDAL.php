<?php
error_reporting(null);
require_once("MysqlConnection.php");

class EmployeeDAL 
{
    private $conn = null;

    public function __construct()
    {
          /*$this->conn = DBConnection::getInstance();*/
		  $this->conn = new MysqlConnection();
    }


    public function getEmployee($table)
    {     
        return $result =  $this->conn->select($table);
    }


    public function getEmployeeDetail($employeeId)
    {
        $qry = "select e.EmployeeID, e.Name, e.Email, e.Phone, e.Address, e.Zip, " .
               "s.Basic, s.HouseRent, s.Allowance, s.IncomeTax, s.NetIncome, s.Grade " .
               "from Employees e inner join " .
               "Salary s on e.EmployeeID=s.EmployeeID " .
               "where e.EmployeeID=$employeeId";
        $res = $this->conn->executeQuery($qry);
        $employees = array();
        if (($row = mysql_fetch_assoc($res))) {
            $employees = $row;
        }
        mysql_free_result($res);
        return $employees;
    }



    public function getSuppliersForEmployee($employeeId)
    {
        $qry = "select SupplierID from Mapping where EmployeeID=$employeeId";
        $res = $this->conn->executeQuery($qry);
        $supplierIds = array();
        while (($row = mysql_fetch_assoc($res))) {
            $supplierIds[] = $row['SupplierID'];
        }
        mysql_free_result($res);
        return $supplierIds;
    }



    public function insertEmployee($arrEmp, $arrSalary, $arrSuppliers)
    {   
        //insert employee        			   
        $affectedRows = $this->conn->insert('Employees',$arrEmp);
        
        if ($affectedRows > 0) {
            $employeeId = $this->conn->getLastInsertId();

            //insert employee salary
            $arrSalary = array( "EmployeeID"=>$employeeId ) + $arrSalary;
			
			$this->conn->insert('Salary', $arrSalary);

            //insert supplier mapping
            $totalSuppliers = count($arrSuppliers);
            if ($totalSuppliers > 0) {
                $isFirst = true;
                $qry = "insert into Mapping (EmployeeID, SupplierID) ";

                for ($i = 0; $i < $totalSuppliers; $i++) {
                    if ($isFirst) {
                        $isFirst = false;
                    }
                    else {
                        $qry .= "union all ";
                    }
                    $qry .= "select $employeeId, " . $arrSuppliers[$i] . " ";
                }
                
                $this->conn->executeQuery($qry);
            }

            return $employeeId;
        }
        else {
            throw new Exception("Could not insert employee");
        }
    }



    public function updateEmployee($employeeId, $arrEmp, $arrSalary, $arrSuppliers)
    {
        //update employee info
		$this->conn->updateData('Employees', 'EmployeeID', $employeeId, $arrEmp);
       

        //update employee salary
		$this->conn->updateData('Salary', 'EmployeeID', $employeeId, $arrSalary);
        

        //update mapping
        $qry = "delete from Mapping where EmployeeID=$employeeId";
        $this->conn->executeQuery($qry);

        $totalSuppliers = count($arrSuppliers);
        if ($totalSuppliers > 0) {
            $isFirst = true;
            $qry = "insert into Mapping (EmployeeID, SupplierID) ";

            for ($i = 0; $i < $totalSuppliers; $i++) {
                if ($isFirst) {
                    $isFirst = false;
                }
                else {
                    $qry .= "union all ";
                }
                $qry .= "select $employeeId, " . $arrSuppliers[$i] . " ";
            }

            $this->conn->executeQuery($qry);
        }
    }



    public function deleteEmployee($table, $idName, $idValue)
    {
        $this->conn->deleteById($table, $idName, $idValue);
    }
	


    public function __destruct()
    {
        $this->conn->close();
    }
	
}
