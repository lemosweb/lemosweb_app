<?php


namespace lemosweb\DB;


class ConnectDB {
    
    private static $db;
    
    public function __construct()
    {
        
        try {
            self::$db = new \PDO("mysql:host=lemosweb.mysql.dbaas.com.br;dbname=lemosweb","lemosweb","manosgana1");
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getCode();
        }                
        
    }
    
    public static function getInstance()
    {
        if (!self::$db) {
            new ConnectDB();
        }
        
        return self::$db;
    }
}
