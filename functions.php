<?
//-------------------------------------Core-------------------------------------
//Don`t change somthing here
//--------------------------------------------------------------------------------------------------
//-----------------------------------------------BLOCK----------------------------------------------
if(!isset($_SESSION["code"])) header ("Location:http://".$_SERVER["SERVER_NAME"]."/".PAGES."/404.php");
//--------------------------------------------------------------------------------------------------

function input($name, $msg) {
    file_put_contents("text/records",$name."|".$msg."\n",FILE_APPEND | LOCK_EX);
    //Prebanlist
    file_put_contents("text/prebanlist",  $name." | ".$_SERVER['REMOTE_ADDR']." | ".date("m.d.y-H:i:s")."\n",FILE_APPEND | LOCK_EX);
    //Last page
    $delimiter = count(file("text/records"));
    $delimiter % MESSONPAGE ? $delimiter = intval($delimiter / MESSONPAGE)+1 : $delimiter /=MESSONPAGE;
    header("Location:http://".$_SERVER["SERVER_NAME"]."/".PAGES."/index.php?page=" . $delimiter);
}

//------------------------------------------------------------------------------
function print_table($fileLink, $fileLines, $page, $strtr) {
    $value = ($page * MESSONPAGE);
    $define = count($fileLink);
    if ($value > $define) {
        $value -= $define;
        $value = MESSONPAGE - $value;
        $define = (count($fileLink) - $value);
        $value += $define;
    } else if (count($fileLink) < $value) {
        $value = count($fileLink);
    } else if (($value - MESSONPAGE) < MESSONPAGE) {
        $define = $value - MESSONPAGE;
    } else if (($value - MESSONPAGE) == 0) {
        $define = 0;
        $value = MESSONPAGE;
    } else if (count($fileLink) > $value) {
        $define = $value - MESSONPAGE;
        //$value = ;
    } else if ($define == $value) {
        $define -= MESSONPAGE;
    }
    $arg1 = $define;
    $arg2 = $value;

    for ($d = $arg1 - 1; $d < $arg2 - 1; $d++) {
        $post = $d + 1;
        $strtr[$post][1] = htmlspecialchars($strtr[$post][1]);
        //$strtr[$post][1] = strip_tags($strtr[$post][1]);
        $strtr[$post][1] = BBCode_replace($strtr[$post][1],0);
        //Table
	include 'text/tmp/msg_table';
    }
}

//------------------------------------------------------------------------------
function print_pages_num($fileLink,$page,$error) {
    $delimiter = null;
    if (count($fileLink) > MESSONPAGE) {
        $delimiter = count($fileLink);
        $delimiter % MESSONPAGE ? $delimiter = ($delimiter / MESSONPAGE) + 1 : $delimiter /=MESSONPAGE;
		settype($delimiter,"integer");
	
	if($delimiter <= 4) {
		for ($d = 1; $d <= $delimiter; $d++) include 'text/tmp/middle_page';
	}else{
		if($page == 1 || $page == 2) {
			for ($d = 1; $d <= 3; $d++) include 'text/tmp/middle_page';
			include 'text/tmp/last_page';
		}
		else if($page == 3) {
			for ($d = 1; $d <= 4; $d++) include 'text/tmp/middle_page';
			include 'text/tmp/last_page';
		}
		else if($page == $delimiter-1) {
			include 'text/tmp/first_page';
			for ($d = $page-1; $d <= $page+1; $d++) include 'text/tmp/middle_page';
		}
		else if($page == $delimiter-2) {
			include 'text/tmp/first_page';
			for ($d = $page-1; $d <= $page+1; $d++) include 'text/tmp/middle_page';
			include 'text/tmp/last_page';
		}
		else if($page == $delimiter) {
			include 'text/tmp/first_page';
			for ($d = $page-2; $d <= $page; $d++) include 'text/tmp/middle_page';
		}
        	else { 
			include 'text/tmp/first_page';
			for ($d = $page-1; $d <= $page+1; $d++) include 'text/tmp/middle_page';
			include 'text/tmp/last_page';
		}
	}
    }
}
//------------------------------------------------------------------------------
function copyleft() { include 'text/tmp/copyleft'; }
//------------------------------------------------------------------------------
function banned() { include 'text/tmp/banned'; }
//------------------------------------------------------------------------------

function hackinj($page_t, $fileLink) {
    settype($page_t,"integer");

    $max_page = count($fileLink);
    
    $max_page % MESSONPAGE ? $max_page = ($max_page / MESSONPAGE) + 1 : ($max_page /= MESSONPAGE);
	settype($delimiter,"integer");
	
    if ($page_t > $max_page || $page_t < 1)
        header("Location:http://".$_SERVER["SERVER_NAME"]."/".PAGES."/404.php");
    else
        return $page_t;
}

