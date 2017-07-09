<?php
require_once("../data/db_info.php");
$s=mysql_connect($serv,$user,$pass) or die("실패");

mysql_select_db($dbnm);


mysql_query("delete from imltb1");
mysql_query("delete from imltb2");
mysql_query("ALTER TABLE imltb1 AUTO_INCREMENT=1");
mysql_query("ALTER TABLE imltb2 AUTO_INCREMENT=1");

print "IML 스레드 초기화 완료";

mysql_close($s);

?>