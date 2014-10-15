<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/EmployeeDAL.php');*/
include_once($_SERVER['DOCUMENT_ROOT'].'at_t/application/class/SupplierDAL.php');
include_once($_SERVER['DOCUMENT_ROOT'].'at_t/application/class/ProductDAL.php');

require_once('product.php');
$productDal = new ProductDAL();
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title>Product Details</title>
  	<link href="<?php echo CSS_DIR.'style.css'?>" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo JS_DIR.'jquery.js'?>"></script>
    <script type="text/javascript" src="<?php echo JS_DIR.'validation.js'?>"></script>
</head>
<body>
<div style="padding:10% 10% 20% 20%; border: 1px solid #333">
<label><h1>Product Detail</h1></label>  
  <table width="100%" border="1" class="listing_table">
        <thead>
        <tr colspan="2">
			<hr>
        </tr>
        </thead>
        <tbody>
        <?php
		
    $result = $productDal->getProductDetail($_GET['product_id']);
	$images = $productDal->getRelatedImages($_GET['product_id']);
        ?>
        <tr>
			<td><b>Product Name</b></td>
            <td><?php echo $result['name'];?></td>
			</tr><tr>
			<td><b>Color</b></td>
			<td><?php echo $result['color'];?></td>
			</tr><tr>
			<td><b>Size</b></td>
			<td><?php echo $result['size'];?></td>
			</tr><tr>
			<td><b>Description</b></td>
			<td><?php echo $result['description'];?></td>
			</tr><tr>
			<td></td>
			<?php 
			for($i=0; $i< sizeof($images['image_path']); $i++)
			{?>
				<img src="<?php echo $images['image_path'][$i];?>" alt="Image Not available" style="width:150px;height:150px; border:1px solid; padding:5px">
				<?php }?>
        </tr>
        <?php
    ?>
</tbody>
</table>
</div>
</body>
</html>