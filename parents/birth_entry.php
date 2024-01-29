<?php
include("parentdashboard.php");
$connection = new mysqli("localhost","root","","upahar");
if($connection->connect_error!=0)
{
  die("Database Connectivity Error");
}
if (isset($_POST['birth_submit'])) {
    // Collect data from the forms
    $birth_date = $_POST['birth_date'];
    $birth_time = $_POST['birth_time'];
    $weight = $_POST['kg'];
    $gender = $_POST['gender'];
    $birth_certificate = uniqid().$_FILES['birth_certificate']['name'];
    $profile_id = $_POST['profile_id'];

    // Move the uploaded file to the desired directory
    $destination = "../uploads/" . $birth_certificate;
    move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $destination);

    // SQL query to insert data into birth_records table
    $sql = "INSERT INTO birth_records (birthdate, birthtime, gender, weight,birth_certificate, profile_id)
            VALUES ('$birth_date', '$birth_time', '$gender', '$weight', '$birth_certificate', '$profile_id')";

if (mysqli_query($connection, $sql)) {
    header("Location:view_birth_records.php");// redirect to view birth record if succesfully entry
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

}

// Close the database connection
mysqli_close($connection);
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

</style>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Parent Dashboard</h1>
        
      </div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Enter Birth Details</h1>
        
      </div>
      <div class="cards">
            <div class="card">
            <form action="birth_entry.php" method="post" class="form" autocomplete="off" enctype="multipart/form-data">
            <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" placeholder="Enter Date" name="birth_date" min="<?php echo date('Y-m-d'); ?>" required />
                    </div>
                    <div class="input-box">
                        <label>Birth Time</label>
                        <input type="time" placeholder="Enter Date" name="birth_time"   required />
                    </div>
                    <div class="input-box">
                        <label>Weight in Kg</label>
                        <input type="text" placeholder="Enter Weight" name="kg"  required />
                    </div> <br> <br>

                

                    <div class="input-box">
                        <label>Gender</label>
                        <select name="gender" required>
        <option value="" disabled selected>Select Gender of Child</option>
        <option value="Girl">Girl</option>
        <option value="Boy">Boy</option>
    </select>
                    </div> <br> <br>
                    <!-- File input for marriage certificate -->
    <div class="input-box">
        <label for="birth_certificate">Birth Certificate From Hospital (PDF only)</label>
        <input type="file" id="birth_certificate" name="birth_certificate" accept=".pdf" required />
    </div>

                    <input type="hidden" name="profile_id" value="<?php echo $profile_id=$row['profile_id'];?>">
                    <button type="submit" name="birth_submit">Submit</button>
                </form>
            </div>
        </div>
            </div>
        </div>
    </main>
  </div>
</div>
</body>
</html>