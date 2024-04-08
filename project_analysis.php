<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    header("location: login.php");
    exit;
}

require_once "config.php";


$sql = "SELECT Name, Budget, Plan FROM project";
$result = $conn->query($sql);


$projectNames = [];
$budgets = [];


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projectNames[] = $row["Name"];
        $budgets[] = $row["Budget"];
    }
}


$planChanges = [];
for ($i = 0; $i < count($projectNames); $i++) {
    $percentChange = rand(-20, 20); 
    $planChanges[] = $percentChange;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Analysis</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https:
    <!-- Chart.js -->
    <script src="https:
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

        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="navbar">
    
<a href="#" onclick="history.back();" class="btn btn-primary">Go Back</a>

    <a href="project_owner.php" class="btn btn-danger">Go Home</a>
</div>

<div class="container">
    <h1>Project Analysis</h1>
    
   
    <h2>Budget Analysis</h2>
    <canvas id="budgetChart" width="400" height="200"></canvas>

    
    <h2>Plan Change</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Plan Change (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($projectNames); $i++) : ?>
                <tr>
                    <td><?= $projectNames[$i] ?></td>
                    <td><?= $planChanges[$i] ?>%</td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

<script>
    
    var ctx = document.getElementById('budgetChart').getContext('2d');
    var budgetChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($projectNames) ?>,
            datasets: [{
                label: 'Budget',
                data: <?= json_encode($budgets) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</body>
</html>
