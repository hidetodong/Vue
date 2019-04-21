<?php
/**
 * Created by PhpStorm.
 * User: Hideto
 * Date: 2019/4/21
 * Time: 15:52
 */
$users = [];
$users['data'][0]['uname']='rich';
$users['data'][0]['ip']='1';
$users['data'][0]['port']='100';

$users['data'][1]['uname']='poor';
$users['data'][1]['ip']='1';
$users['data'][1]['port']='200';
$users['type']='10';
print_r($users);
print_r($users['data'][1]['uname']);
$user_data = array_column($users,'data');
foreach($user_data as $user){
    if($users['data'][(int)$user]['uname']== "rich"){
        unset($users['data'][(int)$user]);
        array_values($users['data']);
    }
}
$users=json_encode($users);
print_r($users);