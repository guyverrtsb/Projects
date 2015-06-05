<?php

$PageTitle = "Manage Users";
include('header.php');
$USER = new MISC_CLASS;



$sql = "ALTER TABLE `reputation_score` ADD `ref_id` INT(10) UNSIGNED NOT NULL AFTER `user_id`";
//$sql = "ALTER TABLE `activity_log` CHANGE `activity_id` `activity_id` BIGINT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT";



//$sql = "SELECT * FROM mobile_code ORDER BY id DESC";

//         $sql = "SELECT * FROM users  ";
//         $sql = "SELECT * FROM post ORDER BY post_id DESC";

$result = $db->query($sql);
                 echo $sql;
//while ($row = $result->fetch()) {
//
//    print_r($row);
//}
die;
