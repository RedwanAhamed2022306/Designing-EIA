<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    header("location: login.php");
    exit;
}

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["user_type"] === "project owner") {
        if (isset($_POST["add_project"])) {
            
            header("location: add_project.php");
            exit;
        } elseif (isset($_POST["update_project"])) {
            
            $project_id = $_POST["project_id"];
            header("location: update_project.php?project_id=$project_id");
            exit;
        } elseif (isset($_POST["delete_project"])) {
            
            $project_id = $_POST["project_id"];
            header("location: delete_project.php?project_id=$project_id");
            exit;
        }
    }
}


$sql = "SELECT * FROM project";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Owner Dashboard</title>
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

        .add-project-form {
            margin-top: 20px;
        }

        .action-btns {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="project_type.php" class="btn btn-primary">Project Type</a>
    <a href="environmental_impact.php" class="btn btn-primary">Environmental Impact</a>
    <a href="monitoring.php" class="btn btn-primary">Monitoring</a>
    <a href="location.php" class="btn btn-primary">Location</a>
    <a href="impact.php" class="btn btn-primary">Impact</a>
    <a href="project_owner_t.php" class="btn btn-primary">Project Owner</a>
    <div class="navbtns">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<div class="container mt-4">
    <h1>Projects</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Project ID</th>
            <th>Project Type ID</th>
            <th>Location ID</th>
            <th>Impact ID</th>
            <th>Monitoring ID</th>
            <th>Name</th>
            <th>Plan</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Budget</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["project_id"] . "</td>";
                echo "<td>" . $row["project_type_id"] . "</td>";
                echo "<td>" . $row["location_id"] . "</td>";
                echo "<td>" . $row["impact_id"] . "</td>";
                echo "<td>" . $row["monitoring_id"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["plan"] . "</td>";
                echo "<td>" . $row["Start_Date"] . "</td>";
                echo "<td>" . $row["End_Date"] . "</td>";
                echo "<td>" . $row["Budget"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No projects found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
