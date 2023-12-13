<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the POST request here
    $data = json_decode(file_get_contents("php://input"), true);
    echo "data:::::";
    var_dump($data);

    if ($data) {
        // Process the data
        $response = "ook";
        $original = file_get_contents("slots.json");

        // Force decoding as an array
        $original = json_decode($original, true);

        if ($original === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            http_response_code(500); // Internal Server Error
            echo "Error decoding JSON: " . json_last_error_msg();
            return;
        }
        
        echo (intval($data["deleteRow"]));
        echo (intval($data["deleteRow"][intval($data["deleteCell"])]));
        echo $original;
        echo intval($data["deleteRow"], 10)-1;

        if (isset($original["slots"][intval($data["deleteRow"], 10)-1][intval($data["deleteCell"], 10)])) {
            echo $original["slots"][intval($data["deleteRow"], 10)-1][intval($data["deleteCell"], 10)];
            unset($original["slots"][intval($data["deleteRow"], 10)-1][intval($data["deleteCell"], 10)]);
            $original["slots"][intval($data["deleteRow"], 10)-1] = array_values($original["slots"][intval($data["deleteRow"], 10)-1]);
            echo $original["slots"][intval($data["deleteRow"], 10)-1][intval($data["deleteCell"], 10)];
        }

        file_put_contents("slots.json", json_encode($original, JSON_PRETTY_PRINT));
        header('Content-Type: application/text');
        // echo ($response);
    } else {
        http_response_code(400); // Bad Request
        echo "Invalid JSON data";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "This endpoint only supports POST requests";
}
?>
