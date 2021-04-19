<?php namespace Test\Model;

use PDO;

abstract class BaseModel {

    static $db = null;

    protected function getDb(): ?PDO {
        if (\is_null(self::$db)) {
            $config = (include(__DIR__ . '/../config.php'))['database'];

            $dsn = "mysql:host={$config['host']};dbname={$config['name']};port={$config['port']};charset=utf8";
            self::$db = new PDO($dsn, $config['username'], $config['password']);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db; 
    }

}