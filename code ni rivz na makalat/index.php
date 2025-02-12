<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            border-color: #3498db;
        }

        /* Activity Log Icon */
        .activity-log-icon {
            font-size: 24px;
            cursor: pointer;
            margin-left: 20px;
            color: white;
            position: relative;
        }

        .activity-log-icon:hover {
            color: #50c878;
        }

        /* Activity Log Dropdown */
        .activity-log {
            width: 350px;
            height: 200px;
            /* Fixed width */
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 70px;
            /* Adjust based on your top-nav height */
            right: 20px;
            z-index: 1000;
            display: none;
            /* Hidden by default */
            max-height: 500px;
            /* Maximum height for scrollability */
            overflow-y: auto;
            /* Enable vertical scrolling */
            border: 1px solid #ddd;



        }

        .activity-log h3 {
            font-size: 16px;
            margin: 0;
            padding: 12px;
            background: #f5f6f7;
            border-bottom: 1px solid #ddd;
            color: #333;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .activity-log .log-entries {
            padding: 8px;
        }

        .activity-log .log-entry {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            background: #fff;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .activity-log .log-entry:hover {
            background: #f0f2f5;
        }

        .activity-log .log-entry i {
            font-size: 16px;
            margin-right: 10px;

        }

        .activity-log .log-entry p {
            margin: 0;
            flex: 1;
            font-size: 14px;
            color: #333;
        }

        .activity-log .log-entry span {
            font-size: 12px;
            color: #606770;
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
            padding-top: 100px;
            /* Adjusted for top-nav */
            margin-left: 10px;
            margin-right: 10px;
            /* Adjusted for sidebar */
            overflow-y: auto;
        }

        /* File Section */
        .file-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
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
        }

        .file:hover {
            transform: scale(1.05);
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
            flex-wrap: wrap;
            /* Allow items to wrap into multiple rows */
            gap: 20px;
            margin-bottom: 30px;
        }

        .category-item {
            flex: 1 1 calc(25% - 20px);
            /* Adjust width for 4 items per row */
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

        /* User ID and Calendar Container */
        .user-id-calendar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* User ID GUI */
        .user-id {
            display: flex;
            align-items: center;
        }

        .user-picture {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .user-position,
        .user-department {
            font-size: 14px;
            margin: 2px 0;
            color: #555;
        }

        /* Digital Calendar and Clock */
        .digital-calendar-clock {
            text-align: right;
        }

        #currentDate,
        #currentTime {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        #currentDate {
            font-weight: bold;
        }


        /* Upload and Activity Log Container */
        .upload-activity-container {
            display: flex;
            gap: 50px;
            margin-bottom: 30px;
            justify-content: center;
        }

        /* Upload Section */
        .upload-file {
            background: white;
            padding: 20px;
            /* Reduced padding */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            max-width: 450px;
            height: 190px;
            /* Reduced height */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .upload-file input[type="file"] {
            margin: 10px 0;
            /* Reduced margin */
            padding: 10px;
            /* Reduced padding */
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
        }

        .upload-file button {
            background: #2c3e50;
            color: white;
            padding: 10px 15px;
            /* Reduced padding */
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            /* Reduced font size */
            transition: background 0.3s;
            width: 100%;
            max-width: 150px;
            /* Reduced max-width */
            margin-top: 10px;
            /* Reduced margin */
        }

        .upload-file button:hover {
            background: #1a252f;
        }

        /* notification Log Section */
        .notification-log {
            width: 450px;
            background: white;
            padding: 15px;
            /* Reduced padding */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: 200px;
            /* Reduced height */
            display: flex;
            flex-direction: column;
        }

        .notification-log h3 {
            font-size: 16px;
            /* Reduced font size */
            margin-bottom: 10px;
            margin-top: 5px;
            /* Reduced margin */
            color: #2c3e50;
        }

        /* Specific icon colors */
        .log-entry .fa-file-upload {
            color: #50c878;
            /* Green for upload */
        }

        .log-entry .fa-file-download {
            color: #3498db;
            /* Blue for download */
        }

        .log-entry .fa-trash {
            color: #e74c3c;
            /* Red for delete */
        }

        .log-entry .fa-hand-paper {
            color: #87ceeb;
            /* Sky Blue for requested */
        }

        .log-entry .fa-thumbs-up {
            color: rgb(0, 183, 255);
            /* Sky Blue for requested */
        }

        .log-entry .fa-check-circle {
            color: #ffd700;
            /* Yellow for approved */
        }

        .log-entry .fa-times-circle {
            color: #ffa500;
            /* Orange for denied */
        }



        .log-entries {
            flex: 1;
            overflow-y: auto;
            /* Enable vertical scrolling */
            padding-right: 10px;
            /* Add padding to prevent scrollbar overlap */
        }

        .log-entry {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            /* Reduced margin */
            padding: 8px;
            /* Reduced padding */
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .log-entry i {
            font-size: 16px;
            /* Reduced font size */
            margin-right: 8px;
            /* Reduced margin */
        }

        .log-entry p {
            margin: 0;
            flex: 1;
            font-size: 14px;
            /* Reduced font size */
            color: #333;
        }

        .log-entry span {
            font-size: 14px;
            /* Reduced font size */
            color: #777;
        }

        /* Popups */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        .exit-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #333;
            padding: 5px;
        }

        .exit-button:hover {
            color: #cc0000;
        }

        .popup h3 {
            margin-bottom: 20px;
        }

        .popup button {
            background: #2c3e50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin: 5px;
            font-size: 14px;
            transition: background 0.3s;
        }

        .popup button:hover {
            background: #1a252f;
        }

        .popup-questionnaire {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #f0f2f5;
            width: 450px;
            padding: 20px;
            border: 1px solid #34495e;
            border-radius: 6px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            font-family: Arial, sans-serif;
            text-align: center;
            display: none;
            z-index: 1000;
        }

        .popup-questionnaire h3 {
            color: #34495e;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .popup-button {
            background: #34495e;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #34495e;
            cursor: pointer;
        }

        .popup-button:hover {
            background: #50c878;
        }

        .popup-questionnaire form {
            text-align: left;
        }

        .popup-questionnaire label {
            display: block;
            font-weight: bold;
            color: #34495e;
            margin-top: 10px;
        }

        .popup-questionnaire input {
            width: 100%;
            padding: 5px;
            border: 1px solid #34495e;
            border-radius: 4px;
            font-size: 14px;
        }

        .submit-button {
            background: #34495e;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #34495e;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }

        .submit-button:hover {
            background: #50c878;
        }

        .popup-error {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ffebeb;
            width: 400px;
            padding: 15px;
            border: 1px solid #cc0000;
            border-radius: 6px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            text-align: left;
            font-family: Arial, sans-serif;
            display: none;
            z-index: 1000;
        }

        .popup-error h3 {
            color: #cc0000;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .popup-error p {
            color: #333;
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        .popup-error .popup-button {
            display: inline-block;
            background: linear-gradient(to bottom, #dd4b39, #b22222);
            color: #fff;
            font-size: 13px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #8b0000;
            cursor: pointer;
            margin-top: 10px;
            text-align: center;
        }

        .popup-error .popup-button:hover {
            background: linear-gradient(to bottom, #b22222, #8b0000);
        }

        .category-link {
            text-decoration: none;
            /* Removes underline */
            color: inherit;
            /* Makes it take the parent’s text color */
            cursor: pointer;
            /* Ensures it looks clickable */
        }

        .category-link:hover {
            text-decoration: none;
            /* Ensures no underline on hover */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Document Archival</h2>
        <a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myDocument.php"><i class="fas fa-folder"></i> My Documents</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <!-- Top Navigation -->
    <div class="top-nav">
        <h2>Dashboard</h2>
        <input type="text" placeholder="Search documents...">
        <i class="fas fa-history activity-log-icon" onclick="toggleActivityLog()"></i>
    </div>

    <!-- Activity Log Dropdown -->
    <div class="activity-log" id="activityLog">
        <h3>Activity Log</h3>
        <div class="log-entries">
            <div class="log-entry">
                <i class="fas fa-hand-paper"></i> <!-- Icon for Requested -->
                <p>Requested "Budget.xlsx"</p>
                <span>08:45 AM</span>
            </div>
            <div class="log-entry">
                <i class="fas fa-file-upload"></i>
                <p>Uploaded "Report.pdf"</p>
                <span>10:00 AM</span>
            </div>
            <div class="log-entry">
                <i class="fas fa-file-download"></i>
                <p>Downloaded "Proposal.docx"</p>
                <span>09:30 AM</span>
            </div>
            <div class="log-entry">
                <i class="fas fa-trash"></i>
                <p>Deleted "Data.xlsx"</p>
                <span>09:00 AM</span>
            </div>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- User ID and Calendar Section -->
        <div class="user-id-calendar-container">
            <!-- User ID GUI -->
            <div class="user-id">
                <img src="user.jpg" alt="User Picture" class="user-picture">
                <div class="user-info">
                    <p class="user-name">Ivan Harvey Rivera</p>
                    <p class="user-position">Software Engineer</p>
                    <p class="user-department">IT Department</p>
                </div>
            </div>

            <!-- Digital Calendar and Clock -->
            <div class="digital-calendar-clock">
                <p id="currentDate"></p>
                <p id="currentTime"></p>
            </div>
        </div>

        <!-- Upload and notification Log Container -->
        <div class="upload-activity-container">
            <!-- Upload Section -->
            <div class="upload-file" id="upload">
                <h3>Upload a Document</h3>
                <form id="uploadForm" action="upload_handler.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="document" id="document" required>
                    <input type="hidden" name="fileType" id="fileType">
                    <input type="hidden" id="redirectPage" name="redirectPage">
                    <button type="button" id="uploadButton">Upload</button>
                </form>
            </div>

            <!-- notification Log Section -->
            <div class="notification-log">
                <h3>Notification</h3>
                <div class="log-entries">


                    <!-- New Entries -->
                    <div class="log-entry">
                        <i class="fas fa-check-circle"></i> <!-- Icon for Approved -->
                        <p>Approved "Project Plan.docx"</p>
                        <span>08:30 AM</span>
                    </div>
                    <div class="log-entry">
                        <i class="fas fa-times-circle"></i> <!-- Icon for Denied -->
                        <p>Denied "Expense Report.pdf"</p>
                        <span>08:15 AM</span>
                    </div>
                    <div class="log-entry">
                        <i class="fas fa-thumbs-up"></i> <!-- Icon for Approved Request -->
                        <p>Request Approved "Audit Report.pdf"</p>
                        <span>07:15 AM</span>
                    </div>


                </div>
            </div>
        </div>

        <!-- Error Popup -->
        <div class="popup-error" id="fileErrorPopup" style="display: none;">
            <button class="exit-button" onclick="closePopup('fileErrorPopup')">X</button>
            <h3>Select A File First</h3>
        </div>

        <!-- Document Categories Section -->
        <div class="category-section">
            <div class="category-header">College and Offices</div>
            <div class="category">
                <div class="category-item">
                    <i class="fas fa-seedling"></i>
                    <p>College of Agriculture and Forestry</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-palette"></i>
                    <p>College of Arts and Sciences</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-briefcase"></i>
                    <p>College of Business and Management</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-graduation-cap"></i>
                    <p>College of Education</p>
                </div>

                <div class="category-item">
                    <a href="CET-folder.php" class="category-link">
                        <i class="fas fa-cogs"></i>
                        <p>College of Engineering and Technology</p>
                    </a>
                </div>

                <div class="category-item">
                    <i class="fas fa-paw"></i>
                    <p>College of Veterinary Medicine</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Admission and Registration Services</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <p>Audit Offices</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-globe"></i>
                    <p>External Linkages and International Affairs</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-server"></i>
                    <p>Management Information Systems</p>
                </div>
                <div class="category-item">
                    <i class="fas fa-user-tie"></i>
                    <p>Office of the President</p>
                </div>
            </div>
        </div>

        <!-- Document Types Section -->
        <div class="category-header">Document Types</div>
        <div class="category">
            <div class="category-item">
                <i class="fas fa-file-pdf"></i>
                <p>PDF</p>
            </div>
            <div class="category-item">
                <i class="fas fa-file-word"></i>
                <p>DOCUMENT</p>
            </div>
            <div class="category-item">
                <i class="fas fa-file-excel"></i>
                <p>EXCEL</p>
            </div>
        </div>

        <!-- Recent Files Section -->
        <h3>Recent Files</h3>
        <div class="file-section">
            <div class="file">
                <i class="fas fa-file-pdf"></i>
                <p>Report.pdf</p>
            </div>
            <div class="file">
                <i class="fas fa-file-word"></i>
                <p>Proposal.docx</p>
            </div>
            <div class="file">
                <i class="fas fa-file-excel"></i>
                <p>Data.xlsx</p>
            </div>
        </div>
    </div>

    <!-- Physical Copy Popup -->
    <div class="popup-questionnaire" id="physicalCopyPopup">
        <button class="exit-button" onclick="closePopup('physicalCopyPopup')">X</button>
        <h3>Does a Physical Copy Exist?</h3>
        <div class="button-group">
            <button id="yesPhysical" class="popup-button">Yes</button>
            <button id="noPhysical" class="popup-button">No</button>
        </div>
    </div>

    <!-- Physical Details Popup -->
    <div class="popup-questionnaire" id="physicalDetailsPopup" style="display: none;">
        <button class="exit-button" onclick="closePopup('physicalDetailsPopup')">X</button>
        <h3>Provide Physical Copy Details</h3>
        <form id="physicalDetailsForm">
            <!-- Department Dropdown -->
            <label for="department">Department/College:</label>
            <select id="department" name="department" required onchange="updateBuildingOptions()">
                <option value="">Select Department</option>
                <option value="College of Agriculture and Forestry">College of Agriculture and Forestry</option>
                <option value="College of Arts and Sciences">College of Arts and Sciences</option>
                <option value="College of Business and Management">College of Business and Management</option>
                <option value="College of Education">College of Education</option>
                <option value="College of Engineering and Technology">College of Engineering and Technology</option>
                <option value="College of Veterinary Medicine">College of Veterinary Medicine</option>
                <option value="Admission and Registration Services">Admission and Registration Services</option>
                <option value="Audit Offices">Audit Offices</option>
                <option value="External Linkages and International Affairs">External Linkages and International Affairs</option>
                <option value="Management Information Systems">Management Information Systems</option>
                <option value="Office of the President">Office of the President</option>
            </select>

            <!-- Building Dropdown -->
            <label for="building">Building:</label>
            <select id="building" name="building" required onchange="updateOfficeOptions()">
                <option value="">Select Building</option>
            </select>

            <!-- Office Dropdown -->
            <label for="office">Office:</label>
            <select id="office" name="office" required onchange="updateShelfOptions()">
                <option value="">Select Office</option>
            </select>

            <!-- Shelf Dropdown -->
            <label for="shelf">Shelf:</label>
            <select id="shelf" name="shelf" required>
                <option value="">Select Shelf</option>
            </select>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        function toggleActivityLog() {
            const activityLog = document.getElementById("activityLog");
            if (activityLog.style.display === "none" || activityLog.style.display === "") {
                activityLog.style.display = "block";
            } else {
                activityLog.style.display = "none";
            }
        }

        // Close the dropdown when clicking outside of it
        document.addEventListener("click", function(event) {
            const activityLog = document.getElementById("activityLog");
            const activityLogIcon = document.querySelector(".activity-log-icon");

            if (!activityLog.contains(event.target) && !activityLogIcon.contains(event.target)) {
                activityLog.style.display = "none";
            }
        });

        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const currentDate = now.toLocaleDateString('en-US', options);
            const currentTime = now.toLocaleTimeString('en-US');

            document.getElementById('currentDate').textContent = currentDate;
            document.getElementById('currentTime').textContent = currentTime;
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);

        // Initial call to display the date and time immediately
        updateDateTime();


        document.addEventListener("DOMContentLoaded", function() {
            const uploadButton = document.getElementById("uploadButton");
            const physicalCopyPopup = document.getElementById("physicalCopyPopup");
            const fileErrorPopup = document.getElementById("fileErrorPopup");
            const yesPhysical = document.getElementById("yesPhysical");
            const noPhysical = document.getElementById("noPhysical");
            const exitButtons = document.querySelectorAll(".exit-button");

            // Show the first popup when "Upload" button is clicked
            uploadButton.addEventListener("click", function() {
                const fileInput = document.getElementById("document");

                if (fileInput.files.length === 0) {
                    fileErrorPopup.style.display = "block"; // Show error popup
                } else {
                    physicalCopyPopup.style.display = "block"; // Proceed to physical copy popup
                }
            });

            // Show the details popup when "Yes" is clicked
            yesPhysical.addEventListener("click", function() {
                physicalCopyPopup.style.display = "none";
                document.getElementById("physicalDetailsPopup").style.display = "block";
            });

            //  "No" is clicked
            document.getElementById("noPhysical").addEventListener("click", function() {
                let fileInput = document.getElementById("document");
                let file = fileInput.files[0];

                if (!file) {
                    alert("No file selected.");
                    return;
                }

                let fileName = file.name;
                let fileExtension = fileName.split('.').pop().toLowerCase();
                let storagePage = "";

                switch (fileExtension) {
                    case "doc":
                    case "docx":
                        storagePage = "word.php";
                        break;
                    case "pdf":
                        storagePage = "pdf.php";
                        break;
                    case "xls":
                    case "xlsx":
                        storagePage = "xlsx.php";
                        break;
                    default:
                        alert("Unsupported file type.");
                        return;
                }

                document.getElementById("hasPhysicalCopy").value = "no";
                document.getElementById("storagePage").value = storagePage; // Hidden field to store destination
                document.getElementById("uploadForm").submit();
            });



            // Close any popup when the exit button is clicked
            exitButtons.forEach(button => {
                button.addEventListener("click", function() {
                    this.parentElement.style.display = "none";
                });
            });

            // Ensure file selection enables upload button
            document.getElementById("document").addEventListener("change", function() {
                uploadButton.style.display = "inline-block";
            });
        });

        function closePopup(id) {
            document.getElementById(id).style.display = "none";
        }



        // Data for buildings, offices, and shelves for each department
        const departmentData = {
            "College of Agriculture and Forestry": {
                buildings: ["Agriculture Building", "Forestry Hall", "Greenhouse Complex"],
                offices: ["Dean's Office", "Research Office", "Student Affairs"],
                shelves: ["Shelf A1", "Shelf B2", "Shelf C3"]
            },
            "College of Arts and Sciences": {
                buildings: ["Humanities Building", "Science Tower", "Social Sciences Hall"],
                offices: ["Dean's Office", "Faculty Office", "Library Services"],
                shelves: ["Shelf D4", "Shelf E5", "Shelf F6"]
            },
            "College of Business and Management": {
                buildings: ["Business Center", "Management Hall", "Finance Tower"],
                offices: ["Dean's Office", "Admissions Office", "Career Services"],
                shelves: ["Shelf G7", "Shelf H8", "Shelf I9"]
            },
            "College of Education": {
                buildings: ["Education Building", "Training Center", "Curriculum Hall"],
                offices: ["Dean's Office", "Student Services", "Research Office"],
                shelves: ["Shelf J10", "Shelf K11", "Shelf L12"]
            },
            "College of Engineering and Technology": {
                buildings: ["Engineering Building", "Tech Innovation Center", "Robotics Lab"],
                offices: ["Dean's Office", "Research Office", "Student Affairs"],
                shelves: ["Shelf M13", "Shelf N14", "Shelf O15"]
            },
            "College of Veterinary Medicine": {
                buildings: ["Veterinary Building", "Animal Hospital", "Research Center"],
                offices: ["Dean's Office", "Clinic Office", "Student Services"],
                shelves: ["Shelf P16", "Shelf Q17", "Shelf R18"]
            },
            "Admission and Registration Services": {
                buildings: ["Administration Building", "Student Center", "Records Hall"],
                offices: ["Admissions Office", "Registration Office", "Records Office"],
                shelves: ["Shelf S19", "Shelf T20", "Shelf U21"]
            },
            "Audit Offices": {
                buildings: ["Finance Building", "Audit Tower", "Administration Hall"],
                offices: ["Internal Audit Office", "External Audit Office", "Compliance Office"],
                shelves: ["Shelf V22", "Shelf W23", "Shelf X24"]
            },
            "External Linkages and International Affairs": {
                buildings: ["International Center", "Partnership Hall", "Global Affairs Building"],
                offices: ["International Office", "Partnership Office", "Global Affairs Office"],
                shelves: ["Shelf Y25", "Shelf Z26", "Shelf AA27"]
            },
            "Management Information Systems": {
                buildings: ["IT Building", "Data Center", "Innovation Hub"],
                offices: ["MIS Office", "IT Support Office", "Data Management Office"],
                shelves: ["Shelf AB28", "Shelf AC29", "Shelf AD30"]
            },
            "Office of the President": {
                buildings: ["President's Hall", "Executive Building", "Administration Tower"],
                offices: ["President's Office", "VP Office", "Executive Office"],
                shelves: ["Shelf AE31", "Shelf AF32", "Shelf AG33"]
            }
        };

        // Function to update building options based on selected department
        function updateBuildingOptions() {
            const department = document.getElementById("department").value;
            const buildingSelect = document.getElementById("building");
            buildingSelect.innerHTML = '<option value="">Select Building</option>';

            if (department && departmentData[department]) {
                departmentData[department].buildings.forEach(building => {
                    const option = document.createElement("option");
                    option.value = building;
                    option.textContent = building;
                    buildingSelect.appendChild(option);
                });
            }
        }

        // Function to update office options based on selected building
        function updateOfficeOptions() {
            const department = document.getElementById("department").value;
            const officeSelect = document.getElementById("office");
            officeSelect.innerHTML = '<option value="">Select Office</option>';

            if (department && departmentData[department]) {
                departmentData[department].offices.forEach(office => {
                    const option = document.createElement("option");
                    option.value = office;
                    option.textContent = office;
                    officeSelect.appendChild(option);
                });
            }
        }

        // Function to update shelf options based on selected office
        function updateShelfOptions() {
            const department = document.getElementById("department").value;
            const shelfSelect = document.getElementById("shelf");
            shelfSelect.innerHTML = '<option value="">Select Shelf</option>';

            if (department && departmentData[department]) {
                departmentData[department].shelves.forEach(shelf => {
                    const option = document.createElement("option");
                    option.value = shelf;
                    option.textContent = shelf;
                    shelfSelect.appendChild(option);
                });
            }
        }

        document.getElementById("uploadButton").addEventListener("click", function() {
            let fileInput = document.getElementById("document");
            if (fileInput.files.length === 0) {
                alert("Please select a file first.");
                return;
            }
            document.getElementById("physicalCopyPopup").style.display = "block";
        });

        document.getElementById("yesPhysical").addEventListener("click", function() {
            document.getElementById("physicalCopyPopup").style.display = "none";
            document.getElementById("physicalDetailsPopup").style.display = "block";
        });

        document.getElementById("physicalDetailsForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append("document", document.getElementById("document").files[0]);

            fetch("upload_handler.php", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("File uploaded successfully.");
                        window.location.href = data.redirect;
                    } else {
                        alert("Upload failed: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        });
    </script>


</body>

</html>