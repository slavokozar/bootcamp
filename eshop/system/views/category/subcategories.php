<h2>Subcategories</h2>
<ul>
<?php foreach($categories as $category) : ?>

  <li>
    <a href="<?php echo url::to('category', array('category_id' => $category['id'])); ?>"><?php echo $category['name']; ?></a>
  </li>

<?php endforeach; ?>
</ul>