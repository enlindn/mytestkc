<?php
if (!session_start()) {
    session_start();
}
error_reporting(E_ALL ^ E_NOTICE);
header('content-type:text/html;charset=GBK');
require_once 'dir.func.php';
require_once 'file.func.php';
require_once 'common.func.php';
require_once "php/admin.inc.php";
checkLogined();
$path = "sitefile";
$path=$_REQUEST['path']?$_REQUEST['path']:$path;
$act=$_REQUEST['act'];
$filename=$_REQUEST['filename'];
$dirname=$_REQUEST['dirname'];


if($act=="delFile"){
    delFile($filename);
  /* if($path=="sitefile"){
        ChangeUrl("file.php");
    }else{
        ChangeUrl("file.php?path=".$path);
   }*/
}elseif($act=="downFile"){
    downFile($filename,$path);
    if($path=="sitefile"){
        ChangeUrl("file.php");
    }else{
        ChangeUrl("file.php?path=".$path);
    }
}elseif($act=="delFolder"){
    delFolder($dirname);
    if($path=="sitefile"){
        ChangeUrl("file.php");
    }else{
        ChangeUrl("file.php?path=".$path);
    }
}

$info = readdirectory($path);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!--    css here    -->
        <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/ghpages-materialize.css"/>
        <link type="text/css" rel="stylesheet" href="css/index.css"/>
        <title>Index</title>
        <script type="text/javascript">
        function delFile(filename,path){
            if(window.confirm("confirm of delete?")){
                Materialize.toast("delete complete!",1000);
                location.href="file.php?act=delFile&filename="+filename+"&path="+path;
            }
        }
        function delFolder(dirname,path){
        	if(window.confirm("confirm of delete?")){
                Materialize.toast("delete complete!",1000);
                location.href="file.php?act=delFolder&dirname="+dirname+"&path="+path;
            }
        }
        function goBack(back,isbootflag){
            if(!isbootflag)
                location.href="file.php?path="+back;
            else
            	Materialize.toast("It's Root Directory!",1000);
        }
        </script>
    </head>

    <body>
        <header>
            <nav class="top-nav">
                <div class="container">
                    <div class="nav-wrapper">
                        <a class="page-title">File</a>
                    </div>
                </div>
            </nav>
            <div class="container">
                <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full">
                    <i class="mdi-navigation-menu">
                    </i>
                </a>
            </div>
            <ul id="nav-mobile" class="side-nav fixed">
                <li id="logo" class="logo">
                    <a id="logo-container" href="#" class="brand-logo">
                        <img class="responsive-img" src="images/logo.png">
                    </a>
                </li>
                <li class="bold">
                    <a href="about.html" class="waves-effects waves-teal">About</a>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold">
                            <a class="collapsible-header  waves-effect waves-teal">
                                Help
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="account.html">Account</a></li>
                                    <li><a href="usage.html">Usage</a></li>
                                    <li><a href="author.html">Author</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="bold active">
                    <a href="file.php" class="waves-effects waves-teal">File</a>
                </li>
                <li class="bold">
                    <a href="database.html" class="waves-effects waves-teal">Database</a>
                </li>
                <li class="bold">
                    <a href="terminal.html" class="waves-effects waves-teal">Terminal</a>
                </li>
                <li class="bold">
                    <a href="setting.html" class="waves-effects waves-teal">Setting</a>
                </li>
                <li class="nav-account">
                    <span class="center-text">
                        Welcome, 
                        <?php
                            echo $_SESSION['username'];
                        ?>
                    </span>
                    <a href="" class="btn-flat waves-effect waves-green red-text" id="login-out"><i class="left mdi-action-account-circle red-text"></i>Login Out</a>
                </li>
            </ul>
        </header>
        <main>
            
            <div class="container">
                <div class="row">
                    <div class="col s12 m9 l10">
                        <div id="introduction" class="section scrollspy">
                            <p class="caption">
                                    You can explore the file system, insert or remove files here. We are devloping more tools for this system, waiting for our latest news.
                            </p>
                        </div>
                        <div id="explorer" class="section scrollspy">
                            
                            <h2 class="header">FileManager</h2>
                            <form action="uploadaction.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name = "pathname" value= "<?php echo $path;?>" />
                            <div class="file-field input-field">
                            <input class="file-path validate" type="text"/>
                                 <div class="btn">
                                    <span>File</span>
                                 <input type="file" name="myFile"/>
                                 </div>
                            </div>
                            <button class="btn waves-effect waves-light" type="submit" name="action">Upload
                                <i class="mdi-content-send right"></i>
                            </button>
                            </form>
                            <p></p>
                            <?php 
                            $isbootflag=true;
                            if($path=="sitefile"){
                                $back="sitefile";
                            }else{
                                $back=dirname($path);
                                $isbootflag=false;
                            }
                            ?>
                            <a onclick="goBack('<?php echo $back;?>','<?php echo $isbootflag;?>')" id="btn-parent" class="waves-effect waves-light btn"><i class="mdi-navigation-arrow-back left"></i>Parent</a>
                            <table id="file-table" class="hoverable responsive-table">
                                <thead>
                                    <th data-field="checkbox-all">
                                        <p>
                                            <input type="checkbox" id="checkall" />
                                            <label for="checkall"></label>
                                        </p>
                                    </th>
                                    <th data-field="filename">
                                        <p>
                                            File Name
                                        </p>
                                    </th>
                                    <th data-field="size">
                                        <p>
                                            Size
                                        </p>
                                    </th>
                                    <th data-field="time-to-create">
                                        <p>
                                            Time to Create
                                        </p>
                                    </th>
                                    <th data-field="operation">
                                        <p>
                                            Operation
                                        </p>
                                    </th>
                                </thead>
                                
                                
                                <!-- 读目录 -->
                                <?php 
                                $i = 1;
                                if($info['dir']){
                                    foreach ($info['dir'] as $val){
                                ?>
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>
                                                <?php echo "<input type=\"checkbox\" id=\"checkbox-file".$i."\" />";?>
                                                <?php echo "<label for=\"checkbox-file".$i."\"></label>";?>
                                            </p>
                                        </td>
                                        <td>
                                            <?php echo $val;?>
                                        </td>
                                        <td>
                                            <?php echo transByte(dirsize($path."/".$val));?>
                                        </td>
                                        <td>
                                            <?php echo date("Y-m-d",filectime($path."/".$val));?>
                                        </td>
                                        <td>
                                            <a href="file.php?path=<?php echo $path."/".$val?>">Check&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
                                            <!--<a href="file.php?act=downFile&filename=<?php echo $path."/".$val;?>">Download</a>-->
                                            <a href="#" onclick="delFolder('<?php echo $path."/".$val;?>','<?php echo $path;?>')">Delete</a>
                                        </td>
                                    
                                    </tr>
                                
                                </tbody>
                                <?php
                                    $i++;
                                    }
                                }
                                ?>
                                
                                
                                <!-- 读文件 -->
                                <?php 
                                if($info['file']){
                                    foreach ($info['file'] as $val){
                                ?>
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>
                                                <?php echo "<input type=\"checkbox\" id=\"checkbox-file".$i."\" />";?>
                                                <?php echo "<label for=\"checkbox-file".$i."\"></label>";?>
                                            </p>
                                        </td>
                                        <td>
                                            <?php echo $val;?>
                                        </td>
                                        <td>
                                            <?php echo transByte(filesize($path."/".$val));?>
                                        </td>
                                        <td>
                                            <?php echo date("Y-m-d",filectime($path."/".$val));?>
                                        </td>
                                        <td>
                                            <a href="file.php?act=downFile&filename=<?php echo $path."/".$val;?>">Download</a>
                                            <a href="#" onclick="delFile('<?php echo $path."/".$val;?>','<?php echo $path;?>')">Delete</a>
                                        </td>
                                    
                                    </tr>
                                
                                </tbody>
                                <?php
                                    $i++;
                                    }
                                }
                                ?>
                                
                            </table>
                        </div>
                    </div>
                    <div class="col hide-on-small-only m3 l2" style="top: 0px;">
                        <div class="toc-wrapper pinned">
                            <div style="height: 1px;">
                                <ul class="section table-of-contents">
                                    <li>
                                        <a href="#introduction" class="">Introduction</a>
                                    </li>
                                    <li>
                                        <a href="#explorer" class="">Explorer</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              
        </main>
        <action-btn>
            <div id="action-btn" class="fixed-action-btn">
                <a class="btn-floating btn-large red">
                    <i class="large mdi-action-toc"></i>
                </a>
                <ul>
                    <li><a class="btn-floating blue"><i class="large mdi-editor-publish"></i></a></li>
                    <li><a class="btn-floating yellow"><i class="large mdi-action-perm-identity"></i></a></li>
                </ul>
            </div>
        </action-btn>
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2014-2015 CMS, All rights reserved.
                    <a class="grey-text text-lighten-4 right" href="https://github.com/Dogfalo/materialize/blob/master/LICENSE">MIT License</a>
                </div>
                
            </div>
        </footer>
        <!--    script here -->
        <script type="text/javascript" src="jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/file.js"></script>
    </body>
</html>
