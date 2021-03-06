<?php
function renderForm($user_id, $firstname, $lastname, $error)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>

<div>

<p><strong>ID:</strong> <?php echo $user_id; ?></p>

<strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $firstname; ?>"/><br/>

<strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $lastname; ?>"/><br/>

<p>* Required</p>

<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}







// connect to the database

include('dbconnect.php');



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['user_id']))

{

// get form data, making sure it is valid

$user_id = $_POST['user_id'];

$firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));

$lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));



// check that firstname/lastname fields are both filled in

if ($firstname == '' || $lastname == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($user_id, $firstname, $lastname, $error);

}

else

{

// save the data to the database

mysql_query("UPDATE players SET firstname='$firstname', lastname='$lastname' WHERE user_id='$user_id'")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: manage_users.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['user_id']) && is_numeric($_GET['user_id']) && $_GET['user_id'] > 0)

{

// query db

$id = $_GET['user_id'];

$result = mysql_query("SELECT * FROM users WHERE user_id=$user_id")

or die(mysql_error());

$row = mysql_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$firstname = $row['firstname'];

$lastname = $row['lastname'];



// show form

renderForm($user_id, $firstname, $lastname, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>