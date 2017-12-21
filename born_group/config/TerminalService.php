<?php
/**
 * Class for Managing Shopping Cart
 * 
 * @author Namas JM <namasjm@gmail.com>
 */
class TerminalService{ 
	
	/**
     * Currency
     * 
     * @var type 
     */
	public $currency = '$';
	
	/**
     * Product Qty
     * 
     * @var type 
     */
	private $addedQty = 1;
	
	/**
     * Constructor
     * 
     */
    public function __construct() {
		session_start();
        $this->productObj   = new Product();
    } // end: function __construct
	
	/**
     * Add/Update Items on ShoppingCart
     * 
     * @param $productCode
	 * @return array
     */
	public function updateShoppingCart($productCode = '') { 

		$product = $this->productObj->getProductInfoByCode($productCode);
		$cartItems = !empty($_SESSION['cartItems']) ?  $_SESSION['cartItems'] : "";
			
        if (empty($cartItems) || !$this->checkIfProductExists($cartItems, $productCode)) {
			$cartItems = $this->addItemInCart($cartItems, $productCode);	
        } else {
			$cartItems = $this->UpdateItemInCart($cartItems, $productCode);
        } // end: if
		
		$_SESSION['cartItems'] = $cartItems;
		return $cartItems; 
		
	}// end: function updateShoppingCart
	
	
	/**
     * Add Product into Cart
     * 
     * @param array $cartItems
     * @param type $productCode
     */
    public function addItemInCart($cartItems=array(), $productCode) {
        
		$product = $this->productObj->getProductInfoByCode($productCode); // Get Product Info
		
		if($product) { 
			$item = array(
				'product_id' => $product['product_id'],
				'product_code' => $product['product_code'],
				'product_name' => $product['product_name'],
				'qty' => $this->addedQty,
				'price' => $product['product_price'],
				'rowtotal' => $tierPrice
			);
			$item['rowtotal'] = $this->productObj->getTierPrice($item);
			$cartItems[] = $item;	
		}
		return $cartItems;
		
    } // end: function addItemInCart
	
    
     /**
     * Update Cart for Existing Added Product
     * 
     * @param type $cartItems
     * @param type $productCode
     * 
     */
    public function UpdateItemInCart($cartItems, $productCode) {
		
		if($cartItems) {
			foreach($cartItems as &$item) {
				if($item['product_code'] == $productCode) {
					$item['qty']      = $item['qty'] + $this->addedQty;
					$item['rowtotal'] = $this->productObj->getTierPrice($item);
					break;
				} // end: if
       		 } // end: foreach
		}
		return $cartItems;

    } // end: function UpdateItemInCart
	
   
	/**
     * Clear Cart Session
     * 
     *@return type
     */
    public function removeCartItems() {
		
       $sessionKeys = array_keys($_SESSION);
		foreach ($sessionKeys as $key){
			unset($_SESSION[$key]);
		}
		
    } // end: function removeCartItems
	
	/**
     * Check If Product is already added in Cart
     * 
     * @param $productCode
	 * @param $cartItems
	 * @return boolean
     */
	public function checkIfProductExists($cartItems, $productCode) {
		
		$response = false;
        foreach($cartItems as $item) {
            if($item['product_code'] == $productCode) {
                $cartItem = true;
                break;
            } // end: if
        } // end: foreach
        
        return $cartItem;
		
	}// end: function checkIfProductExists
	
	 /**
     * Get Cat Items
     * 
     * @param
	 * @return Array
     */
    public function getCartItems(){
		
		return !empty($_SESSION['cartItems']) ?  $_SESSION['cartItems'] : "";
		
	}// end: function getCartItems	
}