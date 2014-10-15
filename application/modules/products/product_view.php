<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/EmployeeDAL.php');*/
include_once(HOST_DIR.'application/class/SupplierDAL.php');
include_once(HOST_DIR.'application/class/ProductDAL.php');

require_once('product.php');
$productDal = new ProductDAL();
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title>Product Management</title>
  	<link href="<?php echo CSS_DIR.'style.css'?>" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo JS_DIR.'jquery.js'?>"></script>
    <script type="text/javascript" src="<?php echo JS_DIR.'validation.js'?>"></script>
	    <script type="text/javascript">
        $(document).ready(function() {
		var count_num=0
		$('.add_more').click(function(e){
			e.preventDefault();
			$(this).before("<input name='file[]' type='file' id='file"+count_num+"' onchange = 'readURL(this)' />");
			$('#file'+count_num).click();
			count_num++;
		});
        });
			var myArray = new Array() 
	var count=0;
function readURL(input){
    var limit = input.files.length;
	if(count == 0 || limit>1) 
	$('div#previewImages').empty();
	for(var i=0; i<limit; i++){
        if (input.files[i]) {
			var reader = new FileReader();
            reader.onload = function (e) {
                $('div#previewImages').append('<img src="'+e.target.result+'" width="100" height="90" />'); //.attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
	count++;
	//e.preventDefault();
	//$(".imgUpload").before("<input style='margin-left: 140px;' name='image_test[]' type='file' onchange = 'readURL(this)', />");
}
    </script>
</head>
<body>
<div id="container">
    <h1>Product Information</h1>
    <form method="post" id="moduleDetail"
          action="product_view.php<?php echo ($isEditing ? "?id=$productId" : ""); ?>" enctype="multipart/form-data">
        <div>
            <label for="name">Name</label>
           <input id="name" name="name" type="text" value="<?php echo $productDetail['name']; ?>"/>
            <span id="nameInfo"></span>
        </div>
        <div>
            <label for="size">Size</label>
            <input id="size" name="size" type="text" value="<?php echo $productDetail['size']; ?>"/>
            <span id="sizeInfo"></span>
        </div>
        <div>
            <label for="color">color</label>
            <input id="color" name="color" type="text" value="<?php echo $productDetail['color']; ?>"/>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="size" cols="1" rows="1" name="description"><?php echo $productDetail['description']; ?></textarea>
        </div>
		<div>
           <button class="add_more" style="margin-left: 140px;">Add Images</button>
			<div id="previewImages">
			<?php 
			
				$images = $productDal->getRelatedImages($_GET['id']);
				for($i=0; $i< sizeof($images['image_path']); $i++)
				{?>
				<img src="<?php echo $images['image_path'][$i];?>" alt="Image Not available" style="width:150px;height:150px; border:1px solid; padding:5px">
				<?php }?>
			</div>
        </div>
        <input id="add" name="add" type="submit" value="<?php echo ($isEditing ? "Update" : "Add"); ?>"/>
    </form>
</div>
</body>
</html>