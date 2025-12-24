<?php
function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(',', $string); 
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    try {
        $skillsString = implode(", ", $skillsArray);
        $record = "$name|$email|$skillsString" . PHP_EOL;

        if(file_put_contents('students.txt', $record, FILE_APPEND | LOCK_EX) === false) {
             throw new Exception("Error writing to storage file.");
        }
        return true;
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

function uploadPortfolioFile($file) {
    try {
        $targetDir = "../uploads/";
        $fileName = basename($file["name"]);
        $fileSize = $file["size"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if ($fileSize > 2000000) {
            throw new Exception("File is too large. Max 2MB allowed.");
        }

        $allowedTypes = ['jpg', 'png', 'pdf'];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type. Only JPG, PNG, and PDF allowed.");
        }

        $newFileName = time() . "_" . str_replace(" ", "_", $fileName);
        $targetFilePath = $targetDir . $newFileName;

        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return "Success: File uploaded as $newFileName";
        } else {
            throw new Exception("There was an error moving the uploaded file.");
        }

    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}
?>