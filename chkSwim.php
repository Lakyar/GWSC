<?php
include 'nav.php';
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST['date'];
    $guests = $_POST['guests'];
    $days = $_POST['days'];
    
    // Store selections
    $_SESSION['selectedDate'] = $selectedDate;
    $_SESSION['guests'] = $guests;
    $_SESSION['days'] = $days;
    
    header("Location: availability_results_swim.php");
    exit();
    
}
?>
    <h1 class="chkH1">Explore Swimming Sites</h1>

    <form action="availability_results_swim.php" method="post" class="chkForm">
        <div>
            <label for="date">Arriving Date:</label>
            <input type="date" name="date" value="<?= date('Y-m-d'); ?>">
        </div>
        <div>
            <label for="guests">Number of Guests:</label>
            <input type="number" name="guests" min="1" max="15" required value="1">
        </div>
        <input type="hidden" name="days" value="1">
        <input type="submit" value="Check Availability" class="chkAvailablityBtn">
    </form>

</body>


    <script>
        const today = new Date().toISOString().split('T')[0];
        const dateInputs = document.querySelectorAll('input[type="date"]');
        dateInputs.forEach(input => {
            input.setAttribute('min', today);
        });
    </script>
</html>
