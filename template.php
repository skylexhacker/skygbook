<?
//-----------------------------------------------BLOCK----------------------------------------------
if(!isset($_SESSION["code"])) header ("Location:http://".$_SERVER["SERVER_NAME"]."/".basename(getcwd())."/404.php");
//--------------------------------------------------------------------------------------------------

if($fileLines == "") include 'text/tmp/no_msg';

$strtr = explode_data($fileLink);
    
!empty($_GET["page"]) ? $page = htmlspecialchars(strip_tags(hackinj($_GET["page"],$fileLink))) : $page = 1;
    
print_table($fileLink,$fileLines,$page,$strtr);

include 'text/tmp/pages_div/div_start';
print_pages_num($fileLink,$page,$error);
include 'text/tmp/pages_div/div_end';
include 'text/tmp/error';

banned();

copyleft();
?>
