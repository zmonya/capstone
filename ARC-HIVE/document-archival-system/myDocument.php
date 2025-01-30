<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Documents</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylesheet/style2.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Doc Archival</h2>
        <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myDocument.php" class="active"><i class="fas fa-folder"></i> My Documents</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <!-- Top Navigation -->
    <div class="top-nav">
        <h2>My Documents</h2>
        <input type="text" placeholder="Search documents...">
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="upload-file" id="upload">
            <h3>Upload a Document</h3>
            <form id="uploadForm" action="upload_handler.php" method="post" enctype="multipart/form-data">
                <input type="file" name="document" id="document" required>
                <button type="button" id="uploadButton" class="hidden">Upload</button>
            </form>
        </div>

        <!-- Error Popup -->
        <div class="popup-error" id="fileErrorPopup" style="display: none;">
            <button class="exit-button" onclick="closePopup('fileErrorPopup')">X</button>
            <h3>Select A File First</h3>
        </div>

        <!-- Upload Popup -->
        <div id="uploadPopup" class="popup">
            <h3>Upload Your File</h3>
            <input type="file">
            <button id="closePopup">Close</button>
        </div>

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
            <label for="department">Department/College:</label>
            <input type="text" id="department" name="department" required>

            <label for="building">Building:</label>
            <input type="text" id="building" name="building" required>

            <label for="office">Office:</label>
            <input type="text" id="office" name="office" required>

            <label for="shelf">Shelf:</label>
            <input type="text" id="shelf" name="shelf" required>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <!-- Scripts -->
    <script>
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

            // Hide all popups when "No" is clicked
            noPhysical.addEventListener("click", function() {
                physicalCopyPopup.style.display = "none";
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

        function toggleRecentFiles() {
            const recentFiles = document.querySelector('.recent-files-section');
            recentFiles.classList.toggle('hidden');
        }

        function toggleRightSidebar() {
            document.getElementById('rightSidebar').classList.toggle('active');
        }
    </script>
</body>

</html>