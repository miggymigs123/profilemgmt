
<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: profilemgmt.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profilemgmt.css">
    <link rel="stylesheet" href="maindashboard.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body{
            font-family: "Rubik", sans-serif;
            background-color: #FCFCFC;
            padding-top: 45px;
        }

        header {
            background-color: #fff;       /* Background color */
            color: black;                 /* Text color */
            padding: 7px 15px;           /* Padding inside the header */
            top: 0;                       /* Fix the header to the top */
            left: 0;                      /* Ensure header starts from the left */
            width: 100%;                  /* Make header span the full width */
            position: fixed;              /* Fix the header position */
            z-index: 1;                /* Ensure header is above other elements */
            box-shadow: 0px 0px 5px rgba(160, 160, 160, 0.5); /* Shadow for depth */
        }

        #pedia3x{
            height: 50px; 
            margin-left: 330px;
        }

        .container-fluid{
            margin: 0px;
            color: #171717;
        }

        #nav_bar{
            height: auto;
            box-shadow: 0px 0px 5px rgba(160, 160, 160, 0.5);
            padding: 20px;
            background: #fff;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 2;
            width: 330px;
            height: 100vh;
            overflow-y: auto;
        }

        #user_profile_card{
            background-color: #F4F3FB; 
            height: 80px; 
            border-radius: 10px;
            align-items: center;
            margin: 1px;
            display: flex;
        }

        #main{
            margin-left: 350px; /* Give space for the sidebar */
            margin-right: 12px;
            margin-top: 35px;
            padding: 80px;
            padding-top: 50px;
            background-color: #fff;
            box-shadow: 0px 0px 3px rgba(160, 160, 160, 0.5);
            flex-grow: 1;
            border-radius: 10px;
            min-height: 100vh;
        }

        .nav-link {
            display: flex; /* Ensured icons and text align properly */
            align-items: center;
            padding: 8px;
            font-size: 1.08rem;
            font-weight: 450;
        }

        .nav-link img {
            margin-right: 8px; /* Added space between icon and text */
        }

        .nav-link a {
            text-decoration: none;
            color: #3c3c3c;
        }

        .status-card {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Ensures icon and text have space */
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            margin: 7px 0;
            overflow: hidden; /* Ensure the left strip is contained within the card */
            height: 85px; /* Adjust height as needed */
        }

        .status-content {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centers content horizontally */
            justify-content: center; /* Centers content vertically */
            text-align: center; /* Centers text */
            flex-grow: 1;
        }

        .status-left {
            width: 12px;
            height: 100%;
            border-radius: 10px 0 0 10px;
        }

        .status-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin-right: 15px;
            margin-left: 15px;
        }

        .status-icon.overdue {
            color: #E55C5C;
            background-color: #e55c5c29;
            height: 95px;
            width: 80px;
            margin-left: 0;
        }

        .status-left.overdue {
            background-color: #E74C3C;
        }

        .status-icon.completed {
            color: #5FA154;
            background-color: #60a15426;
            height: 95px;
            width: 80px;
            margin-left: 0;
        }

        .status-left.completed {
            background-color: #5FA154;
        }

        .status-icon.conditional {
            color: #9574DC;
            background-color: #9574dc29;
            height: 95px;
            width: 80px;
            margin-left: 0;
        }

        .status-left.conditional {
            background-color: #8E44AD;
        }

        .status-icon.pending {
            color: #E5865C;
            background-color: #e5855c2a;
            height: 95px;
            width: 80px;
            margin-left: 0;
        }

        .status-left.pending {
            background-color: #E67E22;
        }

        .status-text.overdue{
            font-weight: 550;
            color: #E55C5C;
            font-size: 1.1rem;
        }

        .status-text.completed{
            font-weight: 550;
            color: #5FA154;
            font-size: 1.1rem;
        }

        .status-text.conditional{
            font-weight: 550;
            color: #9574DC;
            font-size: 1.1rem;
        }

        .status-text.pending{
            font-weight: 550;
            color: #E5865C;
            font-size: 1.1rem;
        }

        .status-number {
            font-size: 2rem;
            font-weight: 550;
            margin-right: 15px;
        }

        .form-control {
            border-radius: 10px;
            margin-right: 5px;
        }

        .profile_label.row{
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            height: 37px;
            align-items: center;
            text-align: center;
            padding-top: 6px;
            margin-top: 15px;
        }

        .child_profile_card.row{
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            height: 75px;
            align-items: center;
            text-align: center;
            margin-top: 8px;
            padding-bottom: 0;
        }

        footer {
            background-color: #8F80D0;
            color: white;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 2.5%
        }
        .archived {
            opacity: 0.5;
            color: #666;
        }


    </style>
