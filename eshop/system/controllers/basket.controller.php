<?php

class basket_controller
{
  public function run()
  {
    $content = new view('basket/detail');
    $content->title = 'Basket';

    $product_ids = basket::getProductIds();

    $product_model = model::get('product');
    $content->items = basket::getItems();
    $content->products = $product_model->getProductsByIds($product_ids);

    presenter::present($content);
  }
}