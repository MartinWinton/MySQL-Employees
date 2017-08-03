
<html>

<head>
<link rel="icon"  type="image/png" href='kMxOTN1.png'">
<style>
.error {
	color: #FF0000;
}
</style>

<title>Employee Update- Martin Winton</title>
</head>

<body>






	<?php 



	$e_first_name = $e_last_name = $e_emp_no = $e_gender = $e_birth_date = $e_hire_date= "";

	
	$link = mysqli_connect("localhost", "mart", "pass");
	$db = mysqli_select_db($link,"employees");
	
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}


	// update, entry and error varaibles


	if(isset($_GET["ID"])){
		$u_emp_no= (int)$_GET["ID"];

	}

	else{
		$u_emp_no = -1;
	}



	$u_emp_no = mysqli_real_escape_string($link, $u_emp_no);
	$sql   = <<<SQL
SELECT
  *
 FROM `employees`
 WHERE `emp_no` = $u_emp_no
 LIMIT 1
SQL;
	if ( $query = mysqli_query($link, $sql) ) {
		
		if ( mysqli_num_rows($query) > 0 ) {
			$results  = mysqli_fetch_assoc($query);
	
			$employee = $results;
		}
		else {
			header('Location: index.php');
			exit(0);
		}
	}
	else {
		die("cannot Connect!");
	}


	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	if (empty($_POST["u_first_name"]) and isset($_POST['add'])) {
		$e_first_name = "You must enter first name";
	}

	
	elseif(isset($_POST["u_first_name"]) and ( strlen(trim($_POST["u_first_name"])) == 0 or strlen(trim($_POST["u_first_name"])) >= 14 ) ) {
		

		$e_first_name = "Invalid First Name";
	}
	
	
	
	

	elseif(!empty($_POST["u_first_name"])) {
		$u_first_name= trim($_POST["u_first_name"]);
	}



	if (empty($_POST["u_last_name"]) and isset($_POST['add'])) {
		$e_last_name = "You must enter last name";
	}

	
	
elseif(!empty($_POST["u_last_name"]) and ( strlen(trim($_POST["u_last_name"])) == 0 or strlen(trim($_POST["u_last_name"])) >= 16 ) ){
		$e_last_name = "Invalid Last Name";
	}
	

	elseif(!empty($_POST["u_last_name"])) {
		$u_last_name= trim($_POST["u_last_name"]);
	}





	if (empty($_POST["u_gender"]) and isset($_POST['add'])) {
		$e_gender = "You must enter gender";
	}


	elseif(!empty($_POST["u_gender"]) and (strtoupper($_POST["u_gender"]) != 'M' and strtoupper($_POST["u_gender"]) != 'F' )) {
		$e_gender= "Only the letter M or F!";
		
	
		
	}
	
	
	

	elseif(!empty($_POST["u_gender"])) {
		$u_gender= strtoupper(trim($_POST["u_gender"]));

	}



	if (empty($_POST["u_birth_date"]) and isset($_POST['add'])) {
		$e_birth_date = "You must enter birth date";
	}
	
	
	elseif(!empty($_POST["u_birth_date"]) and !preg_match('/^([0-9]{4}\-[0-9]?[0-9]\-[0-9]?[0-9])$/', $_POST["u_birth_date"])) {
		$e_birth_date= "Only Proper YYYY-MM-DD Format!!";
	}
	
	


	elseif(!empty($_POST["u_birth_date"])) {
		$u_birth_date= trim($_POST["u_birth_date"]);
	}



	if (empty($_POST["u_hire_date"]) and isset($_POST['add'])) {
		$e_hire_date = "You must enter hire date";
	}

	
	elseif(!empty($_POST["u_hire_date"]) and !preg_match('/^([0-9]{4}\-[0-9]?[0-9]\-[0-9]?[0-9])$/', $_POST["u_hire_date"])) {
		$e_hire_date= "Only Proper YYYY-MM-DD Format!!";
	}
	
	

	elseif(!empty($_POST["u_hire_date"])) {
		$u_hire_date= trim($_POST["u_hire_date"]);
	}

	//error conditionals









	















	

	if(isset($_POST['add']) and $e_first_name == ''and  $e_last_name == '' and  $e_emp_no == '' and $e_gender == '' and $e_birth_date == '' and $e_hire_date== ''){


		
		$u_first_name = mysqli_real_escape_string($link, $u_first_name);
		$u_last_name = mysqli_real_escape_string($link, $u_last_name);
		$u_gender = mysqli_real_escape_string($link, $u_gender);
		$u_birth_date= mysqli_real_escape_string($link, $u_birth_date);
		$u_hire_date = mysqli_real_escape_string($link, $u_hire_date);

		
		
		
		
		

		$sql = "UPDATE
		employees
		SET
		first_name = '$u_first_name', last_name = '$u_last_name', gender = '$u_gender', birth_date = '$u_birth_date', hire_date= '$u_hire_date'
		WHERE
		emp_no = $u_emp_no
		LIMIT 1";
		
		
		
		
		
		
		

		if (mysqli_query($link, $sql)) {
			echo " Employee Record with ID $u_emp_no Updated sucessfully";
			
			$employee['first_name'] = $u_first_name;
			$employee['last_name'] = $u_last_name;
			$employee['gender'] = $u_gender;
			$employee['birth_date'] = $u_birth_date;
			$employee['hire_date'] = $u_hire_date;
			$employee['first_name'] = $u_first_name;
			
			
			
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}

		mysqli_close($link);
	}




	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	
		return $data;
	}


	//removes crap

	?>


	<h3>Insert Employee Info</h3>

	<form method="post"function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	
		return $data;
	}
	
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?ID=<?php echo test_input($u_emp_no)?>">

		First Name:<br> <input type="text" name="u_first_name"
			value="<?php echo test_input($employee['first_name']);?>"> <span class="error">* <?php echo $e_first_name;?>
		</span><br> Last Name:<br> <input type="text"
			value="<?php echo test_input($employee['last_name']);?>" name="u_last_name"> <span class="error">*
			<?php echo $e_last_name;?>
		</span>
		</span><br> Gender:<br> <input type="text" value="<?php echo test_input($employee['gender']);?>"
			name="u_gender"><span class="error">* <?php echo $e_gender;?>
		</span> <br> Birth Date :<br> <input type="text"
			value="<?php echo test_input($employee['birth_date']);?>" name="u_birth_date"> <span class="error">*
			<?php echo $e_birth_date;?>
		</span><br> Hire Date:<br> <input type="text"
			value="<?php echo test_input($employee['hire_date']);?>" name="u_hire_date"> <span class="error">*
			<?php echo $e_hire_date;?>
		</span><br> <input name="add" type="submit" id="add"
			value="Update Employee">


	</form>


	<br>
	<?php echo "<a href = \"employees2.php\"> Home </a>"; ?>






</body>
</html>
