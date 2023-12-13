<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <form method="post">
            <select name="classes" id="classes">
            <option value="none">select</option>
                <?php
                    $json = file_get_contents('example.json');
                    $data = json_decode($json, true);

                    if ($data) {
                        foreach ($data as $class => $classData) {
                            echo '<option value="' . $class . '">' . $class . '</option>';
                        }
                    }
                ?>
            </select>
            <select name="classmates" id="classmates">
               
            </select>
        </form>
    </div>
</nav>
<script>
    $(document).ready(function() {
        // Handle class change event
        $('#classes').on('change', function() {
            var selectedClass = $(this).val();
            $('#classmates').html('<option>Loading...</option>');

            // Send an AJAX request to get students for the selected class
            $.ajax({
                url: 'get_students.php', 
                method: 'POST',
                data: { class: selectedClass },
                success: function(data) {
                    $('#classmates').html(' <option value="none">select</option>'+data);
                }
            });
        });

        // Handle student change event
        $('#classmates').on('change', function() {
            var selectedClass = $('#classes').val();
            var selectedStudent = $(this).val();

            // Send an AJAX request to set class and student in the session
            $.ajax({
                url: 'set_session.php', // Replace with the correct URL
                method: 'POST',
                data: { class: selectedClass, student: selectedStudent},        
                success: function(data) {
                    // You can handle success, e.g., redirect or display a message
                    //console.log(data);
                    sessionStorage.setItem('class', selectedClass);
                    sessionStorage.setItem('student', selectedStudent);
                    //sessionStorage.setItem('absent', )
                    location.reload();
                }
            });
        });
    });
</script>
