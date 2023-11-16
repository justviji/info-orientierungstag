<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the POST request here
    $data = json_decode(file_get_contents("php://input"));
    echo"data:::::";
    var_dump($data);
    if ($data) {
        // Process the data
        $response = "ook";
        $data -> kurse[0];
        $original = file_get_contents("example.json");
        //get the student from the session and get the json element there
        $original = json_decode($original, true);
        $studentName = $data->student;
        $className = $data->class;
        $original[$className]['students'][$studentName]['kurse'] = $data->kurse;
        
        file_put_contents("example.json", json_encode($original, JSON_PRETTY_PRINT));
        header('Content-Type: application/text');
        echo ($response);
    } else {
        http_response_code(400); // Bad Request
        echo "Invalid JSON data";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "This endpoint only supports POST requests";
}
?>
