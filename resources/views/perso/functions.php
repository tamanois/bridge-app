<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/08/2018
 * Time: 23:23
 */

function sanitize($str) {

    $str=str_replace("'","\\'",$str);
    $str=str_replace("\n","\\n",$str);
    $str=str_replace("\r","\\r",$str);

    return $str;
}

