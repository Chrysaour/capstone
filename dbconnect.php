<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","root",""))
{
	die('Connected to Server, but Failed to Connect to Database: '.mysql_error());
}
if(!mysql_select_db("capstone"))
{
	die('Retrieval of data from Database Failed: '.mysql_error());
}

?>