</head>
<header>
    <img src="/images/logo.png" alt="pedia3x" id="pedia3x">
</header>
<body>

<script>
        const calendarGrid = document.querySelector('.calendar-grid');
        const monthSelector = document.getElementById('month-selector');
        const yearSelector = document.getElementById('year-selector');
        const prevButton = document.querySelector('.nav-button.prev');
        const nextButton = document.querySelector('.nav-button.next');
        let currentDate = new Date();

        function populateYearOptions() {
            const currentYear = new Date().getFullYear();
            for (let year = currentYear - 10; year <= currentYear + 10; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearSelector.appendChild(option);
            }
        }

        function updateCalendarGrid(year, month) {
            calendarGrid.innerHTML = ''; // Clear the grid
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDay = new Date(year, month, 1).getDay();

            // Create blank days for the first week
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('calendar-day', 'empty');
                calendarGrid.appendChild(emptyCell);
            }

            // Populate days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayCell = document.createElement('div');
                dayCell.classList.add('calendar-day');
                dayCell.textContent = day;
                calendarGrid.appendChild(dayCell);
            }
        }

        function updateCalendar() {
            const selectedMonth = parseInt(monthSelector.value, 10);
            const selectedYear = parseInt(yearSelector.value, 10);
            updateCalendarGrid(selectedYear, selectedMonth);
        }

        function navigateMonth(step) {
            currentDate.setMonth(currentDate.getMonth() + step);
            monthSelector.value = currentDate.getMonth();
            yearSelector.value = currentDate.getFullYear();
            updateCalendar();
        }

        // Populate the year options
        populateYearOptions();

        // Initialize calendar grid
        updateCalendarGrid(currentDate.getFullYear(), currentDate.getMonth());

        // Event listeners for navigation and selection
        monthSelector.addEventListener('change', updateCalendar);
        yearSelector.addEventListener('change', updateCalendar);

        prevButton.addEventListener('click', () => navigateMonth(-1));
        nextButton.addEventListener('click', () => navigateMonth(1));

        function toggleDescription(id) {
            const desc = document.getElementById(id);
            desc.classList.toggle('show');
        }
