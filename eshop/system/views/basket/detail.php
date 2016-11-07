<div id="basket">
  <h1><?php echo $title; ?></h1>

  <ul class="items">
    
    <?php $total = 0; foreach($items as $product_id => $item) : ?>
      <?php if(empty($products[$product_id])) continue; ?>
      <?php $product = $products[$product_id]; ?>
      <?php $total += $item['amount'] * $product['price']; ?>
      <li>
        <a href="<?php echo url::to('product', array('product_id' => $product['id'])); ?>"><?php echo $product['name']; ?></a>
        <span class="amount"><?php echo $item['amount']; ?> x</span>
        <span class="price"><?php echo $product['price']; ?> &euro;</span>
        <span class="total"><?php echo $item['amount'] * $product['price']; ?> &euro;</span>
      </li>

    <?php endforeach; ?>
    <div class="total">
      <strong>Total:</strong><?php echo $total; ?> &euro;
    </div>


  </ul>

  <div class="order">
    <form action="<?php echo url::to('order'); ?>" method="POST">
      <input type="submit" value="Order items" name="order" />
    </form>
  </div>
</div>

 