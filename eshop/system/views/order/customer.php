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
  <p>Your order is almost ready. Who should we send it to?</p>

  <form action="" method="post">
    <label for="customer_name">Full name:</label><br />
    <input type="text" name="customer[name]" id="customer_name" value="<?php echo $customer['name']; ?>" /><br />
    <label for="user_email">Email:</label><br />
    <input type="text" name="user_email" id="user_email" value="<?php echo $user_email; ?>" /><br />
    <label for="customer_address">Address:</label><br />
    <textarea name="customer[address]" id="customer_address"><?php echo $customer['address']; ?></textarea><br />
    
    <input type="submit" name="register" value="Register" />
  </form>

</div>