<?
$filemtime = "";
$time = "";
$dir = opendir(getcwd()."/captcha");
while(($file = readdir($dir)) !== false) {
	$filemtime = date("i",filemtime(getcwd()."/captcha/".$file));
	$time = date("i",time());
	if($file != "." && $file != "..") {
		if($filemtime > $time) unlink(getcwd()."/captcha/".$file);
		else if(($time - $filemtime) >= 5) unlink(getcwd()."/captcha/".$file); 
	}
}
?>
