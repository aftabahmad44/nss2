<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/EmployeeDAL.php');*/
include_once($_SERVER['DOCUMENT_ROOT'].'nss2/application/class/SupplierDAL.php');
include_once($_SERVER['DOCUMENT_ROOT'].'nss2/application/class/EmployeeDAL.php');


$employeeDal = new EmployeeDAL();


$isEditing = isset($_GET['id']);
if($isEditing){
    $employeeId = $_GET['id'];
}

if(isset($_POST['add'])){
    //form submitted
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
	
	$arrEmp = array(
	                "Name"=>$name,
	                "Email"=>$email,
					"Phone"=>$phone,
					"Address"=>$address,
					"Zip"=>$zip
					);
	
    $basic_salary = $_POST['basic_salary'];
    $grade = $_POST['grade'];
    $arrSuppliers = $_POST['supplierid'];

    $house_rent = $basic_salary * 0.4;
    $allowance = $basic_salary * 0.2;
    $income_tax = $basic_salary * 0.1;
    $net_income = $basic_salary + $house_rent + $allowance + $income_tax;
	
	$arrSalary = array(
					"Basic"=>$basic_salary,
	                "HouseRent"=>$house_rent,
					"Allowance"=>$allowance,
					"IncomeTax"=>$income_tax,
					"NetIncome"=>$net_income,
					"Grade"=>$grade
					);
	
    
    if($isEditing){
        //update employee
        $employeeDal->updateEmployee($employeeId, $arrEmp, $arrSalary, $arrSuppliers);
    }
    else{
        //insert employee
        $employeeDal->insertEmployee($arrEmp, $arrSalary, $arrSuppliers);
        header("Status: 200");
        $path = HOST_PATH."public/index.php";
        header("Location: $path");
        exit();
    }
}

$assignedSuppliers = array();
$employeeDetail = array();
if ($isEditing) {
    $assignedSuppliers = $employeeDal->getSuppliersForEmployee($employeeId);
    $employeeDetail = $employeeDal->getEmployeeDetail($employeeId);
}

?>
