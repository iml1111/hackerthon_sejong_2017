<?php

////////////////////// ���� ���� ���� �� �����ͺ��̽� ���� //////////////////////////////////
require_once("data/db_info.php");

$s=mysql_connect($serv,$user,$pass) or die("�����ͺ��̽� ���� ����");
mysql_select_db($dbnm);


////////////////////// Ÿ��Ʋ �� ǥ�� //////////////////////////////

print <<<eot1
	<html>
	  <head>
	  <meta http-equiv="Content-Type" content="text/html;charset=euc-kr">
	  <TITLE> IML ������ </TITLE>
	  <head>
	<body bgcolor="darkgray">
	 <hr>
	 <font size="5">
		[�˻� ���]
	</font>
eot1;

///////////// ���� ó�� ///////////////////////

$se_d=isset($_GET["se"])?htmlspecialchars($_GET["se"]):null;

/////////////�����Ͱ� ������ �˻�ó�� ///////////////////////////

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

/////////////////// �˻� �Է¶� ����ȭ�� ��ũ ///////////////////

print <<<eot3
	<hr>
	�޼����� ���ԵǴ� ���ڸ� �Է��ϼ���.
	<br>
	<form method="GET" action="IML_search2.php">
		�˻��� ���ڿ�
		<input type="text" name="se">
		<br>
		<input type="submit" value="�˻�">
	</form>
	<br>
	<a href="../IML_main.php">������ ������� ���ư���</a>
	</body>
	</html>
	
eot3;
?>