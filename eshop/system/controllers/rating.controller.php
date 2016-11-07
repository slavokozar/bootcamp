<?php

class rating_controller
{
  public function run()
  {
    error_reporting(-1);
    ini_set('display_errors', 'On');






    $product_id = $_POST['product_id'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $rating = $_POST['rating'];

    $query = "
      INSERT INTO `product_rating`
      (`product_id`, `ip`, `rating`)
      VALUES
      (:product_id, :ip, :rating)
    ";
    
    $substitutions = array(
      ':product_id' => $product_id,
      ':ip' => $ip,
      ':rating' => $rating
    );

    db::execute($query, $substitutions);

      
    $query = "
    SELECT `rating` FROM `product_rating`
    WHERE `product_id` = :product_id";
    
    $substitutions = array(
      ':product_id' => $product_id
    );

    $results = db::execute($query, $substitutions);


    $i = 0;    
    $sum = 0;

    while($row = $results->fetch()){
      $sum += $row['rating'];
      $i++;
    }
    
    $result = [];
    $result['average'] = ($sum / $i);
    $result['anything'] = "any other value";
    echo json_encode($result);
  }
}