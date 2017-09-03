<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cashew Crunch Company Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel = "stylesheet" href ="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css">
  <link rel = "stylesheet" href ="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
  <link href="style.css" type="text/css" rel="stylesheet" />
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
      margin: 0 auto;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e;
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
      margin:center;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  .modal-dialog{
position: absolute;
left: 15%;
top:20%;
} 
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    }
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  .rotate90 {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}
  </style>
  <script>
/* cart.js */
function showEditBox(editobj,id) {
  $('#frmAdd').hide();
  $(editobj).prop('disabled','true');
  var currentMessage = $("#message_" + id + " .message-content").html();
  var editMarkUp = '<textarea rows="5" cols="80" id="txtmessage_'+id+'">'+currentMessage+'</textarea><button name="ok" onClick="callCrudAction(\'edit\','+id+')">Save</button><button name="cancel" onClick="cancelEdit(\''+currentMessage+'\','+id+')">Cancel</button>';
  $("#message_" + id + " .message-content").html(editMarkUp);
}
function cancelEdit(message,id) {
  $("#message_" + id + " .message-content").html(message);
  $('#frmAdd').show();
}
function cartAction(action,product_code) {
  var queryString = "";
  if(action != "") {
    switch(action) {
      case "add":
        queryString = 'action='+action+'&code='+ product_code+'&quantity='+$("#qty_"+product_code).val();
      break;
      case "remove":
        queryString = 'action='+action+'&code='+ product_code;
      break;
      case "empty":
        queryString = 'action='+action;
      break;
    }  
  }
  jQuery.ajax({
  url: "ajax_action.php",
  data:queryString,
  type: "POST",
  success:function(data){
    $("#cart-item").html(data);
    if(action != "") {
      switch(action) {
        case "add":
          $("#add_"+product_code).hide();
          $("#added_"+product_code).show();
        break;
        case "remove":
          $("#add_"+product_code).show();
          $("#added_"+product_code).hide();
        break;
        case "empty":
          $(".btnAddAction").show();
          $(".btnAdded").hide();
        break;
      }  
    }
  },
  error:function (){}
  });
}
$(document).ready(function () {
  cartAction('','');
    // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();
      // Store hash
      var hash = this.hash;
      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})</script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#myPage">CC</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#portfolio">PRODUCTS</a></li>
         <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron text-center">
  <h1>Irish Cashew Crunch</h1>
  <p>We specialize in homemade cashew candy</p>
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Us</h2><br>
      <h4>The Irish Cashew Crunch is a delicacy,the recipe of which is a handover from a british couple of yesteryears. Homemade from the finest of ingredients this food product has been sold as a gift, a corparate handout, or a yummy bite. Packed in boxes of 200 grams and 400 grams,the irish cashew crunch can be customed packed as per the requirement. I Nirmala Chhabria invite you to try it...</h4><br>
    </div>
    <div class="col-sm-4">
    <div class = "thumbnail">
      <img src = "nirmala.JPG" class="rotate90">
      </div>
    </div>
  </div>
</div>
<!-- Container (Order Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">
  <h2>Products</h2><br>
  <h4>What we have created</h4>
  <?php
  $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
  if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){
  ?>
    <div class="col-sm-4">
     <div class="thumbnail">
      <form id="frmCart">
     <img src="<?php echo $product_array[$key]["image"]; ?>" class="img-responsive">
      <div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
      <?php echo "₹".$product_array[$key]["price"]; ?>
      <div><input type="text" id="qty_<?php echo $product_array[$key]["code"]; ?>" name="quantity" value="1" size="2" />
      <?php
        $in_session = "0";
        if(!empty($_SESSION["cart_item"])) {
          $session_code_array = array_keys($_SESSION["cart_item"]);
            if(in_array($product_array[$key]["code"],$session_code_array)) {
            $in_session = "1";
            }
        }
      ?>
      <input type="button" id="add_<?php echo $product_array[$key]["code"]; ?>" value="Add to cart" class="btn btn-danger" onClick = "cartAction('add','<?php echo $product_array[$key]["code"]; ?>')" <?php if($in_session != "0") { ?>style="display:none" <?php } ?> />
      <input type="button" id="added_<?php echo $product_array[$key]["code"]; ?>" value="Added" class="btnAdded" <?php if($in_session != "1") { ?>style="display:none" <?php } ?> />
      </div>
      </form>
    </div>
    </div>
  <?php
      }
  }
  ?>
</div>
<div id="portfolio" class="container-fluid text-center bg-grey">
<div id="cart-item"></div>
<hr/>
<form action="order.php" method ="post">
<input  class="btn btn-danger btn-lg"  id ="submitcart" type="submit">
</form>
</div>
<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-white">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p> Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Bangalore,India</p>
      <p><span class="glyphicon glyphicon-phone"></span> +91 9845588002</p>
      <p><span class="glyphicon glyphicon-envelope"></span> saahil.work@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
      <form action = "mail_info.php" method ="post" name ="emailSend" onsubmit="return validateEmail()" >
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name2" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email2" placeholder="Email" type="email" required>
        </div>
      </div>
      <input class="form-control" id="comment" name="comment_name" placeholder="comment" type="text" size ="50" required>
      <div class="row">
        <div class="col-sm-12 form-group">
        <hr/>
             <input type="submit" name="SubmitEmail" class="btn btn-danger" onclick = "return validateEmail()" >
             </form>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>CashewCrunch</p>
</footer>
<script>
function validateEmail() {
  var name1 = document.forms["emailSend"]["name2"].value;
  var email1 = document.forms["emailSend"]["email2"].value;
  var comment  = document.forms["emailSend"]["comment_name"].value;

  if (name1 == null || name1 == "") {
        alert("Name must be filled out");
        return false; 
      }
       if (email1 == null || email1 == "") {
        alert("email must be filled out");
        return false;
      }
    else {
       var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(email1) == false) {
         alert("Not a valid e-mail address");
         return false;
     }
    }
  
  if (comment == null || comment == "") {
        alert("Comment must be filled out");
        return false; 
      }
}
</script>
</body>
</html>


