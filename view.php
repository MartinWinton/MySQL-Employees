<html>

<head>

<style>
.error {
	color: #FF0000;
}
</style>

<title>Employee View- Martin Winton</title>
</head>

<body>





	<?php 


	$v_emp_no = "";



	if(!empty($_GET["ID"])) {

		$v_emp_no= $_GET["ID"];

	}
	else{
		$v_emp_no = -1;
	}


	$v_emp_no = (int)$v_emp_no;

	$link = mysqli_connect("localhost", "mart", "pass");
	$db = mysqli_select_db($link,"employees");
	$v_emp_no = mysqli_real_escape_string($link,$v_emp_no);
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	//retrives ID To find employee for deletion


	$sql   = <<<SQL
SELECT
  *
 FROM `employees`
 WHERE `emp_no` = $v_emp_no
 LIMIT 1
SQL;
	if ( $query = mysqli_query($link, $sql) ) {
		// success
		if ( mysqli_num_rows($query) > 0 ) {
				
			$results  = mysqli_fetch_assoc($query);
			echo '<table border="1">';

			echo '<tr>';




			echo"<th> First Name </th>";

			echo"<th> Last Name </th>";



			echo"<th> Gender </th>";


			echo"<th>Employee Number</th>";


			echo"<th> Birth Date </th>";


			echo"<th> Hire Date </th>";

				
			echo"</tr>";
				
				
			echo"<tr>";
				
				
			foreach($results as $thing){

				$thing = test_input($thing);
			}
				
			$f = $results['first_name'];
			$l = $results['last_name'];
			$g = $results['gender'];
			$e = $results['emp_no'];
			$b = $results['birth_date'];
			$d = $results['hire_date'];
				
				
				
			echo"<td>$f</td>";
			echo"<td>$l</td>";
			echo"<td>$g</td>";
			echo"<td>$e</td>";
			echo"<td>$b</td>";
			echo"<td>$d</td>";
				
				
			echo"</tr>";

				
				
			mysqli_close($link);

		}
		else {
			$v_emp_no = test_input($v_emp_no);
			die("There is no employee with ID $v_emp_no in the database!");
		}
	}




	// closes link to sql



	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	//removes crap


	?>











</body>
</html>
