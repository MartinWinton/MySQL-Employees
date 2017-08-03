
<html>

<head>
<link rel="icon"  type="image/png" href='kMxOTN1.png'">
<style>
.error {
	color: #FF0000;
}
</style>

<title>Employee Deletion- Martin Winton</title>
</head>

<body>





	<?php 


	$d_emp_no = "";



	if(!empty($_GET["ID"])) {

		$d_emp_no= $_GET["ID"];

	}
	else{
		$d_emp_no = -1;
	}


	$d_emp_no = (int)$d_emp_no;

	$link = mysqli_connect("localhost", "mart", "pass");
	$db = mysqli_select_db($link,"employees");
	$d_emp_no = mysqli_real_escape_string($link,$d_emp_no);
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	//retrives ID To find employee for deletion


	$sql   = <<<SQL
SELECT
  *
 FROM `employees`
 WHERE `emp_no` = $d_emp_no
 LIMIT 1
SQL;
	if ( $query = mysqli_query($link, $sql) ) {
		// success
		if ( mysqli_num_rows($query) > 0 ) {

		}
		else {
			$d_emp_no = test_input($d_emp_no);
			die("There is no employee with ID $d_emp_no in the database!");
		}
	}


	$sql = "DELETE
	FROM
	employees
	WHERE
	emp_no=$d_emp_no";





	if(isset($_POST['add'])){


		if (mysqli_query($link, $sql)) {
			$d_emp_no = test_input($d_emp_no);
			echo " Employee Record with ID $d_emp_no deleted sucessfully";
		} else {
			echo "Error deleting record: " . mysqli_error($link);
		}
	}
	mysqli_close($link);

	// closes link to sql



	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	//removes crap


	?>


	<form method="post"
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?ID=<?php echo "$d_emp_no"?>">



		<b>Delete Info of Employee with ID:<?php echo "$d_emp_no"?>????"
		</b> </b> <input name="add" type="submit" id="add" value="Delete!">
	</form>











</body>
</html>
