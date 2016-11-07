<?php

class category_controller
{
  public function run()
  {
    $layout = new view('category/layout');

    // we get the category uri from URL
    $category_uri = request::get('category', null);





    // if category uri was found in the URL, try to find that category
    if($category_uri)
    {
      // select the category from the database based on the $category_uri
      $query = "
        SELECT `category`.*
        FROM `category`
        WHERE `category`.`uri` = :category_uri
        LIMIT 1
      ";
      $substitutions = array(
        ':category_uri' => $category_uri
      );
      $result = db::execute($query, $substitutions);
      $category = $result->fetch();
      if(!$category) 
      {
        // end the execution of this controller and display a 404 error
        router::runController('error404');
        return;
      }
    }
    else
    {
      $category = null;
    }






    // prepare the info
    if($category!=null) // if a category was found
    {
      $info_view = new view('category/category_info');
      $info_view->category = $category;
      $layout->category_info = $info_view; // we put the $info_view view into $layout
    }
    else
    {
      // we don't create the category_info view
      // in layout.php we will have to check if $category_info is set
    }






    // subcategories OR top categories
    $subcategories_view = new view('category/subcategories');
    if($category!=null) // if a category was found
    {
      // prepare the SUBcategories query & substitutions
      $query = "
          SELECT `category`.*
          FROM `category`
          WHERE `category`.`parent_id` = :category_id
          ORDER BY `category`.`name` ASC
        ";
        $substitutions = array(
          ':category_id' => $category['id']
        );
    }
    else // if no category was set
    {
      // prepare the TOP categories query & substitutions
      $query = "
          SELECT `category`.*
          FROM `category`
          WHERE `category`.`parent_id` IS NULL
          ORDER BY `category`.`name` ASC
        ";
        $substitutions = array();
    }
    $results = db::execute($query, $substitutions);
    $subcategories_view->categories = $results;
    $layout->subcategories = $subcategories_view;

    // products
    $products_view = new view('category/products');
    if($category!=null) // if a category was found
    {
      $query = "
        SELECT `product`.*
        FROM `category_has_product`
        LEFT JOIN `product`
          ON `category_has_product`.`product_id` = `product`.`id`
        WHERE `category_has_product`.`category_id` = :category_id
          OR `category_has_product`.`category_id` IN (
            SELECT `category`.`id`
            FROM `category`
            WHERE `category`.`parent_id` = :category_id
          )
        ORDER BY `product`.`name` ASC
      ";
      $substitutions = array(
        ':category_id' => $category['id']
      );
    }
    else
    {
      $query = "
        SELECT `product`.*
        FROM `product`
        WHERE 1
        ORDER BY `product`.`name` ASC
      ";
      $substitutions = array();
    }
    $results = db::execute($query, $substitutions);
    $products_view->products = $results->fetchAll();
    $layout->products = $products_view;


    presenter::present($layout);
  }

}