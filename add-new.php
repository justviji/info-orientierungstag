
<div>
    <select name="k1" id="k1">

    </select>
    <select name="k2" id="k2">

    </select>
    <select name="k3" id="k3">

    </select>
    <select name="k4" id="k4">

    </select>
    <select name="k5" id="k5">

    </select>
    <select name="k6" id="k6">

    </select>
    
    <button type="button" id="submitBtn">submit</button>
    <script>
        
        function submit(){
            var k1 = document.getElementById("k1").value;
            var k2 = document.getElementById("k2").value;
            var k3 = document.getElementById("k3").value;
            var k4 = document.getElementById("k4").value;
            var k5 = document.getElementById("k5").value;
            var k6 = document.getElementById("k6").value;
            var data = {kurse:[k1,k2,k3,k4,k5,k6], class: sessionStorage.getItem("class"), student:sessionStorage.getItem("student")};
            console.log("class "+sessionStorage.getItem("class"));
            console.log("student "+sessionStorage.getItem("student"));
            console.log(JSON.stringify(data));
            fetch('http://localhost/info-orientierungstag/save-data.php', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data), 
            })
            .then(response => response.text())
            .then(data => console.log(data));
            }

            document.getElementById('submitBtn').addEventListener('click', function () {
                submit();
            });

    </script>

</div>


<script>
fetch('slots.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(slotsData => {
        const selectElements = document.querySelectorAll('select'); 

        selectElements.forEach((select, index) => {
            slotsData.slots[index].forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.textContent = option;
                select.appendChild(optionElement);
            });
        });
    })
    .catch(error => {
        console.error('Error loading or parsing JSON file:', error);
    });
</script>       


<?php
/*




// Load JSON data from example.json
$json = file_get_contents("example.json");
$data = json_decode($json, true);
$slots = file_get_contents("slots.json");
$slotData = json_decode($slots, true);

if ($data === null) {
    die("Failed to decode JSON data");
}

$class = $_SESSION['class'];
$student = $_SESSION['student']; 
var_dump($data[$class]['students'][$student]);
if (isset($data[$class]['students'][$student]["name"])) {
    //$data[$class]['students'][$student];
    echo '<div class="body">';
    echo '<form action="" method="post">';


    for($i = 0; $i < count($slotData['slots']); $i++) {
        echo '<select name="select'.$i.'">';
        $selectedValue = isset($data[$class]['students'][$student][$i]) ? $data[$class]['students'][$student] : '';
        foreach ($slotData["slots"][$i] as $value) {
            echo '<option value="' . $value . '"';
            if ($selectedValue === $value) {
                echo ' selected';
            }
            echo '>' . $value . '</option>';
        }
        echo '</select>';
        echo '<br>';
    }
    /*
    foreach ($slotData['kurse'] as $key => $value) {
        echo '<select name="' . $key . '">';
        $selectedValue = isset($_POST[$key]) ? $_POST[$key] : $value;
        foreach ($slotData["slots"] as $option) {
            echo '<option value="' . $option . '"';
            if ($selectedValue === $option) {
                echo ' selected';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';
        echo '<br>';
    }*

    echo '<input type="submit" name="submit" value="Save">';
    echo '</form>';
    echo '</div>';
} else {
    echo "Student not found!";
}
*/
?>
