<?php

class model
{
  public static function get($model_name)
  {
    require_once(MODELS_DIR.'/'.$model_name.'.model.php');

    $model_class = $model_name.'_model';
    $model = new $model_class;

    return $model;
  }
}