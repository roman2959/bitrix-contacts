<?php

namespace BitrixTestApp;


const DB_HOST       = 'localhost',
      DB_USER       = 'admin',
      DB_PASS       = 'admin',
      DB_NAME       = 'bitrix_contacts',
      DB_CHARSET    = 'utf8mb4';


const BITRIX_WEBHOOK = 'https://b24-bd0l60.bitrix24.ru/rest/1/1n65kjcm6pjd8ga0/';


const MAX_EXECUTION_TIME        = 1200,
      MEMORY_LIMIT              = '256M',
      DISPLAY_ERRORS            = true;


ini_set('max_execution_time', MAX_EXECUTION_TIME);
ini_set('memory_limit', MEMORY_LIMIT);
ini_set('display_errors', DISPLAY_ERRORS);
ini_set('fbsql.generate_warnings', DISPLAY_ERRORS);
ini_set('assert.warning', DISPLAY_ERRORS);
ini_set('html_errors', DISPLAY_ERRORS);
ini_set('display_startup_errors', DISPLAY_ERRORS);
ini_set("error_reporting", \E_ALL);


spl_autoload_register(function($class){
    $class = str_replace(__NAMESPACE__, __DIR__.'/classes', $class);
    $class.= '.php';
    if(file_exists($class))
        include_once $class;
});

require_once __DIR__.'/libraries/composer/vendor/autoload.php';
require_once __DIR__.'/functions.php';
