<?php
session_start ();
function loginForm() {
	echo '
    <div id="loginform">
    <form action="index.php" method="post">
        <p color:white>What is your name?:</p>
        <label class=\'white\'  for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
    </div>
    ';
}

if (isset ( $_POST ['enter'] )) {
	if ($_POST ['name'] != "") {
		$_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
		$fp = fopen ( "log.html", 'a' );
		fwrite ( $fp, "<div class='zielony'><i> !!!!!!!!!!!! " . $_SESSION ['name'] . " Came!!!!!!!!!!!!</i><br></div>" );
		fclose ( $fp );
	} else {
		echo '<span class="error">What is your name?</span>';
	}
}

if (isset ( $_GET ['logout'] )) {
	
	// Simple exit message
	$fp = fopen ( "log.html", 'a' );
	fwrite ( $fp, "<div class='czerwony'><i> " . $_SESSION ['name'] . " Left</i><br></div>" );
	fclose ( $fp );
	
	session_destroy ();
	header ( "Location: index.php" ); // Redirect the user
}

?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
body {
	font: 12px arial;
	color:black;
	text-align: center;
	padding: 35px;
}

.white{
	color:white;
}

form,p,span {
	margin: 0;
	padding: 0;
}

input {
	font: 12px arial;
}

a {
	color:white;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

#wrapper,#loginform {
	margin: 0 auto;
	margin-top:0px;
	padding-bottom: 25px;
	background: #363636;
	width: 504px;
	border: 1px solid #ACD8F0;
	float: top;
}

#loginform {
	padding-top: 18px;
}

#loginform p {
	margin: 5px;
	color:white;
}

#chatbox {
	text-align: left;
	margin: 0 auto;
	margin-bottom: 25px;
	padding: 10px;
	background: #fff;
	height: 270px;
	width: 430px;
	border: 1px solid #ACD8F0;
	overflow: auto;
}

#usermsg {
	width: 395px;
	border: 1px solid #ACD8F0;
}

#submit {
	width: 60px;
}

.error {
	color: #ff0000;
}

#menu {
	padding: 12.5px 25px 12.5px 25px;
}

.welcome {
	float: left;
	color:white;
}

.logout {
	float: right;
}

.czerwony{
	margin: 0 0 2px 0;
	color:red;
}

.zielony{
	margin: 0 0 2px 0;
	color:green;
}

.msgln {
	margin: 0 0 2px 0;
	color: blue;
}

.msgln2 {
	margin: 0 0 2px 0;
}

</style>
<title>Sesja RPG</title>
</head>
<body>

<img src=img/kam.png width=650px>

	<?php
	if (! isset ( $_SESSION ['name'] )) {
		loginForm ();
	} else {
		?>
		

<div id="wrapper" >
		<div id="menu">
			<p class="welcome">
				Hi, <b><?php echo $_SESSION['name']; ?></b>
			</p>
			<p class="logout">
				<a id="exit" href="#">Exit</a>
			</p>
			<div style="clear: both"></div>
		</div>
		<div id="chatbox"><?php
		if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
			$handle = fopen ( "log.html", "r" );
			$contents = fread ( $handle, filesize ( "log.html" ) );
			fclose ( $handle );
			
			echo $contents;
		}
		?></div>

		<form name="message" action="">
			<input name="usermsg" type="text" id="usermsg" size="63" /> <input
				name="submitmsg" type="submit" id="submitmsg" value="Wyślij" />
		</form>
	</div>
	<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<script type="text/javascript">
	
	
	
// jQuery Document
$(document).ready(function(){
});

//jQuery Document
$(document).ready(function(){
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Do you really?");
		if(exit==true){window.location = 'index.php?logout=true';}		
	});
});

//If user submits the form
$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		loadLog;
	return false;
});

function loadLog(){		
	var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
	$.ajax({
		url: "log.html",
		cache: false,
		success: function(html){		
			$("#chatbox").html(html); //Insert chat log into the #chatbox div	
			
			//Auto-scroll			
			var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
			if(newscrollHeight > oldscrollHeight){
				$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
			}				
	  	},
	});
}

setInterval (loadLog, 500);
setInterval (loadLog, 500);
</script>
<?php
	}
	?>
	<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<script type="text/javascript">
</script>



</body>
</html>