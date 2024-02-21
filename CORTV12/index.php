<?php
// Load link from a file
$link = file_get_contents('link.txt');
// Redirect to the new link
header("Location: $link");
exit(); // Ensure no further code execution after redirection
?>
