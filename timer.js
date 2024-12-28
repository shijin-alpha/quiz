const intailTimerLimit = 1800 ;
function startTimer(timeLimit) {
    const countdownElement = document.getElementById('countdown');
    let timeLeft = timeLimit;

    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownElement.textContent =` ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert('Time is up! Automatically submitting...');
            // Automatically submit the form
            document.getElementById('quiz-form').submit();
        } else {
            timeLeft--;
        }
    }

    function animateTimer() {
        let rotation = 0;
        const maxRotation = 360;
        const animationDuration = 1000; // 1 second

        function animate() {
            rotation = (rotation + 1) % maxRotation;
            countdownElement.style.transform = ` rotate(${rotation}deg)`;
        }

        const animateInterval = setInterval(animate, animationDuration / maxRotation);
    }

    // Initial call to set the timer display
    updateTimer();

    const timerInterval = setInterval(updateTimer, 1000);
    animateTimer();
}

// Start the timer when the page loads
window.onload = function () {
    startTimer(intailTimerLimit); // 10 minutes (600 seconds)
}
