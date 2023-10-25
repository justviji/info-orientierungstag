<div class="body">
        <form action="" method="post">
            <?php 
                if(isset($_POST["submit"])){
                    $csv = fopen("example.csv", "a");
                    str_replace($_SESSION['class'], '"', '');
                    $data = array($_SESSION['class'], $_SESSION['student']);
                    foreach ($_POST as $key => $value) {        
                        str_replace($value, '"', '');
                        
                        if($value != "Save"){
                            array_push($data, $value);
                        }
                    }
                    $_POST = array();
                    var_dump($data);
                    $file = fopen("example.csv", "r");
                    $rows = array();
                    while (($row = fgetcsv($file)) !== false) {
                        if($row[0]!= $_SESSION['class'] && $row[1] != $_SESSION['student'])
                            $rows[] = $row;
                    }
                    array_push($rows, $data);
                    fclose($file);
                    fputcsv($csv, $rows);
                    fclose($csv);
                    echo "Saved successfully";
                }


                $jsonData = file_get_contents('./slots.json');
                $data = json_decode($jsonData, true);
                
                if ($data === null) {
                    die("Failed to decode JSON data");
                }
                $n = 0;
                $exists = false;

                $csv = fopen("example.csv", "r");
                while (($row = fgetcsv($csv)) !== false) {
                   
                        if ($_SESSION['class'] == $row[0] && $_SESSION['student'] == $row[1]) {
                            if(!empty($row[3])){
                                if(!isset($_POST["submit"])){
                                    echo'user existiert schon!';
                                    
                                } 
                                $exists = true;
                            }else{
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
                if($exists == false){
                    echo '<input type="submit" name="submit" value="Save">';
                }
                
            ?>
           
        </form>
    </div>