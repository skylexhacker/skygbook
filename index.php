<?
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require 'text/config';
//Check ban---------------------------------------------------------------
check_ban();
if(isset($_COOKIE['banned'])) { include 'template.php'; exit(); }
//------------------------------------------------------------------------

if(isset($_POST['name']) & isset($_POST['msg']) & isset($_POST['captcha'])) {
	$name = $_POST['name'];
	$msg = $_POST['msg'];
    if($_POST['captcha'] !== $_SESSION['captcha'])
    {   $error = "Symbols are not correct";   }
    else if(!isset($_SESSION['captcha'])) 
    {	$error = "Please Enable Cookies"; }
    else if(strlen($name) > 16 || strlen($msg) > 256)
    {   $error = "Name/Message is too long"; }
    else if($name == "" || $msg == "")
    {	$error = "Enter Name/Message";	}
    else
    {
		$msg = convert($msg);
		$name = htmlspecialchars(strip_tags($name));
		input($name,$msg);
        setcookie('nameData',$name,mktime(0,0,0,0,0,2020));
    }
}

include 'captcha.php';

if($fileLines == "") include 'text/tmp/no_msg';

$strtr = explode_data($fileLink);
    
!empty($_GET["page"]) ? $page = htmlspecialchars(strip_tags(hackinj($_GET["page"],$fileLink))) : $page = 1;
 
print_table($fileLink,$fileLines,$page,$strtr);

include 'text/tmp/pages_div/div_start';
print_pages_num($fileLink,$page,$error);
include 'text/tmp/pages_div/div_end';
include 'text/tmp/error';

//------------------------------------------------------------------------------
include 'hard.php';
//------------------------------------------------------------------------------

?>
