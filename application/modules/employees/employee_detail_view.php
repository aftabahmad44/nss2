<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/EmployeeDAL.php');*/
include_once(HOST_DIR.'application/class/SupplierDAL.php');
include_once(HOST_DIR.'application/class/EmployeeDAL.php');

require_once('employee_detail.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title>Employee Management</title>
  	<link href="<?php echo CSS_DIR.'style.css'?>" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo JS_DIR.'jquery.js'?>"></script>
    <script type="text/javascript" src="<?php echo JS_DIR.'validation.js'?>"></script>
    <script type="text/javascript">
            $("#basic_salary").keyup(
        $(document).ready(function() {
                    function() {
                        var basic_salary = $("#basic_salary").val();
                        if (isNaN(basic_salary) || basic_salary.length == 0) {
                            $("#houseRent, #allowance, #incomeTax, #netIncome").html("--");
                        }
                        else {
                            $("#houseRent").html(basic_salary * 0.4);
                            $("#allowance").html(basic_salary * 0.2);
                            $("#incomeTax").html(basic_salary * 0.1);
                            var total = basic_salary * 1 + basic_salary * 0.4 + basic_salary * 0.2 + basic_salary * 0.1;
                            $("#netIncome").html(total);
                        }
                        return true;
                    }).trigger("keyup");
        });
    </script>

</head>
<body>
<div id="container">
    <h1>Employee Information</h1>

    <form method="post" id="moduleDetail"
          action="employee_detail_view.php<?php echo ($isEditing ? "?id=$employeeId" : ""); ?>">
        <div>
            <label for="name">Name</label>
           <input id="name" name="name" type="text" value="<?php echo $employeeDetail['Name']; ?>"/>
            <span id="nameInfo"></span>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input id="email" name="email" type="text" value="<?php echo $employeeDetail['Email']; ?>"/>
            <span id="emailInfo"></span>
        </div>
        <div>
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="text" value="<?php echo $employeeDetail['Phone']; ?>"/>
        </div>
        <div>
            <label for="address">Address</label>
            <textarea id="address" cols="1" rows="1" name="address"><?php echo $employeeDetail['Address']; ?></textarea>
        </div>
        <div>
            <label for="zip">Zip</label>
            <input type="text" id="zip" name="zip" value="<?php echo $employeeDetail['Zip']; ?>"/>
            <span id="zipInfo"></span>
        </div>
        <div>

            <label for="basic_salary">Basic Salary</label>
            <input type="text" id="basic_salary" name="basic_salary" value="<?php echo $employeeDetail['Basic']; ?>"/>
            <span id="basicSalaryInfo"></span>
        </div>
        <div>
            <label for="houseRent">House Rent</label>

            <div id="houseRent" class="salary"></div>
            <label for="Allowance">Allowance</label>

            <div id="allowance" class="salary"></div>
            <label for="IncomeTax">Income Tax</label>

            <div id="incomeTax" class="salary"></div>
            <label for="netIncome">Net Income</label>

            <div id="netIncome" class="salary"></div>
        </div>
        <div>
            <label for="grade">Grade</label>
            <input type="text" name="grade" id="grade" value="<?php echo $employeeDetail['Grade']; ?>"/>
        </div>


        <h1>Supplier list</h1>

        <div class="supplier">
<?php
    $supplier_detail = new SupplierDAL();
    $list_suppliers = $supplier_detail->getSuppliers();

    foreach ($list_suppliers as $rows)
    {
        ?>
        <input type="checkbox" name="supplierid[]"
               <?php if(in_array($rows['SupplierID'],$assignedSuppliers)){ ?>
            checked="checked"
            <?php } ?>
               value="<?php echo $rows['SupplierID']; ?>"/> <?php echo $rows['Name']; ?>
        <br/>
        <?php

    }
    ?>
        </div>
        <input id="add" name="add" type="submit" value="<?php echo ($isEditing ? "Update" : "Add"); ?>"/>
    </form>
</div>
</body>
</html>