</script>
    <!--SIDE NAV-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-auto" id="nav_bar">
                <br>
                <div class="row" id="user_profile_card">
                    <div class="col-2">
                        <img src="/images/sample.png" width="55px">
                    </div>
                    <div class="col-1">
                        
                    </div>
                    <div class="col-9">
                        <p class="fs-5 fw-bold mb-0">BRGY. UGAC SUR</p>
                        <p class="fs-6 mt-0">Account In Use</p>
                    </div>
                </div>

                <hr>

                <div class="col">
                    <ul class="list-unstyled">
                        <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/dashboard-layout.png" alt="dashboard-layout"/><a style="text-decoration: none; color: #3c3c3c;" href="maindashboard.php">&#160 Dashboard</a></li>
                        <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/syringe.png" alt="syringe"/><a style="text-decoration: none; color: #3c3c3c;" href="VaccineList.php">&#160 List of Vaccines</a></li>
                        <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/admin-settings-male.png" alt="admin-settings-male"/><a style="text-decoration: none; color: #3c3c3c;" href="#">&#160 Manage Profiles</a></li>
                        <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/group-of-projects.png" alt="group-of-projects"/><a style="text-decoration: none; color: #3c3c3c;" href="programs.php">&#160 Immunization Programs</a></li>
                    </ul>
                    <hr class="divider">
                <section class="calendar-widget">
                    <div class="calendar-container">
                        <div class="calendar-header">
                            <div class="month-selector">
                                <label for="month-selector" class="selector-text">Month</label>
                                <select id="month-selector">
                                    <option value="0">January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                    <option value="4">May</option>
                                    <option value="5">June</option>
                                    <option value="6">July</option>
                                    <option value="7">August</option>
                                    <option value="8">September</option>
                                    <option value="9">October</option>
                                    <option value="10">November</option>
                                    <option value="11">December</option>
                                </select>
                            </div>
                            <div class="year-selector">
                                <label for="year-selector" class="selector-text">Year</label>
                                <select id="year-selector"></select>
                            </div>
                        </div>
                        <div class="calendar-navigation">
                            <button class="nav-button prev" aria-label="Previous Month"><img src="images/arrowleft.png" alt="Previous Month" loading="lazy" style="width: 19px; height: 20px;"></button>
                            <button class="nav-button next" aria-label="Next Month"><img src="images/arrowright.png" alt="Next Month" loading="lazy" style="width: 19px; height: 20px;"></button>
                        </div>
                        <div class="calendar-grid">
                        <div class="calendar-day">1</div>
                            <div class="calendar-day">2</div>
                            <div class="calendar-day">3</div>
                            <div class="calendar-day">4</div>
                            <div class="calendar-day">5</div>
                            <div class="calendar-day">6</div>
                            <div class="calendar-day">7</div>
                            <div class="calendar-day">8</div>
                            <div class="calendar-day">9</div>
                            <div class="calendar-day">10</div>
                            <div class="calendar-day">11</div>
                            <div class="calendar-day">12</div>
                            <div class="calendar-day">13</div>
                            <div class="calendar-day">14</div>
                            <div class="calendar-day">15</div>
                            <div class="calendar-day">16</div>
                            <div class="calendar-day">17</div>
                            <div class="calendar-day">18</div>
                            <div class="calendar-day">19</div>
                            <div class="calendar-day">20</div>
                            <div class="calendar-day">21</div>
                            <div class="calendar-day">22</div>
                            <div class="calendar-day">23</div>
                            <div class="calendar-day">24</div>
                            <div class="calendar-day">25</div>
                            <div class="calendar-day">26</div>
                            <div class="calendar-day">27</div>
                            <div class="calendar-day">28</div>
                            <div class="calendar-day">29</div>
                            <div class="calendar-day">30</div>
                        </div>
                        </div>
                    </div>
                </section>

                <a href="logout.php" id="logout_btn" class="btn btn-warning">Logout</a> 

                </div>

            </div>  
        </div>   
    </div>
                
                    
           
            <!--STATUS CARD-->
            <div class="col" id="main">

            <div class="section1">
                <div class="row mt-4 mb-2 align-items-center" id="ch-info">
                        <div class="col-md-6">
                            <h2 style="font-size: large; font-weight: bold;">Children Information</h2>
                        </div>
                        
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search by Child Name" style="width: 50px;">
                                </div>                          
                            </div>
                </div>
            </div>

            <!-- Insert Record -->
                <div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="insertdataLabel">Insert Child Record</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="insert.php" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                    <label for="ChildFirstName" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="ChildFirstName" name="ChildFirstName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ChildLastName" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="ChildLastName" name="ChildLastName" required>
                                </div>
                                    <div class="mb-3">
                                        <label for="Address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="Address" placeholder="Enter Address" name="Address" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="BirthDate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control" id="BirthDate" placeholder="Enter Birthdate" name="Birthdate" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Sex" class="form-label">Gender</label>
                                        <input type="text" class="form-control" id="Sex" placeholder="Enter Gender" name="Gender" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ParentName" class="form-label">Parent/Guardian Name</label>
                                        <input type="text" class="form-control" id="ParentName" placeholder="Enter Parent/Guardian Name" name="ParentName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ContactNumber" class="form-label">Parent/Guardian Phone Number</label>
                                        <input type="text" class="form-control" id="ContactNumber" placeholder="Enter Phone Number" name="ContactNumber" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="MedicalNotes" class="form-label">Medical Notes</label>
                                        <textarea class="form-control" id="MedicalNotes" rows="3" placeholder="Enter Necessary Medical Notice" name="MedicalNotes"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="savedata">Save Record</button>
                                    
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


