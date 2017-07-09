<?php
	$email_d=$_POST['email'];
	$na_d=$_POST['na'];
	$me_d=$_POST['me'];
	$header='From: shin10256@gmail.com'."\r\n".'Reply-To: shin10256@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
  	$send=mail("shin10256@gmail.com","QnA","name:".$na_d."\n email:".$email_d."\n message:".$me_d."    \n-IML",$header);

	print <<< eot1
<!DOCTYPE HTML>
<!--
   Solid State by HTML5 UP
   html5up.net | @ajlkn
   Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=euc-kr">
        <TITLE> SEJONG TIMES </TITLE>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="assets/css/main.css" />
   <style>   
   ul.tab {
          list-style-type: none;
          margin: 30;
          padding: 0;
          overflow: hidden;
      border:none;
          background-color: black;
   }
</style>
</head>
   <body>
	 <!-- Banner -->
               <section id="banner">
                  <div class="inner">
			 </div>




               </section>
	 <!-- One -->
                     <section id="one" class="wrapper spotlight  style1">               <div class="inner">
                           
                           <div class="content">                      

                           
   
                              <h2  class="major">
				<font size="10">
				Sending mail was successful.
   				 </font>
  				</h2>
                           </div>
                        </div>
                     </section>
</body>
</html>
eot1;
?>