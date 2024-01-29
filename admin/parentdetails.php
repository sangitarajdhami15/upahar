<?php
$connection = new mysqli("localhost", "root", "", "upahar");

if ($connection->connect_errno != 0) {
    die("Database Connectivity Error");
}

function linearSearchByName($records, $searchName) {
    $matchedRecords = array();

    foreach ($records as $record) {
        if (stripos($record['mother_name'], $searchName) !== false) {
            $matchedRecords[] = $record;
        }
    }

    return $matchedRecords;
}

// Fetch the birth submission details based on the profile_id
$profile_id = 5;
$profile_id = 7;
 // Replace with the actual profile_id
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

$result = $connection->query($sql);

if (!$result) {
    die("Query failed: " . $connection->error);
}

$records = $result->fetch_all(MYSQLI_ASSOC);

$i = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parent Dashboard</title>
  <style>
    /* Styles for the main content area */
.main-content {
    padding: 20px;
}

/* Style for the search form */
form {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-right: 10px;
}

input[type="text"] {
    padding: 5px;
    width: 200px;
}

button {
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

/* Style for the table */
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
</head>
<body>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Parent Dashboard</h1>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Your Birth Submission Details</h1>
    </div>

    <div>
      <form action="#" method="post">
        <label for="search_name">Search by Mother's Name:</label>
        <input type="text" id="search_name" name="search_name" required>
        <button type="submit" name="search_by_name">Search</button>
      </form>

      <table border='1' width="100%">
        <!-- Table header -->
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_by_name'])) {
            $searchName = $_POST['search_name'];
            $matchedRecords = linearSearchByName($records, $searchName);
            foreach ($matchedRecords as $row) {
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

<?php
$connection->close(); // Close the database connection when you're done
?>
