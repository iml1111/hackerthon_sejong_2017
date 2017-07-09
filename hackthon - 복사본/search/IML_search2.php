<?php

////////////////////// 계정 정보 습득 및 데이터베이스 접속 //////////////////////////////////
require_once("data/db_info.php");

$s=mysql_connect($serv,$user,$pass) or die("데이터베이스 접속 실패");
mysql_select_db($dbnm);


////////////////////// 타이틀 등 표시 //////////////////////////////

print <<<eot1
	<html>
	  <head>
	  <meta http-equiv="Content-Type" content="text/html;charset=euc-kr">
	  <TITLE> IML 스레드 </TITLE>
	  <head>
	<body bgcolor="darkgray">
	 <hr>
	 <font size="5">
		[검색 결과]
	</font>
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
	<hr>
	메세지에 포함되는 문자를 입력하세요.
	<br>
	<form method="GET" action="IML_search2.php">
		검색할 문자열
		<input type="text" name="se">
		<br>
		<input type="submit" value="검색">
	</form>
	<br>
	<a href="../IML_main.php">스레드 목록으로 돌아가기</a>
	</body>
	</html>
	
eot3;
?>