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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            height: 100vh;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
            border-radius: 8px;
        }

        .sidebar a i {
            margin-right: 12px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .upload-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            margin: 30px auto;
        }

        .upload-section input[type="file"] {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
        }

        .upload-section button {
            background: #2c3e50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .upload-section button:hover {
            background: #1a252f;
        }
    </style>
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