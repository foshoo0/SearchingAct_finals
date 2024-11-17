<?php 
require_once 'core/dbconfig.php'; 
require_once 'core/models.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Applicants Data</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
	        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
	        crossorigin="anonymous"></script>
	<style>
		/* General Styles For More Presentable Looking Table*/
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 20px;
			background-color: #f4f4f9;
		}
		h1 {
			color: green;
			text-align: center;
			background-color: #e9f9e9;
			border: 1px solid #c3e6c3;
			padding: 10px;
			margin-bottom: 20px;
		}
		form {
			margin-bottom: 20px;
			text-align: center;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		th, td {
			padding: 12px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f8f9fa;
			color: #333;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		tr:hover {
			background-color: #e9ecef;
		}
		.action-links a {
			margin-right: 10px;
			text-decoration: none;
			color: #007bff;
		}
		.action-links a:hover {
			text-decoration: underline;
		}
		.controls {
			margin-bottom: 10px;
			text-align: center;
		}
		.controls a {
			margin: 0 10px;
			text-decoration: none;
			color: #007bff;
		}
		.controls a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<!-- Flash Messages-->
	<?php if (isset($_SESSION['message'])): ?>
		<h1>
			<?php echo $_SESSION['message']; ?>
		</h1>
		<?php unset($_SESSION['message']); ?>
	<?php endif; ?>

	<!-- Search and Controls -->
	<div class="controls">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
			<input type="text" name="searchInput" placeholder="Search here">
			<input type="submit" name="searchBtn" value="Search">
		</form>
		<p><a href="index.php">Clear Search Query</a> | <a href="insert.php">Insert New User</a></p>
	</div>

	<!-- Data Table -->
	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Contact Number</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Address</th>
				<th>Role</th>
				<th>Speciality</th>
				<th>Nationality</th>
				<th>Date Added</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			// Fetch data based on search or get all applicants
			$data = isset($_GET['searchBtn']) 
				? searchForAapplicant($pdo, $_GET['searchInput']) 
				: getAllApplicants($pdo);
			foreach ($data as $row): ?>
				<tr>
					<td><?php echo htmlspecialchars($row['first_name']); ?></td>
					<td><?php echo htmlspecialchars($row['last_name']); ?></td>
					<td><?php echo htmlspecialchars($row['contact_number']); ?></td>
					<td><?php echo htmlspecialchars($row['gender']); ?></td>
					<td><?php echo htmlspecialchars($row['age']); ?></td>
					<td><?php echo htmlspecialchars($row['address']); ?></td>
					<td><?php echo htmlspecialchars($row['role']); ?></td>
					<td><?php echo htmlspecialchars($row['speciality']); ?></td>
					<td><?php echo htmlspecialchars($row['nationality']); ?></td>
					<td><?php echo htmlspecialchars($row['date_added']); ?></td>
					<td class="action-links">
						<a href="edit.php?applicant_id=<?php echo $row['applicant_id']; ?>">Edit</a>
						<a href="delete.php?applicant_id=<?php echo $row['applicant_id']; ?>">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>
