<?php
// Include CssMin library
require_once 'cssmin.php';

// Validate form input
if (!empty($_POST['css_code'])) {
    $css_code = $_POST['css_code'];

    // CSS validation using regular expressions
    $pattern = '/^(?!\/\*)(?:[^\/\{]++|\/\/.)*?(?:\{(?:[^}]++|\/\*.*?\*\/)++\})*$/s';
    if (preg_match($pattern, $css_code)) {
        // Compress CSS
        $compressed_css = CssMin::minify($css_code);

        // Output compressed CSS
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compressed CSS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Compressed CSS</h1>
    <textarea rows="10" cols="50" readonly>' . htmlspecialchars($compressed_css) . '</textarea>
    <p><a href="download.php?css=' . urlencode($compressed_css) . '">Download Compressed CSS</a></p>
    <p><a href="index.html">Back</a></p>
</body>
</html>';
    } else {
        header('Location: index.html?error=Invalid CSS code.');
        exit;
    }
} else {
    header('Location: index.html?error=Please enter CSS code.');
    exit;
}
?>
