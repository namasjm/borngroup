<?php
include 'config/Product.php';
$productObj = new Product();

include 'config/TerminalService.php'; 
$terminalServiceObj 	= new TerminalService();

// Get Request Parameter
$action = trim($_REQUEST['action']);
$productCode = trim($_REQUEST['productCode']);


if($action == 'addProduct') {
	$terminalServiceObj->updateShoppingCart($productCode); 
} else if($action == 'clearCart') {
	$terminalServiceObj->removeCartItems(); 
}

$response =  '<table class="table table-striped">';

$cartItems 	= $terminalServiceObj->getCartItems(); // Get Cart Products 
if(!empty($cartItems)) {	
   $response .=  '<thead>
							  <tr class="success">
								<th>Summary View</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Total Price</th>
							  </tr>
							</thead>
							<tbody>';
	
	$totalPrice = 0;
	$currency = $terminalServiceObj->currency; // Currency Symbol

	foreach($cartItems as $key=>$cartInfo) {
		$totalPrice += $cartInfo['rowtotal'];	
		$response .= '<tr>
				<td>'.$cartInfo['product_name'].'</td>
				<td>'.$cartInfo['qty'].'</td>
				<td>'.$currency.$cartInfo['price'].'</td>
				<td>'.$currency.$cartInfo['rowtotal'].'</td>
			  </tr>';
	}
		$response .= '<tr class="success">
				<td colspan="3">&nbsp;</td>
				<td colspan="1">Total : '. $currency.$totalPrice.'</td>
			  </tr>';
} else {
		$response .= '<tr class="danger">
				<td colspan="4" align="center">Shopping Cart is empty !!!...</td>
			  </tr>';
}
  
$response .= '</tbody>
  </table>';

echo $response ;
?>