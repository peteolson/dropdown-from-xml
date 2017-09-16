<?php
session_start();
$xml = simplexml_load_file("location.xml");
	if(!empty($_POST))
	{
		if(isset($_SESSION['session_location']) and $_SESSION['session_location'] !="" and isset($_POST['location'] ))
		{
			$_SESSION["session_location"] .= " - ".$_POST['location'];
			
			} else {
				
			$_SESSION["session_location"] = $_POST['location'];
		}
		$_SESSION['session_length'] = strlen($_SESSION["session_location"]);
	}

	function clear_session()
{
	$_SESSION["session_location"] = "";
	$_POST['location'] = "";
	$_SESSION['session_length'] = 12;
}


$param = $_SERVER['QUERY_STRING'];
$arr = explode("=", $param);
if (count($arr) > 1) {
    $param = $arr[0];
}
if ($param == "clear_session") {
    clear_session();
}
?>

<form action="index.php" method="POST">
<select name="location" onchange="this.form.submit()">
<option value=''>Select a item</option>
<?php 
foreach($xml as $row)
{
	echo "<option value='$row->item '>" . $row->item . "</option>";
}
?>
</select>

</form>

<form  action="index.php?clear_session" method="POST">
<input id="button" value="clear" type="submit">
</form>

<form  action="index.php?populate_textbox" method="POST">
<input name="populate_textbox" 
value="<?php echo $_SESSION["session_location"];?>"
size="<?php echo $_SESSION["session_length"];?>"
type="text"/>
</form>




