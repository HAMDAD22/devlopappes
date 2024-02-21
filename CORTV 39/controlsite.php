<!DOCTYPE html>
<html>
<head>
    <title>Control Site</title>
</head>
<body>
    <h1>Control Site</h1>
    <p>Use this form to update the redirecting link:</p>
    <form method="post">
        <label for="link">New Redirecting Link: </label>
        <input type="text" id="link" name="link">
        <input type="submit" value="Update Link">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize the new link
        $new_link = isset($_POST['link']) ? htmlspecialchars($_POST['link']) : '';
        
        // Save the new link to a file
        file_put_contents('link.txt', $new_link);
        echo "<p>Link updated successfully!</p>";
    }
    ?>
</body>
</html>
