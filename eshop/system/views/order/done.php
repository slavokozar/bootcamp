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
  <h1>All done!</h1>
</div>