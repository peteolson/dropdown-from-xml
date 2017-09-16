<?php
session_start();
echo '<form action="index.php" method="POST">';
echo '<select name="location" onchange="this.form.submit()">';
$xml = simplexml_load_file("location.xml");
echo "<option value=''>Select a item</option>";
foreach($xml as $row)
{
	echo "<option value='$row->item '>" . $row->item . "</option>";
}
echo '</select>';
if($_POST)
	{
		if(isset($_SESSION['session_location']) and $_SESSION['session_location'] !=""){
			$_SESSION["session_location"] .= " - ".$_POST['location'];
			
			} else {
			$_SESSION["session_location"] = $_POST['location'];
			
		}
		
		echo "<br><br>" . $_SESSION["session_location"];
		
	}
echo '</form>';
function clear_session()
{
	$_SESSION["session_location"] = "";
}

function populate_textbox()
{
	$populate_textbox = $_SESSION["session_location"];
	$len = strlen($populate_textbox);
	echo '<input name="populate_textbox" size="'.$len.'" type="text" value="'.$populate_textbox.'"/>';
}

echo '<form  action="index.php?clear_session" method="POST">';
echo '<input id="button" value="clear" type="submit">';
echo '</form>';

echo '<form  action="index.php?populate_textbox" method="POST">';
echo '<input id="button" value="add to text box" type="submit">';
echo '</form>';

echo '<form  action="index.php?populate_textbox" method="POST">';
echo '<input name="populate_textbox" type="text" />';
echo '</form>';



$param = $_SERVER['QUERY_STRING'];
$arr = explode("=", $param);
if (count($arr) > 1) {
    $param = $arr[0];
}
if ($param == "clear_session") {
    clear_session();
}
if ($param == "populate_textbox") {
    populate_textbox();
}
?>
