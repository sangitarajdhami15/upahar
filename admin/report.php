<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu for Admin Dashboard | CodingNepal</title>
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<body>
  <?php
  session_start(); 
  if(!isset($_SESSION['admin'])) {
    header("Location:index.php"); 
  }
  $row=$_SESSION['admin']; 
  $email=$row['email']; 
  if(isset($_POST['logout'])) {
    session_destroy(); 
    header("Location:index.php");  
  }

$connection = new mysqli("localhost", "root", "", "upahar");
if ($connection->connect_errno != 0) {
    die("Connection failed");
}
?>

<main class="main">
    <br><br><br>
    <div>
        <h1>Birth Record Report</h1>
        <form action="report.php" method="POST">
            <label for="start_date"> Start Date: <input type="date" name="start_date" id="start_date" required></label><br><br>
            <label for="end_date"> End Date: <input type="date" name="end_date" id="end_date" required></label><br><br>
            <button type="submit" name="search">Submit</button>
        </form>
    </div>

    <div>
        <?php
        $birthRecords = array(); // Initialize an array to store the matched records

        if (isset($_POST['search'])) { // Corrected to use $_POST
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            // Protect against SQL injection by using prepared statements
            $sql = "SELECT gender, weight, birthdate FROM birth_records WHERE birth_verification_status='Approved'AND birthdate BETWEEN ? AND ?";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ss", $start_date, $end_date);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $birthRecords[] = $row; // Add each record to the array
                }
            }
        }
        ?>

        <canvas id="chartCanvas" width="400" height="150"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const birthRecords = <?php echo json_encode($birthRecords); ?>;
            const canvas = document.getElementById('chartCanvas');
            const ctx = canvas.getContext('2d');

            const start_date = "<?php echo $start_date; ?>";
            const end_date = "<?php echo $end_date; ?>";
            const labels = [start_date, ...birthRecords.map(record => record.birthdate), end_date];

            const weights = [null, ...birthRecords.map(record => record.weight), null]; // Using null to keep the endpoints

            const genders = birthRecords.map(record => record.gender);
            const colors = birthRecords.map(record => (record.gender === 'Boy') ? 'rgba(0, 0, 255, 0.8)' : 'rgba(0, 128, 0, 0.8)');



            const chartData = {
                labels: labels,
                datasets: [{
                  
                    label: 'Weight',
                    data: weights,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1,
                    pointRadius: 5, // Set the point radius to make points visible
                    pointHoverRadius: 8 // Set hover radius for better visibility
                }]
            };

            new Chart(ctx, {
                type: 'scatter', // Change the type to 'scatter' for points
                data: chartData,
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            labels: labels,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Weight'
                            },
                            ticks: {
                                stepSize: 1.5, // Set the step size to 1.5
                                callback: function (value, index, values) {
                                    return value % 1.5 === 0 ? value : ''; // Display ticks at intervals of 1.5
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</main>


  <script src="dashboard.js"></script>
</body>
</html>