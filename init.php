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

mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
mysql_select_db(MYSQL_DB);


