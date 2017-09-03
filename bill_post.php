<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$errors = "";
//continue if DB does not fail
if(isset($_SESSION["totalValue"])) {
$totalValue = $_SESSION["totalValue"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if ($_POST['name'] != "") {

$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

 if ($_POST['name'] == "") {
                $errors .= 'Please enter a valid name.<br/><br/>';
            }
        } else {
            $errors .= 'Please enter your name.<br/>';
        }
 if ($_POST['email'] != "") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors .= "$email is <strong>NOT</strong> a valid email address.<br/><br/>";
            }
        } else {
            $errors .= 'Please enter your email address.<br/>';
        }
if($_POST['mobile'] !="") {
        	$number = $_POST['mobile'];
        	$value = preg_match('/^[0-9]{10}+$/', $number); 
        	if($value == 0) {
        		$errors .= 'Enter valid 10 digit number.<br/>';
        	}
        }
        else {
        	$errors .= 'Enter valid 10 digit number.<br/>';
        }
        if(!$errors) {
$resultValue = $db_handle->runQuery("INSERT INTO Customer(firstName,email,mobile) VALUES ('$name','$email','$number')");
if($resultValue === false) {
    // Handle failure - log the error, notify administrator, etc.
    echo "Customer Insert Error,Try Again";
}
else {
$user_id = $db_handle->mysql();
if(isset($_SESSION["cart_item"])){
foreach ($_SESSION["cart_item"] as $item){
$itemName = $item["name"];

$Code = $item["code"];
$price = $item["price"];
$qty = $item["quantity"];
$resultValue1 = $db_handle->runQuery("INSERT INTO Orders(C_Id,name,code,price,totalprice,qty) VALUES ('$user_id','$itemName','$Code','$price','$totalValue','$qty')");
}
if($resultValue1 === false) {
    // Handle failure - log the error, notify administrator, etc.
    echo "Order Insert Error,Try Again";
}
else {
    session_destroy();
	echo '<meta http-equiv="refresh" content="0;URL=confirm.html" />';
	
}
}
else {
  echo "No order has been placed please go back";
}
}
}
else {
            echo '<div style="color: red">' . $errors . '<br/></div>';
        }
        }
        else {
            echo '<p>Request Method is not Post</p>';
        }
    }
    else  {
        echo "Total Value Not Set";
    }
?>