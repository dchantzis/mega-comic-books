<?php
	if ($_GET["os_date"]=='' OR $_GET["os_time"]=='' OR $_GET["cust_id"]=='')
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

			<table width="800" height="100%" border="0" cellpadding="0" cellspacing="2" BGCOLOR="#FFFFFF">
				<tr>
				  <td width="" height="500" align="center" valign="top">
					<CENTER>
<?php 
	if ($_GET["title"]=="")
	{
		show_subscription_entries($_GET["os_date"], $_GET["os_time"], $_GET["cust_id"], $_GET["navi"]); 
	}
	elseif ($_GET["title"]!="")
	{
		show_subscription_entries2($_GET["os_date"], $_GET["os_time"], $_GET["cust_id"], $_GET["navi"], $_GET["title"]); 
	}
?>
					</CENTER>
					</td>								
				</tr>
			</table>

</center>
</body>
</html>
