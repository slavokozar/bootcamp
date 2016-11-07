<?php

require_once('product.object.php');

class product_model
{
  public function retrieveById($id)
  {
    $stmt = db::pdo()->prepare("
      SELECT `product`.*
      FROM `product`
      WHERE `product`.`id` = :id
    ");
    if(!$stmt->execute(array(
      ':id' => $id
    ))) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'product_object');

    return $stmt->fetch(); 
  }

  public function getTopProducts()
  {
    $stmt = db::pdo()->prepare("
      SELECT `product`.*
      FROM `product`
      WHERE `product`.`is_top` = 1
    ");
    if(!$stmt->execute()) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'product_object');

    $products = array();
    foreach($stmt as $row)
    {
      $products[$row['id']] = $row;
    }
    return $products; 
  }

  public function getProducts($category_id)
  {
    if($category_id)
    {
      $stmt = db::pdo()->prepare("
        SELECT `product`.*
        FROM `category_has_product`
        LEFT JOIN `product`
          ON `category_has_product`.`product_id` = `product`.`id`
        WHERE `category_has_product`.`category_id` = :category_id
        ORDER BY `product`.`id` DESC
      ");
      $params = array(
        ':category_id' => $category_id
      );
    }
    else
    {
      $stmt = db::pdo()->prepare("
        SELECT `product`.*
        FROM `product`
        WHERE 1
        ORDER BY `product`.`id` DESC
      ");
      $params = array();
    }
    if(!$stmt->execute($params)) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'product_object');
    
    $products = array();
    foreach($stmt as $row)
    {
      $products[$row['id']] = $row;
    }
    return $products; 
  }

  public function getProductsByIds($product_ids)
  {
    $product_ids = array_map('intval', $product_ids);
    if(!$product_ids) return array();

    $stmt = db::pdo()->prepare("
      SELECT `product`.*
      FROM `product`
      WHERE `product`.`id` IN (".join(", ", $product_ids).")
      ORDER BY `product`.`id` DESC
    ");
    $params = array();
    if(!$stmt->execute($params)) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'product_object');
    
    $products = array();
    foreach($stmt as $row)
    {
      $products[$row['id']] = $row;
    }
    return $products; 
  }
}