<?php

namespace Orbital\Env;

abstract class Env {

    /**
     * Set env data
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value){
        putenv("$key=$value");
        $_ENV[ $key ] = $value;
    }

    /**
     * Retrieve env data or default
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = NULL){
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }

    /**
     * Load environment file and put values into env data
     * @param string $file
     * @return void
     */
    public static function load($file){

        if( !file_exists($file) ){
            return;
        }

        $env = require_once $file;

        if( !is_array($env) ){
            return;
        }

        foreach( $env as $key => $value ):
            self::set($key, $value);
        endforeach;

    }

}