<div class="container mt-5">

    <div class="row justify-content-center">
            <?php
            $connection = mysqli_connect("localhost", "root", "", "CRUDE");
            $fetch_query = "SELECT * FROM ChildInfo";
            $fetch_query_run = mysqli_query($connection, $fetch_query);

            if (mysqli_num_rows($fetch_query_run) > 0) {
                echo '<div class="accordion" id="childAccordion">';
                $count = 0; // Counter for unique IDs
                while ($accordion = mysqli_fetch_array($fetch_query_run)) {
                    $count++;
            ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $count; ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?>" aria-expanded="true" aria-controls="collapse<?php echo $count; ?>">
                            <div class="row_child_profile_card">
                                <div class="col-1">
                                    <img src="/images/sample.png" width="55px">
                                </div>
                                <div class="col-3 childName" style="padding-top: 14px; text-align: left;">
                                    <p><?php echo $accordion['ChildID']; ?></p>
                                </div>
                                <div class="col-3 childName" style="padding-top: 14px; text-align: left;">
                                    <p><?php echo $accordion['ChildFirstName']; ?></p>
                                </div>
                                <div class="col-3 childName" style="padding-top: 14px; text-align: left;">
                                    <p><?php echo $accordion['ChildLastName']; ?></p>
                                </div>
                                <div class="col-3" style="padding-top: 14px;">
                                    <p><?php echo $accordion['Address']; ?></p>
                                </div>
                                <div class="col-1" style="padding-top: 14px;">
                                    <p><?php echo $accordion['Sex']; ?></p>
                                </div>
                                <div class="col-2" style="padding-top: 14px;">
                                    <p><?php echo $accordion['Birthdate']; ?></p>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $count; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $count; ?>" data-bs-parent="#childAccordion">
                        <div class="accordion-body">
                            <button type="button" class="btn btn-primary view_data" data-id="<?php echo $accordion['ChildID']; ?>">View Record</button>
                            <button type="button" class="btn btn-info edit_data" data-id="<?php echo $accordion['ChildID']; ?>" data-firstname="<?php echo $accordion['ChildFirstName']; ?>" data-lastname="<?php echo $accordion['ChildLastName']; ?>" data-address="<?php echo $accordion['Address']; ?>" data-birthdate="<?php echo $accordion['Birthdate']; ?>" data-gender="<?php echo $accordion['Sex']; ?>" data-parentname="<?php echo $accordion['ParentName']; ?>" data-contact="<?php echo $accordion['ParentContactNumber']; ?>" data-medical="<?php echo $accordion['MedicalNotes']; ?>">Edit</button>
                            <button type="button" class="btn btn-danger delete_data" data-id="<?php echo $accordion['ChildID']; ?>" data-bs-toggle="modal" data-bs-target="#confirmArchive">Archive</button>
                        </div>
                    </div>
                </div>

                <?php
            }
            echo '</div>'; // Close accordion
        } else {
            echo "No records found.";
        }

        // Close the connection
        mysqli_close($connection);
        ?>

        <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="recordModalLabel">Child Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="recordDetails"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Child Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="update1.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="editChildID" name="ChildID">
                    <div class="mb-3">
                        <label for="editChildFirstName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="editChildFirstName" name="ChildFirstName"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editChildLastName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="editChildLastName" name="ChildLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="Address" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBirthDate" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="editBirthDate" name="Birthdate" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSex" class="form-label">Gender</label>
                        <select class="form-control" id="editSex" name="Gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editParentName" class="form-label">Parent/Guardian Name</label
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Record</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Archive Confirmation Modal -->
                        <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="archiveModalLabel">Confirm Archiving</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to archive this record? This action cannot be undone.</p>
                                        <input type="hidden" id="archive_id" name="archive_id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="confirmArchive">Archive</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <?php
                                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                    echo $_SESSION['status'];
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php
                                    unset($_SESSION['status']);
                                }
                                ?>
                                <div class="class header">
                                    <h4> PHP POP UP CRUD<h4>
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insertdata">
                                        ADD CHILD RECORD
                                    </button>
                                </div>
                            <div class="card-body"></div>
                        </div>          
                        
            </div>  <!--  main div ends here  -->
        </div>
    </div>
