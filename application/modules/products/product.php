<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/ProductDAL.php');*/
include_once(HOST_DIR.'application/class/SupplierDAL.php');
include_once(HOST_DIR.'application/class/ProductDAL.php');


$ProductDal = new ProductDAL();


$isEditing = isset($_GET['id']);
if($isEditing){
    $productId = $_GET['id'];
}

if(isset($_POST['add'])){
    //form submitted
    $name = $_POST['name'];
    $description = $_POST['description'];
    $color = $_POST['color'];
    $size = $_POST['size'];
	
	$arrProd = array(
	                "name"=>$name,
	                "description"=>$description,
					"color"=>$color,
					"size"=>$size
					);
	
    if($isEditing){
        //update employee
		
        $ProductDal->updateProduct($productId, $arrProd);
		// upload image to server
		
		//$arrimage = array();
		for($i=0; $i<count($_FILES['file']['name']); $i++){
		
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"][$i]);
		$extension = end($temp);

		if ((($_FILES["file"]["type"][$i] == "image/gif")
		|| ($_FILES["file"]["type"][$i] == "image/jpeg")
		|| ($_FILES["file"]["type"][$i] == "image/jpg")
		|| ($_FILES["file"]["type"][$i] == "image/pjpeg")
		|| ($_FILES["file"]["type"][$i] == "image/x-png")
		|| ($_FILES["file"]["type"][$i] == "image/png"))
		&& ($_FILES["file"]["size"][$i] < 20000)
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"][$i] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
		  } else {
			echo "Upload: " . $_FILES["file"]["name"][$i] . "<br>";
			echo "Type: " . $_FILES["file"]["type"][$i] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"][$i] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"][$i] . "<br>";
			
			$path = HOST_DIR. 'public/images/'.$productId.'/'. $_FILES["file"]["name"][$i];
			
			$db_path='/nss2/public/images/'.$productId.'/'. $_FILES["file"]["name"][$i];
			$arrimage[] = $db_path;
			if (file_exists($path)) {
			  
			} else {
			
			  move_uploaded_file($_FILES["file"]["tmp_name"][$i],
			  $path);
			  
			  echo "Stored in: " . $path ;
			  		// image upload ended
				
			}
		  }
		} else {
		  echo "Invalid file";
		}
	}
		$ProductDal->insertRelatedImages($arrimage, $productId);
		header("Status: 200");
		$path = HOST_PATH."public/index.php";
        header("Location: $path");
        exit();
    }
    else{
        $productId = $ProductDal->insertProduct($arrProd);
		//insert images related to product
		mkdir(HOST_DIR. 'public/images/'.$productId , 0755); 
		// upload image to server
		$arrimage = array();
		for($i=0; $i<count($_FILES['file']['name']); $i++){
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"][$i]);
		$extension = end($temp);

		if ((($_FILES["file"]["type"][$i] == "image/gif")
		|| ($_FILES["file"]["type"][$i] == "image/jpeg")
		|| ($_FILES["file"]["type"][$i] == "image/jpg")
		|| ($_FILES["file"]["type"][$i] == "image/pjpeg")
		|| ($_FILES["file"]["type"][$i] == "image/x-png")
		|| ($_FILES["file"]["type"][$i] == "image/png"))
		&& ($_FILES["file"]["size"][$i] < 20000)
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"][$i] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
		  } else {
			echo "Upload: " . $_FILES["file"]["name"][$i] . "<br>";
			echo "Type: " . $_FILES["file"]["type"][$i] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"][$i] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"][$i] . "<br>";
			
			$path = HOST_DIR. 'public/images/'.$productId.'/'. $_FILES["file"]["name"][$i];
			$db_path='/nss2/public/images/'.$productId.'/'. $_FILES["file"]["name"][$i];
			if (file_exists($path)) {
			 $ProductDal->insertRelatedImages($arrimage, $productId);
			} else {
			  move_uploaded_file($_FILES["file"]["tmp_name"][$i],
			  $path);
			  echo "Stored in: " . $path ;
			  		// image upload ended
				$arrimage[] = $db_path;
			}
		  }
		} else {
		  echo "Invalid file";
		}
	}
		$ProductDal->insertRelatedImages($arrimage, $productId);
        header("Status: 200");
		$path = HOST_PATH."public/index.php";
        header("Location: $path");
        exit();
    }
}

$assignedSuppliers = array();
$productDetail = array();
if ($isEditing) {
    //$assignedSuppliers = $productDal->getSuppliersForEmployee($employeeId);
    $productDetail = $ProductDal->getProductDetail($productId);
}

?>
