<?php
// Start the user session (if not already started)
session_start();

// Set the time limit in seconds
$timeLimit = 1000; // 10 minutes

// Check if the start time is not set, indicating the beginning of the quiz
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// Get the current time
$currentTime = time();

// Calculate the time left
$timePassed = $currentTime - $_SESSION['start_time'];
$timeLeft = $timeLimit - $timePassed;

if ($timeLeft <= 0) {
    // Time is up, you can perform actions like automatically submitting the quiz
    echo "Time is up!";
} else {
    $minutes = floor($timeLeft / 60);
    $seconds = $timeLeft % 60;
    echo "Time Left: $minutes minutes $seconds seconds";
}
?>