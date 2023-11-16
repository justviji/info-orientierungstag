<?php
// Check if the 'class' parameter is set and not empty
if (isset($_POST['class']) && !empty($_POST['class'])) {
    $selectedClass = $_POST['class'];

    // Read the JSON data from example.json
    $json = file_get_contents('example.json');
    $data = json_decode($json, true);

    if ($data === null) {
        die("Failed to decode JSON data");
    }

    $students = array();

    // Check if the selected class exists in the JSON data
    if (isset($data[$selectedClass]['students'])) {
        // Iterate through the students in the selected class
        foreach ($data[$selectedClass]['students'] as $student) {
            $students[] = $student['name'];
        }

        // Generate the HTML options for the students
        $options = '';
        foreach ($students as $student) {
            $options .= '<option value="' . $student . '">' . $student . '</option>';
        }

        echo $options;
    } else {
        echo '<option value="">No students found for the selected class</option>';
    }
} else {
    echo '<option value="">Select a class first</option>';
}
?>
