<?php 
require 'functions.php';
require 'header.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rawName = $_POST['name'];
    $rawEmail = $_POST['email'];
    $rawSkills = $_POST['skills'];

    $name = formatName($rawName);
    $email = validateEmail($rawEmail);
    
    $skillsArray = cleanSkills($rawSkills);

    if (!$name || !$email || empty($skillsArray[0])) {
        $message = "<div class='message error'>Please provide a valid name, email, and at least one skill.</div>";
    } else {
        $result = saveStudent($name, $email, $skillsArray);
        
        if ($result === true) {
            $message = "<div class='message success'>Student <strong>$name</strong> added successfully!</div>";
        } else {
            $message = "<div class='message error'>$result</div>";
        }
    }
}
?>

<h2>Add Student Information</h2>
<?php echo $message; ?>

<form action="add_student.php" method="POST">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" placeholder="e.g. John Doe" required>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" placeholder="e.g. john@example.com" required>

    <label for="skills">Skills (comma-separated):</label>
    <textarea id="skills" name="skills" rows="3" placeholder="e.g. PHP, HTML, CSS, SQL" required></textarea>

    <button type="submit">Save Student</button>
</form>

<?php require 'footer.php'; ?>