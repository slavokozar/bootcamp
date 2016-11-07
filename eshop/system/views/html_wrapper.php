<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My eshop</title>

  <link rel="stylesheet" href="css/main.css" />

</head>
<body>

  <?php

  // print the contents of the output buffer
  echo $content;

  ?>


  <script src="js/jquery.min.js"></script>
  <script>
  	$('#filter-price-min').change(function(e){	
  		/*
  		this
  		e.target
  		$('#filter-price-min')
		*/
	
  		validatePrice(this);
  	});

  	$('#filter-price-max').change(function(){
  		validatePrice(this);
  	});

  	$('#filter-price').submit(function(e){
  		e.preventDefault();
  		if(
  			validatePrice($('#filter-price-max')) 
  			&& validatePrice($('#filter-price-min'))
		){
  			alert('Now, we can do filtering');
  			$('#products-list').find('li').each(function(){

				var price = $(this).find('.price').text();
				
				price = price.replace(" €", "");
				price = parseInt(price);

				var price_min = $('#filter-price-min').val();
				var price_max = $('#filter-price-max').val();
				
				if(price < price_min || price > price_max){
					$(this).hide();
				}else{
					$(this).show();
				}
  			});
  		}

  	});

  	function validatePrice(element){
  		var value = $(element).val();

  		
  		if(value == "" || isNaN(value) || value < 0){
  			alert("Use number greater than 0!");
  			$(element).val('');
  			return false;
  		}

  		return true;
  	}
  </script>


  <script>
  	$('#ajax-button').click(function(){

  		$.ajax({
		    'url' : "ajax.php",
		    'type' : "get"
		})
		.done(function(data) {
		    alert( "success " + data );
		})
		.fail(function(jqXHR, textStatus) {
    		alert( "error" );
		})
		.always(function() {
    		alert( "complete" );
		});

  	});

  	var a = 10; 
  	var b = 15;

  	$('#ajax-button2').click(function(){

  		$.ajax({
		    'url' : "ajaxasd.php",
		    'type' : "post",
		    'data' : {
		    	'a' : a,
		    	'b' : b
 		    }
		})
		.done(function(data) {
		    alert( "success " + data );
		})
		.fail(function(jqXHR, textStatus) {
			if(jqXHR.status == 404){
				alert( "Page not found!" );	
			}else{
				alert( "Error!" );	
			}
    		
		})
		.always(function() {
    		alert( "complete" );
		});
  	});

  	$('.rating img').click(function(){
  		// var rating = $(this).prevAll().length + 1;
  	
  		var rating = $(this).data('rating');

  		var product_id = $('#product-id').val();

  		console.log(rating, product_id);

  		$.ajax({
  			'url' : "index.php?page=rating",
  			'type' : "post",
  			'data' : {
  				'rating' : rating,
  				'product_id' : product_id
  			}
  		})
  		.done(function(data){
  			data = JSON.parse(data);
  			console.log(data);
  			$('.rating-avg').text(parseFloat(data.average).toFixed(2));
  		})

  	});

  	$('#product-order').submit(function(e){
  		e.preventDefault();

  		var data = $(this).serialize() + '&order=Order';
  		
  		console.log(data);

  		var action = $(this).attr('action');
  		var method = $(this).attr('method');


		$.ajax({
  			'url' : action,
  			'type' : method,
  			'data' : data
  		});

  	})

  </script>
</body>
</html>