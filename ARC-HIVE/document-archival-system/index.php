<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/style.css">
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
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- User ID and Calendar Section -->
        <div class="user-id-calendar-container">
            <!-- User ID GUI -->
            <div class="user-id">
                <img src="UserImage/Master.png" alt="User Picture" class="user-picture">
                <div class="user-info">
                    <p class="user-name">Caleb Steven A Lagunilla</p>
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


        <!-- Upload and Activity Log Container -->
        <div class="upload-activity-container">
            <!-- Upload Section -->
            <div class="upload-file" id="upload">
                <h3>Upload a Document</h3>
                <form id="uploadForm" action="upload_handler.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="document" id="document" required>
                    <button type="button" id="uploadButton">Upload</button>
                </form>
            </div>

            <!-- Activity Log Section -->
            <div class="activity-log">
                <h3>Activity Log</h3>
                <div class="log-entries">
                    <!-- Existing Entries -->
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

                    <!-- New Entries -->
                    <div class="log-entry">
                        <i class="fas fa-hand-paper"></i> <!-- Icon for Requested -->
                        <p>Requested "Budget.xlsx"</p>
                        <span>08:45 AM</span>
                    </div>
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
                    <i class="fas fa-cogs"></i>
                    <p>College of Engineering and Technology</p>
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

        function closePopup(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>


</body>

</html>