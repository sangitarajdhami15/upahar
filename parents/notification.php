<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Program Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Health Program Notifications</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <!-- Use PHP to dynamically generate rows based on notifications -->
                <?php
                    // Assuming $notifications is an array of notifications
                    foreach ($notifications as $notification) {
                        echo "<tr>";
                        echo "<td>{$notification['notification_date']}</td>";
                        echo "<td>{$notification['message']}</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
