<?php
error_reporting(null);
require_once("MysqlConnection.php");

class ProductDAL 
{
    private $conn = null;

    public function __construct()
    {
          /*$this->conn = DBConnection::getInstance();*/
		  $this->conn = new MysqlConnection();
    }


    public function getProduct($table)
    {     
        return $result =  $this->conn->select($table);
    }


    public function getProductDetail($productId)
    {
		
        $qry = "select p.product_id, p.name, p.description, p.color, p.size,pe.image_path from products p inner join product_images pe where p.product_id=pe.product_id AND p.product_id=$productId";
        $res = $this->conn->executeQuery($qry);
        $products = array();
        if (($row = mysql_fetch_assoc($res))) {
            $products = $row;
        }
        mysql_free_result($res);
        return $products;
    }
	public function getRelatedImages($productId)
    {
        $qry = "select id,image_path from product_images where product_id=$productId";
        $res = $this->conn->executeQuery($qry);
        $images = array();
		$counter=0;
        while (($row = mysql_fetch_assoc($res))) {
			$images['id'][$counter] = $row['id'];
            $images['image_path'][$counter] = $row['image_path'];
			$counter++;
        }
        mysql_free_result($res);
        return $images;
    }



  /*  public function getSuppliersForEmployee($employeeId)
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
*/


    public function insertProduct($arrProd)
    {   
        //insert products        		
        $affectedRows = $this->conn->insert('products',$arrProd);
        
        if ($affectedRows > 0) {
            $productId = $this->conn->getLastInsertId();
            return $productId;
        }
        else {
            throw new Exception("Could not insert employee");
        }
    }
	public function insertRelatedImages($arrImages, $productId)
	{	$this->conn->deleteById('product_images', 'product_id', $productId);
		foreach($arrImages as $k=> $image){
			$arrImages = array( "product_id"=>$productId, "image_path"=>$image );
			$result = $this->conn->insert('product_images', $arrImages);
		} 
	}

    public function updateProduct($productId, $arrProd, $arrImages)
    {
        //update employee info
		$this->conn->updateData('products', 'product_id', $productId, $arrProd);
    }

    public function deleteProduct($table, $idName, $idValue)
    {
        $this->conn->deleteById($table, $idName, $idValue);
    }
	


    public function __destruct()
    {
        $this->conn->close();
    }
	
}
