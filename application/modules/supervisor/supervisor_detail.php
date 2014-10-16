<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/SupervisorDAL.php');*/
//include_once($_SERVER['DOCUMENT_ROOT'].'at&t/application/class/SupplierDAL.php');
include_once($_SERVER['DOCUMENT_ROOT'].'nss2/application/class/supervisorDAL.php');


$supervisorDal = new SupervisorDAL();


$isEditing = isset($_GET['id']);
if($isEditing){
    $supervisorId = $_GET['id'];
}

if(isset($_POST['add'])){
    //form submitted
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $access = $_POST['access'];

	$arrEmp = array(
	                "first_name"=>$first_name,
					"last_name"=>$last_name,
	                "Email"=>$email,
					"access"=>$access,
					);
	
    $basic_salary = $_POST['basic_salary'];
    $grade = $_POST['grade'];
    $arrSupervisor = $_POST['supervisor_id'];

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
        //update supervisor
        $supervisorDal->updateSupervisor($suppervisorId, $arrEmp, $arrSalary, $arrSuppliers);
    }
    else{
        //insert supervisor
        $supervisorDal->insertSupervisor($arrEmp, $arrSalary, $arrSuppliers);
        header("Status: 200");
        header("Location: index.php");
        exit();
    }
}

$assignedSuppliers = array();
$supervisorDetail = array();
if ($isEditing) {
    //$assignedSuppliers = $suppervisorDal->getSuppliersForSupervisor($supervisorId);
    $supervisorDetail = $supervisorDal->getSupervisorDetail($supervisorId);
}

?>