//------------------------------------------------------------------------------
function BBCode_replace($post_mes,$off) {
//htmlspecialchars + strip_tags
    if($off == "1") $post_mes = htmlspecialchars($post_mes);
    
    $arv_p = array("/\[center\]/i", "/\[\/center\]/i",
        "/\[right\]/i", "/\[\/right\]/i",
        "/\[left\]/i", "/\[\/left\]/i",
        "/\[sup\]/i", "/\[\/sup\]/i",
        "/\[sub\]/i", "/\[\/sub\]/i",
        "/\[s\]/i", "/\[\/s\]/i", "/\[u\]/i", "/\[\/u\]/i",
        "/\[b\]/i", "/\[\/b\]/i", "/\[i\]/i", "/\[\/i\]/i");
    $arv_r = array("<div align='center'>", "</div>",
        "<div align='right'>", "</div>",
        "<div align='left'>", "</div>",
        "<sup>", "</sup>", "<sub>", "</sub>", "<s>", "</s>",
        "<u>", "</u>", "<b>", "</b>", "<i>", "</i>");

    $post_mes = preg_replace($arv_p, $arv_r, $post_mes);

    $arv_p = array(
        "/\:smile\:/i", "/\:arrow\:/i", "/\:biggrin\:/i",
        "/\:confused\:/i", "/\:cool\:/i", "/\:cry\:/i",
        "/\:eek\:/i", "/\:evil\:/i", "/\:exclaim\:/i",
        "/\:geek\:/i", "/\:idea\:/i", "/\:lol\:/i",
        "/\:mad\:/i", "/\:mrgreen\:/i", "/\:neutral\:/i",
        "/\:question\:/i", "/\:razz:\:/i", "/\:redface\:/i",
        "/\:rolleyes\:/i", "/\:sad\:/i", "/\:surprised\:/i",
        "/\:twisted\:/i", "/\:ugeek\:/i", "/\:wink\:/i"
    );
    $arv_r = array(
        "<img src='smiles/kolobok_smile.gif'>",
        "<img src='smiles/kolobok_arrow.gif'>",
        "<img src='smiles/kolobok_biggrin.gif'>",
        "<img src='smiles/kolobok_confused.gif'/>",
        "<img src='smiles/kolobok_cool.gif'/>",
        "<img src='smiles/kolobok_cry.gif'/>",
        "<img src='smiles/kolobok_eek.gif'/>",
        "<img src='smiles/kolobok_evil.gif'/>",
        "<img src='smiles/kolobok_exclaim.gif'/>",
        "<img src='smiles/kolobok_geek.gif'/>",
        "<img src='smiles/kolobok_idea.gif'/>",
        "<img src='smiles/kolobok_lol.gif'/>",
        "<img src='smiles/kolobok_mad.gif'/>",
        "<img src='smiles/kolobok_mrgreen.gif'/>",
        "<img src='smiles/kolobok_neutral.gif'/>",
        "<img src='smiles/kolobok_question.gif'/>",
        "<img src='smiles/kolobok_razz.gif'/>",
        "<img src='smiles/kolobok_redface.gif'/>",
        "<img src='smiles/kolobok_rolleyes.gif'/>",
        "<img src='smiles/kolobok_sad.gif'/>",
        "<img src='smiles/kolobok_surprised.gif'/>",
        "<img src='smiles/kolobok_twisted.gif'/>",
        "<img src='smiles/kolobok_ugeek.gif'/>",
        "<img src='smiles/kolobok_wink.gif'/>"
    );
    $post_mes = preg_replace($arv_p, $arv_r, $post_mes);

    
    @preg_match_all("/http:\/\/[0-9a-z]{1,15}.[a-z]{1,4}/i", $post_mes, $url_addr);

    for($i=0;$i<count($url_addr);$i++) {
        for($x=0;$x<count($url_addr[$i]);$x++)
        $post_mes = @str_replace($url_addr[$i][$x], "<a href='".$url_addr[$i][$x]."'>".$url_addr[$i][$x]."</a>", $post_mes);
    }
    return $post_mes;
}

//------------------------------------------------------------------------------
function convert($msg) {
    $arv_p = array( "[center][/center]","[right][/right]","[left][/left]",
                    "[sup][/sup]","[sub][/sub]",
                    "[s][/s]", "[u][/u]",
                    "[b][/b]", "[i][/i]");
    $msg = str_replace($arv_p, "", $msg);
    return $msg;
}
//------------------------------------------------------------------------------
function check_ban() {
	$ban = file("text/banlist");
	foreach($ban as $key => $value) {
    	if($_SERVER["REMOTE_ADDR"] == $value) {
			setcookie('banned','1',mktime(0,0,0,1,1,2020));
        	break;
		}
	}
}
//-------------------------------------------------------------------------------
function remove_img($get) { if(isset($get)) {unlink("/var/www/guest/captcha/img_".md5(sha1(session_id()))); exit(); } }
//-------------------------------------------------------------------------------
function explode_data($fileLink) {
	for($i=0; $i<count($fileLink);$i++)
        $strtr[$i] = explode("|", $fileLink[$i]);
    return $strtr;
    
}

?>
