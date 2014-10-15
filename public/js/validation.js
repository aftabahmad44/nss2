$(document).ready(function() {
    var form = $("#employeeDetail");
    var name = $("#name");
    var nameInfo = $("#nameInfo");
    var email = $("#email");
    var emailInfo = $("#emailInfo");
    var zip = $("#zip");
    var zipInfo = $("#zipInfo");
    var basicSalary = $("#basic_salary");
    var basicSalaryInfo = $("#basicSalaryInfo");
    
    name.blur(validateName);
    email.blur(validateEmail);
    zip.blur(validateZip);
    name.keyup(validateName);
    email.keyup(validateEmail);
    zip.keyup(validateZip);
    basicSalary.blur(validateBasicSalary).keyup(validateBasicSalary);
    
    form.submit(function() {

        if (validateName() & validateEmail() & validateZip())
            return true;
        else
            return false;
    });


    function validateEmail() {

        var a = $("#email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;

        if (filter.test(a)) {
            email.removeClass("error");
            emailInfo.text("email address is valid");
            emailInfo.removeClass("error");
            return true;
        }

        else {
            email.addClass("error");
            emailInfo.text("Please insert a valid email address..");
            emailInfo.addClass("error");
            return false;
        }
    }

    function validateName() {

        if (name.val() == "") {
            name.addClass("error");
            nameInfo.text("Please insert your name");
            nameInfo.addClass("error");
            return false;
        }

        else {
            name.removeClass("error");
            nameInfo.text("Name is valid");
            nameInfo.removeClass("error");
            return true;
        }
    }


    function validateZip() {
        var z = $("#zip").val();
        var filter = /^[0-9]+(-[0-9]+)*$/;
        if (filter.test(z)) {
            zip.removeClass("error");
            zipInfo.text("Valid");
            zipInfo.removeClass("error");
            return true;


        }
        else {
            zip.addClass("error");
            zipInfo.text("Please insert a valid zip code...");
            zipInfo.addClass("error");
            return false;
        }


    }

    function validateBasicSalary(){
        var ret =  !isNaN(basicSalary.val());
        if(ret){
            basicSalary.removeClass("error");
            basicSalaryInfo.removeClass("error").html("Valid");
        }
        else{
            basicSalary.addClass("error");
            basicSalaryInfo.addClass("error").html("Numeric value only");
        }
        return ret;
    }


});