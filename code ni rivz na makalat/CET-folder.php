<?php
$conn = new mysqli("localhost", "root", "", "document_archival");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all files from the database
$stmt = $conn->prepare("SELECT id, file_name, department, building, office, shelf FROM files");
$stmt->execute();
$stmt->bind_result($id, $file_name, $department, $building, $office, $shelf);

$files = [];
while ($stmt->fetch()) {
    // Determine the file type based on the file extension
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $icon_class = "fas fa-file"; // Default icon
    switch (strtolower($file_extension)) {
        case 'pdf':
            $icon_class = "fas fa-file-pdf icon pdf";
            break;
        case 'docx':
        case 'doc':
            $icon_class = "fas fa-file-word icon word";
            break;
        case 'xlsx':
            $icon_class = "fas fa-file-excel icon excel";
            break;
    }

    $files[] = [
        "id" => $id,
        "file_name" => $file_name,
        "department" => $department,
        "building" => $building,
        "office" => $office,
        "shelf" => $shelf,
        "icon_class" => $icon_class // Add the icon class to the file data
    ];
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CET Folder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: calc(100% - 360px);
            background: linear-gradient(135deg, #50c878, #34495e);
            padding: 15px 30px;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 300px;
            right: 50px;
            height: 60px;
            z-index: 10;
        }

        .top-nav h2 {
            font-size: 20px;
            margin: 0;
        }

        .top-nav input {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .top-nav input:focus {
            border-color: #34495e;
        }


        /* Search Container */
        .search-container {
            position: relative;
            width: 300px;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .search-bar:focus {
            border-color: #50c878;
            outline: none;
        }

        /* Search Suggestions */
        .search-suggestions {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #50c878;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 100;
            max-height: 200px;
            overflow-y: auto;
        }

        .search-suggestions div {
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* .search-suggestions div:hover {

        } */

        /* Highlight Matches */
        .highlight {
            background-color: #50c878;

            font-weight: bold;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(220deg, #50c878, #34495e);
            height: 100%;
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
            margin-bottom: 10px;
        }

        .sidebar a i {
            margin-right: 12px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            padding-top: 50px;
            margin-top: 100px;
            overflow-y: auto;
        }



        /* Close Button */
        .close-sidebar-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #333;
            /* Changed to white for better visibility */
            padding: 5px;
            border-radius: 50%;
            /* Make it circular */
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-sidebar-btn:hover {
            background: #50c878 !important;
            /* Green background on hover */
            color: white;
        }

        /* File Info Sidebar */
        .file-info-header {

            margin-top: 5px;
            display: flex;
            justify-content: space-between;
            padding: 0;
            align-items: center;
            line-height: 0;
            border-radius: 5px;
            border-bottom: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .file-info-location,
        .file-info-details {
            padding: 0;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            text-align: center;
            flex: 1;
        }

        .file-info-location:hover,
        .file-info-details:hover {
            background-color: #f0f0f0;
            color: #50c878;
        }

        .file-info-location.active,
        .file-info-details.active {
            background-color: #50c878;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Hide sections by default */
        .info-section {
            display: none;
            padding: 15px;
            padding-top: 0;
            border-radius: 0 0 8px 8px;
            background: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 0px;
            /*  line-height: 2 !important;*/

        }

        .info-section p {
            font-size: 12px;
            color: #333;
            margin: 8px 0;
            font-weight: 450;
        }

        .info-section p::before {
            font-weight: 450;
            color: #007BFF;
        }

        .info-section span {
            font-weight: 450;
            color: #555;
        }

        .info-section.active {
            display: block;

        }

        /* Access Log Styling */
        .access-log {
            margin-bottom: 15px;
            padding: 10px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .access-log h3 {
            line-height: 1;
            border-radius: 3px;
            margin-bottom: 10px;
            margin-top: 0px;
            font-size: 16px;
            color: #333;
        }

        .access-log i {
            display: block;
            font-size: 30px;
            text-align: center;
            margin: 10px auto;
            color: #333;
            padding: 50px 50px;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .access-users {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
        }

        .profile-pic {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .access-info {
            font-size: 12px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .vertical-border {
            display: inline-block;
            width: 1px;
            height: 12px;
            background: #ccc;
        }

        .current-access {
            font-size: 12.5px;
            font-weight: 600;
            color: #50c878 !important;
        }

        .user-names {
            font-size: 12px;
            font-weight: 600;
            color: #333;
        }

        #locationSection {
            display: block;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            padding: 15px 30px;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header h2 {
            font-size: 20px;
            margin: 0;
        }

        .header input {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .header input:focus {
            border-color: #3498db;
        }

        /* File Section */
        .file-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            overflow: visible !important;
        }

        /* File Options Styling */
        .file-options {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            z-index: 999;

        }


        .file-options .fa-ellipsis-v {
            font-size: 18px;
            color: #2c3e50;
            padding: 5px;
        }

        .options-menu {
            z-index: 1000;
        }

        .file-options .options-menu {
            display: none;
            position: absolute;
            top: 25px;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);



        }

        .file-options .options-menu div {
            padding: 10px 20px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            transition: background 0.3s;
        }

        .file-options .options-menu div:hover {
            background: #f0f0f0;
        }

        .file-options .options-menu.show {
            display: block;

        }

        /* File Information Sidebar */
        .file-info-sidebar {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 260px;
            height: 100%;
            background: #f9f9f9;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 0 10px;
            overflow-y: auto;
            z-index: 1000;
            flex-direction: column;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease;
        }

        /* File Name and Close Button Container */
        .file-name-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
            line-height: 1;
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;

        }

        /* File Name */
        .file-name {
            font-family: 'Montserrat', Arial, sans-serif;
            font-weight: 200;
            padding: 5px 10px;
            color: #50c878;
            margin: 0;
            /* Remove default margin */
            line-height: 1;
        }

        .file {
            width: 220px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border 0.3s ease-in-out;
            z-index: 1 !important;

        }

        .file:hover {

            background-color: #50c878;
            /* Light yellow highlight */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Soft shadow for depth */
            transition: all 0.3s ease-in-out;
        }


        .file i {
            font-size: 50px;
            color: #2c3e50;
        }

        /* Category Section */
        .category-section {
            margin-top: 30px;
        }

        .category-header {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .category {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .category-item {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .category-item:hover {
            transform: scale(1.05);
            cursor: pointer;
        }

        .category-item i {
            font-size: 30px;
            color: #2c3e50;
        }

        .recent-files {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
            text-align: center;
        }

        .files-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .file p {
            margin-top: 10px;
            font-size: 14px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        #newFileName {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .close-modal {
            float: right;
            cursor: pointer;
            font-size: 24px;
        }

        .modal-content input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            padding: 10px 20px;
            background-color: #50c878;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #40a867;
        }


        /* Alert Modal Styles */
        #alertModal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .alert-modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        .alert-modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .alert-modal-body {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .alert-modal-footer button {
            padding: 10px 20px;
            background-color: #50c878;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 2s;
        }

        .alert-modal-footer button:hover {
            background-color: #40a867;
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <h2>My Documents</h2>
        <div class="search-container">
            <input type="text" placeholder="Search documents..." class="search-bar">
            <div class="search-suggestions"></div> <!-- Container for search suggestions -->
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Doc Archival</h2>
        <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myDocument.php" class="active"><i class="fas fa-folder"></i> My Documents</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <!-- Rename Modal -->
    <div id="renameModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeRenameModal()">&times;</span>
            <h2>Rename File</h2>
            <input type="text" id="newFileName" placeholder="Enter new file name">
            <button onclick="confirmRename()">Rename</button>
        </div>
    </div>

    <!-- Alert Modal -->
    <div id="alertModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeAlert()">&times;</span>
            <p id="alertMessage"></p>
            <button onclick="closeAlert()">OK</button>
        </div>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- Document Types Section -->
        <div class="category-header">Document Types</div>
        <div class="category">
            <div class="category-item">
                <i class="fas fa-file-pdf"></i>
                <p>Reports</p>
            </div>
            <div class="category-item">
                <i class="fas fa-file-word"></i>
                <p>Proposals</p>
            </div>
            <div class="category-item">
                <i class="fas fa-file-excel"></i>
                <p>Data</p>
            </div>
        </div>

        <!-- Stored Files Section -->
        <h3>Stored Files</h3>
        <div class="file-section">
            <?php foreach ($files as $file): ?>
                <div class="file" data-file-id="<?= $file['id'] ?>">
                    <i class="<?= $file['icon_class'] ?>"></i> <!-- Use the icon class here -->
                    <p><?= htmlspecialchars($file['file_name']) ?></p>
                    <div class="file-options">
                        <i class="fas fa-ellipsis-v" onclick="toggleOptions(this)"></i>
                        <div class="options-menu">
                            <div onclick="handleOption('Download', <?= $file['id'] ?>)">Download</div>
                            <div onclick="handleOption('Rename', <?= $file['id'] ?>)">Rename</div>
                            <div onclick="handleOption('Make Copy', <?= $file['id'] ?>)">Make Copy</div>
                            <div onclick="handleOption('Delete', <?= $file['id'] ?>)">Delete</div>
                            <div onclick="handleOption('File Information', <?= $file['id'] ?>)">File Information</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </div>
    </div>

    <!-- File Information Sidebar -->
    <div class="file-info-sidebar">
        <!-- File Name and Close Button Container -->
        <div class="file-name-container">
            <div class="file-name">File Name</div>
            <button class="close-sidebar-btn" onclick="closeSidebar()">&times;</button>
        </div>
        <div class="file-info-header">
            <div class="file-info-location active" onclick="showSection('locationSection')">
                <h4>Location</h4>
            </div>
            <div class="file-info-details" onclick="showSection('detailsSection')">
                <h4>Details</h4>
            </div>
        </div>

        <div class="info-section active" id="locationSection" style="line-height: 2;">
            <p><strong>Department:</strong> <span id="departmentCollege"><?= $metadata['department'] ?></span></p>
            <p><strong>Building:</strong> <span id="building"><?= $metadata['building'] ?></span></p>
            <p><strong>Room:</strong> <span id="room"><?= $metadata['office'] ?></span></p>
            <p><strong>Shelf:</strong> <span id="shelf"><?= $metadata['shelf'] ?></span></p>
        </div>


        <div class="info-section" id="detailsSection">
            <div class="access-log">
                <h3>Who Has Access</h3>
                <i class="fas fa-file"></i>
                <div class="access-users">
                    <img src="profile1.jpg" alt="User 1" class="profile-pic">
                    <img src="profile2.jpg" alt="User 2" class="profile-pic">
                    <img src="profile3.jpg" alt="User 3" class="profile-pic">
                </div>
                <p class="access-info">
                    <span class="current-access">Owned by you</span>
                    <span class="vertical-border"></span>
                    <span class="user-names">John, Alice, Mark</span>
                </p>
            </div>
            <h3>File Details</h3>
            <p>Uploader: <span id="uploader">Loading...</span></p>
            <p>File Type: <span id="fileType">Loading...</span></p>
            <p>File Size: <span id="fileSize">Loading...</span></p>
            <p>File Category: <span id="fileCategory">Loading...</span></p>
            <p>Date of Upload: <span id="dateUpload">Loading...</span></p>
            <p>Pages: <span id="pages">Loading...</span></p>
        </div>
    </div>


    <!-- Scripts -->
    <script>
        document.querySelectorAll('.file').forEach(fileElement => {
            fileElement.addEventListener('click', function(event) {
                // Prevent action if clicking on the options menu or its children
                if (event.target.closest('.file-options')) {
                    return;
                }

                // Get file ID from data attribute
                const fileId = this.getAttribute('data-file-id');
                if (fileId) {
                    // Open the file in a new tab
                    window.open(`view.php?fileId=${fileId}`, '_blank');
                }
            });
        });



        // Search functionality
        const searchInput = document.querySelector('.search-bar');
        const searchSuggestions = document.querySelector('.search-suggestions');
        const fileElements = document.querySelectorAll('.file'); // Get all file elements

        // Function to highlight matching text
        function highlightText(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        }

        // Function to update search suggestions
        function updateSuggestions(query) {
            const suggestions = [];
            fileElements.forEach(fileElement => {
                const fileName = fileElement.querySelector('p').textContent.toLowerCase();
                if (fileName.includes(query)) {
                    suggestions.push(fileName);
                }
            });

            // Display suggestions
            if (suggestions.length > 0 && query) {
                searchSuggestions.innerHTML = suggestions
                    .map(suggestion => `<div>${highlightText(suggestion, query)}</div>`)
                    .join('');
                searchSuggestions.style.display = 'block';
            } else {
                searchSuggestions.style.display = 'none';
            }
        }

        // Function to filter files based on search query
        function filterFiles(query) {
            fileElements.forEach(fileElement => {
                const fileName = fileElement.querySelector('p').textContent.toLowerCase();
                if (fileName.includes(query)) {
                    fileElement.style.display = 'flex'; // Show the file
                    fileElement.querySelector('p').innerHTML = highlightText(fileName, query); // Highlight matches
                } else {
                    fileElement.style.display = 'none'; // Hide the file
                }
            });
        }

        // Event listener for search input
        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            updateSuggestions(query); // Update suggestions
            filterFiles(query); // Filter files
        });

        // Event listener for clicking on a suggestion
        searchSuggestions.addEventListener('click', function(event) {
            if (event.target.tagName === 'DIV') {
                const selectedSuggestion = event.target.textContent;
                searchInput.value = selectedSuggestion; // Set the search bar value
                filterFiles(selectedSuggestion); // Filter files
                searchSuggestions.style.display = 'none'; // Hide suggestions
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.matches('.search-bar')) {
                searchSuggestions.style.display = 'none';
            }
        });

        // JavaScript code for handling file information and options
        function toggleOptions(element) {
            // Close all other options menus
            document.querySelectorAll('.options-menu').forEach(menu => {
                if (menu !== element.nextElementSibling) {
                    menu.classList.remove('show');
                }
            });

            // Toggle the clicked options menu
            element.nextElementSibling.classList.toggle('show');
        }

        // Close the menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.file-options')) {
                document.querySelectorAll('.options-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });




        let isActionInProgress = false; // Flag to track action progress

        function handleOption(option, fileId) {
            if (isActionInProgress) {
                showAlert("An action is already in progress. Please wait.");
                return;
            }

            isActionInProgress = true; // Set the flag to true

            if (option === 'File Information') {
                showFileInfo(fileId);
                isActionInProgress = false; // Reset the flag
            } else if (option === 'Download') {
                downloadFile(fileId);
                isActionInProgress = false; // Reset the flag
            } else if (option === 'Rename') {
                renameFile(fileId);
            } else if (option === 'Make Copy') {
                makeCopy(fileId);
            } else if (option === 'Delete') {
                deleteFile(fileId);
            }
        }

        function showFileInfo(fileId) {
            const file = {
                departmentCollege: "<?= $file['department'] ?>",
                building: "<?= $file['building'] ?>",
                room: "<?= $file['office'] ?>",
                shelf: "<?= $file['shelf'] ?>",
                uploader: "John Doe",
                fileType: "PDF",
                fileSize: "2.5 MB",
                fileCategory: "Report",
                dateUpload: "2023-10-01",
                pages: "15"
            };

            document.getElementById('departmentCollege').textContent = file.departmentCollege;
            document.getElementById('building').textContent = file.building;
            document.getElementById('room').textContent = file.room;
            document.getElementById('shelf').textContent = file.shelf;
            document.getElementById('uploader').textContent = file.uploader;
            document.getElementById('fileType').textContent = file.fileType;
            document.getElementById('fileSize').textContent = file.fileSize;
            document.getElementById('fileCategory').textContent = file.fileCategory;
            document.getElementById('dateUpload').textContent = file.dateUpload;
            document.getElementById('pages').textContent = file.pages;
            document.querySelector('.file-info-sidebar').style.display = 'flex';
        }

        function closeSidebar() {
            document.querySelector('.file-info-sidebar').style.display = 'none';
        }

        function showSection(sectionId) {
            document.querySelectorAll('.info-section').forEach(section => {
                section.style.display = section.id === sectionId ? 'block' : 'none';
            });

            document.querySelectorAll('.file-info-header div').forEach(div => {
                div.classList.remove('active');
            });

            document.querySelector(`.file-info-header div[onclick="showSection('${sectionId}')"]`).classList.add('active');
        }

        function showAlert(message) {
            document.getElementById('alertMessage').textContent = message;
            document.getElementById('alertModal').style.display = 'flex';
        }

        function closeAlert() {
            const alertModal = document.getElementById('alertModal');
            if (alertModal.getAttribute('data-reload') === 'true') {
                location.reload();
            }
            alertModal.style.display = 'none';
            isActionInProgress = false; // Reset the flag
        }

        let currentFileId = null;
        let currentFileName = null;

        function renameFile(fileId) {
            currentFileId = fileId;
            const fileElement = document.querySelector(`.file[data-file-id="${fileId}"]`);
            if (fileElement) {
                currentFileName = fileElement.querySelector('p').textContent;
                const fileNameWithoutExtension = currentFileName.replace(/\.[^/.]+$/, "");
                document.getElementById('newFileName').value = fileNameWithoutExtension;
                document.getElementById('renameModal').style.display = 'flex';
            }
        }

        function closeRenameModal() {
            document.getElementById('renameModal').style.display = 'none';
            isActionInProgress = false; // Reset the flag
        }

        function confirmRename() {
            const newName = document.getElementById('newFileName').value.trim();
            if (newName) {
                const fileExtension = currentFileName.split('.').pop();
                const newFileNameWithExtension = `${newName}.${fileExtension}`;

                fetch(`rename.php?fileId=${currentFileId}&newName=${newFileNameWithExtension}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert("File renamed successfully!");
                            document.getElementById('alertModal').setAttribute('data-reload', 'true');
                        } else {
                            showAlert("Failed to rename the file.");
                        }
                        closeRenameModal();
                    })
                    .catch(error => {
                        console.error("Rename error:", error);
                        showAlert("An error occurred while renaming the file.");
                        closeRenameModal();
                    });
            } else {
                showAlert("Please enter a valid file name.");
            }
        }
        //copy
        function makeCopy(fileId) {
            fetch(`copy.php?fileId=${fileId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert("File copied successfully!");
                        document.getElementById('alertModal').setAttribute('data-reload', 'true');
                    } else {
                        showAlert("Failed to copy the file.");
                    }
                    isActionInProgress = false; // Reset the flag
                });
        }

        function deleteFile(fileId) {
            fetch(`delete.php?fileId=${fileId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const fileElement = document.querySelector(`.file[data-file-id="${fileId}"]`);
                        if (fileElement) {
                            fileElement.remove();
                        }
                        showAlert("File moved to recently deleted!");
                    } else {
                        showAlert("Failed to delete the file.");
                    }
                    isActionInProgress = false; // Reset the flag
                })
                .catch(error => {
                    console.error("Delete error:", error);
                    showAlert("An error occurred while deleting the file.");
                    isActionInProgress = false; // Reset the flag
                });
        }

        function downloadFile(fileId) {
            window.location.href = `download.php?fileId=${fileId}`;
            isActionInProgress = false; // Reset the flag
        }
    </script>
</body>

</html>