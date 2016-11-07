<?php

class order_controller
{
  public function run()
  {
    return 'ads';
    $customer = array(
      'name' => '',
      'address' => ''
    );
    $user_email = '';
    $messages = array();

    $product_ids = basket::getProductIds();
    $basket_items = basket::getItems();


    if(request::post('customer'))
    {
      $customer = array_merge($customer, request::post('customer'));
    }
    if(request::post('user_email'))
    {
      $user_email = request::post('user_email');
    }

    $step = 'customer';
    if(request::post('register'))
    {
      $valid = true;
      // recap 
      if(!strlen(trim($customer['name'])))
      {
        $messages['error'][] = 'Customer name must not be empty';
        $valid = false;
      }
      if(!strlen(trim($user_email)))
      {
        $messages['error'][] = 'Customer email must not be empty';
        $valid = false;
      }
      if(!strlen(trim($customer['address'])))
      {
        $messages['error'][] = 'Customer address must not be empty';
        $valid = false;
      }

      if(!$valid)
      {
        $step = 'customer';
      }
      else
      {
        $step = 'recap';
      }
    }
    elseif(request::post('submit'))
    {
      // create a user
      $query = "
        INSERT INTO `user`
        (`username`, `email`)
        VALUES
        (:email, :email)
      ";
      $substitutions = array(
        ':email' => $user_email
      );
      db::execute($query, $substitutions);
      $user_id = db::pdo()->lastInsertId();

      // create customer
      $query = "
        INSERT INTO `customer`
        (`name`, `address`, `user_id`)
        VALUES
        (:name, :address, :user_id)
      ";
      $substitutions = array(
        ':name' => $customer['name'],
        ':address' => $customer['address'],
        ':user_id' => $user_id
      );
      db::execute($query, $substitutions);
      $customer_id = db::pdo()->lastInsertId();

      // create order
      $total_price = 0;
      foreach($basket_items as $product_id => $item)
      {
        $total_price += $item['amount'] * $item['price'];
      }
      $query = "
        INSERT INTO `order`
        (`customer_id`, `ordered_at`, `total_price`)
        VALUES
        (:customer_id, :ordered_at, :total_price)
      ";
      $substitutions = array(
        ':customer_id' => $customer_id,
        ':ordered_at' => date('Y-m-d H:i:s'),
        ':total_price' => $total_price
      );
      db::execute($query, $substitutions);
      $order_id = db::pdo()->lastInsertId();

      foreach($basket_items as $product_id => $item)
      {
        $query = "
          INSERT INTO `order_has_product`
          (`order_id`, `product_id`, `amount`, `unit_price`)
          VALUES
          (:order_id, :product_id, :amount, :unit_price)
        ";
        $substitutions = array(
          ':order_id' => $order_id,
          ':product_id' => $product_id,
          ':amount' => $item['amount'],
          ':unit_price' => $item['price']
        );
        db::execute($query, $substitutions);
      }

      $messages['success'][] = 'Order has been placed. Thank you for your business.';
      $step = 'done';

      basket::deleteCookie();
    }

    if($step == 'customer')
    {
      // customer
      $content = new view('order/customer');
      $content->customer = $customer;
      $content->user_email = $user_email;
      $content->messages = $messages;
    }
    elseif($step == 'recap')
    {
      // recap
      $content = new view('order/recap');
      $content->customer = $customer;
      $content->user_email = $user_email;
      $content->messages = $messages;

      $product_ids = basket::getProductIds();

      $product_model = model::get('product');
      $content->items = $basket_items;
      $content->products = $product_model->getProductsByIds($product_ids);
    }
    elseif($step == 'done')
    {
      $content = new view('order/done');
    }

    presenter::present($content);
  }
}