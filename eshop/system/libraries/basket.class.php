<?php

class basket
{
  protected static $items = null; // null = nevybrano z cookie

  public static function loadCookie()
  {
    if(self::$items===null)
    {
      $cookie = isset($_COOKIE['basket'])?$_COOKIE['basket']:null;
      if($cookie) {
        parse_str($cookie, $items);
        self::$items = $items;
      } else {
        self::$items = array();

        self::updateCookie();
      }
    }
  }

  public static function addItem($product_id, $amount, $price)
  {
    self::loadCookie();

    $basket_item = isset(self::$items[$product_id])?self::$items[$product_id]:array();
    
    $basket_item['amount'] = !empty($basket_item['amount'])?$basket_item['amount']+$amount:$amount; 
    $basket_item['price'] = $price;

    self::$items[$product_id] = $basket_item;

    self::updateCookie();
  }

  public static function getItems()
  {
    self::loadCookie();

    return self::$items;
  }

  public static function getProductIds()
  {
    self::loadCookie();

    return array_keys(self::$items);
  }

  protected static function updateCookie()
  {
    setcookie(
      'basket', 
      http_build_query(self::$items), 
      time()+86400*7, 
      "/"
    );
  }

  public static function deleteCookie()
  {
    setcookie(
      'basket', 
      '', 
      1, 
      "/"
    );
    $_COOKIE['basket'] = array();
  }

  public static function countItems()
  { 
    self::loadCookie();

    $count = 0;
    foreach(self::$items as $basket_item)
    {
      if($basket_item['amount'])
      {
        $count++;
      }
    }
    return $count;
  }

  public static function countTotalPrice()
  { 
    self::loadCookie();

    $price = 0.0;
    foreach(self::$items as $basket_item)
    {
      if($basket_item['amount'])
      {
        $price += $basket_item['amount']*$basket_item['price'];
      }
    }

    return $price;
  }

}