<?php
include("parentdashboard.php");

$connection = new mysqli("localhost", "root", "", "upahar");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$birthquery = "SELECT 
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
WHERE br.profile_id = ? AND br.birth_verification_status='Approved'";

$stmt = $connection->prepare($birthquery);
$stmt->bind_param("s", $profile_id);
$stmt->execute();
$birthdata = $stmt->get_result();

if ($birthdata) {
    while ($birthrow = $birthdata->fetch_assoc()) {
        $babybirthdate = $birthrow['birthdate'];
        $motherName = $birthrow['mother_name'];
        $fatherName = $birthrow['father_name'];
    }

    function calculateDueDate($birthdate, $weeksToAdd) 
    {
        $date = new DateTime($birthdate);
        $date->add(new DateInterval("P{$weeksToAdd}W"));
        return $date->format('Y-m-d');
    }

    $today = new DateTime();
    $birthDate = new DateTime($babybirthdate);
    $interval = $today->diff($birthDate);
    $ageInWeeks = floor($interval->days / 7);

    echo "Age in weeks: $ageInWeeks<br>";
    echo "Baby's birthdate: $babybirthdate<br>";

    $vaccineSchedule = [
        0 => [
            'name' => "BCG",
            'details' => "Bacillus Calmette-Guérin vaccine, given at birth to prevent Tuberculosis.",
        ],
        6 => [
            'name' => "Hepatitis B",
            'details' => "Hepatitis B vaccine, given at 6 weeks.",
        ],
        10 => [
            'name' => "Pentavalent",
            'details' => "Pentavalent vaccine, given at 10 weeks. Protects against Diphtheria, Tetanus, Pertussis, Hepatitis B, and Hib.",
        ],
        14 => [
            'name' => "Polio",
            'details' => "Oral Polio Vaccine (OPV), given at 14 weeks.",
        ],
        14 => [
            'name' => "PCV",
            'details' => "Pneumococcal Conjugate Vaccine (PCV), given at 14 weeks. Protects against Pneumococcal diseases.",
        ],
        18 => [
            'name' => "Rotavirus",
            'details' => "Rotavirus vaccine, given at 18 weeks.",
        ],
        24 => [
            'name' => "MMR",
            'details' => "Measles, Mumps, Rubella (MMR) vaccine, given at 24 weeks.",
        ],
        36 => [
            'name' => "Varicella",
            'details' => "Varicella (Chickenpox) vaccine, given at 9 months.",
        ],
        48 => [
            'name' => "Hepatitis A",
            'details' => "Hepatitis A vaccine, given at 12 months.",
        ],
        96 => [
            'name' => "Typhoid",
            'details' => "Typhoid vaccine, given at 24 months.",
        ],
        // Add more entries as needed
    ];

    $messages = [];
    foreach ($vaccineSchedule as $week => $vaccine) {
        if ($ageInWeeks >= $week) {
            $dueDate = calculateDueDate($babybirthdate, $week);
            $messages[] = "Dear $motherName and $fatherName, it's time for the {$vaccine['name']} vaccine. {$vaccine['details']} Please schedule your appointment for $dueDate.";
        }
    }

    

    $stmt->close();
    $connection->close();
} else {
    echo "Hello";
}
?>
<style>
    .notification {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f0f0f0;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Parent Dashboard</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Your Vaccine Details</h1>
    </div>
    <div>
        <?php
        foreach ($messages as $message) {
            echo "<div class='notification'><h3>$message</h3></div>";
        }
        ?>
    </div>
</main>
</body>
</html>