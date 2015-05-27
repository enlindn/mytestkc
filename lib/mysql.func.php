<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/25/15
 * Time: 21:41
 */

function connectDatabase() {
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="";
    $dbname="cms_mini";
    $charset="utf8";

    $con = mysql_connect($host, $user, $password)
    or die ('Could not connect to the database server' . mysql_errno() . ":" . mysql_error());
    mysql_set_charset($charset);
    mysql_select_db($dbname) or die ('Could not open the database');
    return $con;
//$con->close();

}

function fetchOne($sql, $result_type = MYSQL_ASSOC) {
    $result = mysql_query($sql);
    if (!$result) {
        $row = null;
    } else {
        $row = mysql_fetch_array($result,$result_type);
    }
    return $row;
}

function fetchAll($sql, $result_type = MYSQL_ASSOC) {
    $result = mysql_query($sql);
    while(@$row = mysql_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    return $rows;
}
