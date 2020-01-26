<?php

namespace Aecodes\AdminPanel;

use Error;
use Exception;

class Config
{

    public static function arrget($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }
        
        if (isset($array[$key])) {
            return $array[$key];
        }
        
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) && !($array instanceof \ArrayAccess)) {
                return $default;
            }
            
            if (!isset($array[$segment])) {
                return $default;
            }
            
            $array = $array[$segment];
        }

        if ( is_object($array) ) {
            // force array usage.
            $array = $array->toArray();
        }

        return $array;
    }

    public static function parse_dot($name)
    {
        $names = explode('.', $name);
        if (count($names) == 1) {
            return $name;
        }

        $attrs = array_shift($names);
        foreach ($names as $name) {
            $attrs .= '[' . $name . ']';
        }

        return $attrs;
    }
}
