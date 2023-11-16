<div class="bg-gray-100 h-screen flex flex-col items-center justify-center">
    <div class="max-w-sm mx-auto bg-white p-4 rounded shadow-md mt-4">
        <table class="custom-table">
            <?php 
                $original = file_get_contents("example.json");
                $original = json_decode($original, true);
                if (isset($_SESSION['class']) && isset($_SESSION['student'])) {
                    // Get the class and student from the POST data
                    $selectedClass = $_SESSION['class'];
                    $selectedStudent = $_SESSION['student'];
                    $kurse = $original[$selectedClass]['students'][$selectedStudent]['kurse'];
                    $anwesend = $original[$selectedClass]['students'][$selectedStudent]['anwesend'];
                
                    // Store the class and student in session variables

                    echo '<tr>
                            <th>
                                <a class="custom-link">'.$_SESSION["student"].'</a>
                            </th>
                        </tr>';
                    echo '<tr>
                            <th>
                                <a class="custom-link">'.$_SESSION["class"].'</a>
                            </th>
                        </tr>';
                    echo '
                        <tr>
                            <td>
                                <a class="custom-link" href="./orientierungs.php?action=add-new">Angemeldet für:</a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <a class="custom-link"><pre>'. implode( "\n",$kurse).'</pre></a>
                            </th>
                        </tr>';
                    echo '<tr>
                            <th>
                                <a class="custom-link">'.$anwesend==true?"anwesend":"abwesend".'</a>
                            </th>
                        </tr>';
                }
            ?>
        </table>
    </div>
</div>
