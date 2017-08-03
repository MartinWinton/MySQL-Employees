
<html>

<head>
<title>Employee Database- Martin Winton</title>
<link rel="icon" type="image/png" href='kMxOTN1.png'>
<link rel="shortcut icon" href="/kMxOTN1.png" />

<style>
a {
	padding: 0px 10px;
	word-wrap: normal;
	display: inline-block;
}
</style>

</head>

<body>

	<h1>
		Welcome to Employee Database Manager
		</h3>


		<h3>Select Number of Entries Per Page:</h3>

		<form
			method="get"
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<select name="entries">
				<option value="15">15</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="75">75</option>
			</select>



			<!-- Provides 4 possible number of entries per page-->

			<h3>Select Ordering Type:</h3>
			<input type="radio" name="order" value="L_DESC"> Last Name:
			Descending<br> <input type="radio" name="order" value="L_ASC"> Last
			Name: Ascending<br> <input type="radio" name="order" value="F_DESC">
			First Name: Descending<br> <input type="radio" name="order"
				value="F_ASC"> First Name: Ascending<br> <input type="radio"
				name="order" value="E_DESC">Employee Number: Descending<br> <input
				type="radio" name="order" value="E_ASC">Employee Number: Ascending <br>
			<input type="submit">




		</form>

		<h3>Insert Employee Data?</h3>
		<a href="insert.php">Click Me to Insert!</a>


		<?php


		$neworder = '';
		$order = "ASC";
		$type ="first_name";

		if (!empty($_GET["order"])) {
			$order = $_GET["order"];

		}
		if ($order == "L_DESC"){
			$neworder = "DESC";
			$type = "last_name";
		}

		elseif ($order == "F_DESC"){
			$neworder = "DESC";
			$type = "first_name";
		}

		elseif ($order == "L_ASC"){
			$neworder = "ASC";
			$type = "last_name";
		}

		elseif ($order == "F_ASC"){
			$neworder = "ASC";
			$type = "first_name";
		}


		elseif ($order == "E_ASC"){
			$neworder = "ASC";
			$type = "emp_no";
		}

		elseif ($order == "E_DESC"){
			$neworder = "DESC";
			$type = "emp_no";
		}



		// intializes type variable and redfines order variable

		// gets order choice from form

		else{
			echo "<h4>Please pick order</h4>";
		}




		$self= $_SERVER['PHP_SELF'];


		if($neworder!= ''){


			if(!empty($_GET['entries'])){
				$rec_limit = $_GET['entries'];
				//sets entries per page



				$link = mysqli_connect("localhost", "mart", "pass");
				$db = mysqli_select_db($link,"employees");
				// establishes link to sql



				$data = mysqli_query($link,"SELECT
						COUNT(emp_no)
						AS
						'total'
						FROM
						employees
						ORDER BY
						$type $neworder");

				$rowss = mysqli_fetch_assoc($data);
				$row_count = $rowss['total'];

				/* Get total number of records */


				// sets up selection variables as booleans





				// creates a string of types from booleans



				// removes comma from string to fit with mysql syntax







				if( isset($_GET{'page'} ) ) {
					$page = $_GET{'page'};
					$offset = $rec_limit * $page ;

				}else {
					$page = 0;
					$offset = 0;
				}

				// finds  current page and sets page/offset accordingly


				$left_rec = $row_count - ($page * $rec_limit);
				//calculates amount of entries left


				$sql = "SELECT *

				FROM
				employees
				ORDER BY $type $neworder
				LIMIT
				$offset, $rec_limit";

				$retval = mysqli_query( $link, $sql );

				// creates  query and result







				echo '<table border="1">';

				echo '<tr>';




				echo"<th> First Name </th>";








				echo"<th> Last Name </th>";










				echo"<th> Gender </th>";





				echo"<th>Employee Number</th>";





				echo"<th> Birth Date </th>";




				echo"<th> Hire Date </th>";



				echo"<th colspan='3'>Options</th>";



				// create table header









				while($row = mysqli_fetch_assoc($retval)){


					echo"<tr>";





					$f = $row['first_name'];
					echo"<td>".$f."</td>";








					$l= $row['last_name'];
					echo"<td>".$l."</td>";










					$g= $row['gender'];
					echo"<td>".$g."</td>";





					$e = $row['emp_no'];
					echo"<td>".$e."</td>";





					$b= $row['birth_date'];
					echo"<td>".$b."</td>";





					$h= $row['hire_date'];
					echo"<td>".$h."</td>";





					//creates table rows

















					echo "<td><a href = \"delete.php?ID=$e\"> Delete Me!</a></td>";
					echo "<td><a href = \"update.php?ID=$e\">Update Me! </a></td>";
					echo "<td><a href = \"view.php?ID=$e\">View Me! </a></td>";


					//provides update and delete links if all entries are selected



					echo"</tr>";




				}

			}	echo "</table>";

			echo "<br>";

			// prints names according to query with linebreak between each name


			if( $page > 0 ) {
		$last = $page - 1;
		$next = $page + 1;
		echo "<a href = \"$self?page=$last&entries=$rec_limit&order=$order\">Last $rec_limit Records</a> |";
		echo "<a href = \"$self?page=$next&entries=$rec_limit&order=$order\">Next $rec_limit Records</a>";
	}else if( $page == 0 ) {
		$page = $page + 1;
		echo "<a href = \"$self?page=$page&entries=$rec_limit&order=$order\">Next $rec_limit Records</a>";
	}
		}
		?>

</body>
</html>
