<?php if(!empty($messages)) : ?>
  <div class="messages">
    <?php foreach($messages as $type => $type_msgs) : ?>
      <?php foreach($type_msgs as $message) : ?>
        <div class="message <?php echo $type; ?>"><?php echo $message; ?></div>
      <?php endforeach; ?>  
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<div id="order">
  <p>Recapitulation</p>

  <h2>Customer</h2>
  <strong>Name:</strong><br />
  <?php echo $customer['name']; ?><br />
  <input type="hidden" name="customer[name]" value="<?php echo $customer['name']; ?>" />
  <strong>Email:</strong><br />
  <input type="hidden" name="customer[email]" value="<?php echo $user_email; ?>" />
  <?php echo $user_email; ?><br />
  <strong>Address:</strong><br />
  <input type="hidden" name="customer[address]" value="<?php echo $customer['address']; ?>" />
  <?php echo $customer['address']; ?><br />

  <h2>Items</h2>
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
  </ul>

  <h2>Amount to pay</h2>
  <div class="total">
    <strong>Total:</strong><?php echo $total; ?> &euro;
  </div>

  <form action="" method="post">
    <input type="submit" name="submit" value="Order" />
  </form>

</div>