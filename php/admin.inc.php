<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/25/15
 * Time: 21:53
 */

$root = dirname(dirname(__FILE__));
require_once $root."/lib/mysql.func.php";
function checkAdmin($sql) {
    return fetchOne($sql);

}

function checkLogined() {
    if ($_SESSION['adminid'] == '') {
        header("location: index.php");
    }
}
