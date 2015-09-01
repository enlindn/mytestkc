<?php
/**
 * Created by PhpStorm.
 * User: Illution
 * Date: 5/25/15
 * Time: 21:38
 */

$root = dirname(dirname(__FILE__));
require_once $root."/lib/mysql.func.php";
require_once $root."/common.func.php";


    session_start();


$action = $_GET['action'];

switch ($action) {
	case 'loginin':
        $username = stripslashes(trim($_POST['username']));
        $password = stripslashes(trim($_POST['password']));
        if (empty($username)) {
            $arr['success'] = 1;
            $arr['msg'] = "empty username";
        } else if (empty($password)) {
            $arr['success'] = 1;
            $arr['msg'] = "empty password";
        } else {
            
			$con = connectDatabase();
            if (!$con) {
                $arr['success'] = 1;
                $arr['msg'] = 'Can not connect to database!';
                break;
            } else {
				
                $sql = "select * from admin where username = '{$username}' and password = '{$password}'";
                $row = fetchOne($sql);
                if ($row) {
                   $arr['success'] = 1;
                    $_SESSION['adminid'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                  $arr['msg'] = "welcome, " . $_SESSION['username'];
                } else {
                    $arr['success'] = 0;
                    $arr['msg'] = 'Wrong username or password!';
                }
				
            }
			
			
        }
        break;
    case 'loginout':
        $_SESSION['adminid'] = '';
		$_SESSION['username'] = '';
		
        $arr['success'] = 1;
        $arr['msg'] = 'Login out successfully!';
        break;
   default:
        $arr['success'] = 0;
        $arr['msg'] = 'Action ' . $action . ' Unknown!';
        break;
}

//$arr['session'] = $_SESSION;
echo json_encode($arr);


//$result = checkAdmin($sql);
//echo $usernmae . " " . $password;