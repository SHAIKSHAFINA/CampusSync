<?php
// Profile.php - User Profile Page

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include('../db/db.php');

$user_id = $_SESSION["id"];
$sql = "SELECT username, events_attended, clubs, score FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $events_attended, $clubs, $score);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style3.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <div class="profile-stats">
            <h3>Profile Stats</h3>
            <p><strong>Events Attended:</strong> <?php echo $events_attended; ?></p>
            <p><strong>Clubs:</strong> <?php echo $clubs; ?></p>
            <p><strong>Score:</strong> <?php echo $score; ?></p>
            <h3>Leaderboard</h3>
            <p>Placeholder for leaderboard details.</p>
        </div>
    </div>
</body>
</html>
