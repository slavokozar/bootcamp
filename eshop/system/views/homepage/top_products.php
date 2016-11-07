<ul>
  <?php foreach($products as $product) : ?>

    <li>
      <?php echo $product['name']; ?>
      <div class="price"><?php echo $product['price']; ?> Kč</div>
    </li>

  <?php endforeach; ?>
</ul>