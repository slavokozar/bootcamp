<?php

require_once('eshop_user.object.php');

class eshop_user_model
{
  public function retrieveById($id)
  {
    $stmt = db::pdo()->prepare("
      SELECT `eshop_user`.*
      FROM `eshop_user`
      WHERE `eshop_user`.`id` = :user_id
    ");
    if(!$stmt->execute(array(
      ':user_id' => $id
    ))) {
      var_dump($stmt->errorInfo());
    }
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'eshop_user_object');

    return $stmt->fetch(); 
  }
}