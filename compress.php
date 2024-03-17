<?php
// Validate form input
if (!empty($_POST['css_code'])) {
    $css_code = $_POST['css_code'];

    // CSS validation using regular expressions
    $pattern = '/^(?!\/\*)(?:[^\/\{]++|\/\/.)*?(?:\{(?:[^}]++|\/\*.*?\*\/)++\})*$/s';
    if (preg_match($pattern, $css_code)) {
        // Compress CSS
        $compressed_css = compressCss($css_code);

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

function compressCss($css) {
    // Remove comments
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

    // Remove whitespace
    $css = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '     '], '', $css);

    // Remove extra spaces
    $css = preg_replace('/\s+/', ' ', $css);

    // Remove last semicolon from the last property
    $css = str_replace(';}', '}', $css);

    return trim($css);
}
?>
