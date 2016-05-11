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
<TR>
	<TD WIDTH="800" HEIGHT="" COLSPAN="2">
		<table width="800" height="" bgcolor="" cellpadding="" cellspacing="">
			<tr>
				<td>
					<TABLE WIDTH="800" HEIGHT="100" BGCOLOR="#FFFFFF" CELLPADDING="0" CELLSPACING="0" BORDER="0">
						<TD width="105" height="25" bgcolor="#FFFFFF">&nbsp;</TD>
						<TD width="105" height="25" bgcolor="#FFFFFF">&nbsp;</TD>
						<TD width="380" height="100" bgcolor="#FFFFFF" align="center" valign="top"><img src="./images/logo.gif" width="380" height="100"></td>
						<TD width="105" height="25" bgcolor="#FFFFFF">&nbsp;</TD>
						<TD width="105" height="25" bgcolor="#FFFFFF">&nbsp;</TD>
					</TABLE>
				</td>
			</tr>
		
			<tr>
				<td>
					<TABLE WIDTH="800" HEIGHT="33" BGCOLOR="#000000" CELLPADDING="0" CELLSPACING="0" BORDER="0">
						<TD width="" height="33" align="right">&nbsp;<span class="white">|</span></TD>
						<TD width="150" height="33" bgcolor="#000000" align="center" valign="middle"><a href="./index.php" onmouseover="changeImages('butt_04','./images/butt_04_over.gif'); return true;" onmouseout="changeImages('butt_04','./images/butt_04.gif'); return true;"><img name="butt_04" id="butt_04" src="./images/butt_04.gif" width="100%" height="100%" border="0"></a></TD>
						<TD width="150" height="33" bgcolor="#000000" align="center" valign="middle"><a href="./customers.php" onmouseover="changeImages('butt_01','./images/butt_01_over.gif'); return true;" onmouseout="changeImages('butt_01','./images/butt_01.gif'); return true;"><img name="butt_01" id="butt_01" src="./images/butt_01.gif" width="100%" height="100%" border="0"></a></TD>
						<TD width="150" height="33" bgcolor="#000000" align="center" valign="middle"><a href="./orders.php" onmouseover="changeImages('butt_02','./images/butt_02_over.gif'); return true;" onmouseout="changeImages('butt_02','./images/butt_02.gif'); return true;"><img name="butt_02" id="butt_02" src="./images/butt_02.gif" width="100%" height="100%" border="0"></a></TD>
						<TD width="150" height="33" bgcolor="#000000" align="center" valign="middle"><a href="./titles.php" onmouseover="changeImages('butt_03','./images/butt_03_over.gif'); return true;" onmouseout="changeImages('butt_03','./images/butt_03.gif'); return true;"><img name="butt_03" id="butt_03" src="./images/butt_03.gif" width="100%" height="100%" border="0"></a></TD>
						<TD width="" height="33" align="left">&nbsp;<span class="white">|</span></td>
					</TABLE>
				</td>
			</tr>
		</table>
		</TD>
	</TR>
	<TR><TD WIDTH="800" HEIGHT="2" COLSPAN="2" ALIGN="center" VALIGN="middle">&nbsp;</TD></TR>
	<TR>
		<TD COLSPAN="3" ROWSPAN="1">			
			<table width="800" height="100%" border="0" cellpadding="0" cellspacing="2" BGCOLOR="#FFFFFF">
				<tr>
				  <td width="" height="500" align="center" valign="top">
					<CENTER>
<?php
	
	if($_GET["id"]=="1")
	{
		show_all_orders();
	}
	elseif($_GET["id"]=="2")
	{
		echo "<span class='headline'>Search orders</span>";
		echo "<br>";
		echo "<span class='headline'>If none fields are filled, all the orders are shown</span>";
		echo "<br>" . "<br>";
?>
<table width='' height='' cellpading='5' cellspacing='5' border='1' bordercolor='#000000' bgcolor=''>
<form name='form03' id='form03' action='./code.php?form_id=6' method='post'>
	<tr>
		<td height='20' align='center' valign='middle'>
			<span class='title'>Search orders/subscriptions older than date: </span>
		</td>
		<td>
				<select name="day_01" id="day_01" style="width:80px">
					<option value="" selected>[Day]</option>
					<option value=""></option>
					<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option>
					<option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option>
					<option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					<option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					<option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
					<option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option>
					<option value="31">31</option>
				</select>
				
				<select name="month_01" id="month_01" style="width:100px" >
					<option value="" SELECTED>[Month]</option>
					<option value=""></option>
					<option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option>
					<option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option>
					<option value="10">October</option><option value="11">November</option><option value="12">December</option>
				</select>
				
				<select name="year_01" id="year_01" style="width:100px" onFocus="focused(this)" onBlur="blurred(this)">
					<option value="" SELECTED>[Year]</option>
					<option value=""></option>
					<option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option>
					<option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option>
					<option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option>
					<option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option>
					<option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option>
					<option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option>
					<option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option>
					<option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option>
					<option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option>
				</select>	
		</td>
	</tr>
		<tr>
		<td height='20' align='right' valign='middle'>
			<span class='title'>earlier than date: </span>
		</td>
		<td>
				<select name="day_02" id="day_02" style="width:80px">
					<option value="" selected>[Day]</option>
					<option value=""></option>
					<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option>
					<option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option>
					<option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					<option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					<option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
					<option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option>
					<option value="31">31</option>
				</select>
				
				<select name="month_02" id="month_02" style="width:100px">
					<option value="" SELECTED>[Month]</option>
					<option value=""></option>
					<option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option>
					<option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option>
					<option value="10">October</option><option value="11">November</option><option value="12">December</option>
				</select>
				
				<select name="year_02" id="year_02" style="width:100px" onFocus="focused(this)" onBlur="blurred(this)">
					<option value="" SELECTED>[Year]</option>
					<option value=""></option>
					<option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option>
					<option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option>
					<option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option>
					<option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option>
					<option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option>
					<option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option>
					<option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option>
					<option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option>
					<option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option>
				</select>	
		</td>
	</tr>
	<tr><td height='20' colspan=2></td></tr>
	<tr>
		<td height='20' align='right' valign='middle'><input type="submit" name="sbm" id="sbm" style='width:300px' value="search" style="CURSOR:hand"></td>
		<td height='20' align='right' valign='middle'><input type="reset" name="rst" id="rst" style='width:300px' value="reset" style="CURSOR:hand"></td>
	</tr>
	</form>
</table>

<?	

	echo "<br>";
	echo "<a href='./orders.php'>::back::</a>";
	echo "</center>";
	}//end if
?>
					</CENTER>
					</td>								
				</tr>
			</table>
		</TD>
	</TR>
	<TR><TD WIDTH="800" HEIGHT="33" COLSPAN="2" bgcolor="#000000">&nbsp;</TD></TR>
</TABLE>
</center>
</body>
</html>
