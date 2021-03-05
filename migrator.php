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

$config_file = $config_folder . DIRECTORY_SEPARATOR . 'main.php';

if( !file_exists($config_file) ) {
    die("\e[31mFATAL ERROR\e[0m: The configuration file main.php does not exists");
}
try {
    
    $yii = $current_dir . '/../../framework/yii.php';
    require_once($yii);    
    
    $config = require_once($config_file);    
    unset($config['defaultController']);
    unset($config['components']['log']);    
    $app=Yii::createApplication('CConsoleApplication', $config);
    $db_connection = [];

    foreach($config['components'] as $name => $params) {
        if (isset($params['class']) && preg_match('~\.db\.~ui', $params['class'])) {
            $db_connection[$name] = $params;
        }
    }

    foreach($db_connection as $db_name => $db_params) {
        echo "\e[33mDB\e[0m: $db_name".PHP_EOL;        
        $tables = Yii::app()->$db_name->schema->getTables();
        echo "\e[32mTABLES\e[0m:".PHP_EOL;
        foreach($tables as $table) {
            echo " - \e[36m$table->name\e[0m".PHP_EOL;
            foreach($table->columns as $column=>$shema) {
                echo "     | ".($table->primaryKey == $column?"\e[44m$column\e[0m":"$column").PHP_EOL;
            }
        }
        
    }

} catch (Throwable $t) {
    die("\e[31mFATAL ERROR\e[0m: " . $t->getMessage() . "\r\n");
} catch (Exception $e) {
    die("\e[31mFATAL ERROR\e[0m: ".$e->getMessage() . "\r\n");
}