<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of init
 *
 * @author dominik
 */

include 'config/mysql.php';
include 'datatypes/user.php';

date_default_timezone_set('Europe/Warsaw');

mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
mysql_select_db(MYSQL_DB);
mysql_query('set names utf8');



function getView($view,$params=array()){
    mb_internal_encoding("UTF-8");
    mb_http_output( "UTF-8" );
    ob_start();
    include dirname(__FILE__).'/views/'.$view.'.php';
    return ob_get_clean();
}


