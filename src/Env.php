<?php
declare(strict_types=1);

namespace Orbital\Env;

abstract class Env {

    /**
     * Set env data
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, mixed $value): void {
        putenv("$key=$value");
        $_ENV[ $key ] = $value;
    }

    /**
     * Retrieve env data or default
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed {
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }

    /**
     * Load environment file and put values into env data
     * @param string $file
     * @return void
     */
    public static function load(string $file): void {

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