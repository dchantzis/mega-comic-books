<?php
	if ($_GET["id"]=='')
	{header("Location: ./index.php");}
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
<TABLE WIDTH="800" HEIGHT="" BGCOLOR="" CELLPADDING="" CELLSPACING="">
<?php
layout_01();
?>
			<table width="800" height="100%" border="0" cellpadding="0" cellspacing="2" BGCOLOR="#FFFFFF">
				<tr>
				  <td width="" height="500" align="center" valign="top">
					<CENTER>
<?php

	if($_GET["id"]=="1")
	{
		show_all_customers();
	}
	elseif($_GET["id"]=="2")
	{
		echo "<span class='headline'>Search customers using one or more fields</span>";
		echo "<br>";
		echo "<span class='headline'>If none fields are selected, all the customers are shown</span>";
		show_search_fields();
		echo "<br>" . "<br>";
		echo "<a href='./customers.php'>back</a>";
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
