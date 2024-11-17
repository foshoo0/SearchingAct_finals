<?php  

require_once 'dbconfig.php';
require_once 'models.php';


if (isset($_POST['insertApplicantBtn'])) {
	$insertApplicant = insertNewApplicant($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['gender'], $_POST['age'], $_POST['address'], $_POST['role'], $_POST['speciality'], $_POST['nationality']);

	if ($insertApplicant) {
		$_SESSION['message'] = "Successfully inserted!";
		header("Location: ../index.php");
	}
}


if (isset($_POST['editApplicantBtn'])) {
	$editApplicant = editApplicant($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['gender'], $_POST['age'], $_POST['address'], $_POST['role'], $_POST['speciality'], $_POST['nationality'], $_GET['applicant_id']);

	if ($editApplicant) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteApplicantBtn'])) {
	$deleteApplicant = deleteApplicant($pdo,$_GET['applicant_id']);

	if ($deleteApplicant) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['email']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['address']}</td>
				<td>{$row['state']}</td>
				<td>{$row['nationality']}</td>
				<td>{$row['car_brand']}</td>
			  </tr>";
	}
}

?>