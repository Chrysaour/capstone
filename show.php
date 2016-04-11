<?php

 # Init the MySQL Connection
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","root",""))
{
	die('Connected to Server, but Failed to Connect to Database: '.mysql_error());
}
if(!mysql_select_db("capstone"))
{
	die('Retrieval of data from Database Failed: '.mysql_error());
}

 # Prepare the SELECT Query
  $selectSQL = 'SELECT * FROM `users`';
 # Execute the SELECT Query
  if( !( $selectRes = mysql_query( $selectSQL ) ) ){
    echo 'Retrieval of data from Database Failed - #'.mysql_errno().': '.mysql_error();
  }else{
    ?>
<table border="2">

  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Device ID</th>
      <th>Email</th>
	  <th>Privilege</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if( mysql_num_rows( $selectRes )==0 ){
        echo '<tr><td colspan="5">No Rows Returned</td></tr>';
      }else{
        while( $row = mysql_fetch_assoc( $selectRes ) ){
          echo "<tr><td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['device_id']}</td><td>{$row['email']}</td><td>{$row['priviledge']}</td></tr>\n";
        }
      }
    ?>
  </tbody>
</table>
    <?php
  }

?>