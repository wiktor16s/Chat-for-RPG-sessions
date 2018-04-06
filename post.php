<?php
session_start();
if(isset($_SESSION['name'])){
	
    $text = $_POST['text'];
     
    $fp = fopen("log.html", 'a');
	
	if($text == 'k100'){
		$los = rand ( 1,100);
		fwrite($fp, "<div class='msgln'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars("used: ".$text." and roll: ".$los))."<br></div>");
	}
	else if($text == 'k10'){
		$los = rand ( 1,10);
		fwrite($fp, "<div class='msgln'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars("used: ".$text." and roll: ".$los))."<br></div>");
	}
	else if($text == 'k8'){
		$los = rand ( 1,8);
		fwrite($fp, "<div class='msgln'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars("used: ".$text." and roll: ".$los))."<br></div>");
	}
	else if($text == 'k4'){
		$los = rand ( 1,4);
		fwrite($fp, "<div class='msgln'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars("used: ".$text." and roll: ".$los))."<br></div>");
	}
	else if($text == 'moneta'){
		$los = rand ( 0,1);
			if($los==1){
				fwrite($fp, "<div class='msgln'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars(" flip TAILS "))."<br></div>");
			}else{
		fwrite($fp, "<div class='msgln'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars(" flip HEADS"))."<br></div>");
			}	
	}
	else{
		fwrite($fp, "<div class='msgln2'>(".date("H:i").") <b> - ".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
		fclose($fp);
	}
}


?>


