<?php
/*include_once('../application/class/SupplierDAL.php');
include_once('class/SupervisorDAL.php');*/

include_once($_SERVER['DOCUMENT_ROOT'].'at_t/application/class/SupervisorDAL.php');

require_once('supervisor_detail.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title>Supervisor Management</title>
	<?php 
	$ROOT = './';
	?>
	<link href="<?php echo CSS_DIR.'style.css'?>" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo JS_DIR.'jquery.js'?>"></script>
    <script type="text/javascript" src="<?php echo JS_DIR.'validation.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#basic_salary").keyup(
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
    <h1>Supervisor Information</h1>

    <form method="post" id="moduleDetail"
          action="supervisor_detail_view.php<?php echo ($isEditing ? "?id=$id" : ""); ?>">
        <div>
            <label for="first_name">First Name:</label>
           <input id="first_name" name="first_name" type="text" value="<?php echo $supervisorDetail['first_name']; ?>"/>
            <span id="nameInfo"></span>
        </div>
		<div>
            <label for="last_name">Last Name:</label>
           <input id="last_name" name="last_name" type="text" value="<?php echo $supervisorDetail['last_name']; ?>"/>
            <span id="nameInfo"></span>
        </div>
        <div>
            <label for="email">E-mail   :  </label>
            <input id="email" name="email" type="text" value="<?php echo $supervisorDetail['Email']; ?>"/>
            <span id="emailInfo"></span>
        </div>

        <div>
            <label for="access">Access</label>
            <textarea id="access" cols="1" rows="1" name="access"><?php echo $supervisorDetail['access']; ?></textarea>
        </div>

        <input id="add" name="add" type="submit" value="<?php echo ($isEditing ? "Update" : "Add"); ?>"/>
    </form>
</div>
</body>
</html>