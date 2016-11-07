<?php

class request
{
  protected static $original_get = array();
  protected static $original_post = array();

  public static function loadRequest()
  {
    static::$original_get = $_GET;
    static::$original_post = $_POST;
    // will load all the request information into itself
  }

  public static function get($key, $default = null)
  {
    // returns the value from $_GET with the key $key
    // if not present in $_GET, returns $default
    if(isset(static::$original_get[$key]))
    {
      return static::$original_get[$key];
    }
    else
    {
      return $default;
    }    
  }

  public static function post($key, $default = null)
  {
    // returns the value from $_POST with the key $key
    // if not present in $_POST, returns $default
    return isset(static::$original_post[$key]) ? static::$original_post[$key] : $default;
  }

  public static function isPost()
  {
    return ($_SERVER['REQUEST_METHOD']=='POST');
  }


}

