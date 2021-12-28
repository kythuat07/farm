<?php
    $rf = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
    $config['database']['refix'] = "db_";
    $config['database']['servername'] = 'localhost';
    $config['database']['username'] = 'root';
    $config['database']['password'] = '';
    $config['database']['database'] = 'db_farm';

    define("URLPATH","http://".$_SERVER["SERVER_NAME"]."/farm/");
    define("urladmin","http://".$_SERVER["SERVER_NAME"]."/farm/admin/");

?>