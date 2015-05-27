<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/25/15
 * Time: 21:32
 */

header("content-type:text/html;charset=utf-8");

session_start();

define("ROOT", dirname(__FILE__));

set_include_path(get_include_path().PATH_SEPARATOR.
    ".".PATH_SEPARATOR.
    ROOT.PATH_SEPARATOR.
    ROOT."/php".PATH_SEPARATOR.
    ROOT."/lib".PATH_SEPARATOR.
    ROOT."/drawable");


//connectDatabase();