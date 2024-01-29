<?php
include("parentdashboard.php");
$connection = new mysqli("localhost","root","","upahar");
if($connection->connect_error!=0)
{
  die("Database Connectivity Error");
}
if (isset($_POST['register'])) {
    // Collect data from the form
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $income = $_POST['income'];
    $marriage_certificate = uniqid().$_FILES['marriage_certificate']['name'];
    $citizenship_certificate = uniqid().$_FILES['citizenship_certificate']['name'];
    $email = $_POST['uemail'];

  // SQL query to update data
  $sql = "UPDATE parent_profile SET father_name='$father_name', mother_name='$mother_name', income='$income', marriage_certificate='$marriage_certificate', citizenship_certificate='$citizenship_certificate' WHERE email='$email'";

  if ($connection->query($sql) === TRUE) {
      header("Location:view_parents_profile.php");
  } else {
      echo "Error: " . $sql . "<br>" . $connection->error;
  }

  // Upload files to a directory
  move_uploaded_file($_FILES['marriage_certificate']['tmp_name'], "../uploads/" . $marriage_certificate);
  move_uploaded_file($_FILES['citizenship_certificate']['tmp_name'], "../uploads/" . $citizenship_certificate);
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

</style>
<?php
 // SQL query to update data
 $select_sql = "SELECT * FROM parents NATURAL JOIN parent_profile where parent_profile.email='$email' AND parent_profile.status='Approved'";
 $select_result=$connection->query($select_sql);
 if($select_result->num_rows>0)
 {
    header("Location:view_parents_profile.php");
}
else{?>
    
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Parent Dashboard</h1>
        
      </div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Enter Parents Details</h1>
        
      </div>
      <div class="cards">
            <div class="card">
            <form action="parents_profile.php" method="post" class="form" autocomplete="off" enctype="multipart/form-data">
                                        <div class="input-box">
                        <label>Father name</label>
                        <input type="text" placeholder="Enter father name" name="father_name" pattern="^[A-Za-z\s]+$" value="<?php ?>"required />
                    </div>
                    <div class="input-box">
                        <label>Mother name</label>
                        <input type="text" placeholder="Enter mother name" name="mother_name" pattern="^[A-Za-z\s]+$"  required />
                    </div> <br> <br>

                

                    <div class="input-box">
                        <label>Income Range of Family</label>
                        <select name="income" required>
        <option value="" disabled selected>Select an income range</option>
        <option value="Less than NPR 20,000">Less than NPR 20,000</option>
        <option value="NPR 20,001 - NPR 40,000">NPR 20,001 - NPR 40,000</option>
        <option value="NPR 40,001 - NPR 60,000">NPR 40,001 - NPR60,000</option>
        <option value="NPR 60,001 - NPR 80,000">NPR 60,001 - NPR80,000</option>
        <option value="NPR 80,001 - NPR 100,000">NPR 80,001 - NPR100,000</option>
        <option value="More than NPR 100,000">More than NPR100,000</option>
    </select>
                    </div> <br> <br>
                    <!-- File input for marriage certificate -->
    <div class="input-box">
        <label for="marriage_certificate">Marriage Certificate (PDF only)</label>
        <input type="file" id="marriage_certificate" name="marriage_certificate" accept=".pdf" required />
    </div>

    <!-- File input for citizenship certificate -->
    <div class="input-box">
        <label for="citizenship_certificate">Citizenship Certificate (PDF only)</label>
        <input type="file" id="citizenship_certificate" name="citizenship_certificate" accept=".pdf" required />
    </div>
                    <input type="hidden" name="uemail" value="<?php echo $email;?>">
                    <button type="submit" name="register">Submit</button>
                </form>
            </div>
        </div>
            </div>
        </div>
        <?php
}
?>
    </main>
  </div>
</div>
</body>
</html>