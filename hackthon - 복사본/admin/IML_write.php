<?php

print <<< eot3

<html>
	<head>
	  <meta http-equiv="Content-Type" content="text/html;charset=euc-kr">
	  <TITLE> IML 공지사항 </TITLE>
	</head>


<style>
h1.head {
    font-family: "Times New Roman", Times, serif;
	font-size: 40px;
}

ul.tab {
    list-style-type: none;
    margin: 30;
    padding: 0;
    overflow: hidden;
border:none;
    background-color: black;
}
body {
	background-image:url("img/gray.jpg");
		
}

li.tab {
margin: 30;
    float: left;
	list-style-type: none;
	border:none;    
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 16px;
    text-decoration: none;
    border:1px solid white;
}

li a:hover {
    background-color: #444444;
}

.ir{
	background: url(paper.gif);
}

div.cities {
	    
    background-color: black;
    color: white;
    margin: 30px 0 30px 0;
    padding: 20px;
    border: 3px solid white;
	 border-radius: 25px;
}


#left {
float: left;

margin-right: 5px;
}


#rightflow {
width: 200px;
float: right;
background: #efe5d0;   
padding: 50px;
margin-right: 100px;
}

</style>




<body bgcolor="darkgray">

<div class="cities">
<font size="5">
	  스레드 작성
	</font>
	<br>
	   여기에 새로운 스레드를 작성합니다.
	<br>
	   <form method="POST" action="../iml_main.php" enctype="multipart/form-data">
	      공지사항 제목
	   <input type="text" name="th" size="50">
	   <br>
		단과대
	   <input type="text" name="coll" size="50">
	   <br>
		학과
	   <input type="text" name="major" size="50">
	   <br>
		성향
	   <input type="text" name="opt" size="50">
	<br>
	내용
	<TEXTAREA NAME="me" ROWS="10" cols="70"></TEXTAREA>
	<br>
	<input type="file" name="file" size="50">
	<br>
	   <input type="submit" value="확인">
	   </form></div>
<hr>
</body>
</html>

eot3;

?>