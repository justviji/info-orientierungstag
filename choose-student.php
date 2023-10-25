

<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <form method="post">
                <select name="classes" id="classes">
                    <?php
                        $file = fopen('example.csv', 'r');
                        $classes = array();
                        while (($row = fgetcsv($file)) !== false) {
                            if (!in_array($row[0], $classes)) {
                                array_push($classes, $row[0]);
                                if (isset($_POST['classes']) && $_POST['classes'] == $row[0]) {
                                    echo '<option value="' . $row[0] . '" selected>' . $row[0] . '</option>';
                                }else{
                                    echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
                                }   
                            }
                        }
                        fclose($file);
                    ?>
                </select>
                <div>
                    <button type="submit" name="loadStudents">Load Students</button>
                </div>
                <select name="classmates">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loadStudents'])) {
                    $class = filter_input(INPUT_POST, 'classes', FILTER_SANITIZE_STRING);
                    $file = fopen('example.csv', 'r');
                    while ($row = fgetcsv($file)) {
                        if ($class == $row[0]) {
                            if (isset($_POST['classmates']) && $_POST['classmates'] == $row[1]) {
                                echo '<option value="' . $row[1] . '" selected>' . $row[1] . '</option>';
                            }else{
                                echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
                            }
                        }
                    }
                    fclose($file);
                }
                ?>
                </select>
                <div>
                    <button type="submit" name="loadSingleStudent">Load student</button>
                </div>
            </form>
        </div>
    </nav>