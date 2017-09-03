<?php
session_start();
if(isset($_SESSION["cart_item"])) {
  $flag = 1;
}else {
  $flag = 0;
}
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Order Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
  }
  </style>
</head>
<body>
<div class="jumbotron text-center">
  <h1>Order Cart</h1>
</div>
<div class ="container">
<?php
if(isset($_SESSION["cart_item"])){
    $count_php = count($_SESSION["cart_item"]);
    $item_total = 0;
?>  
<div class ="container">
 <legend>Order Cart</legend>
           <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Order summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                                <tr>
                      <td ><strong>Item Name</strong></td>
                      <td class="text-center"><strong> Code</strong></td>
                      <td class="text-center"><strong>Quantity</strong></td>
                      <td class="text-center"><strong>Price</strong></td>
                </thead>
                <tbody>
<?php   
    foreach ($_SESSION["cart_item"] as $item){
    ?>
        <tr>
        <td  id ="itemName"><strong><?php echo $item["name"]; ?></strong></td>
        <td class="text-center" id ="code"><?php echo $item["code"]; ?></td>
        <td class="text-center" id ="Quantity"><?php echo $item["quantity"]; ?></td>
        <td class="text-center" id ="price"><?php echo "₹".$item["price"]; ?></td>
        </tr>
        <?php
        $item_total += ($item["price"]*$item["quantity"]);
    }
    ?>

</tbody>
</table> 
<h3>Total : <span class="label label-danger"><?php echo "₹".$item_total; ?></span></h3>
 </div>
          </div>
        </div>
      </div>
  </div>  
  </div>
  <?php
}
?>
   <legend>Customer Details</legend>
<form action ="bill_post.php" method ="post" name="bill">
  <div class="form-group">
    <label for="Name">Full Name</label>
    <input type="text" class="form-control" name ="name" id="fname" aria-describedby="" placeholder="Enter First Name" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your personal details with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="Email1">Email address</label>
    <input name = "email" type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email" required>
  </div>
   <div class="form-group">
    <label for="">Mobile</label>
    <input name = "mobile" type="number" class="form-control" id="mobile1" aria-describedby="phone" placeholder="Enter mobile number"  required>
  </div>
   <hr/>
   <legend>Payment Options</legend>
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="optionsRadios" id="cash" value="Pick-Up" checked>
        By Cash (Pick up from address mentioned below, call +91 9663387103 for any help.)
      </label>
    </div>
    <hr/>
      <fieldset class="form-group">
    <legend>Delivery Details (Delivery Only In Bangalore, Only pick up available)</legend>
    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="optionsRadios" id="Pick-Up" value="Pick-Up" checked>
        Pick Up (Address - No 12 Gurukrupa, Cunnigham Road, Opposite Le meridian staff gate, Bangalore - 560052)
      </label>
    <div id="googleMap" style="height:400px;width:100%;"></div>
      <hr/>
  <div class="form-check">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name ="terms" checked>
       I Agree to the terms and conditions
    </label>
  </div>
  <hr/>
  <input type="submit" class="btn btn-danger" id="orderFinal"  onclick=" return validateForm()"/>
</form>
</div>
<script>
function validateForm() {
   var name = document.forms["bill"]["name"].value;
   var email = document.forms["bill"]["email"].value;
   var mobile  = document.forms["bill"]["mobile"].value;
  var javaScriptVar = "<?php echo $flag; ?>";

  if (javaScriptVar == 0) {
    alert("Go back and place order");
    return false;
  }

  if (name == null || name == "" || name.length < 5 ) {
        alert("Name must be filled out or check the length");
        return false; 
      }
  if (email == null || email == "") {
        alert("email must be filled out");
        return false;
      }
    else {
       var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(email) == false) {
         alert("Not a valid e-mail address");
         return false;
     }
    }
  if (mobile == null || mobile == "") {
        alert("mobile must be filled out OR check if you entered text instead");
        return false;
    }
    else {
  if (/^\d{10}$/.test(mobile) &&  (mobile.value != "")) {
    // value is ok, use it
    }
    else {
      alert("Enter 10 Digits Please");
      return false;
    }
    }   
  if (document.getElementById("cash").checked == false) {
    alert("Choose a payment method");
    return false;
  }  
  if (document.getElementById("terms").checked == false) {
    alert("Please Accept The terms and Conditions");
    return false;
  } 
}
</script>
<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN11Owl9qLgm-3er5UGMeLrmFI6nwR7Bg"></script>
<script>
var myCenter = new google.maps.LatLng(12.990976,77.5868226);
function initialize() {
var mapProp = {
  center:myCenter,
  zoom:12,
  scrollwheel:false,
  draggable:false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>


