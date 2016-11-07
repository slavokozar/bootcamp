<?php

class homepage_controller
{

  public function run()
  {
    $homepage = new view('homepage/homepage');


    // TOP PRODUCTS
    $top_products = new view('homepage/top_products');
    $query = "
      SELECT `product`.*
      FROM `product`
      WHERE `product`.`is_top` = 1
      ORDER BY `product`.`name` ASC
    ";
    $results = db::execute($query);
    $top_products->products = $results;
    $homepage->top_products = $top_products;
    

    // CATEGORIES
    $categories_view = new view('homepage/categories');
    $query = "
      SELECT `category`.*
      FROM `category`
      WHERE `category`.`parent_id` IS NULL
      ORDER BY `category`.`name` ASC
    ";
    // select data from database
    $results = db::execute($query);
    // put the data in the view 
    $categories_view->categories = $results;
    // put the view in the homepage view
    $homepage->categories = $categories_view;


    // SHOP INFO
    $shop_info_view = new view('homepage/shop_info');
    $homepage->shop_info = $shop_info_view;

    presenter::present($homepage);
  }

}



?>