<?php
////////////////////// 계정 정보 습득 및 데이터베이스 접속 //////////////////////////////////


require_once("data/db_info.php");

$s=mysql_connect($serv,$user,$pass) or die("데이터베이스 접속 실패");
mysql_select_db($dbnm);



//////////////////////////////// 그룹번호(gn)를 %gn_d에 대입 //////////////////

$gn_d=$_GET["gn"];

/////////////////////////////보안검사 //////////////////////////////////

if(preg_match("/[^0-9]/",$gn_d))
{
print <<<eot1
	부정한 값이 입력되었습니다. <br>
	<a href="board_top.php"> 스레드 목록으로 돌아가기. </a>
eot1;
}
elseif(preg_match("/[0-9]/",$gn_d))
{

$na_d=isset($_GET["na"])?htmlspecialchars($_GET["na"]):null;
$me_d=isset($_GET["me"])?htmlspecialchars($_GET["me"]):null;

$ip=getenv("REMOTE_ADDR");                      // ip 가져오기 //


/////////////////////////// 스레드의 그룹번호gn 과 일치하는 레코드를 표시 /////////////////

$re=mysql_query("select * from imltb1 where gnum=$gn_d");
$result=mysql_fetch_array($re);

///////////////////////// 스레드의 댓글을 표시하는 문자열을 작성 //////////////////

$thread_com="「".$gn_d."-".$result[1]."」";
$result[8] = $result[8] + 1;
mysql_query("update imltb1 set view=$result[8] where gnum=$gn_d");

$gd_d=isset($_GET["gd"])?1:0;
if($gd_d)
{
	mysql_query("update imltb1 set good=($result[9]+1) where gnum=$gn_d");
	mysql_query("update imltb1 set view=($result[8]-1) where gnum=$gn_d");
}

///////////////////////// 스레드를 표시하는 제목 등 출력 //////////////////////////

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
         <input type="submit" value="좋아요">
<br><strong>Good:$result[9]</strong>
      </form>
	
      </font>
	
eot2;


//////////////////////////// 이름($na_d)이 입력되면 tbj1에 레코드를 추가한다. //////////////////////

if($na_d<>"")
{
	mysql_query("insert into imltb2 values(0,'$na_d','$me_d',now(),$gn_d,'$ip')");
}

print "<hr>";

/////////////////////////////  날짜와 시간순으로 댓글을 표시 ////////////////////////////////////

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

//////////////////////////////  데이터베이스 접속 종료 ////////////////////////////////////////

mysql_close($s);

print <<< eot3
   <hr>
   <font size="5">
   COMMENT
   </font>
   <form method="GET" action="IML_board.php">
      이름<br><input type="text" name="na"><br>
      메세지 <br>
      <TEXTAREA NAME="me" ROWS="5" cols="70"></TEXTAREA>
      <br>
      <input type="hidden" name="gn" value=$gn_d>
      <input type="submit" value="확인">
   </form>
   </blockquote>
                              <h4>Preformatted</h4>

                           </section>
eot3;

///////////////////////////// $gn_d 보안 처리 ///////////////////////////////////////////

}
else
{
	print "스레드를 선택하세요.<br>";
	print "<a href='IML_main.php'>스레드 목록으로 돌아가기</a>";
	print "</body></html>";
}

?>