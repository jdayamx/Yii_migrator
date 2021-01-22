<?php

define('MVERSION', '1.0.0');

echo "Yii migrator for create migration in exists project v." . MVERSION . "\r\n";

$current_dir = dirname(__FILE__);

$migration_folder = $current_dir . DIRECTORY_SEPARATOR . 'migrations';
$config_folder = $current_dir . DIRECTORY_SEPARATOR . 'config';

if( !is_dir($config_folder) ) {
    die("\e[31mFATAL ERROR\e[0m: The configuration directory does not exists");
}

if( !is_dir($migration_folder) ) {
    echo "\e[33mWARNING\e[0m: The migration directory does not exists, crate ? Y/N\r\n";
    $result = readline();
    if(!preg_match('~[y]~ui', $result)) {
	die("Bye!");
    } else {
	mkdir($migration_folder);
    }
}

// todo: main code here