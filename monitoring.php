<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    header("location: login.php");
    exit;
}

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['audit'])) {
    $monitoring_id = $_POST['monitoring_id'];
    header("location: audit.php?monitoring_id=" . $monitoring_id);
    exit;
}

$sql = "SELECT * FROM monitoring";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
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
    <a href="project_type.php" class="btn btn-primary">Project Type</a>
    <a href="mitigation_plan.php" class="btn btn-primary">Mitigation Plan</a>
    <a href="project_owner.php" class="btn btn-primary">Go Back to Home</a>
    <div class="navbtns">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<div class="container-fluid mt-4">
    <h1>Monitoring</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Monitoring ID</th>
            <th>Project ID</th>
            <th>Date</th>
            <th>Parameters Measured</th>
            <th>Audit</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["monitoring_id"] . "</td>";
                echo "<td>" . $row["Project_id"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["parameters_measured"] . "</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='monitoring_id' value='" . $row["monitoring_id"] . "'>";
                echo "<button type='submit' name='audit' class='btn btn-primary'>Audit</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No monitoring data found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
