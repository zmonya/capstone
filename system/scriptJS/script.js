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