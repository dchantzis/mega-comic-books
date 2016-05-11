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
<span class='headline'>Search for a comic book title</span>
<br>
<span class='headline'>If there is no title typed, all the titles are shown</span>
<br><br>
<table width='' height='' cellpading='5' cellspacing='5' border='1' bordercolor='#000000' bgcolor=''>
<form name='form04' id='form04' action='./code.php?form_id=7' method='post'>
	<tr>
		<td height='20' align='center' valign='middle'>
			<span class='title'>Enter comic book title: </span>
		</td>
		<td>
			<input type="text" name="title_name" id="title_name" style="width:150px" maxlength="100">
 		</td>
	</tr>
	<tr><td height='20' colspan=2></td></tr>
	<tr>
		<td height='20' align='right' valign='middle'><input type="submit" name="sbm" id="sbm" style='width:170px' value="search" style="CURSOR:hand"></td>
		<td height='20' align='right' valign='middle'><input type="reset" name="rst" id="rst" style='width:150px' value="reset" style="CURSOR:hand"></td>
	</tr>
	</form>
</table>
<br><br>
<a href='./index.php'>back</a>
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
