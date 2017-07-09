<?php

////////////////////// 계정 정보 습득 및 데이터베이스 접속 //////////////////////////////////
require_once("data/db_info.php");

$s=mysql_connect($serv,$user,$pass) or die("데이터베이스 접속 실패");
mysql_select_db($dbnm);


////////////////////// 타이틀 등 표시 //////////////////////////////

print <<<eot1
<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		 <TITLE> SEJONG TIMES </TITLE>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>
	<body>

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="IML_main.php">SEJONG TIMES</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<h2>Menu</h2>
							<ul class="links">
								<li><a href="search.php">Search</a></li>
								<li><a href="link.html">External Link</a></li>
								<li><a href="map.html">Map</a></li>
								<li><a href="chat.html">Chat</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Wrapper -->
					<section id="wrapper">
						<header>
							<div class="inner">
								<h2>Search Board</h2>
								</div>
eot1;

///////////// 보안 처리 ///////////////////////

$se_d=isset($_GET["se"])?htmlspecialchars($_GET["se"]):null;

/////////////데이터가 있으면 검색처리 ///////////////////////////

if($se_d<>"")
{
   $str=<<<eot2
	select IMLtb1.gnum,IMLtb1.thread,IMLtb1.mess,IMLtb1.date
	from IMLtb1
	where IMLtb1.mess like "%$se_d%" and IMLtb1.thread like "%$se_d%"
eot2;

$re=mysql_query($str);
while($result=mysql_fetch_array($re))
{
	print "<a href='IML_board.php?gn=$result[0]'>$result[0] : $result[1]</a> : $result[2] ( $result[3] )";
	print "<br><br>";
}
}

mysql_close($s);

/////////////////// 검색 입력란 메인화면 링크 ///////////////////

print <<<eot3
	<b>Please enter the characters in post.</b>
	<br><br><br>
	<form method="GET" action="search.php">
		Input
		<input type="text" name="se">
		<br>
		<input type="submit" value="Submit">
	</form>
	<br>
	</body>
	</html>
	
eot3;
?>