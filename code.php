<?php require_once ( "config.inc.php"); ?>
<?php
	switch ($_GET["form_id"])
	{
		case 1:
			header("Location: ./show_customer.php?cust_id=".$_POST["cust_id"]."&navi=".$_POST["navi"]);
			break;
		case 2:
			customers_query($_POST["surname"], $_POST["name"], $_POST["country"], $_POST["city"], $_POST["email"]);
			break;
		case 3:
			header("Location: ./show_customer.php?cust_id=".$_POST["cust_id"]."&navi=".$_POST["navi"]);
			break;
		case 4:
			show_subscription_entries($_POST["os_date"], $_POST["os_time"], $_POST["cust_id"], $_POST["navi"]);
			break;
		case 5:
			header("Location: ./show_order.php?os_date=".$_POST["os_date"] . "&os_time=" . $_POST["os_time"] . "&cust_id=" . $_POST["cust_id"]."&navi=".$_POST["navi"]);
			break;
		case 6:
			show_orders_query($_POST["day_01"], $_POST["month_01"], $_POST["year_01"], $_POST["day_02"], $_POST["month_02"], $_POST["year_02"]);
			break;
		case 7:
			show_titles_query($_POST["title_name"], 5);//second parameter is the navi button value
			break;
		case 8:
			header("Location: ./show_order.php?os_date=".$_POST["os_date"] . "&os_time=" . $_POST["os_time"] . "&cust_id=" . $_POST["cust_id"] . "&navi=" . $_POST["navi"] . "&title=" . $_POST["title"]);
			break;
	}//switch
?>
<link rel="stylesheet" type="text/css" href="./style.css">
<?php

