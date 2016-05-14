<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 03/05/16
 * Time: 09:26
 */

namespace lemosweb\DI;

use lemosweb\DB\ConnectDB;

class Container
{
    public static function getClass($name)
    {
        $str_class = "\\App\\Models\\".ucfirst($name);
        $class = new $str_class(ConnectDB::getInstance());

        return $class;
    }
}