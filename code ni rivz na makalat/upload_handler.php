<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadDir = "uploads/";
    $file = $_FILES["document"];
    $department = $_POST["department"];
    $building = $_POST["building"];
    $office = $_POST["office"];
    $shelf = $_POST["shelf"];

    $departmentFolders = [
        "College of Engineering and Technology" => "CET-folder.php",
        "College of Agriculture and Forestry" => "CAF-folder.php",
        "College of Arts and Sciences" => "CAS-folder.php",
    ];

    $targetFolder = isset($departmentFolders[$department]) ? $departmentFolders[$department] : "others-folder.php";

    $filePath = $uploadDir . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $filePath)) {
        // Store file metadata in the database
        $conn = new mysqli("localhost", "root", "", "document_archival");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO files (file_name, department, building, office, shelf) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $file["name"], $department, $building, $office, $shelf);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "redirect" => $targetFolder]);
        } else {
            echo json_encode(["success" => false, "message" => "Database error."]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["success" => false, "message" => "Upload failed."]);
    }
}
