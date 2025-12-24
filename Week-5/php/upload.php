<?php 
require 'functions.php';
require 'header.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["portfolio"])) {
    $result = uploadPortfolioFile($_FILES["portfolio"]);
    
    if (strpos($result, 'Success') !== false) {
        $message = "<div class='message success'>$result</div>";
    } else {
        $message = "<div class='message error'>$result</div>";
    }
}
?>

<h2>Upload Portfolio File</h2>
<?php echo $message; ?>

<div class="message" style="background: #e9ecef; border: 1px solid #ced4da; color: #495057;">
    <strong>Requirements:</strong> Only PDF, JPG, PNG allowed. Max size 2MB.
</div>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="portfolio">Select File:</label>
    <input type="file" id="portfolio" name="portfolio" required>
    
    <button type="submit">Upload File</button>
</form>

<?php require 'footer.php'; ?>