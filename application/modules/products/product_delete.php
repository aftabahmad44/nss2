<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/EmployeeDAL.php');*/
include_once(HOST_DIR.'application/class/SupplierDAL.php');
include_once(HOST_DIR.'application/class/ProductDAL.php');
require_once('product.php');
$productDal = new ProductDAL();
if(isset($_GET['id']))
{
  $productDal->deleteProduct('products','product_id',$_GET['id']);
    header("Status: 200");
	$path = HOST_PATH."public/index.php";
	//header("Location: $path");
}
?>
