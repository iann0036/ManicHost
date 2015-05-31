<?php
/**
 * Created by PhpStorm.
 * User: iann0036
 * Date: 21/2/2015
 * Time: 12:57 PM
 */
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
    header("Location: ".$protocol."manic.host/hosting/shared/");
?>