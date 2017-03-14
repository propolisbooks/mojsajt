<?php
function konekcija()
{
    $db=mysqli_connect("localhost", "root", "", "g2_vesti");
    if(!$db) return false;
    mysqli_query($db,"SET NAMES UTF8");
        $db=mysqli_connect("localhost", "root", "", "g2_vesti");
    if(!$db) return false;
    mysqli_query($db,"SET NAMES UTF8");
    return $db;
}
?>