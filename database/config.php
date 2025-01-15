<?php
    $dev_data = array('id'=>'-1','firstname'=>'Developer','lastname'=>'','username'=>'dev_church_admin','password'=>'5da283a2d990e8d8512cf967df5bc0d0','last_login'=>'','date_updated'=>'','date_added'=>'');
    if(!defined('base_url')) define('base_url','https://passicitychurch.org/');
    if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );
    if(!defined('dev_data')) define('dev_data',$dev_data);
    if(!defined('DB_SERVER')) define('DB_SERVER',"153.92.15.31");
    if(!defined('DB_USERNAME')) define('DB_USERNAME',"u534384527_church_admin");
    if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"Passicitychurch_123");
    if(!defined('DB_NAME')) define('DB_NAME',"u534384527_dbpassichurch");
?>