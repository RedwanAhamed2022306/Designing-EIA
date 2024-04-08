<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT * FROM project_type";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Type</title>
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
    <a href="environmental_impact.php" class="btn btn-primary">Environmental Impact</a>
    <a href="project_owner.php" class="btn btn-primary">Go Back to Home</a>
    <div class="navbtns">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<div class="container-fluid mt-4">
    <h1>Project Type</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Project Type ID</th>
            <th>Project Type Name</th>
            <th>Baseline Impact</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["project_type_id"] . "</td>";
                echo "<td>" . $row["project_type_name"] . "</td>";
                echo "<td>" . $row["baseline_impact"] . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No project types found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
