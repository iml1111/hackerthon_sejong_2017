<?php
////////////////////// 계정 정보 습득 및 데이터베이스 접속 //////////////////////////////////
require_once("data/db_info.php");

$s=mysql_connect($serv,$user,$pass) or die("데이터베이스 접속 실패");
mysql_select_db($dbnm);


///////////////////// 타이틀 화면 표시 ///////////////////////////////////

print <<< eot1
<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		 <TITLE> SEJONG TIMES </TITLE>
		<meta http-equiv="Content-Type" content="text/html;charset=euc-kr">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
   <body>

      <!-- Page Wrapper -->
         <div id="page-wrapper">

            <!-- Header -->
               <header id="header" class="alt">
                  <h1><a href="IML_main.php">Sejong Times</a></h1>
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

          <!-- Banner -->
					<section id="banner">
						<div class="inner">
							<div class="logo"><span class="icon fa-diamond"></span></div>
							<h2>Welcome to Sejong Times</h2>
							<p>Take the right information for you</p>
						</div>
	
					</section>

            <!-- Wrapper -->
               <section id="wrapper">
  
eot1;

///////////////////// 클라이언트의 ip 주소 수집 /////////////////////////////

$ip=getenv("REMOTE_ADDR");

//////////////////// 스레드 제목(th)에 데이터가 있으면 테이블 tbj0에 대입 ////////////////////

$th_d=isset($_POST["th"])? htmlspecialchars($_POST["th"]):null;

if($th_d<>"")
{
	$coll_d=$_POST["coll"];
	$major_d=$_POST["major"];
	$opt_d=$_POST["opt"];
	$me_d=$_POST["me"];
	mysql_query("insert into imltb1(thread,date,ipaddr,coll,major,opt,mess,view,good) values('$th_d',now(),'$ip','$coll_d','$major_d','$opt_d','$me_d',0,0)");
	$target="files/".$th_d.".png";
	move_uploaded_file($_FILES['file']['tmp_name'],$target);	
}


/////////////////////// tbj0의 모든 데이터 추출 및 출력 ////////////////////////////////

$so_d=isset($_POST["so"])? htmlspecialchars($_POST["th"]):null;
$ju_d=isset($_POST["ju"])? htmlspecialchars($_POST["th"]):null;
$go_d=isset($_POST["go"])? htmlspecialchars($_POST["th"]):null;

if($so_d<>"")
{
	$re=mysql_query("select * from imltb1 where imltb1.collage like '%소프트웨어융합%'");
}
else if($ju_d<>"")
{
	$re=mysql_query("select * from imltb1 where imltb1.collage like '%전자정보%'");
}
else if($go_d<>"")
{
	$re=mysql_query("select * from imltb1 where imltb1.collage like '%공과%'");
}
else
{
	$re=mysql_query("select * from imltb1");
}
$pg_d=isset($_GET["pg"])? $_GET["pg"]:1;
$cnt=0;
while($result=mysql_fetch_array($re))
{
	if($result[0] >= (($pg_d - 1) * 10) + 1)
	{
	if($result[0] <= ($pg_d * 10))
	{
	$nm=$result[0] % 10;
	if($nm == 0)
	$nm=10;
if($nm % 2 == 1)
{
print <<< eot2
	 <!-- One -->
                     <section id="one" class="wrapper spotlight  style1">               <div class="inner">
                           
                           <div class="content">                      

                           
   
                              <h2  class="major" ><font size="5" color="powderblue">
     [$nm] $result[1]
    </font>
  </h2>
      $result[2]<br>
                              <a href="IML_board.php?gn=$result[0]"  class="special">Learn more</a>
                           </div>
                        </div>
                     </section>
eot2;
}
else
{
print <<< eot2
	<!-- Two -->
                     <section id="two" class="wrapper alt  spotlight style2">
                        <div class="inner">
                         
                           <div class="content">
                              <h2  class="major"><font size="5" color="powderblue">[$nm] $result[1]</font></h2>
  
				$result[2]<br>
                               <a href="IML_board.php?gn=$result[0]"  class="special">Learn more</a>
                           </div>
                        </div>
                     </section>
eot2;
}

 $cnt=$cnt+1;
	}
	}

}
if($cnt==0)
{
	print"<font size='5'><b>EMPTY</b></font><br>";
}

print <<< eot4
	<font size="5">
	<ul class="pagination" style="text-align:right">
	<li></li>
	<li><a href="IML_main.php?pg=1" class="page">1 </a></li>
	<li><a href="IML_main.php?pg=2" class="page">2 </a></li>
	<li><a href="IML_main.php?pg=3" class="page">3 </a></li>
	<li><a href="IML_main.php?pg=4" class="page">4 </a></li>
	<li><a href="IML_main.php?pg=5" class="page">5 </a></li>
	<li><a href="IML_main.php?pg=6" class="page">6 </a></li>
	<li></li>
	</font>
	</ul>
eot4;

mysql_close($s);

////////////////// 스레드 제목 입력과 메인 화면으로 이동하는 링크 등등 ////////////////////

print <<< eot3

	
                           <ul class="actions">
                              <br><li><a href="#"  class="button">Browse All</a></li>
                           </ul>
                        </div>
                     </section>

               </section>

 <!-- Footer -->
               <section id="footer">
                  <div class="inner">
                     <h2 class="major">QnA</h2>
                     <p>If you have any questions or concerns, please do not hesitate to contact us.</p>

		 <form method="post" action="mail/sending.php">
                        <div class="field">
                           <label  for="name">Name</label>
                           <input type="text"  name="na" id="name" />
                        </div>
                        <div class="field">
                           <label  for="email">Email</label>
                           <input type="email"  name="email" id="email" />
                        </div>
                        <div class="field">
                           <label  for="message">Message</label>
                           <textarea name="me"  id="message" rows="4"></textarea>
                        </div>
                        <ul class="actions">
                           <li><input type="submit"  value="Send Message" /></li>
                        </ul>
                     </form>


                     <ul class="contact">
                        <li class="fa-home">
                           IML Inc<br />
                           Sejong University<br/>
                           Korea.
                        </li>
                        <li class="fa-phone">(010) 4579 - 3099</li>
                        <li class="fa-envelope"><a  href="#">shin10256@gmail.com</a></li>
                     </ul>
                     <ul class="copyright">
                        <li>&copy; IML Inc. All rights  reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                     </ul>
                  </div>
               </section>

         </div>

      <!-- Scripts -->
         <script src="assets/js/skel.min.js"></script>
         <script src="assets/js/jquery.min.js"></script>
         <script src="assets/js/jquery.scrollex.min.js"></script>
         <script src="assets/js/util.js"></script>
         <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><! [endif]-->
         <script src="assets/js/main.js"></script>

   </body>
</html>
eot3;

?>