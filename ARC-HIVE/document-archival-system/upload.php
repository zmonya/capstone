<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Documents</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="">
</head>

<body>
    <div class="sidebar">
        <h2>Doc Archival</h2>
        <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myDocument.php"><i class="fas fa-folder"></i> My Documents</a>
        <a href="upload.php" class="active"><i class="fas fa-upload"></i> Upload</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Upload Documents</h2>
        </div>

        <div class="upload-section">
            <h3>Select a file to upload</h3>
            <form action="upload_handler.php" method="post" enctype="multipart/form-data">
                <input type="file" name="document" required>
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
</body>

</html>