</div>
    
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase().trim();
        const accordionItems = document.querySelectorAll('.accordion-item');

        accordionItems.forEach(function(item) {
            const childNameElements = item.querySelectorAll('.childName');  // Get all childName elements

            let isVisible = false;
            childNameElements.forEach((childNameElement) => {
                const childName = childNameElement.textContent.toLowerCase();
                
                // Check if any childName matches the search value
                if (childName.includes(searchValue)) {
                    isVisible = true;
                }
            });

            item.style.display = isVisible ? '' : 'none';  // Show if any name matches
        });
    });
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.view_data').click(function() {
        var child_id = $(this).data('id');
        $.ajax({
            url: 'fetch_child.php',
            method: 'POST',
            data: {child_id: child_id},
            dataType: 'json',
            success: function(data) {
                if (data.status !== "error") {
                    var details = `
                        <p><strong>Child First Name:</strong> ${data.ChildFirstName}</p>
                        <p><strong>Child Last Name:</strong> ${data.ChildLastName}</p>
                        <p><strong>Address:</strong> ${data.Address}</p>
                        <p><strong>Birthdate:</strong> ${data.Birthdate}</p>
                        <p><strong>Gender:</strong> ${data.Sex}</p>
                        <p><strong>Parent/Guardian Name:</strong> ${data.ParentName}</p>
                        <p><strong>Contact Number:</strong> ${data.ParentContactNumber}</p>
                        <p><strong>Medical Notes:</strong> ${data.MedicalNotes}</p>
                    `;
                    $('#recordDetails').html(details);
                    $('#recordModal').modal('show');
                } else {
                    alert(data.message);
                }
            },
            error: function() {
                alert("An error occurred.");
            }
        });
    });

    // Edit button click event
    $('.edit_data').click(function() {
    var childId = $(this).data('id');
    var childFirstName = $(this).data('firstname');
    var childLastName = $(this).data('lastname');
    var address = $(this).data('address');
    var birthdate = $(this).data('birthdate');
    var gender = $(this).data('gender');
    var parentName = $(this).data('parentname');
    var contact = $(this).data('contact');
    var medical = $(this).data('medical');

    // Set the values in the edit modal
$('#editChildID').val(childId);
$('#editChildFirstName').val(childFirstName);
$('#editChildLastName').val(childLastName);
$('#editAddress').val(address);
$('#editBirthDate').val(birthdate);
$('#editSex').val(gender);
$('#editParentName').val(parentName);
$('#editContactNumber').val(contact);
$('#editMedicalNotes').val(medical);

// Show the edit modal
$('#editModal').modal('show');

// Update button click event
$('#updateChild').click(function() {
    var childId = $('#editChildID').val();
    var childFirstName = $('#editChildFirstName').val();
    var childLastName = $('#editChildLastName').val();
    var address = $('#editAddress').val();
    var birthdate = $('#editBirthDate').val();
    var gender = $('#editSex').val();
    var parentName = $('#editParentName').val();
    var contact = $('#editContactNumber').val();
    var medical = $('#editMedicalNotes').val();

    $.ajax({
        url: 'update_child.php',
        method: 'POST',
        data: {
            child_id: childId,
            child_first_name: childFirstName,
            child_last_name: childLastName,
            address: address,
            birthdate: birthdate,
            gender: gender,
            parent_name: parentName,
            contact: contact,
            medical: medical
        },
        success: function(data) {
            if (data.status === "success") {
                $('#editModal').modal('hide');
                // Update the record's values in the UI
                $('#record-' + childId + ' .child-first-name').text(childFirstName);
                $('#record-' + childId + ' .child-last-name').text(childLastName);
                $('#record-' + childId + ' .address').text(address);
                $('#record-' + childId + ' .birthdate').text(birthdate);
                $('#record-' + childId + ' .gender').text(gender);
                $('#record-' + childId + ' .parent-name').text(parentName);
                $('#record-' + childId + ' .contact').text(contact);
                $('#record-' + childId + ' .medical').text(medical);
            } else {
                alert(data.message);
            }
        },
        error: function() {
            alert("An error occurred.");
        }
    });
});

// $(document).ready(function() {
//     // Set the delete ID when the delete button is clicked
//     $('.delete_data').click(function() {
//         var childId = $(this).data('id');
//         $('#delete_id').val(childId); // Set the hidden input value in the modal
//     });

//     // Handle the delete confirmation
//     $('#confirmDelete').click(function() {
//         var deleteId = $('#delete_id').val();

//         $.ajax({
//             url: 'delete.php',
//             method: 'POST',
//             data: { delete_id: deleteId },
//             success: function(response) {
//                 $('#deleteModal').modal('hide'); // Hide the modal after deletion
//                 location.reload(); // Reload the page to show updated records
//             },
//             error: function() {
//                 alert("An error occurred. Please try again.");
//             }
//         });
//     });
// });
$('#confirmArchive').click(function() {
    var childId = $('#archive_id').val();
    $.ajax({
        url: 'archive_child.php',
        method: 'POST',
        data: {child_id: childId},
        success: function(data) {
            if (data.status === "success") {
                $('#archiveModal').modal('hide');
                // Update the record's status to "archived" in the UI
                $('#record-' + childId).addClass('archived');
            } else {
                alert(data.message);
            }
        },
        error: function() {
            alert("An error occurred.");
        }
    });
});
</script>
    

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="profilemgmt.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
<footer>
    <p style="font-size: small; margin-left: 250px;">Empowering pediatrics, one click with PEDIA3X.</p>>
</footer>
</html>