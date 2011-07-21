<?
//-----------------------------------------------BLOCK----------------------------------------------
if(!isset($_SESSION["code"])) header ("Location:http://".$_SERVER["SERVER_NAME"]."/".basename(getcwd())."/404.php");
//--------------------------------------------------------------------------------------------------
    $arr = array('7','b','c','d','e','1',
                 'g','h','i','j','5','l',
                 '2','8','o','3','r','6',
                 't','u','4','x','0','z',
                 'f','m','p','v','k','s',
                 'a','n','9','y');
    $image = imagecreate(270, 50);
    imagecolorallocate($image, 217 , 217, 217);
    $color = imagecolorallocate($image, 0, 0, 0);
    $p = "";
    for($i = 0;$i < 4;$i++) {
        $index = rand(0, count($arr)-1);
        $p .= $arr[$index];
    }
    $_SESSION["captcha"] = $p;
    


    for($i=0;$i<4;$i++) {
        imagettftext($image, 35, 0, 80+$i*25, 35+$i,$color, getcwd()."/text/ac.ttf", $p[$i]);
    }

    
    //touch("captcha/img_".md5(sha1(session_id())));
    imagepng($image,"captcha/img_".md5(sha1(session_id())));
    imagedestroy($image);
?>
