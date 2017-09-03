<?php
session_start();
$_SESSION["totalValue"] = "";
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["action"])) {
switch($_POST["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_POST["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_POST["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;		
}
}
?>

<?php
if(isset($_SESSION["cart_item"])){
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
                      <td><strong>Item Name</strong></td>
                      <td class="text-center"><strong>Code</strong></td>
                      <td class="text-center"><strong>Quantity</strong></td>
                      <td class="text-center"><strong>Price</strong></td>
                </thead>
                <tbody>
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td class="text-center" id ="itemName"><strong><?php echo $item["name"]; ?></strong></td>
				<td class="text-center" id ="code"><?php echo $item["code"]; ?></td>
				<td class="text-center" id ="Quantity"><?php echo $item["quantity"]; ?></td>
				<td class="text-center" id ="price"><?php echo "₹".$item["price"]; ?></td>
				<td class="text-center"><a  onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="text-center" >Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		$_SESSION["totalValue"] = $item_total;
		?>
</tbody>
</table>
<h4>Total : <span class="label label-danger"><?php echo "₹".$item_total; ?></span></h4>
 </div>
          </div>
        </div>
      </div>
  </div>	
  </div>
  <?php
}
?>
