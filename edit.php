<div class="body">
        <form action="" method="post">
            <?php 
                if(isset($_POST["submit"])){
                    $csv = fopen("example.csv", "a");
                    $data = array($_SESSION['class'], $_SESSION['student']);
                    foreach ($_POST as $key => $value) {
                        array_push($data, $value);
                    }
                    fputcsv($csv, $data);
                    fclose($csv);
                    echo "Saved successfully";
                }


                $jsonData = file_get_contents('./slots.json');
                $data = json_decode($jsonData, true);
                
                if ($data === null) {
                    die("Failed to decode JSON data");
                }
                $n = 0;
                $exists = true;

                $csv = fopen("example.csv", "r");
                while (($row = fgetcsv($csv)) !== false) {
                   
                        if ($_SESSION['class'] == $row[0] && $_SESSION['student'] == $row[1]) {
                            if(empty($row[3])){
                                echo'user existiert noch nicht!';
                                $exists = false;
                            }else{
                                if(!isset($_POST["submit"])){
                                foreach ($data['slots'] as $subarray) {
                                    echo '<select name="select'.$n.'">';
                                    $selectedValue = isset($_POST['select'.$n]) ? $_POST['select'.$n] : '';
                                    foreach ($subarray as $value) {
                                        echo '<option value="' . $value . '"';
                                        if ($selectedValue === $value) {
                                            echo ' selected';
                                        }
                                        echo '>' . $value . '</option>';
                                    }
                                    echo '</select>';
                                    echo '<br>';
                                    $n++;   
                                }
                            }
                        }
                        } 

                       
                    
                }
                if($exists == true){
                    echo '<input type="submit" name="submit" value="Save">';
                }
                
            ?>
           
        </form>
    </div>