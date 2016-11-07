<nav>
  <a href="index.php">home</a>
  <a href="index.php?page=contact">contact form</a>
  <a href="index.php?page=products">products</a>
</nav>

<div class="basket">
  <a href="<?php echo url::to('basket'); ?>">In the basket</a>: <?php echo $basket_count.($basket_count==1?' item':' items'); ?> (<?php echo $basket_price; ?> &euro;)
</div>