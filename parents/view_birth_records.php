<?php
include("parentdashboard.php");
$connection = new mysqli("localhost","root","","upahar");
if($connection->connect_error!=0)
{
  die("Database Connectivity Error");
}
?>
<style>
    /* Custom CSS for .cards */
.cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between; /* Arrange the cards evenly */
    padding: 20px;
    margin-top: 20px; /* Adjust margin as needed */
}

/* Custom CSS for .card */
.card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 45%; /* Adjust width to fit two cards per row */
    box-sizing: border-box; /* Ensure padding is included in the width */
    margin-bottom: 20px; /* Adjust margin as needed */
}

.card input {
    width: 100%; /* Make the input fields fill the card */
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

.card label {
    font-weight: bold;
}

.card button {
    background-color: #5581b7;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.card button:hover {
    background-color: #335b91;
}

.card a {
    color: #5581b7;
    text-decoration: none;
    margin-left: 10px;
}

.card a:hover {
    text-decoration: underline;
}
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text {
            font-style: italic;
            color: #888;
        }

        .view-link {
            text-decoration: none;
            color: blue;
        }

        .view-link:hover {
            text-decoration: underline;
        }
</style>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Parent Dashboard</h1>
        
      </div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Your Birth Submission Details</h1>
      </div>
      <div>
      <table border='1' width="100%">
      <tr>
                <th style="width:1%">SN</th>
                <th style="width:1%">Submission Time</th>
                <th style="width:20%">Mother Name</th>
                <th style="width:20%">Father Name</th>
                <th style="width:10%">Gender</th>
                <th style="width:10%">Birth Date</th>
                <th style="width:10%">Birth Time</th>
                <th style="width:10%">Weight</th>
                <th style="width:10%">Status</th>
                <th style="width:19%">View</th>
            </tr>
    <?php
    $connection = new mysqli("localhost", "root", "", "upahar");

    // Checking Database Connection
    if ($connection->connect_errno != 0) {
        die("Database Connectivity Error");
    }

    $sql = "SELECT 
                pp.mother_name, 
                pp.father_name, 
                br.gender, 
                br.birthdate, 
                br.birthtime, 
                br.weight, 
                br.birth_certificate,
                br.birth_verification_status,
                br.submitted_time
            FROM 
                parent_profile AS pp
            INNER JOIN 
                birth_records AS br 
            ON 
                pp.profile_id = br.profile_id
            WHERE br.profile_id='$profile_id'";

    $i = 1;
    if ($result = $connection->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>".$i++."</td>
                    <td>{$row['submitted_time']}</td>
                    <td>{$row['mother_name']}</td>
                    <td>{$row['father_name']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['birthdate']}</td>
                    <td>{$row['birthtime']}</td>
                    <td>{$row['weight']}</td>
                    <td>{$row['birth_verification_status']}</td>
                    <td>";

            if (empty($row['birth_certificate'])) {
                echo '<span class="text"> No File Uploaded</span>';
            } else {
                $file_path = '../uploads/' . $row['birth_certificate'];
                echo '<a href="' . $file_path . '" target="_blank">View</a>';
            }

            echo "</td></tr>";
        }
    }
    ?>
</table>
</div>

      
    </main>

</body>
</html>
