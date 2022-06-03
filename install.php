<?php

require_once __DIR__.'/app/config.php';

use BitrixTestApp\Database;

use const BitrixTestApp\DB_CHARSET;
use const BitrixTestApp\DB_HOST;
use const BitrixTestApp\DB_NAME;
use const BitrixTestApp\DB_PASS;
use const BitrixTestApp\DB_USER;


$tables = file_get_contents(__DIR__.'/data/db.sql');

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET);
$db->create($tables);

print_r($db);
