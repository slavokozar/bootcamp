<div id="product_detail">
  <h1><?php echo $title; ?></h1>

  <div class="description">
    <?php echo $product['description']; ?>
  </div>

  <input type="hidden" id="product-id" 
      value="<?php echo $product['id']; ?>">

  <div class="order">
    <form id="product-order" action="" method="POST">
      <input type="submit" value="Order" name="order" />
      <input type="text" value="1" name="amount" />
      * <?php echo $product['price']; ?> &euro;
    </form>
  </div>

  <div class="rating-avg"></div>
  <div class="rating">
    <img data-rating="1" width="20px" src="http://images.clipartpanda.com/clipart-star-RTA9RqzTL.png"/>
    <img data-rating="2" width="20px" src="http://images.clipartpanda.com/clipart-star-RTA9RqzTL.png"/>
    <img data-rating="3" width="20px" src="http://images.clipartpanda.com/clipart-star-RTA9RqzTL.png"/>
    <img data-rating="4" width="20px" src="http://images.clipartpanda.com/clipart-star-RTA9RqzTL.png"/>
    <img data-rating="5" width="20px" src="http://images.clipartpanda.com/clipart-star-RTA9RqzTL.png"/>
  </div>  
</div>