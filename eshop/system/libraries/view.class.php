<?php

class view
{
  public static function smarty()
  {
    $smarty = new Smarty();

    $smarty->setTemplateDir(config::get('smarty_template_dir'));
    $smarty->setCompileDir(config::get('smarty_compile_dir'));
    $smarty->setConfigDir(config::get('smarty_config_dir'));
    $smarty->setCacheDir(config::get('smarty_cache_dir'));
    
    return $smarty;
  }

  protected $template_name = null;

  protected $template_variables = array();

  public function __construct($template_name)
  {
    $this->template_name = $template_name;
  }

  public function __toString()
  {
    return $this->render(false);
  }

  public function render($print = true)
  {
    $rendered_content = $this->getRenderedContent();

    if($print)
    {
      echo $rendered_content;
    }
    else
    {
      return $rendered_content;
    }
  }

  protected function getRenderedContent()
  {
    ob_start();

    extract($this->template_variables);
    
    include(VIEWS_DIR . '/' . $this->template_name . '.php');

    // return the contents of the right template based on $this->template_name
    return ob_get_clean();
  }

  public function __set($name, $value)
  {
    $this->template_variables[$name] = $value;
  }

  public function __get($name)
  {
    if(array_key_exists($name, $this->template_variables))
    {
      return $this->template_variables[$name];
    }
    $trace = debug_backtrace();
    trigger_error(
        'Undefined property via __get(): ' . $name .
        ' in ' . $trace[0]['file'] .
        ' on line ' . $trace[0]['line'],
        E_USER_NOTICE);
  }

  public function __isset($name)
  {
    return isset($this->template_variables[$name]);
  }

  public function __unset($name)
  {
    unset($this->template_variables[$name]);
  }


}