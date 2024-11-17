<?php  

require_once 'dbConfig.php';

function getAllapplicants($pdo) {
	$sql = "SELECT * FROM applicants_data
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getApplicantByID($pdo, $applicant_id) {
	$sql = "SELECT * from applicants_data WHERE applicant_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicant_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAapplicant($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM applicants_data WHERE 
			CONCAT(first_name,last_name,contact_number,gender,age,
				address,role,speciality,nationality,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
//CRUD FUNCTIONALITIES
function insertNewApplicant($pdo, $first_name, $last_name, $contact_number, 
	$gender, $age, $address, $role, $speciality, $nationality) {

	$sql = "INSERT INTO applicants_data
			(
				first_name,
				last_name,
				contact_number,
				gender,
                age,
				address,
				role,
                speciality,
				nationality
			)
			VALUES (?,?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $contact_number, 
	$gender, $age, $address, $role, $speciality, $nationality
	]);

	if ($executeQuery) {
		return true;
	}

}

function editApplicant($pdo, $first_name, $last_name, $contact_number, 
$gender, $age, $address, $role, $speciality, $nationality, $applicant_id) {

	$sql = "UPDATE applicants_data
				SET first_name = ?,
					last_name = ?,
					contact_number = ?,
					gender = ?,
                    age = ?,
					address = ?,
					role = ?,
					speciality = ?,
					nationality = ?
				WHERE applicant_id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $contact_number, 
    $gender, $age, $address, $role, $speciality, $nationality, $applicant_id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteApplicant($pdo, $applicant_id) {
	$sql = "DELETE FROM applicants_data
			WHERE applicant_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$applicant_id]);

	if ($executeQuery) {
		return true;
	}
}



?>