<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT * FROM project_owner";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Owners</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https:
    <style>
        .navbar {
            background-color: #468847;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #6c6c6c;
        }

        .navbtns {
            float: right;
        }

        .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="project_owner.php" class="btn btn-primary">Go Home</a>
    <<a href="#" onclick="history.back();" class="btn btn-primary">Go Back</a>
    <div class="navbtns">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<div class="container-fluid mt-4">
    <h1>Project Owners</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Project Owner ID</th>
            <th>Project ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Contact Details</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Project_owner_id"] . "</td>";
                echo "<td>" . $row["project_id"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td><a href='contact_information.php?project_owner_id=" . $row["Project_owner_id"] . "' class='btn btn-info'>Contact Details</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No project owners found</td></tr>";
        }
        ?>
        </tbody>
    </table>
    
    <!-- Button to redirect to add_project_owner.php -->
    <a href="add_project_owner.php" class="btn btn-success">Assign to a Project</a>
    
    <a href="javascript:history.go(-1);" class="btn btn-primary">Go Back</a>
</div>

</body>
</html>
