<?php
////////////////////// ���� ���� ���� �� �����ͺ��̽� ���� //////////////////////////////////


require_once("data/db_info.php");

$s=mysql_connect($serv,$user,$pass) or die("�����ͺ��̽� ���� ����");
mysql_select_db($dbnm);



//////////////////////////////// �׷��ȣ(gn)�� %gn_d�� ���� //////////////////

$gn_d=$_GET["gn"];

/////////////////////////////���Ȱ˻� //////////////////////////////////

if(preg_match("/[^0-9]/",$gn_d))
{
print <<<eot1
	������ ���� �ԷµǾ����ϴ�. <br>
	<a href="board_top.php"> ������ ������� ���ư���. </a>
eot1;
}
elseif(preg_match("/[0-9]/",$gn_d))
{

$na_d=isset($_GET["na"])?htmlspecialchars($_GET["na"]):null;
$me_d=isset($_GET["me"])?htmlspecialchars($_GET["me"]):null;

$ip=getenv("REMOTE_ADDR");                      // ip �������� //


/////////////////////////// �������� �׷��ȣgn �� ��ġ�ϴ� ���ڵ带 ǥ�� /////////////////

$re=mysql_query("select * from imltb1 where gnum=$gn_d");
$result=mysql_fetch_array($re);

///////////////////////// �������� ����� ǥ���ϴ� ���ڿ��� �ۼ� //////////////////

$thread_com="��".$gn_d."-".$result[1]."��";
$result[8] = $result[8] + 1;
mysql_query("update imltb1 set view=$result[8] where gnum=$gn_d");

$gd_d=isset($_GET["gd"])?1:0;
if($gd_d)
{
	mysql_query("update imltb1 set good=($result[9]+1) where gnum=$gn_d");
	mysql_query("update imltb1 set view=($result[8]-1) where gnum=$gn_d");
}

///////////////////////// �����带 ǥ���ϴ� ���� �� ��� //////////////////////////

print <<< eot2
	<html>
      <head>
	<meta http-equiv="Content-Type" content="text/html;charset=euc-kr">
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="assets/css/main.css" />           <meta http-equiv="Content-Type"  content="text/html;charset=euc-kr">
            <TITLE> SEJONG TIMES </TITLE>
      </head>
      <body bgcolor="darkgray">
      
      <!-- Content -->
                     <div class="wrapper">
                        <div class="inner">

                           <section>
                              <h3 class="major"><font size="7"  color="powderblue">
      $thread_com 
      </font> view:$result[8]
      </h3>
                              
<font size="5">
      
      <br>
eot2;

print nl2br($result[7]);

print <<< eot2
      <br>
      <br><br><br>
      <form method="GET" action="IML_board.php">
         <input type="hidden" name="gd" value="good">
         <input type="hidden" name="gn" value=$gn_d>
         <input type="submit" value="���ƿ�">
<br><strong>Good:$result[9]</strong>
      </form>
	
      </font>
	
eot2;


//////////////////////////// �̸�($na_d)�� �ԷµǸ� tbj1�� ���ڵ带 �߰��Ѵ�. //////////////////////

if($na_d<>"")
{
	mysql_query("insert into imltb2 values(0,'$na_d','$me_d',now(),$gn_d,'$ip')");
}

print "<hr>";

/////////////////////////////  ��¥�� �ð������� ����� ǥ�� ////////////////////////////////////

$re=mysql_query("select * from imltb2 where gnum=$gn_d order by date");

$i=1;
print "<h4>Comment</h4>";
while($result=mysql_fetch_array($re))
{
	print "<blockquote>$i($result[0])[<U>$result[1]</U>] $result[3] <br>";
	print nl2br($result[2]);
	print "<br><br>";
	$i++;
}

//////////////////////////////  �����ͺ��̽� ���� ���� ////////////////////////////////////////

mysql_close($s);

print <<< eot3
   <hr>
   <font size="5">
   COMMENT
   </font>
   <form method="GET" action="IML_board.php">
      �̸�<br><input type="text" name="na"><br>
      �޼��� <br>
      <TEXTAREA NAME="me" ROWS="5" cols="70"></TEXTAREA>
      <br>
      <input type="hidden" name="gn" value=$gn_d>
      <input type="submit" value="Ȯ��">
   </form>
   </blockquote>
                              <h4>Preformatted</h4>

                           </section>
eot3;

///////////////////////////// $gn_d ���� ó�� ///////////////////////////////////////////

}
else
{
	print "�����带 �����ϼ���.<br>";
	print "<a href='IML_main.php'>������ ������� ���ư���</a>";
	print "</body></html>";
}

?>