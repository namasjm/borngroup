// JavaScript Document
$(document).ready(function(){
    showAjaxLoader();
	$.ajax({url: "item.php", success: function(result){
        $(".shopping_cart_display").html(result);
    }});
	
	$('.add_product').on('click', function (e) {
		showAjaxLoader();
	    var productCode = $(this).attr('id');
        $.ajax({url:  'item.php?action=addProduct',data: { productCode: productCode},success: function (result) {
                    $(".shopping_cart_display").html(result);
            },           
        });
    });	
	
	$('.clear_shopping_cart').on('click', function (e) {
		showAjaxLoader();
        $.ajax({url:  'item.php?action=clearCart',data: {},success: function (result) {
                    $(".shopping_cart_display").html(result);
            },           
        });
    });
	
	function showAjaxLoader() {
		$(".shopping_cart_display").html('<img src="images/loader.gif" id="loading-indicator" />');	
	}	
});	