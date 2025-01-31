<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="script" href="scriptJS/script.js">
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
        <!-- Activity Log Icon -->
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
                <img src="imageUser/master.png" alt="User Picture" class="user-picture">
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


        <!-- Upload and notification Log Container -->
        <div class="upload-activity-container">
            <!-- Upload Section -->
            <div class="upload-file" id="upload">
                <h3>Upload a Document</h3>
                <form id="uploadForm" action="upload_handler.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="document" id="document" required>
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
                    <i class="fas fa-cogs"></i>
                 <a href="#"><p>College of Engineering and Technology</p></a>
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


    <?php
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values
$dep_college = $building = $office = $shelf = $document = "";
$dep_college_err = $building_err = $office_err = $shelf_err = $document_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate Department/College

    $input_dep_college = trim($_POST["dep_college"]);
    if(empty($input_dep_college)){
        $dep_college_err = "Please enter a Department/College.";
    } elseif(!filter_var($input_dep_college, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $dep_college_err = "Please enter a Department/College.";
    } else{
        $dep_college = $input_dep_college;
    }
    
    // Validate Building
    $input_building = trim($_POST["building"]);
    if(empty($input_building)){
        $building_err = "Please enter a Building.";     
    } else{
        $building = $input_building;
    }

       // Validate Office
    $input_office = trim($_POST["office"]);
    if(empty($input_office)){
        $office_err = "Please enter a office.";     
    } else{
        $office = $input_office;
    }
    
    
       // Validate shelf
    $input_shelf = trim($_POST["shelf"]);
    if(empty($input_shelf)){
        $shelf_err = "Please enter a shelf.";     
    } else{
        $shelf = $input_shelf;
    }

       // Validate document
    $input_document = trim($_POST["document"]);
    if(empty($input_document)){
        $document_err = "Please enter a document.";     
    } else{
        $document = $input_document;
    }
    
    // Check input errors before inserting in database
    if(empty($dep_college_err) && empty($building_err) && empty($office_err) && empty($shelf_err) && empty($document_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO document_upload (dep_college, building, office, shelf, document) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_dep_college, $param_building, $param_office, $param_shelf, $param_document);
            
            // Set parameters
            $param_dep_college = $dep_college;
            $param_building = $building;
            $param_office = $office;
            $param_shelf = $shelf;
            $param_document = $document;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index1.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

    <div class="popup-questionnaire" id="physicalDetailsPopup" style="display: none;">
        <button class="exit-button" onclick="closePopup('physicalDetailsPopup')">X</button>
        <h3>Provide Physical Copy Details</h3>

<!--         <form id="physicalDetailsForm">
            <label for="department">Department/College:</label>
            <input type="text" id="department" name="department" required>

            <label for="building">Building:</label>
            <input type="text" id="building" name="building" required>

            <label for="office">Office:</label>
            <input type="text" id="office" name="office" required>

            <label for="shelf">Shelf:</label>
            <input type="text" id="shelf" name="shelf" required>

            <button type="submit" class="submit-button">Submit</button>
        </form> -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Department/College:</label>
                <input type="text" name="dep_college" class="form-control <?php echo (!empty($dep_college_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dep_college; ?>">
                <span class="invalid-feedback"><?php echo $dep_college_err;?></span>
            </div>
            <div class="form-group">
                <label>Building:</label>
                <input type="text" name="building" class="form-control <?php echo (!empty($building_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $building; ?>">
                <span class="invalid-feedback"><?php echo $building_err;?></span>
            </div>
            <div class="form-group">
                <label>Office:</label>
                <input type="text" name="office" class="form-control <?php echo (!empty($office_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $office; ?>">
                <span class="invalid-feedback"><?php echo $office_err;?></span>
            </div>
            <div class="form-group">
                <label>Shelf:</label>
                <input type="text" name="shelf" class="form-control <?php echo (!empty($shelf_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $shelf; ?>">
                <span class="invalid-feedback"><?php echo $shelf_err;?></span>
            </div>
            <button type="submit
            
            
            " class="submit-button">Submit</button>
            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>

    </div>


</body>

</html>