//shows all customers
function show_all_customers()
{
	$dbobj = new MCBDBase();
	$customerVars = array();

	$query = "SELECT cust_id, surname, name, e_mail, country, city, street, street_number, post_code, phone FROM customers; ";
	$result = @mysql_query($query) or die("error executing query "+$query);
	$num = @mysql_num_rows($result);

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form01' id='form01' action='./code.php?form_id=1' method='post'>";
	$html_tag_11 = "<input type='submit' style='width:100px' value='view";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='hidden' name='cust_id' id='cust_id' value='";
	$html_tag_14 = "'>";
	$html_tag_15 = "</form>";

	$html_tag_16 = "<a href='mailto:";
	$html_tag_17 = "'>";
	$html_tag_18 = "</a>";


	echo "<center>";//prints table in the center of the page
	echo "<span class='headline2'>" . "customers" . "<span>";
	echo "<br>" . "<br>";
	echo ($html_tag_01);//table

	//create first table row with titles
	echo ($html_tag_02);
	echo ($html_tag_03 . $html_tag_07 . "&nbsp;" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "surname" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "name" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "e_mail" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "country" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "city" . $html_tag_08 . $html_tag_04);
	/*
	echo ($html_tag_03 . $html_tag_07 . "street" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "street number" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "post_code" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "phone" . $html_tag_08 . $html_tag_04);
	*/
	echo ($html_tag_05);//table row
	for($i=0; $i<$num; $i++)
	{
		$tempID = @mysql_result($result,$i,'cust_id');
		$customerVars[$tempID]['cust_id'] = @mysql_result($result,$i,'cust_id');
		$customerVars[$tempID]['surname'] = @mysql_result($result,$i,'surname');
		$customerVars[$tempID]['name'] = @mysql_result($result,$i,'name');
		$customerVars[$tempID]['e_mail'] = @mysql_result($result,$i,'e_mail');
		$customerVars[$tempID]['country'] = @mysql_result($result,$i,'country');
		$customerVars[$tempID]['city'] = @mysql_result($result,$i,'city');
	}

	reset ($customerVars);
	while (list($key, $val) = each ($customerVars))
	{
		echo ($html_tag_02);//new table row

		echo ($html_tag_10);//new form
		echo ($html_tag_03 . $html_tag_11 . $html_tag_12 . $html_tag_13 . $customerVars[$key]['cust_id'] . $html_tag_14 . $html_tag_04 );
		echo ("<input type='hidden' name='navi' id='navi' value='1'></input>");//hidden for navi button
		echo ($html_tag_15);//end form
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['surname'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['name'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $html_tag_16 . $customerVars[$key]['e_mail'] . $html_tag_17 . $customerVars[$key]['e_mail'] . $html_tag_18 . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['country'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['city'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_05);//end table row
	}
	echo ($html_tag_06);//end table

	echo "<br>" . "<br>";
	echo "<a href='./customers.php'>back</a>";
	echo "</center>";

	unset($dbobj);
}//end show_all_customers


//show customer data
function show_customer($cust_id, $navi)
{
	$dbobj = new MCBDBase();
	$customerVars = array();

	$query = "SELECT * FROM customers WHERE cust_id=" . $cust_id . ";";
	$result = @mysql_query($query) or die("error executing query "+$query);
	$num = @mysql_num_rows($result);

	$html_tag_01 = "<table width='' height='' cellpading='5' cellspacing='5' border='0' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='left' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<a href='mailto:";
	$html_tag_11 = "'>";
	$html_tag_12 = "</a>";

	$cust_id = "";

	echo "<span class='headline2'>" . "CUSTOMER DATA" . "<span>";
	echo "<br>" . "<br>";

	for($i=0; $i<$num; $i++)
	{
		$tempID = @mysql_result($result,$i,'cust_id');
		$customerVars[$tempID]['cust_id'] = @mysql_result($result,$i,'cust_id');
		$customerVars[$tempID]['surname'] = @mysql_result($result,$i,'surname');
		$customerVars[$tempID]['name'] = @mysql_result($result,$i,'name');
		$customerVars[$tempID]['e_mail'] = @mysql_result($result,$i,'e_mail');
		$customerVars[$tempID]['country'] = @mysql_result($result,$i,'country');
		$customerVars[$tempID]['city'] = @mysql_result($result,$i,'city');
		$customerVars[$tempID]['street'] = @mysql_result($result,$i,'street');
		$customerVars[$tempID]['street_number'] = @mysql_result($result,$i,'street_number');
		$customerVars[$tempID]['post_code'] = @mysql_result($result,$i,'post_code');
		$customerVars[$tempID]['phone'] = @mysql_result($result,$i,'phone');
	}

	echo ($html_tag_01);//table

	echo ($html_tag_02);//new table row
	echo ($html_tag_03 . $html_tag_07 . "Surname: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "Name: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "E-mail: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "Country: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "City: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "Street: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "Street Number: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "Postal Code: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "Phone: " . $html_tag_09 . $html_tag_04);
	echo ($html_tag_05);//end table row


	reset ($customerVars);
	while (list($key, $val) = each ($customerVars))
	{
		$cust_id = $customerVars[$key]['cust_id'];

		echo ($html_tag_02);//new table row
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['surname'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['name'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $html_tag_10 . $customerVars[$key]['e_mail'] . $html_tag_11 . $customerVars[$key]['e_mail'] . $html_tag_12 . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['country'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['city'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['street'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['street_number'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['post_code'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_03 . $html_tag_08 . $customerVars[$key]['phone'] . $html_tag_09 . $html_tag_04);//show column value
		echo ($html_tag_05);//end table row
	}
	echo ($html_tag_06);//end table
	echo "<br>";

	unset($dbobj);
}//end show_customer



//prints all the search forms for customer search
function show_search_fields()
{
	$dbobj = new MCBDBase();
	$customerVars = array();

	$html_tag_01 = "<table width='' height='' cellpading='5' cellspacing='5' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "</table>";
	$html_tag_03 = "<tr>";
	$html_tag_04 = "</tr>";
	$html_tag_05 = "<td height='20' align='center' valign='middle'>";
	$html_tag_06 = "</td>";
	$html_tag_07 = "<span class='tag'>";
	$html_tag_08 = "<span class='title'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form02' id='form02' action='./code.php?form_id=2' method='post'>";
	$html_tag_11 = "<input type='submit' name='sbm' id='sbm' style='width:150px' value='search";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='reset' name='rst' id='rst' style='width:250px' value='";
	$html_tag_14 = "' style='CURSOR: hand'>";
	$html_tag_15 = "</form>";
	$html_tag_16 = "<select name='";
	$html_tag_17 = "' id='";
	$html_tag_18 = "' style='width:250px' class=''>";
	$html_tag_19 = "</select>";

	$query01 = "SELECT DISTINCT(surname) FROM customers ORDER BY surname ASC"; //finds all the customer surnames
	$result01 = @mysql_query($query01) or die("<span class='title'>" . "error" . "</span>");
	$num01 = @mysql_num_rows($result01);

	echo $html_tag_10;//form
	echo $html_tag_01;//table

	echo $html_tag_03;//table row
	echo $html_tag_05 . $html_tag_08 . "choose surname:" . $html_tag_09 . $html_tag_06;
	echo $html_tag_05;//table data for combo box
	echo $html_tag_16 . "surname" . $html_tag_17 . "surname" . $html_tag_18;//select
	echo "<option value=''>" . "<span class='blog_tag'>" . "" . "</span></option>"; //first choice empty

	//create name combo box
	for($i=0; $i<$num01; $i++)
	{
		$tempSurname = @mysql_result($result01,$i,'surname');
		echo "<option value='" . $tempSurname . "'>" . "<span class='blog_tag'>" . $tempSurname . "</span></option>";
	}//for
	echo $html_tag_06;//end table data for combo box
	echo $html_tag_04;//end table row
	echo $html_tag_19;//end select

	$query02 = "SELECT DISTINCT(name) FROM customers ORDER BY surname ASC"; //finds all the customer surnames
	$result02 = @mysql_query($query02) or die("<span class='title'>" . "error" . "</span>");
	$num02 = @mysql_num_rows($result02);

	echo $html_tag_03;//table row
	echo $html_tag_05 . $html_tag_08 . "choose name:" . $html_tag_09 . $html_tag_06;
	echo $html_tag_05;//table data for combo box
	echo $html_tag_16 . "name" . $html_tag_17 . "name" . $html_tag_18;//select
	echo "<option value=''>" . "<span class='blog_tag'>" . "" . "</span></option>"; //first choice empty

	//create name combo box
	for($i=0; $i<$num02; $i++)
	{
		$tempName = @mysql_result($result02,$i,'name');
		echo "<option value='" . $tempName . "'>" . "<span class='blog_tag'>" . $tempName . "</span></option>";
	}//for
	echo $html_tag_06;//end table data for combo box
	echo $html_tag_04;//end table row
	echo $html_tag_19;//end select

	$query03 = "SELECT DISTINCT(country) FROM customers ORDER BY country ASC;"; //finds all the customer countries
	$result03 = @mysql_query($query03) or die("<span class='title'>" . "error" . "</span>");
	$num03 = @mysql_num_rows($result03);

	echo $html_tag_03;//table row
	echo $html_tag_05 . $html_tag_08 . "choose country:" . $html_tag_09 . $html_tag_06;
	echo $html_tag_05;//table data for combo box
	echo $html_tag_16 . "country" . $html_tag_17 . "country" . $html_tag_18;//select
	echo "<option value=''>" . "<span class='blog_tag'>" . "" . "</span></option>"; //first choice empty

	//create country combo box
	for($i=0; $i<$num03; $i++)
	{
		$tempCountry = @mysql_result($result03,$i,'country');
		echo "<option value='" . $tempCountry . "'>" . "<span class='blog_tag'>" . $tempCountry . "</span></option>";
	}//for
	echo $html_tag_06;//end table data for combo box
	echo $html_tag_04;//end table row
	echo $html_tag_19;//end select

	$query04 = "SELECT DISTINCT(city) FROM customers ORDER BY city ASC;"; //finds all the customer countries
	$result04 = @mysql_query($query04) or die("<span class='title'>" . "error" . "</span>");
	$num04 = @mysql_num_rows($result04);

	echo $html_tag_03;//table row
	echo $html_tag_05 . $html_tag_08 . "choose city:" . $html_tag_09 . $html_tag_06;
	echo $html_tag_05;//table data for combo box
	echo $html_tag_16 . "city" . $html_tag_17 . "city" . $html_tag_18;//select
	echo "<option value=''>" . "<span class='blog_tag'>" . "" . "</span></option>"; //first choice empty
	//create city combo box
	for($i=0; $i<$num04; $i++)
	{
		$tempCity = @mysql_result($result04,$i,'city');
		echo "<option value='" . $tempCity . "'>" . "<span class='blog_tag'>" . $tempCity . "</span></option>";
	}//for
	echo $html_tag_06;//end table data for combo box
	echo $html_tag_04;//end table row
	echo $html_tag_19;//end select

	$query05 = "SELECT DISTINCT(e_mail) FROM customers ORDER BY e_mail ASC;"; //finds all the customer e-mails
	$result05 = @mysql_query($query05) or die("<span class='title'>" . "error" . "</span>");
	$num05 = @mysql_num_rows($result05);

	echo $html_tag_03;//table row
	echo $html_tag_05 . $html_tag_08 . "choose e-mail:" . $html_tag_09 . $html_tag_06;
	echo $html_tag_05;//table data for combo box
	echo $html_tag_16 . "email" . $html_tag_17 . "email" . $html_tag_18;//select
	echo "<option value=''>" . "<span class='blog_tag'>" . "" . "</span></option>"; //first choice empty
	//create e-mail combo box
	for($i=0; $i<$num05; $i++)
	{
		$tempE_mail = @mysql_result($result05,$i,'e_mail');
		echo "<option value='" . $tempE_mail . "'>" . "<span class='blog_tag'>" . $tempE_mail . "</span></option>";
	}//for
	echo $html_tag_06;//end table data for combo box
	echo $html_tag_04;//end table row
	echo $html_tag_19;//end select

	echo $html_tag_03 . "<td height='20' colspan=2></td>" . $html_tag_04;//empty row in table

	echo $html_tag_03;//new row
	echo $html_tag_05 . $html_tag_11 . $html_tag_12 . $html_tag_06; //table data with submit button
	echo $html_tag_05 . $html_tag_13 . "reset" . $html_tag_14 . $html_tag_06; //table data with submit button
	echo $html_tag_04;//end row

	echo $html_tag_02;//end table
	echo $html_tag_15;//end form

	unset($dbobj);
}//show_search_fields



//finds all the resulting customers from the search customer form
function customers_query($surname, $name, $country, $city, $email)
{
	$dbobj = new MCBDBase();
	$customerVars = array();

	layout_01();//print the first part of the html layout code
	$layoutA = "<table width='800' height='100%' border='0' cellpadding='0' cellspacing='2' BGCOLOR='#FFFFFF'>"
		. "<tr>"
		. "<td width='' height='500' align='center' valign='top'>"
		. "<CENTER>";

	$layoutB = "</CENTER>"
		. "</td>"
		. "</tr>"
		. "</table>";

	echo $layoutA;

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form01' id='form01' action='./code.php?form_id=3' method='post'>";
	$html_tag_11 = "<input type='submit' style='width:100px' value='view";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='hidden' name='cust_id' id='cust_id' value='";
	$html_tag_14 = "'>";
	$html_tag_15 = "</form>";

	$html_tag_16 = "<a href='mailto:";
	$html_tag_17 = "'>";
	$html_tag_18 = "</a>";

	$string_01 = " surname='";
	$string_02 = "'";
	$string_03 = " name='";
	$string_04 = " country='";
	$string_05 = " city='";
	$string_06 = " e_mail='";
	$string_07 = " OR ";
	$string_08 = " AND ";
	$string_09 = " WHERE ";

	$STRING_CUSTOMER_SELECTION_01 = "SELECT * " . " FROM customers ";
	$STRING_CUSTOMER_SELECTION_02 = $STRING_CUSTOMER_SELECTION_01 . $string_09;
	$STRING_CUSTOMER_SELECTION_03 = $string_01 . $surname . $string_02;
	$STRING_CUSTOMER_SELECTION_04 = $string_03 . $name . $string_02;
	$STRING_CUSTOMER_SELECTION_05 = $string_04 . $country . $string_02;
	$STRING_CUSTOMER_SELECTION_06 = $string_05 . $city . $string_02;
	$STRING_CUSTOMER_SELECTION_07 = $string_06 . $email . $string_02;

	if($surname!="")
		{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION_02 . $STRING_CUSTOMER_SELECTION_03;}
	else {$STRING_CUSTOMER_SELECTION="";}

	if($name!="")
	{
		if($surname=="")
			{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION_02 . $STRING_CUSTOMER_SELECTION_04;}
		else
			{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION . $string_08 . $STRING_CUSTOMER_SELECTION_04;}
	}

	if($country!="")
	{
		if($name=="" AND $surname=="")
			{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION_02 . $STRING_CUSTOMER_SELECTION_05;}
		else
			{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION . $string_08 . $STRING_CUSTOMER_SELECTION_05;}
	}

	if($city!="")
	{
		if($country=="" AND $name=="" AND $surname=="")
		{
			$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION_02 . $STRING_CUSTOMER_SELECTION_06;
		}else
			{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION . $string_08 . $STRING_CUSTOMER_SELECTION_06;}
	}

	if($email!="")
	{
		if($city=="" AND $country=="" AND $name=="" AND $surname=="")
		{
			$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION_02 . $STRING_CUSTOMER_SELECTION_07;
		}else
			{$STRING_CUSTOMER_SELECTION = $STRING_CUSTOMER_SELECTION . $string_08 . $STRING_CUSTOMER_SELECTION_07;}
	}

	if($email=="" AND $city=="" AND $country=="" AND $name=="" AND $surname=="")
	{$STRING_CUSTOMER_SELECTION=$STRING_CUSTOMER_SELECTION_01;}

	/*
	$STRING_CUSTOMER_SELECTION = "SELECT * " . " FROM customers "
	 . $string_09 . $string_01 . $surname . $string_02
	 . $string_08 . $string_03 . $name . $string_02
	 . $string_08 . $string_04 . $country . $string_02
	 . $string_08 . $string_05 . $city . $string_02
	 . $string_08 . $string_06 . $email . $string_02 . " ORDER BY SURNAME,NAME;";
	*/

	$query = $STRING_CUSTOMER_SELECTION; //finds all the customer e-mails
	$result = @mysql_query($query) or die("<span class='title'>" . "error" . "</span>");
	$num = @mysql_num_rows($result);

	if (!$result)
	{
		echo ("<span class='tag'>" . "error" . "</span>");
		echo ("<a href='show_all_customers.php?id=2'>go back</a>");
	}
	echo "<center>";//prints table in the center of the page
	if($num==0)//check if the query returns any values
	{
		echo ("<span class='tag'>" . "A customer with these values");

		echo "<br>";
		echo "<br>";
		echo $html_tag_01;//table

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "Surname: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "&nbsp;" . $surname . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "Name: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "&nbsp;" . $name . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "Country: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "&nbsp;" . $country . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "City: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "&nbsp;" . $city . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "E_Mail: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "&nbsp;" . $email . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_06;//table
		echo "<br>";

		echo (" doesn't exist" . "</span>");
		echo "<br>";
		echo "<br>";
		echo ("<a href='show_all_customers.php?id=2'>go back</a>");
	}
	else{//if the guery returns row then show them in table

			echo "<span class='headline2'>" . "customers" . "<span>";
			echo "<br>" . "<br>";
			echo ($html_tag_01);//table

			//create first table row with titles
			echo ($html_tag_02);
			echo ($html_tag_03 . $html_tag_07 . "&nbsp;" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "surname" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "name" . $html_tag_08 . $html_tag_04);

			echo ($html_tag_03 . $html_tag_07 . "e-mail" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "country" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "city" . $html_tag_08 . $html_tag_04);
			/*in case i want to print all the columns
			echo ($html_tag_03 . $html_tag_07 . "street" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "street number" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "postal code" . $html_tag_08 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_07 . "phone" . $html_tag_08 . $html_tag_04);
			*/

			echo ($html_tag_05);

			for($i=0; $i<$num; $i++)
			{
				$tempCust_id = @mysql_result($result,$i,'cust_id');
				$tempSurname = @mysql_result($result,$i,'surname');
				$tempName = @mysql_result($result,$i,'name');
				$tempE_mail = @mysql_result($result,$i,'e_mail');
				$tempCountry = @mysql_result($result,$i,'country');
				$tempCity = @mysql_result($result,$i,'city');
				$tempStreet = @mysql_result($result,$i,'street');
				$tempStreet_Number = @mysql_result($result,$i,'street_number');
				$tempPost_code = @mysql_result($result,$i,'post_code');
				$tempPhone = @mysql_result($result,$i,'phone');

				echo ($html_tag_10);//new form
				echo ($html_tag_03 . $html_tag_11 . $html_tag_12 . $html_tag_13 . $tempCust_id . $html_tag_14 . $html_tag_04 );
				echo ("<input type='hidden' name='navi' id='navi' value='2'></input>");//hidden for navi button
				echo ($html_tag_15);//end form
				echo ($html_tag_03 . $html_tag_08 . $tempSurname . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $tempName . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $html_tag_16 . $tempE_mail . $html_tag_17 . $tempE_mail . $html_tag_18 . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $tempCountry . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $tempCity . $html_tag_09 . $html_tag_04);
				/*
				echo ($html_tag_03 . $html_tag_08 . $tempStreet . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $tempStreet_Number . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $tempPost_code . $html_tag_09 . $html_tag_04);
				echo ($html_tag_03 . $html_tag_08 . $tempPhone . $html_tag_09 . $html_tag_04);

				*/
				echo ($html_tag_05);//end table row
			}//for

		echo ($html_tag_06);//end table
	}//if

	echo "<br>" . "<br>";
	echo "<a href='./show_all_customers.php?id=2'>back</a>";
	echo "</center>";//end center

	unset($dbobj);

	echo $layoutB;
	layout_02();//print the last part of the html layout code
}//customers_query()


//shows all subscriptions
function show_all_subscriptions($cust_id, $navi)
{
	$dbobj = new MCBDBase();
	$customerVars = array();

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form03' id='form03' action='./code.php?form_id=4' method='post'>";
	$html_tag_11 = "<input type='submit' style='width:100px' value='view";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='hidden' name='os_date' id='os_date' value='";
	$html_tag_14 = "'>";
	$html_tag_15 = "</form>";
	$html_tag_16 = "<input type='hidden' name='os_time' id='os_time' value='";
	$html_tag_17 = "<input type='hidden' name='cust_id' id='cust_id' value='";

	$query = "SELECT * FROM orders_subscriptions WHERE cust_id=" . $cust_id . "; ";
	$result = @mysql_query($query) or die("<span class='title'>" . "error" . "</span>");
	$num = @mysql_num_rows($result);

	echo "<span class='headline2'>" . "SUBSCRIPTIONS/ORDERS" . "<span>";
	echo "<br>" . "<br>";

	if($num==0)
	{
		echo "<span class='title'>" . "no subscriptions/orders" . "</span>";
	}
	else{
		echo ($html_tag_01);//table

		//create first table row with titles
		echo ($html_tag_02);
		echo ($html_tag_03 . $html_tag_07 . "&nbsp;" . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_07 . "date" . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_07 . "time" . $html_tag_09 . $html_tag_04);
		echo ($html_tag_05);

		for($i=0; $i<$num; $i++)
		{
			$arVars['os_date'] = @mysql_result($result,$i,'os_date');
			$arVars['os_time'] = @mysql_result($result,$i,'os_time');
			$arVars['cust_id'] = @mysql_result($result,$i,'cust_id');

		echo ($html_tag_02);//new table row
		echo ($html_tag_10);//new form

			echo ($html_tag_03);//new table data
			echo ("<input type='submit' style='width:100px' value='view' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>");
			echo ("<input type='hidden' name='os_date' id='os_date' value='".$arVars['os_date']."'>");
			echo ($html_tag_04);//end table data

			echo ("<td height='20' align='center' valign='middle'>"."<span class='tag'>".$arVars['os_date']."</span>"."</td>");

			echo ("<input type='hidden' name='os_time' id='os_time' value='".$arVars['os_time']."'>");
			echo ("<td height='20' align='center' valign='middle'>" . "<span class='tag'>" . $arVars['os_time'] . "</span>" . "</td>");
			echo ("<input type='hidden' name='cust_id' id='cust_id' value='".$arVars['cust_id']."'>");

			echo "<input type='hidden' name='navi' id='navi' value='" . $navi . "'></input>";//hidden for navi button
		echo ($html_tag_15);//end form
		echo ($html_tag_05);//end table row

		}//for

		echo ($html_tag_06);//end table
	}//else

	unset($dbobj);
}//show_all_subscriptions


function show_subscription_entries($os_date, $os_time, $cust_id, $navi)
{
	$dbobj = new MCBDBase();
	$arVars = array();

	layout_01();//print the first part of the html layout code
	$layoutA = "<table width='800' height='100%' border='0' cellpadding='0' cellspacing='2' BGCOLOR='#FFFFFF'>"
		. "<tr>"
		. "<td width='' height='500' align='center' valign='top'>"
		. "<CENTER>";

	$layoutB = "</CENTER>"
		. "</td>"
		. "</tr>"
		. "</table>";

	echo $layoutA;

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title_red'>";
	$html_tag_08 = "<span class='title'>";
	$html_tag_09 = "<span class='headline2'>";
	$html_tag_10 = "<span class='headline'>";
	$html_tag_11 = "</span>";
	$html_tag_12 = "<span class='tag'>";
	$status = "";

	$sql_query = "SELECT OS2.os_date, OS2.os_time, CB.title, OS2.issue_number, CBC.name, OS2.status, OS2.quantity
		 FROM orders_subscriptions AS OS1, order_subscription_issues AS OS2,
		 comic_books AS CB, comic_book_companies AS CBC, customers AS C
		 WHERE C.cust_id=OS1.cust_id
		 AND OS1.os_date=OS2.os_date AND OS1.os_time=OS2.os_time
		  AND OS2.cb_id=CB.cb_id AND CB.cbc_id=CBC.cbc_id AND  C.cust_id=".$cust_id."
		 AND OS2.os_date='" . $os_date . "' AND OS2.os_time='" . $os_time . "' ORDER BY CB.title ASC;";

	$result = @mysql_query($sql_query) or die("error executing query "+$sql_query);
	$num = @mysql_num_rows($result);

	echo "<center>";//show html content in the center of the page

	echo "<span class='headline2'>" . "SUBSCRIPTIONS/ORDERS" . "<span>";
	echo "<br>" . "<br>";
	echo "<span class='headline3'>" . "ORDER DATE: " . "</span>" . "<span class='title'>" . $os_date . "</span>" . "	";
	echo "<span class='headline3'>" . "ORDER TIME: " . "</span>" . "<span class='title'>" . $os_time . "</span>";
	echo "<br>" . "<br>";
	find_customer($cust_id, $navi);
	echo "<br>" . "<br>";

	echo $html_tag_01;//new table

	//first table row with field titles
	echo $html_tag_02;//new table row
	echo $html_tag_03 . $html_tag_07 . "Title: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Issue #: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Company: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Status: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Quantity: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_05;//end row
	for($i=0; $i<$num; $i++)
	{
		echo $html_tag_02;//new table row
		$arVars['status'] = @mysql_result($result,$i,'status');
		$arVars['title'] = @mysql_result($result,$i,'title');
		$arVars['issue_number'] = @mysql_result($result,$i,'issue_number');
		$arVars['name'] = @mysql_result($result,$i,'name');
		$arVars['quantity'] = @mysql_result($result,$i,'quantity');

		switch ($arVars['status'])//switch for status name
		{
			case 1:
				$status="ordered";
				break;
			case 2:
				$status="in stock";
				break;
			case 3:
				$status="dispatched";
				break;
			default:
			//
		}//switch
		echo $html_tag_03 . $html_tag_12 . $arVars['title'] . $html_tag_11 . $html_tag_04;
		echo $html_tag_03 . $html_tag_12 . $arVars['issue_number'] . $html_tag_11 . $html_tag_04;
		echo $html_tag_03 . $html_tag_12 . $arVars['name'] . $html_tag_11 . $html_tag_04;
		echo $html_tag_03 . $html_tag_12 . $status . $html_tag_11 . $html_tag_04;//print status
		echo $html_tag_03 . $html_tag_12 . $arVars['quantity'] . $html_tag_11 . $html_tag_04;

		echo $html_tag_05;//end row
	}//for
	echo $html_tag_06;//end table

	echo "<br>" . "<br>";
	switch ($navi)
	{
		case 1:
			echo "<a href='./show_customer.php?cust_id=" . $cust_id . "&navi=1'>back</a>";
			break;
		case 2:
			echo "<a href='./show_customer.php?cust_id=" . $cust_id . "&navi=2'>back</a>";
			break;
		case 3:
			echo "<a href='./show_all_orders.php?id=1'>back</a>";
			break;
		case 4:
			echo "<a href='./show_all_orders.php?id=2'>return to search form</a>";
			break;
		case 5:
			echo "<a href='./titles.php'>return to search form</a>";
			break;
		default:
			//
	}
	echo "</center>";
	unset($dbobj);

	echo $layoutB;
	layout_02();//print the last part of the html layout code
}//show_subscription_entries


//function that shows all the orders in the DB
function show_all_orders()
{
	$dbobj = new MCBDBase();
	$arVars = array();

	$sql_query = "SELECT DISTINCT(OS1.os_date), C.cust_id, OS1.os_time, C.surname, C.name
			FROM orders_subscriptions OS1,order_subscription_issues OS2, customers C
			WHERE C.cust_id=OS1.cust_id AND OS1.os_date=OS2.os_date AND OS1.os_time=OS2.os_time
			ORDER BY os1.os_date; ";

	$result = @mysql_query($sql_query) or die("error executing query "+$sql_query);
	$num = @mysql_num_rows($result);

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form01' id='form01' action='./code.php?form_id=5' method='post'>";
	$html_tag_11 = "<input type='submit' style='width:100px' value='view";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='hidden' name='";
	$html_tag_14 = "' id='";
	$html_tag_15 = "' value='";
	$html_tag_16 = "'>";
	$html_tag_17 = "</form>";


	echo "<center>";//prints table in the center of the page
	echo "<span class='headline2'>" . "ORDERS/SUBSCRIPTIONS" . "<span>";
	echo "<br>" . "<br>";
	echo ($html_tag_01);//table

	//create first table row with titles
	echo ($html_tag_02);
	echo ($html_tag_03 . $html_tag_07 . "&nbsp;" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "date" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "time" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "customer surname" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "customer name" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_05);

	if($num==0)
	{
		echo '<tr>';
			echo '<td colspan="5">'.'<span class="error">'.'There are no orders in the system.'.'</span>'.'</td>';
		echo '</tr>';
	}
	else{
		//fetch data from customers
		for($i=0; $i<$num; $i++)
		{
			echo ($html_tag_02);//new table row

			$arVars['os_date'] = @mysql_result($result,$i,'os_date');
			$arVars['cust_id'] = @mysql_result($result,$i,'cust_id');
			$arVars['os_time'] = @mysql_result($result,$i,'os_time');
			$arVars['surname'] = @mysql_result($result,$i,'surname');
			$arVars['name'] = @mysql_result($result,$i,'name');

			echo ($html_tag_10);//new form
			echo ($html_tag_03 . $html_tag_11 . $html_tag_12);
			echo ($html_tag_13 . "os_date" . $html_tag_14 . "os_date" . $html_tag_15 . $arVars['os_date'] . $html_tag_16);//hidden form input for order date
			echo ("<input type='hidden' name='navi' id='navi' value='3'></input>");//hidden form input for navi button
			echo ($html_tag_03 . $html_tag_08 . $arVars['os_date'] . $html_tag_09 . $html_tag_04);
			echo ($html_tag_13 . "cust_id" . $html_tag_14 . "cust_id" . $html_tag_15 . $arVars['cust_id'] . $html_tag_16);//hidden form input for cust id
			echo ($html_tag_13 . "os_time" . $html_tag_14 . "os_time" . $html_tag_15 . $arVars['os_time'] . $html_tag_16);//hidden form input for order time
			echo ($html_tag_17);//end form
			echo ($html_tag_03 . $html_tag_08 . $arVars['os_time'] . $html_tag_09 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_08 . $arVars['surname'] . $html_tag_09 . $html_tag_04);
			echo ($html_tag_03 . $html_tag_08 . $arVars['name'] . $html_tag_09 . $html_tag_04);
			echo ($html_tag_05);//end table row
		}//for
	}
	echo ($html_tag_06);//end table

	echo "<br>";
	echo "<a href='./orders.php'>back</a>";
	echo "</center>";

	unset($dbobj);
}//show_all_orders


function find_customer($cust_id, $navi)//returns customer surname and name using cust_id
{
	$dbobj = new MCBDBase();
	$arVars = array();

	$sql_query = "SELECT surname, name FROM customers WHERE cust_id=" . $cust_id . ";";

	$result = @mysql_query($sql_query) or die("error executing query "+$sql_query);
	$num = @mysql_num_rows($result);

	$html_tag_01 = "<span class='red2'>";
	$html_tag_02 = "<span class='tag'>";
	$html_tag_03 = "</span>";

	//fetch data from customers
	for($i=0; $i<$num; $i++)
	{
		$arVars['surname'] = @mysql_result($result,$i,'surname');
		$arVars['name'] = @mysql_result($result,$i,'name');
		echo ($html_tag_02);

		echo ($html_tag_01 . "Customer: " . $html_tag_03 . "<a href='./cs.php?cust_id=" . $cust_id . "&navi=" . $navi . "'>" . $arVars['surname'] . " ");
		echo ($arVars['name'] . "</a>");
	}//for

	unset($dbobj);
}

function show_orders_query($day_01, $month_01, $year_01, $day_02, $month_02, $year_02)
{
	$dbobj = new MCBDBase();
	$arVars = array();

	layout_01();//print the first part of the html layout code
	$layoutA = "<table width='800' height='100%' border='0' cellpadding='0' cellspacing='2' BGCOLOR='#FFFFFF'>"
		. "<tr>"
		. "<td width='' height='500' align='center' valign='top'>"
		. "<CENTER>";

	$layoutB = "</CENTER>"
		. "</td>"
		. "</tr>"
		. "</table>";

	echo $layoutA;

	$date_01 == "";
	$date_02 == "";

	if($day_01=="" OR $month_01=="" OR $year_01=="")
	{
	//big error the date_01 remains null
	}
	else
	{
		$date_01 = $year_01 . "-" . $month_01 . "-" . $day_01;
	}

	if($day_02=="" OR $month_02=="" OR $year_02=="")
	{
		$date_02 == "";//then it will search with only the first date
	}
	else
	{
		$date_02 = $year_02 . "-" . $month_02 . "-" . $day_02;//second date
	}

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form01' id='form01' action='./code.php?form_id=5' method='post'>";
	$html_tag_11 = "<input type='submit' style='width:100px' value='view";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='hidden' name='";
	$html_tag_14 = "' id='";
	$html_tag_15 = "' value='";
	$html_tag_16 = "'>";
	$html_tag_17 = "</form>";


	$string_01 = " OS1.os_date>'";
	$string_02 = "'";
	$string_03 = " OS1.os_date<'";
	$string_07 = " OR ";
	$string_08 = " AND ";
	$string_09 = " ORDER BY OS1.os_date";
	$STRING_ORDER_SUBSCRIPTION = "";

	$STRING_ORDER_SUBSCRIPTION_01 = "SELECT DISTINCT(OS1.os_date), C.cust_id, OS1.os_time, C.surname, C.name
								FROM orders_subscriptions OS1,order_subscription_issues OS2, customers C
								WHERE C.cust_id=OS1.cust_id AND OS1.os_date=OS2.os_date AND OS1.os_time=OS2.os_time ";
	$STRING_ORDER_SUBSCRIPTION_02 = $STRING_ORDER_SUBSCRIPTION_01 . $string_08;
	$STRING_ORDER_SUBSCRIPTION_03 = $string_01 . $date_01 . $string_02;
	$STRING_ORDER_SUBSCRIPTION_04 = $string_03 . $date_02 . $string_02;

	if($date_01!=="")
		{$STRING_ORDER_SUBSCRIPTION = $STRING_ORDER_SUBSCRIPTION_02 . $STRING_ORDER_SUBSCRIPTION_03;}
	else {$STRING_ORDER_SUBSCRIPTION="";}

	if($date_02!=="" AND $date_01=="")
	{
		$STRING_ORDER_SUBSCRIPTION = $STRING_ORDER_SUBSCRIPTION_02 . $STRING_ORDER_SUBSCRIPTION_04;
	}elseif($date_02=="" AND $date_01=="")
	{
		$STRING_ORDER_SUBSCRIPTION = $STRING_ORDER_SUBSCRIPTION . $string_08 . $STRING_ORDER_SUBSCRIPTION_04;
	}

	if($date_01=="" AND $date_02=="")
	{$STRING_ORDER_SUBSCRIPTION=$STRING_ORDER_SUBSCRIPTION_01;}


	$result = @mysql_query($STRING_ORDER_SUBSCRIPTION) or die("error executing query "+$STRING_ORDER_SUBSCRIPTION);
	$num = @mysql_num_rows($result);


	if (!isset($num))
	{
		echo ("<span class='tag'>" . "error" . "</span>");
		echo ("<a href='show_all_orders.php?id=2'>go back</a>");
	}

	echo "<center>";//prints table in the center of the page
	if($num==0)//check if the query returns any values
	{
		echo ("<span class='title'>" . "An order with these values");

		echo "<br>";
		echo "<br>";
		echo $html_tag_01;//table

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "From Date: " . $html_tag_09 . $html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "-" . $date_01 . $html_tag_09 . $html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "To Date: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "-" . $date_02 . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_06;//table
		echo "<br>";

		echo (" doesn't exist" . "</span>");
		echo "<br>";
	}
	else{//if the guery returns row then show them in table

	echo "<center>";//prints table in the center of the page
	echo "<span class='headline2'>" . "ORDERS/SUBSCRIPTIONS" . "<span>";
	echo "<br>" . "<br>";

	echo ($html_tag_01);//table

	//create first table row with titles
	echo ($html_tag_02);
	echo ($html_tag_03 . $html_tag_07 . "&nbsp;" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "date" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "time" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "customer surname" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "customer name" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_05);//table row

	//fetch data from customers
	for($i=0; $i<$num; $i++)
	{
		echo ($html_tag_02);//new table row

		$arVars['os_date'] = @mysql_result($result,$i,'os_date');
		$arVars['cust_id'] = @mysql_result($result,$i,'cust_id');
		$arVars['os_time'] = @mysql_result($result,$i,'os_time');
		$arVars['surname'] = @mysql_result($result,$i,'surname');
		$arVars['name'] = @mysql_result($result,$i,'name');

		echo ($html_tag_10);//new form
		echo ($html_tag_03 . $html_tag_11 . $html_tag_12);
		echo ($html_tag_13 . 'os_date' . $html_tag_14 . 'os_date' . $html_tag_15 . $arVars['os_date'] . $html_tag_16);//hidden form input for order date
		echo ("<input type='hidden' name='navi' id='navi' value='4'></input>");//hidden form input for navi button
		echo ($html_tag_03 . $html_tag_08 . $arVars['os_date'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_13 . "cust_id" . $html_tag_14 . "cust_id" . $html_tag_15 . $arVars['cust_id'] . $html_tag_16);//hidden form input for cust id
		echo ($html_tag_13 . "os_time" . $html_tag_14 . "os_time" . $html_tag_15 . $arVars['os_time'] . $html_tag_16);//hidden form input for order time
		echo ($html_tag_17);//end form
		echo ($html_tag_03 . $html_tag_08 . $arVars['os_time'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $arVars['surname'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $arVars['name'] . $html_tag_09 . $html_tag_04);

		echo ($html_tag_05);//end table row
	}//for

	echo ($html_tag_06);//end table
	}//if

	echo "<br>" . "<br>";
	echo "<a href='./show_all_orders.php?id=2'>back</a>";
	echo "</center>";//end center

	unset($dbobj);
	echo $layoutB;
	layout_02();//print the last part of the html layout code
}//show_orders_query


function show_titles_query($title_name, $navi)//query that print all the titles matching the title_name
{
	$dbobj = new MCBDBase();
	$arVars = array();

	layout_01();//print the first part of the html layout code
	$layoutA = "<table width='800' height='100%' border='0' cellpadding='0' cellspacing='2' BGCOLOR='#FFFFFF'>"
		. "<tr>"
		. "<td width='' height='500' align='center' valign='top'>"
		. "<CENTER>";

	$layoutB = "</CENTER>"
		. "</td>"
		. "</tr>"
		. "</table>";

	echo $layoutA;
	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title'>";
	$html_tag_08 = "<span class='tag'>";
	$html_tag_09 = "</span>";

	$html_tag_10 = "<form name='form01' id='form01' action='./code.php?form_id=8' method='post'>";
	$html_tag_11 = "<input type='submit' style='width:100px' value='view";
	$html_tag_12 = "' onmouseover='this.style.textDecoration='Underline';' onmouseout='this.style.textDecoration='None';' style='CURSOR: hand'>";
	$html_tag_13 = "<input type='hidden' name='";
	$html_tag_14 = "' id='";
	$html_tag_15 = "' value='";
	$html_tag_16 = "'>";
	$html_tag_17 = "</form>";

	$STRING_TITLES = "";

	$STRING_TITLES_01 = "SELECT DISTINCT(CB.title), CBC.name, OS1.os_date, C.cust_id, OS1.os_time, C.surname, C.name
			FROM comic_books CB, comic_book_companies CBC, order_subscription_issues OS1, orders_subscriptions OS2, customers C
			WHERE CB.cbc_id=CBC.cbc_id AND CB.cb_id=OS1.cb_id AND OS1.os_date=OS2.os_date AND OS1.os_time=OS2.os_time AND OS2.cust_id=C.cust_id " ;
	$STRING_TITLES_02 = " AND CB.title='" . $title_name . "'";
	$STRING_TITLES_03 = " ORDER BY OS1.os_date ASC;";

	if ($title_name!=="")
	{
		$STRING_TITLES = $STRING_TITLES_01 . $STRING_TITLES_02 . $STRING_TITLES_03;
	}
	elseif ($title_name=="")
	{
		$STRING_TITLES = $STRING_TITLES_01 . $STRING_TITLES_03;
	}

	$result = @mysql_query($STRING_TITLES) or die("error executing query "+$STRING_TITLES);
	$num = @mysql_num_rows($result);


	if (!isset($num))
	{
		echo ("<center><span class='tag'>" . "error" . "</span></center>");
		echo ("<a href='titles.php'>back</a>");
	}

	echo "<center>";//prints table in the center of the page

	if($num==0)//check if the query returns any values
	{
		echo ("<span class='title'>" . "A comic book title with this name:");

		echo "<br>";
		echo "<br>";
		echo $html_tag_01;//table

		echo $html_tag_02;//new row
		echo $html_tag_03 . $html_tag_07 . "Title: " . $html_tag_09 .$html_tag_04;//table data with string
		echo $html_tag_03 . $html_tag_08 . "&nbsp;" . $title_name . $html_tag_09 .$html_tag_04;//table data with value
		echo $html_tag_05;//end row

		echo $html_tag_06;//table
		echo "<br>";

		echo (" doesn't exist" . "</span>");
		echo "<br>";
	}
	else{//if the guery returns row then show them in table

	echo "<center>";//prints table in the center of the page
	echo "<span class='headline2'>" . "COMIC BOOK TITLES" . "<span>";
	echo "<br>" . "<br>";

	echo ($html_tag_01);//table

	//create first table row with titles
	echo ($html_tag_02);
	echo ($html_tag_03 . $html_tag_07 . "&nbsp;" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "title" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "company" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "order date" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "order time" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "customer surname" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_03 . $html_tag_07 . "customer name" . $html_tag_08 . $html_tag_04);
	echo ($html_tag_05);//table row

	//fetch data from customers
	for($i=0; $i<$num; $i++)
	{
		$arVars['title'] = @mysql_result($result,$i,'title');
		$arVars['name'] = @mysql_result($result,$i,'name');
		$arVars['os_date'] = @mysql_result($result,$i,'os_date');
		$arVars['cust_id'] = @mysql_result($result,$i,'cust_id');
		$arVars['os_time'] = @mysql_result($result,$i,'os_time');
		$arVars['surname'] = @mysql_result($result,$i,'surname');
		$arVars['name'] = @mysql_result($result,$i,'name');

		echo ($html_tag_02);//new table row
		echo ($html_tag_10);//new form
		echo ($html_tag_03 . $html_tag_11 . $html_tag_12 . $html_tag_04);//submit button
		echo ($html_tag_13 . 'title' . $html_tag_14 . 'title' . $html_tag_15 . $arVars['title'] . $html_tag_16);//hidden form input for comic book title
		echo ($html_tag_03 . $html_tag_08 . $arVars['title'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $arVars['name'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_13 . 'os_date' . $html_tag_14 . 'os_date' . $html_tag_15 . $arVars['os_date'] . $html_tag_16);//hidden form input for order date
		echo ("<input type='hidden' name='navi' id='navi' value='5'></input>");//hidden form input for navi button
		echo ($html_tag_03 . $html_tag_08 . $arVars['os_date'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_13 . "cust_id" . $html_tag_14 . "cust_id" . $html_tag_15 . $arVars['cust_id'] . $html_tag_16);//hidden form input for cust id
		echo ($html_tag_13 . "os_time" . $html_tag_14 . "os_time" . $html_tag_15 . $arVars['os_time'] . $html_tag_16);//hidden form input for order time
		echo ($html_tag_17);//end form
		echo ($html_tag_03 . $html_tag_08 . $arVars['os_time'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $arVars['surname'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_03 . $html_tag_08 . $arVars['name'] . $html_tag_09 . $html_tag_04);
		echo ($html_tag_05);//end table row
	}//for

	echo ($html_tag_06);//end table
	}//if

	echo "<br>" . "<br>";
	echo "<a href='./titles.php'>back</a>";
	echo "</center>";//end center

	unset($dbobj);
	echo $layoutB;
	layout_02();//print the last part of the html layout code
}//show_titles_query

function show_subscription_entries2($os_date, $os_time, $cust_id, $navi, $title_name)
{
	$dbobj = new MCBDBase();
	$arVars = array();

	$html_tag_01 = "<table width='' height='' cellpading='0' cellspacing='0' border='1' bordercolor='#000000' bgcolor=''>";
	$html_tag_02 = "<tr>";
	$html_tag_03 = "<td height='20' align='center' valign='middle'>";
	$html_tag_04 = "</td>";
	$html_tag_05 = "</tr>";
	$html_tag_06 = "</table>";
	$html_tag_07 = "<span class='title_red'>";
	$html_tag_08 = "<span class='title'>";
	$html_tag_09 = "<span class='headline2'>";
	$html_tag_10 = "<span class='headline'>";
	$html_tag_11 = "</span>";
	$html_tag_12 = "<span class='tag'>";
	$status = "";

	$sql_query = "SELECT OS2.os_date, OS2.os_time, CB.title, OS2.issue_number, CBC.name, OS2.status, OS2.quantity
		 FROM orders_subscriptions AS OS1, order_subscription_issues AS OS2,
		 comic_books AS CB, comic_book_companies AS CBC, customers AS C
		 WHERE C.cust_id=OS1.cust_id
		 AND OS1.os_date=OS2.os_date AND OS1.os_time=OS2.os_time
		  AND OS2.cb_id=CB.cb_id AND CB.cbc_id=CBC.cbc_id AND  C.cust_id=" . $cust_id
		 ."  AND OS2.os_date='" . $os_date . "' AND OS2.os_time='" . $os_time . "' AND CB.title='" . $title_name . "' ORDER BY CB.title ASC;";

	$result = @mysql_query($sql_query) or die("error executing query "+$sql_query);
	$num = @mysql_num_rows($result);

	echo "<center>";//show html content in the center of the page

	echo "<span class='headline2'>" . "SUBSCRIPTIONS/ORDERS" . "<span>";
	echo "<br>" . "<br>";
	echo "<span class='headline3'>" . "ORDER DATE: " . "</span>" . "<span class='title'>" . $os_date . "</span>" . "	";
	echo "<span class='headline3'>" . "ORDER TIME: " . "</span>" . "<span class='title'>" . $os_time . "</span>";
	echo "<br>" . "<br>";
	find_customer($cust_id, $navi);
	echo "<br>" . "<br>";

	echo $html_tag_01;//new table

	//first table row with field titles
	echo $html_tag_02;//new table row
	echo $html_tag_03 . $html_tag_07 . "Title: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Issue #: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Company: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Status: " . $html_tag_11 . $html_tag_04;
	echo $html_tag_03 . $html_tag_07 . "Quantity: " . $html_tag_11 . $html_tag_04;

	for($i=0; $i<$num; $i++)
	{
		$arVars['status'] = @mysql_result($result,$i,'status');
		$arVars['title'] = @mysql_result($result,$i,'title');
		$arVars['issue_number'] = @mysql_result($result,$i,'issue_number');
		$arVars['name'] = @mysql_result($result,$i,'name');
		$arVars['quantity'] = @mysql_result($result,$i,'quantity');

		echo $html_tag_02;//table row
		switch ($arVars['status'])//switch for status name
		{
			case 1:
				$status="ordered";
				break;
			case 2:
				$status="in stock";
				break;
			case 3:
				$status="dispatched";
				break;
			default:
			//
		}//switch
		echo $html_tag_03 . $html_tag_12 . $status . $html_tag_11 . $html_tag_04;//print status
		echo $html_tag_03 . $html_tag_12 . $arVars['title'] . $html_tag_11 . $html_tag_04;
		echo $html_tag_03 . $html_tag_12 . $arVars['issue_number'] . $html_tag_11 . $html_tag_04;
		echo $html_tag_03 . $html_tag_12 . $arVars['name'] . $html_tag_11 . $html_tag_04;
		echo $html_tag_03 . $html_tag_12 . $arVars['quantity'] . $html_tag_11 . $html_tag_04;

		echo $html_tag_05;//end row
	}//for
	echo $html_tag_06;//end table

	echo "<br>" . "<br>";
	switch ($navi)
	{
		case 1:
			echo "<a href='./show_customer.php?cust_id=" . $cust_id . "&navi=1'>back</a>";
			break;
		case 2:
			echo "<a href='./show_customer.php?cust_id=" . $cust_id . "&navi=2'>back</a>";
			break;
		case 3:
			echo "<a href='./show_all_orders.php?id=1'>back</a>";
			break;
		case 4:
			echo "<a href='./show_all_orders.php?id=2'>return to search form</a>";
			break;
		case 5:
			echo "<a href='./titles.php'>return to search form</a>";
			break;
		default:
			//
	}
	echo "</center>";
	unset($dbobj);
}//show_subscription_entries2

function layout_01()
{
	$html_tag_01 = "<center>";
	$html_tag_02 = "<TABLE WIDTH='800' HEIGHT='' BGCOLOR='' CELLPADDING='' CELLSPACING=''>"
		. "<TR>";
	$html_tag_03 = "<TD WIDTH='800' HEIGHT='' COLSPAN='2'>"
		. "<table width='800' height='' bgcolor='' cellpadding='' cellspacing=''>";
	$html_tag_04 = "<tr>"
		 . "<td>"
		 . "<TABLE WIDTH='800' HEIGHT='100' BGCOLOR='#FFFFFF' CELLPADDING='0' CELLSPACING='0' BORDER='0'>"
		 . "<TD width='105' height='25' bgcolor='#FFFFFF'>&nbsp;</TD>"
		 . "<TD width='105' height='25' bgcolor='#FFFFFF'>&nbsp;</TD>"
		 . "<TD width='380' height='100' bgcolor='#FFFFFF' align='center' valign='top'><img src='./images/logo.gif' width='380' height='100'></td>"
		 . "<TD width='105' height='25' bgcolor='#FFFFFF'>&nbsp;</TD>"
		 . "<TD width='105' height='25' bgcolor='#FFFFFF'>&nbsp;</TD>"
		 . "</TABLE>"
		 . "</td>"
		 . "</tr>";

	$html_tag_05 = "<tr>"
			. "<td>"
			. "<TABLE WIDTH='800' HEIGHT='33' BGCOLOR='#000000' CELLPADDING='0' CELLSPACING='0' BORDER='0'>"
			. "<TD width='' height='33' align='right'>&nbsp;<span class='white'>|</span></TD>"
			. "<TD width='150' height='33' bgcolor='#000000' align='center' valign='middle'><a href='./index.php' onmouseover=changeImages('butt_04','./images/butt_04_over.gif'); return true; onmouseout=changeImages('butt_04','./images/butt_04.gif'); return true;><img name='butt_04' id='butt_04' src='./images/butt_04.gif' width='100%' height='100%' border='0'></a></TD>"
			. "<TD width='150' height='33' bgcolor='#000000' align='center' valign='middle'><a href='./customers.php' onmouseover=changeImages('butt_01','./images/butt_01_over.gif'); return true; onmouseout=changeImages('butt_01','./images/butt_01.gif'); return true;><img name='butt_01' id='butt_01' src='./images/butt_01.gif' width='100%' height='100%' border='0'></a></TD>"
			. "<TD width='150' height='33' bgcolor='#000000' align='center' valign='middle'><a href='./orders.php' onmouseover=changeImages('butt_02','./images/butt_02_over.gif'); return true; onmouseout=changeImages('butt_02','./images/butt_02.gif'); return true;><img name='butt_02' id='butt_02' src='./images/butt_02.gif' width='100%' height='100%' border='0'></a></TD>"
			. "<TD width='150' height='33' bgcolor='#000000' align='center' valign='middle'><a href='./titles.php' onmouseover=changeImages('butt_03','./images/butt_03_over.gif'); return true; onmouseout=changeImages('butt_03','./images/butt_03.gif'); return true;><img name='butt_03' id='butt_03' src='./images/butt_03.gif' width='100%' height='100%' border='0'></a></TD>"
			. "<TD width='' height='33' align='left'>&nbsp;<span class='white'>|</span></td>"
			. "</TABLE>"
			. "</td>"
			. "</tr>"
			. "</table>"
			. "</TD>"
			. "</TR>";
	$html_tag_07 = "<TR><TD WIDTH='800' HEIGHT='2' COLSPAN='2' ALIGN='center' VALIGN='middle'>&nbsp;</TD></TR>"
		. "<TR>"
		. "<TD COLSPAN='3' ROWSPAN='1'>";

	echo $html_tag_01 . $html_tag_02 . $html_tag_03 . $html_tag_04 . $html_tag_05 . $html_tag_06 . $html_tag_07;

}//layout_01

function layout_02()
{
	$html_tag_01 = "</TD>"
		. "</TR>"
		. "<TR><TD WIDTH='800' HEIGHT='33' COLSPAN='2' bgcolor=''>&nbsp;</TD></TR>"
		. "</TABLE>";
	$html_tag_02 = "</center>";

	echo $html_tag_01 . $html_tag_02;
}//layout_02

?>
