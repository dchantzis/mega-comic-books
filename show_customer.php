<?php
	if ($_GET["cust_id"]=='')
	{echo ("<span class='red2'>" . "ERROR". "</span>") ;}
?>
<?php require("./code.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>::mega comic books::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link rel="stylesheet" type="text/css" href="./style.css">
<script language="JavaScript" type="text/JavaScript" src="./scripts/js_00.js"></script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" ONLOAD="preloadImages();">
<center>
<?php
layout_01();
?>
			<table width="800" height="100%" border="0" cellpadding="0" cellspacing="2" BGCOLOR="#FFFFFF">
				<tr>
				  <td width="" height="500" align="center" valign="top">
					<CENTER>
<?php

	show_customer($_GET["cust_id"], $_GET["navi"]);
	show_all_subscriptions($_GET["cust_id"], $_GET["navi"]);//call function that shows all the subscriptions of customer with customer id cust_id, and the navigation value for the 'back' link

	echo "<br>";
	switch ($_GET["navi"])
	{
		case 1:
			echo "<a href='./show_all_customers.php?id=1'>back</a>";
			break;
		case 2:
			echo "<a href='./show_all_customers.php?id=2'>return to search form</a>";
			break;
		default;
	}
?>
					</CENTER>
					</td>
				</tr>
			</table>
<?php
layout_02();
?>
</center>
</body>
</html>
