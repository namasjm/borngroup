<!DOCTYPE html>
<html lang="en">
<head>
  <title>BornGroup - Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/product.js" language="javascript"></script>
</head>
<body>
<?php
include 'config/Product.php';
$productInstance = new Product();
?>
<div class="container">
  <h2>Products</h2><hr />
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Unit Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     <?php foreach ($productInstance->getProductDetails() as $product_code => $productInfo): ?>
            <tr>							
                <td><?php echo $productInfo['product_name']; ?></td>
                <td><p><?php echo $productInfo['product_price']; ?></p></td>
                <td><button type="button" class="btn btn-primary add_product" id="<?php echo $productInfo['product_code']; ?>">Add</button></td>
            </tr>
     <?php endforeach; ?>		
    </tbody>
  </table>
  <hr /><h2>Shopping Cart <button type="button" class="btn btn-info clear_shopping_cart">Clear All</button> </h2><hr />
  <div class="shopping_cart_display"></div>
</div>
</body>
</html>