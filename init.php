<?php

function __autoload($class_name) {
  //diretorios
  $directorys = array(
      '',
      'classes/'
  );

  foreach ($directorys as $directory) {
    if (file_exists($directory . $class_name . '.php')) {
      require_once($directory . $class_name . '.php');
      return;
    }
  }
}

$database = new Database();
$db = & $database;
