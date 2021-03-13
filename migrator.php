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
        $class_name = 'm'.date('ymd').'_000000_sheme_'.$db_name;
        $text = '<?php'.PHP_EOL;
        $text .= 'class '.$class_name.' extends CDbMigration'.PHP_EOL;
        $text .= '{'.PHP_EOL;        
        $text .="\t// Use safeUp/safeDown to do migration with transaction".PHP_EOL;
	    $text .="\tpublic function safeUp()".PHP_EOL;
	    $text .="\t{".PHP_EOL;
        $text .="\t\t\$this->setDbConnection(Yii::app()->getComponent('".$db_name."'));".PHP_EOL;
        $_d_table = '';
        $_d_foreign_key = '';
        echo "\e[33mDB\e[0m: $db_name".PHP_EOL;        
        $tables = Yii::app()->$db_name->schema->getTables();
        echo "\e[32mTABLES\e[0m:".PHP_EOL;
        foreach($tables as $table) {
            $_d_table .= "\t\t//\$this->dropTable('".$table->name."');".PHP_EOL;;
            $_table = '';
            echo " - \e[36m$table->name\e[0m".PHP_EOL;

            $_table .="\t\t\$this->createTable('".$table->name."', [".PHP_EOL;
            $foreign_key = '';
            foreach($table->columns as $column=>$shema) {
                $foreignKeys = array_keys($table->foreignKeys);
                echo "     | ".($table->primaryKey == $column?"\e[44m$column\e[0m":in_array($column, $foreignKeys)?"\e[45m$column\e[0m":"$column").PHP_EOL;
                $_table .="\t\t\t'".$column."' => '".strtoupper($shema->dbType).(!$shema->allowNull?" NOT NULL":"").($shema->autoIncrement?" AUTO_INCREMENT":"").($shema->isPrimaryKey?" PRIMARY KEY":"").($shema->comment?" COMMENT \"".addslashes($shema->comment)."\"":"")."',".PHP_EOL;
                if($shema->isForeignKey) {
                    $foreign_key .= "\t\t\$this->createIndex('".$column."', '".$table->name."', '".$column."');".PHP_EOL;
                    $_d_foreign_key .= "\t\t//\$this->dropIndex('".$column."', '".$table->name."');".PHP_EOL;
                }
            }     
            $_table .= "\t\t]);".PHP_EOL;      
            $_table .= $foreign_key;

            
            $text .= $_table.PHP_EOL;
            
        }
        $text .= "\t}".PHP_EOL.PHP_EOL;            
        $text .= "\tpublic function safeDown()".PHP_EOL;        
        $text .= "\t{".PHP_EOL;
        $text .= "\t\t//Uncomment if you want lose your data".PHP_EOL;
        $text .= "\t\t//\$this->setDbConnection(Yii::app()->getComponent('".$db_name."'));".PHP_EOL;
        $text .= $_d_foreign_key;
        $text .= $_d_table;
        $text .= "\t}".PHP_EOL.PHP_EOL;
        
        $text .= '}'.PHP_EOL;
        //echo  $text;
        $migration_file = $migration_folder.DIRECTORY_SEPARATOR.$class_name.'.php';
        $create = false;
        if(file_exists($migration_file)) {
            if(preg_match('~y~ui', readline('Owerwrite file '.$class_name.'.php ? Y/N '))) {
                $create = true;
            }
        } else {
            $create = true;
        }

        if($create) {
            file_put_contents($migration_file, $text);
        }
        
    }
} catch (Throwable $t) {
    die("\e[31mFATAL ERROR\e[0m: " . $t->getMessage() . "\r\n");
} catch (Exception $e) {
    die("\e[31mFATAL ERROR\e[0m: ".$e->getMessage() . "\r\n");
}