<?php

function google_api_autoload($className) 
{
  $classPath = explode('_', $className);

  if ($classPath[0] != 'Google') {
    return;
  }

  if (count($classPath) > 3) {
    $classPath = array_slice($classPath, 0, 3);
  }

  $filePath = dirname(__FILE__) . '/libs/' . implode('/', $classPath) . '.php';
  if (file_exists($filePath)) {
    require_once($filePath);
  }
}

spl_autoload_register('google_api_autoload');
