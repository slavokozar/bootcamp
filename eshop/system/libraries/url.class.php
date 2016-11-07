<?php

class url
{
  public static function to($page_name = '', $params = array())
  {
    $qs = http_build_query(array_merge($page_name?array('page' => $page_name):array(), $params));
    return config::get('url_base').($qs?'?'.$qs:'');
  }


  public static function redirect($url, $code = 302)
  {
    $real_url = url::to($url);
  
    if($code == 'refresh')
		{
			header('Refresh: 0; url='.$url);
		}
		else
		{
			$codes = array
			(
				'301' => 'Moved Permanently',
				'302' => 'Found',
				'303' => 'See Other',
				'304' => 'Not Modified',
				'305' => 'Use Proxy',
				'307' => 'Temporary Redirect'
			);

			$code = isset($codes[$code]) ? $code : '302';

			header('HTTP/1.1 '.$code.' '.$codes[$code]);
			header('Location: '.$url);
		}

		exit('<h1>'.$code.' - '.$codes[$code].'</h1><p><a href="'.$url.'">'.$url.'</a></p>');
  }
}