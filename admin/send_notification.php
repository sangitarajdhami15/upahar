<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents('php://input'));

    if ($data && isset($data->birthDate, $data->options->body)) {
        // Check if the browser supports notifications
        if ($data->permission === 'granted') {
            // Store the newborn notification in the database
            require_once('birth_records.php'); // Assuming birth_records.php is the correct file

            $birthdate = $data->birthDate;
            $body = $data->options->body;
            $timestamp = strtotime($birthdate . ' 10:00 AM');

            $sql = "INSERT INTO birth_records (birthdate, body, timestamp) VALUES ('$birthdate', '$body', '$timestamp')";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Newborn notification scheduled successfully.'));
            } else {
                echo json_encode(array('error' => 'Error scheduling newborn notification.'));
            }

            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(array('error' => 'Notification permission denied.'));
        }
    } else {
        echo json_encode(array('error' => 'Invalid request data.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method.'));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
// Assume you have a function to request notification permission
function requestNotificationPermission() {
    return Notification.requestPermission();
}

// Function to schedule a notification
function sendNotification(hid, birth_id) {
    requestNotificationPermission().then(permission => {
        // Check if permission is granted
        if (permission === 'granted') {
            // Send notification scheduling request to the server
            fetch('send_notification.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    hid: hid,
                    birth_id: birth_id,
                    permission: permission,
                }),
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error(error));
        } else {
            console.error('Notification permission denied.');
        }
    });
}


// Example usage
scheduleNewbornNotification('Baby Smith', '2023-01-01', 'Welcome to the world, Baby Smith! 🍼');

</script>

    
</body>
</html>