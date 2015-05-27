<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/25/15
 * Time: 21:41
 */
global $con;
function connectDatabase() {
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="13245768";
    $dbname="cms_mini";
    $charset="utf8";
	global $con;
    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
    //or die ('Could not connect to the database server' . mysql_errno() . ":" . mysql_error());
    //mysql_set_charset($charset);
    //mysql_select_db($dbname) or die ('Could not open the database');
	return $con;
	

}

function fetchOne($sql, $result_type = MYSQL_ASSOC) {
	global $con;
    $result = mysqli_query($con,$sql);
    if (!$result) {
        $row = null;
    } else {
        $row = mysqli_fetch_array($result,$result_type);
    }
    return $row;
}

function fetchAll($sql, $result_type = MYSQL_ASSOC) {
	global $con;
    $result = mysqli_query($con,$sql);
    while(@$row = mysqli_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    return $rows;
}

//connectDatabase();
