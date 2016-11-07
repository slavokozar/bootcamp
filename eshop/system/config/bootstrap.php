<?php

define('SYSTEM_DIR', DOCROOT.'/system');
// cache - for cached files, generated by the script itself
define('CACHE_DIR', SYSTEM_DIR.'/cache');
// config - for our project configuration
define('CONFIG_DIR', SYSTEM_DIR.'/config');
// controllers - for our page controllers
define('CONTROLLERS_DIR', SYSTEM_DIR.'/controllers');
// libraries - for all globally usable classes
define('LIBRARIES_DIR', SYSTEM_DIR.'/libraries');
// models - for classes that handle the database communication
define('MODELS_DIR', SYSTEM_DIR.'/models');
// vendor - for libraries included from 3rd party vendors
define('VENDOR_DIR', SYSTEM_DIR.'/vendor');
// views - for our templates
define('VIEWS_DIR', SYSTEM_DIR.'/views');


// LIBS
$libs = scandir(LIBRARIES_DIR);
foreach($libs as $file)
{
  if($file == '.' || $file == '..') continue;
  if(is_file(LIBRARIES_DIR.'/'.$file))
  {
    require_once(LIBRARIES_DIR.'/'.$file);
  }
}


// MODELS
$models = scandir(MODELS_DIR);
foreach($models as $file)
{
  if($file == '.' || $file == '..') continue;
  if(is_file(LIBRARIES_DIR.'/'.$file))
  {
    require_once(MODELS_DIR.'/'.$file);
  }
}


// load the configuration of our project
config::load();

