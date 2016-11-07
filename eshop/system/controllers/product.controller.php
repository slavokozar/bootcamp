<?php

class product_controller
{
  public function run()
  {
    $product_id = !empty($_GET['product_id'])?$_GET['product_id']:null;

    $content = new view('product/detail');
    $content->title = 'Product detail';

    $product_model = model::get('product');
    $content->product = $product_model->retrieveById($product_id);

    if(!empty($_POST['order']))
    {
      $amount = isset($_POST['amount'])?(float)$_POST['amount']:0;
      if($amount > 0)
      {
        basket::addItem($content->product['id'], $amount, $content->product['price']);
      }  
    }

    if($content->product)
    {
      $content->title = $content->product['name'];
    }

    presenter::present($content);
  }
}