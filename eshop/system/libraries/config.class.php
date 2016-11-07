<?php

class config
{
  public static $data = array();

  public static function load()
  {
    // initialize empty config
    $config = array();

    // include the config file and hope that there is some $config within
    include(CONFIG_DIR.'/config.php');

    // put it in static::$data
    static::$data = $config;  
  }

  public static function get($name, $default = null)
  {
    // if data with name $name exists in static::$data
    if(array_key_exists($name, static::$data))
    {
      return static::$data[$name];
    }
    else
    {
      return $default;
    }
  }
}