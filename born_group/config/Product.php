<?php
/**
 * Product Configuration
 * 
 * @author Namas JM <namasjm@gmail.com>
 */
Class Product {
    /**
     * Get the Product Details
     * 
     * @return array
     */
    public function getProductDetails() {
        
        $returnValue = array(
           'A' => array('product_name' => 'Item A', 'product_id'  => 1, 'product_code' => 'A', 'product_price'  => 2,'tier_qty'	=> 4,'tier_price'	=> 7),
		   'B' => array('product_name'  => 'Item B', 'product_id'  => 2, 'product_code' => 'B', 'product_price'  => 12),
		   'C' => array('product_name'  => 'Item C', 'product_id'  => 3, 'product_code' => 'C', 'product_price'  => 1.25,'tier_qty'	=> 6,'tier_price'	=> 6),
		   'D' => array('product_name'  => 'Item D', 'product_id'  => 4, 'product_code' => 'D', 'product_price'  => 0.15)
		);       
        
        return $returnValue;
    } // end: function getProductDetails
	
    
	/**
     * Calculating Tier Price
     * 
     * @param type $item
     * @return type
     */
    public function getTierPrice($item) {
		
        $productInfo  = $this->getProductInfoByCode($item['product_code']);
		$tierPrice =  $productInfo['tier_price']; // Tier Price of Product
		$tierQty =  $productInfo['tier_qty']; 
			
		if(!empty($tierQty)) {
			$rowtotal = ( floor($item['qty'] / $tierQty) * $tierPrice ) + (($item['qty'] % $tierQty) * $item['price']);
		} else {
			$rowtotal = $item['qty'] * $item['price'];
		}// end: if
        return $rowtotal;
		
    } // end: function getTierPrice
	
	 /**
     * Get Product info Based on Code
     * 
     * @return array
     */
    public function getProductInfoByCode($productCode) {
		
        $products = $this->getProductDetails();
        return $products[$productCode];
    
	} // end: function getProductInfoByCode
}