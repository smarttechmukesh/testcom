<?php
if (isset($_GET['css'])) {
    $compressed_css = urldecode($_GET['css']);

    // Set headers for file download
    header('Content-Type: text/css');
    header('Content-Disposition: attachment; filename="compressed.css"');

    // Output compressed CSS
    echo $compressed_css;
} else {
    header('Location: index.html');
    exit;
}
?>
