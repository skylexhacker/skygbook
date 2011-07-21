<?
//-----------------------------------------------BLOCK----------------------------------------------
if(!isset($_SESSION["code"])) header ("Location:http://".$_SERVER["SERVER_NAME"]."/".basename(getcwd())."/404.php");
//--------------------------------------------------------------------------------------------------
?>
<body onbeforeunload="window.location.href='index.php?q=1';">
<table class="hard" cellspacing="0" width="40%" name="top" align='center'>
   <tr>
    <form name="form1" action="index.php" method="POST">
        <td width="40%" colspan="2">
            <b>Name:</b>
        </td>
        <td align="left">
            <input id="input" type="text" name="name" <? if(isset($_COOKIE['nameData'])) echo "value='".$_COOKIE['nameData']."'"; ?> >
        </td>
    </td>
    </tr>
    <tr>
        <td width="40%" colspan="2">
            <b>Message:</b>
        </td>
        <td>
            <span onclick="document.all.form1.msg.value+='[b][/b]'" id='bb'><b>B</b></span>
            <span onclick="document.all.form1.msg.value+='[s][/s]'" id='bb'><s>S</s></span>
            <span onclick="document.all.form1.msg.value+='[u][/u]'" id='bb'><u>U</U></span>
            <span onclick="document.all.form1.msg.value+='[i][/i]'" id='bb'><i>&nbsp;I&nbsp;</i></span>
            <span onclick="document.all.form1.msg.value+='[left][/left]'" id='bb_img'><img src='/guest/text/img/left.png'/></span>
            <span onclick="document.all.form1.msg.value+='[center][/center]'" id='bb_img'><img src='/guest/text/img/center.png'/></span>
            <span onclick="document.all.form1.msg.value+='[right][/right]'" id='bb_img'><img src='/guest/text/img/right.png'/></span>
            <span onclick="document.all.form1.msg.value+='[sub][/sub]'" id='bb'>X<sub>2</sub></span>
            <span onclick="document.all.form1.msg.value+='[sup][/sup]'" id='bb'>X<sup>2</sup></span>
        </td>
    </tr>
    <tr>
        <td width="40%" colspan="2" align="left">
            <img src="smiles/kolobok_smile.gif" onclick="document.all.form1.msg.value+=':smile:'"/>
            <img src="smiles/kolobok_arrow.gif" onclick="document.all.form1.msg.value+=':arrow:'"/>
            <img src="smiles/kolobok_biggrin.gif" onclick="document.all.form1.msg.value+=':biggrin:'"/>
            <img src="smiles/kolobok_confused.gif" onclick="document.all.form1.msg.value+=':confused:'"/>
            <img src="smiles/kolobok_cool.gif" onclick="document.all.form1.msg.value+=':cool:'"/>
            <img src="smiles/kolobok_cry.gif" onclick="document.all.form1.msg.value+=':cry:'"/>
            <img src="smiles/kolobok_eek.gif" onclick="document.all.form1.msg.value+=':eek:'"/>
            <img src="smiles/kolobok_evil.gif" onclick="document.all.form1.msg.value+=':evil:'"/>
            <img src="smiles/kolobok_exclaim.gif" onclick="document.all.form1.msg.value+=':exclaim:'"/>
            <img src="smiles/kolobok_geek.gif" onclick="document.all.form1.msg.value+=':geek:'"/>
            <img src="smiles/kolobok_idea.gif" onclick="document.all.form1.msg.value+=':idea:'"/>
            <img src="smiles/kolobok_lol.gif" onclick="document.all.form1.msg.value+=':lol:'"/>
            <img src="smiles/kolobok_mad.gif" onclick="document.all.form1.msg.value+=':mad:'"/>
            <img src="smiles/kolobok_mrgreen.gif" onclick="document.all.form1.msg.value+=':mrgreen:'"/>
            <img src="smiles/kolobok_neutral.gif" onclick="document.all.form1.msg.value+=':neutral:'"/>
            <img src="smiles/kolobok_question.gif" onclick="document.all.form1.msg.value+=':question:'"/>
            <img src="smiles/kolobok_razz.gif" onclick="document.all.form1.msg.value+=':razz:'"/>
            <img src="smiles/kolobok_redface.gif" onclick="document.all.form1.msg.value+=':redface:'"/>
            <img src="smiles/kolobok_rolleyes.gif" onclick="document.all.form1.msg.value+=':rolleyes:'"/>
            <img src="smiles/kolobok_sad.gif" onclick="document.all.form1.msg.value+=':sad:'"/>
            <img src="smiles/kolobok_surprised.gif" onclick="document.all.form1.msg.value+=':surprised:'"/>
            <img src="smiles/kolobok_twisted.gif" onclick="document.all.form1.msg.value+=':twisted:'"/>
            <img src="smiles/kolobok_ugeek.gif" onclick="document.all.form1.msg.value+=':ugeek:'"/>
            <img src="smiles/kolobok_wink.gif" onclick="document.all.form1.msg.value+=':wink:'"/>
        </td>
        <td >
            <textarea id="textarea" rows="5" name="msg"></textarea>
        <br>
    </td></tr>
    <tr>
        <td colspan="2">
            <img src="<? echo "captcha/img_".md5(sha1(session_id())); ?>" alt="captcha">
        </td>
        <td colspan="2">
            <b>Enter code:</b>
            <input type="text" id="input" name="captcha">
        </td>
    </tr>
    <tr >
    <td colspan="2">
            &nbsp;
    </td>
    <td  colspan="2" align="right">
        <input id="button" type="submit" value="send">
    </td>
    </tr>
    </form>
</table>
<div align="center">
<font size="2"><font color="blue"><font color="red">*</font> |All fields are required to be filled|</font></font>
<br>
</div>
<?copyleft();?>
