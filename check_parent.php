<?php

//check_parent_login.php

include('admin/database_connection.php');

session_start();

$parent_emailid = '';
$parent_password = '';
$error_parent_emailid = '';
$error_parent_password = '';
$error = 0;

if(empty($_POST["parent_emailid"]))
{
	$error_parent_emailid = 'Email Address is required';
	$error++;
}
else
{
	$parent_emailid = $_POST["parent_emailid"];
}

if(empty($_POST["parent_password"]))
{	
	$error_parent_password = 'Password is required';
	$error++;
}
else
{
	$parent_password = $_POST["parent_password"];
}

if($error == 0)
{
	$query = "
	SELECT * FROM tbl_parent 
	WHERE parent_emailid = '".$parent_emailid."'
	";

	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$total_row = $statement->rowCount();
		if($total_row > 0)
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				if(password_verify($parent_password, $row["parent_password"]))
				{
					$_SESSION["parent_id"] = $row["parent_id"];
				}
				else
				{
					$error_parent_password = "Wrong Password";
					$error++;
				}
			}
		}
		else
		{
			$error_parent_emailid = "Wrong Email Address";
			$error++;
		}
	}
}

if($error > 0)
{
	$output = array(
		'error'			=>	true,
		'error_parent_emailid'	=>	$error_parent_emailid,
		'error_parent_password'	=>	$error_parent_password
	);
}
else
{
	$output = array(
		'success'		=>	true
	);
}

echo json_encode($output);

?>