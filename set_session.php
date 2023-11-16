

<?php
session_start(); // Start or resume the session

        $original = file_get_contents("example.json");
        //get the student from the session and get the json element there
        $original = json_decode($original, true);
if (isset($_POST['class']) && isset($_POST['student'])) {
    // Get the class and student from the POST data
    $selectedClass = $_POST['class'];
    $selectedStudent = $_POST['student'];
    $kurse = $original[$selectedClass]['students'][$selectedStudent]['kurse'];
    $anwesend = $original[$selectedClass]['students'][$selectedStudent]['anwesend'];

    // Store the class and student in session variables
    $_SESSION['class'] = $selectedClass;
    $_SESSION['student'] = $selectedStudent;
    $_SESSION['kurse'] = $kurse;
    $_SESSION['anwesend'] = $anwesend;

    echo "Session variables set successfully."; // You can customize this response message
} else {
    echo "Failed to set session variables."; // You can customize this response message
}
?>
