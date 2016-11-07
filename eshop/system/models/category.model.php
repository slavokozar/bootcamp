<?php

require_once('eshop_category.object.php');

class eshop_category_model
{
  public function retrieveById($id)
  {
    $stmt = db::pdo()->prepare("
      SELECT `eshop_category`.*
      FROM `eshop_category`
      WHERE `eshop_category`.`id` = :id
    ");
    if(!$stmt->execute(array(
      ':id' => $id
    ))) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'eshop_category_object');

    return $stmt->fetch(); 
  }

  public function getCategories()
  {
    $stmt = db::pdo()->prepare("
      SELECT `eshop_category`.*
      FROM `eshop_category`
      WHERE 1
      ORDER BY `eshop_category`.`name` ASC
    ");
    if(!$stmt->execute()) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'eshop_category_object');
    
    $categories = array();
    foreach($stmt as $row)
    {
      $categories[$row->id] = $row;
    }
    return $categories; 
  }
}