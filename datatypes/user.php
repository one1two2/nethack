<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Konrad
 */
class user {
    private $uid;
    private $location_id;
    private $date_registred;
    private $first_name;
    private $second_name;
    private $birthday;
    private $email;
            
    function __construct($uid,$facebook){
        
        $sql = 'SELECT * FROM user WHERE uid='.$uid.'';
        $result = mysql_query($sql);
        $num_rows = mysql_num_rows($result);
        if($num_rows === 0){
            $row = mysql_fetch_array($result);
            $this->uid = $row['uid'];
            $this->location_id = $row['location_id'];
            $this->date_registred = $row['date_registred'];
            $this->first_name = $row['first_name'];
            $this->second_name = $row['second_name'];
            $this->birthday = $row['birthday'];
            $this->email = $row['email'];
        }else{
            $user_profile = $facebook->api('/me','GET');
            /*echo "<pre>";
            var_dump($user_profile);
            echo "</pre>";*/
            $this->uid = $uid;
            $this->birthday = 0;
            $this->email = "";
            $this->first_name = $user_profile['first_name'];
            $this->second_name = $user_profile['last_name'];
            $this->location_id = $user_profile['location']['id'];
            $this->date_registred = time();
            $sql = 'INSERT INTO user (uid,location_id,date_registred,first_name,second_name)'
                . ' VALUES ('.$this->uid.','.$this->location_id.','.$this->date_registred.',"'.$this->first_name.'","'.$this->second_name.'")';
            echo $sql;
            mysql_query($sql);
        }
    }
}
