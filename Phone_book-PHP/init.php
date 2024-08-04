<?php
    ini_set('display_errors','1');
    error_reporting(-1);
    ob_start();
    session_start();
    date_default_timezone_set('Asia/Tehran');
    require_once 'config.php';
    require_once 'helper/base.php';
    require_once 'helper/frontend.php';
    $main = new Frontend;