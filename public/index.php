<?php
include_once('../application/class/EmployeeDAL.php');
include_once('../application/class/SupervisorDAL.php');
include_once('../application/class/ProductDAL.php');
$employeeDal = new EmployeeDAL();
$supervisorDal = new SupervisorDAL();
$productDal = new ProductDAL();

/*if(isset($_GET['delete'])){
    $employeeDal->deleteEmployee('Employees','EmployeeID',$_GET['delete']);
    header("Status: 200");
    header("Location: index.php");
}*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>List Employee</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="container">
    <h1>List All Employee</h1>

    <table width="100%" class="listing_table">
        <thead>
        <tr>
            <th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Address</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
    $get_all_employee = $employeeDal->getEmployee('employees');
    foreach ($get_all_employee as $result)
    {

        ?>
        <tr>
            <td><?php echo $result['Name'];?></td>
			<td><?php echo $result['email'];?></td>
			<td><?php echo $result['phone'];?></td>
			<td><?php echo $result['address'];?></td>
            <td>
                <a href="../application/modules/employees/employee_detail_view.php?id=<?php echo $result['EmployeeID'];?>">Edit</a>
            </td>
            <td>
                <a href="index.php?delete=<?php echo $result['EmployeeID']; ?>">Delete</a>
            </td>
        </tr>
        <?php


    }
    ?>
    <tr>
            <td colspan="3"><a href="../application/modules/employees/employee_detail_view.php">Add New Employee</a> </td>
        </tr>
</tbody>
</table>
<h1>List All Supervisor</h1>
   <table width="100%" class="listing_table">
        <thead>
        <tr>
            <th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Access/th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
		
    $get_all_supervisor = $supervisorDal->getSupervisor('supervisors');
    foreach ($get_all_supervisor as $result)
    {

        ?>
        <tr>
            <td><?php echo $result['first_name'];?></td>
			<td><?php echo $result['last_name'];?></td>
			<td><?php echo $result['email'];?></td>
			<td><?php echo $result['access'];?></td>
            <td>
                <a href="../application/modules/supervisor/supervisor_detail_view.php?id=<?php echo $result['id'];?>">Edit</a>
            </td>
            <td>
                <a href="index.php?delete=<?php echo $result['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php


    }
	
    ?>
    <tr>
            <td colspan="3"><a href="../application/modules/supervisor/supervisor_detail_view.php">Add New Supervisor</a> </td>
        </tr>
</tbody>
</table>
<h1>List All Products</h1>
   <table width="100%" class="listing_table">
        <thead>
        <tr>
            <th>Product Name</th>
			<th>Color</th>
			<th>Size</th>
			<th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
		
    $get_all_products = $productDal->getProduct('products');
    foreach ($get_all_products as $result)
    {

        ?>
        <tr>
            <td><?php echo $result['name'];?></td>
			<td><?php echo $result['color'];?></td>
			<td><?php echo $result['size'];?></td>
			<td><?php echo $result['description'];?></td>
            <td>
                <a href="../application/modules/products/product_detail.php?product_id=<?php echo $result['product_id'];?>">View</a>
            </td>
			<td>
                <a href="../application/modules/products/product_view.php?id=<?php echo $result['product_id'];?>">Edit</a>
            </td>
            <td>
                <a href="../application/modules/products/product_delete.php?id=<?php echo $result['product_id'];?>">Delete</a>
            </td>
        </tr>
        <?php


    }
    ?>
    <tr>
		<td colspan="3"><a href="../application/modules/products/product_view.php">Add New Product</a> </td>
    </tr>
</tbody>
</table>
</div>
</body>
</html>