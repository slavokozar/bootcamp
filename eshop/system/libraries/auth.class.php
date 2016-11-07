<?php

class auth
{
  protected static $session_started = false;

  protected static $user_id = false; // false === not tried yet

  public static function startSession()
  {
    if(!self::$session_started)
    {
      session_name(config::get('session_name'));

      session_set_cookie_params(
        config::get('session_cookie_expiration'),
        config::get('session_cookie_path'),
        config::get('session_cookie_domain')
      );

      session_start();

      $_SESSION['session_id'] = session_id();

      self::$session_started = true;
    }
  }

  public static function getUserId()
  {
    if(self::$user_id===false)
    {
      auth::startSession();

      self::$user_id = (!empty($_SESSION['logged_in']) && !empty($_SESSION['user_id']))?$_SESSION['user_id']:null;
    }
    return self::$user_id;
  }

  public static function login($user_id)
  {
    auth::startSession();

    $_SESSION['logged_in'] = 1;
    
    $_SESSION['user_id'] = 1;
  }
  
  public static function logout()
  {
    auth::startSession();

    $_SESSION['logged_in'] = 0;
    
    unset($_SESSION['user_id']);
  }
}