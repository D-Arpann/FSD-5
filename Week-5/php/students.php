<?php 
require 'header.php'; 
?>

<h2>Registered Students</h2>

<table>
    <thead>
        <tr>
            <th>Name</th> <th>Email</th> <th>Skills</th> </tr>
    </thead>
    <tbody>
        <?php
        $file = 'students.txt';

        if (file_exists($file) && filesize($file) > 0) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                $data = explode('|', $line);
                
                if(count($data) >= 3) {
                    $name = htmlspecialchars($data[0]);
                    $email = htmlspecialchars($data[1]);
                    $skillsString = htmlspecialchars($data[2]);

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$email</td>";
                    echo "<td>$skillsString</td>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='3'>No students found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php require 'footer.php'; ?>