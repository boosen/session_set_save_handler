<?php
include 'mysql.php';
include 'handleWithMysql.php'

$session = new SessionSaveHandle();
ini_set('session.user_trans_sid', 0);
ini_set('session.user_cookies', 1);
ini_set('session.cookie_path', '/');
ini_set('session.save_handle', 'user');
session_module_name('user');
session_set_save_handler(
    array($session, "open"),
    array($session, "close"),
    array($session, "read"),
    array($session, "write"),
    array($session, "destroy"),
    array($session, "gc")
    );
session_start();
$_SESSION['age'] = 18;
var_dump($_SESSION);
