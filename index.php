<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Encoding Report</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <style>
    .table-width {
        width: 200px;
    }

    * {
        margin: 0;
        padding: 0;
    }

    #chart-container {
        position: relative;
        height: 70vh;
        width: 50vw;
        overflow: hidden;
    }

    #chart-container-yesterday {
        position: relative;
        height: 70vh;
        width: 50vw;
        overflow: hidden;
    }

    #chart-container-last-week {
        position: relative;
        height: 70vh;
        width: 50vw;
        overflow: hidden;
    }

    .scroll-animation {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.5s, transform 0.5s;
    }

    .fade-in {
        opacity: 1;
        transform: translateY(0);
    }

    .slide-left {
        opacity: 1;
        transform: translateX(0);
    }

    .scale-up {
        opacity: 1;
        transform: scale(1);
    }
    </style>
    <div class="container">
        <h1 class="m-5 text-center">Generate Encoding Report</h1>

        <!-- Encoding for the day -->
        <div class="container mt-5 d-flex justify-content-center">
            <!-- Pie Chart -->
            <div class="row">
                <div class="col-6">
                    <div id="chart-container"></div>
                </div>
                <div class="ms-5 ps-5 col-5">
                    <?php
                    date_default_timezone_set('Asia/Manila');
                    // Establish a connection to the database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "generate_encoding_report";

                    //hosting 
                    // $servername = "localhost";
                    // $username = "ppibdzqe_ppibdzqe";
                    // $password = "f(ZYu7pGq2g{";
                    // $database = "ppibdzqe_post_and_comment";

                    $conn = new mysqli($servername, $username, $password, $database);

                    // Check for connection errors
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all data from the database
                    $sql1 = "SELECT handler, COUNT(*) AS count FROM encoded WHERE DATE(date_encoded) = CURDATE() GROUP BY handler;";
                    $result = $conn->query($sql1);


                    // Get the current month
                    $currentMonth = date('F');

                    // Get the current day
                    $currentDay = date('j');

                    $dateToday = strval($currentMonth) . " " . strval($currentDay);

                    $pieChartData = array();

                    if ($result->num_rows > 0) {
                        // Display data in a table
                        echo "<table class='table table-hover table-bordered mt-3 table-width text-center'>";
                        echo "<thead class='table-primary'>";
                        echo "<tr><th>Encoder</th><th>" . $currentMonth . ' ' . $currentDay . "</th></tr>";
                        echo "</thead>";
                        $totalEncoded = 0;

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='table-info'>" . $row["handler"] . "</td>";
                            echo "<td>" . $row["count"] . "</td>";
                            echo "</tr>";
                            $totalEncoded += $row["count"];

                            // Pie Report
                            $pieChartData[] = array(
                                'value' => intval($row["count"]),
                                'name' => $row["handler"]
                            );
                        }
                        echo "<tr class='table-warning'>";
                        echo "<td>Grand Total</td>";
                        echo "<td>" . $totalEncoded . "</td>";
                        echo "</tr>";

                        echo "</table>";
                    } else {
                        echo "<table class='table table-hover table-bordered mt-3 table-width scroll-animation'>";
                        echo "<thead class='table-primary'>";
                        echo "<tr><th>Encoder</th><th>" . $currentMonth . ' ' . $currentDay . "</th>";
                        echo "</thead>";
                        echo "<tr>";
                        echo "<td colspan='7' class='text-center'>No data encoded for today.</td>";
                        echo "</tr>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Encoding yesterday -->
        <div class="container mt-5 d-flex justify-content-center">
            <!-- Pie Chart -->
            <div class="row">
                <div class="col-6">
                    <div id="chart-container-yesterday" class="scroll-animation scale-up"></div>
                </div>
                <div class="ms-5 ps-5 col-5">
                    <?php

                    // Fetch all data from the database
                    $sql4 = "SELECT DATE_FORMAT(CURDATE() - INTERVAL 1 DAY, '%Y-%m-%d') AS yesterday_date, handler, COUNT(*) AS count FROM encoded WHERE DATE(date_encoded)=DATE_FORMAT(CURDATE() - INTERVAL 1 DAY, '%Y-%m-%d') GROUP BY handler;";
                    $result2 = $conn->query($sql4);


                    // Get the current month
                    $currentMonth = date('F');

                    // Get the yesterday
                    $yesterday = date('j') - 1;

                    $dateToday = strval($currentMonth) . " " . strval($yesterday);

                    $pieChartDataYesterday = array();

                    if ($result2->num_rows > 0) {
                        // Display data in a table
                        echo "<table class='table table-hover table-bordered mt-3 table-width text-center scroll-animation'>";
                        echo "<thead class='table-primary'>";
                        echo "<tr><th>Encoder</th><th>" . $currentMonth . ' ' . $yesterday . "</th></tr>";
                        echo "</thead>";
                        $totalEncoded = 0;

                        while ($row = $result2->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='table-info'>" . $row["handler"] . "</td>";
                            echo "<td>" . $row["count"] . "</td>";
                            echo "</tr>";
                            $totalEncoded += $row["count"];

                            // Pie Report
                            $pieChartDataYesterday[] = array(
                                'value' => intval($row["count"]),
                                'name' => $row["handler"]
                            );
                        }
                        echo "<tr class='table-warning'>";
                        echo "<td>Grand Total</td>";
                        echo "<td>" . $totalEncoded . "</td>";
                        echo "</tr>";

                        echo "</table>";
                    } else {
                        echo "<table class='table table-hover table-bordered mt-3 table-width scroll-animation'>";
                        echo "<thead class='table-primary'>";
                        echo "<tr><th>Encoder</th><th>" . $currentMonth . ' ' . $yesterday . "</th>";
                        echo "</thead>";
                        echo "<tr>";
                        echo "<td colspan='7' class='text-center'>No data encoded for today.</td>";
                        echo "</tr>";
                    }
                    ?>
                </div>
            </div>
        </div>


        <!-- Encoding last week -->
        <div class="container mt-5 d-flex justify-content-center">
            <!-- Pie Chart -->
            <div class="row">
                <div class="col-6">
                    <div id="chart-container-last-week" class="scroll-animation"></div>
                </div>
                <div class="ms-5 ps-5 col-5">
                    <?php

                    // Fetch all data from the database
                    $sql5 = "SELECT COUNT(*) as count, handler,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 1 THEN 1 ELSE 0 END) AS `sunday`,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 2 THEN 1 ELSE 0 END) AS `monday`,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 3 THEN 1 ELSE 0 END) AS `tuesday`,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 4 THEN 1 ELSE 0 END) AS `wednesday`,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 5 THEN 1 ELSE 0 END) AS `thursday`,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 6 THEN 1 ELSE 0 END) AS `friday`,
                    SUM(CASE WHEN DAYOFWEEK(date_encoded) = 7 THEN 1 ELSE 0 END) AS `saturday`
             FROM encoded
             WHERE date_encoded >= DATE_SUB(CURDATE(), INTERVAL DAYOFWEEK(CURDATE()) + 6 DAY)
                   AND date_encoded < DATE_SUB(CURDATE(), INTERVAL DAYOFWEEK(CURDATE()) - 1 DAY)
             GROUP BY handler;";

                    $result3 = $conn->query($sql5);

                    $pieChartDataLastWeek = array();

                    if ($result3->num_rows > 0) {
                        // Display data in a table
                        echo "<table class='table table-hover table-bordered mt-3 table-width text-center scroll-animation'>";
                        echo "<thead class='table-primary'>";

                        // Set the timezone to the desired timezone
                        date_default_timezone_set('Asia/Manila');

                        $currentDay = date('l');
                        $asOfSundayLastWeek = '';
                        $asOfSaturdayLastWeek = '';

                        if($currentDay == 'Sunday'){
                            $asOfSundayLastWeek = ' -7 day';
                            $asOfSaturdayLastWeek = ' -1 day';
                        }

                        if($currentDay == 'Monday'){
                            $asOfSundayLastWeek = ' -8 day';
                            $asOfSaturdayLastWeek = ' -2 day';
                        }

                        if($currentDay == 'Tuesday'){
                            $asOfSundayLastWeek = ' -9 day';
                            $asOfSaturdayLastWeek = ' -3 day';
                        }

                        if($currentDay == 'Wednesday'){
                            $asOfSundayLastWeek = ' -10 day';
                            $asOfSaturdayLastWeek = ' -4 day';
                        }

                        if($currentDay == 'Thursday'){
                            $asOfSundayLastWeek = ' -11 day';
                            $asOfSaturdayLastWeek = ' -5 day';
                        }
    
                        if($currentDay == 'Friday'){
                            $asOfSundayLastWeek = ' -12 day';
                            $asOfSaturdayLastWeek = ' -6 day';
                        }

                        if($currentDay == 'Saturday'){
                            $asOfSundayLastWeek = ' -13 day';
                            $asOfSaturdayLastWeek = ' -7 day';
                        }

                        // Get the start and end dates of the last week
                        $date = date('Y-m-d');  // Current date
                        $startOfWeekFormated = date('Y-m-d', strtotime($date . $asOfSundayLastWeek));
                        $endOfWeekFormated = date('Y-m-d', strtotime($date . $asOfSaturdayLastWeek));

                        $startOfWeek = strtotime($startOfWeekFormated);
                        $endOfWeek = strtotime($endOfWeekFormated);

                        // Loop through each day of the last week and store the dates
                        $currentDate = $startOfWeek;
                        $formattedDates = array();
                        while ($currentDate <= $endOfWeek) {
                            $formattedDate = date('F j', $currentDate);
                            $formattedDates[] = $formattedDate;
                            $currentDate = strtotime('+1 day', $currentDate);
                        }


                        echo "<tr>";
                        echo "<th>Encoder</th>";
                        // Output the dates of the last week
                        foreach ($formattedDates as $date) {
                            echo "<th>" . $date . "</th>";
                        }
                        echo "<th>Total</th>";
                        echo "</tr>";

                        echo "</thead>";
                        $totalEncoded = 0;
                        $totalEncodedSunday = 0;
                        $totalEncodedMonday = 0;
                        $totalEncodedTuesday = 0;
                        $totalEncodedWednesday = 0;
                        $totalEncodedThursday = 0;
                        $totalEncodedFriday = 0;
                        $totalEncodedSaturday = 0;

                        while ($row = $result3->fetch_assoc()) {
                            $totalEncoded += $row["sunday"] + $row["monday"] + $row["tuesday"] + $row["wednesday"] + $row["thursday"] + $row["friday"] + $row["saturday"];
                            $totalEncodedSunday += $row["sunday"];
                            $totalEncodedMonday += $row["monday"];
                            $totalEncodedTuesday += $row["tuesday"];
                            $totalEncodedWednesday += $row["wednesday"];
                            $totalEncodedThursday += $row["thursday"];
                            $totalEncodedFriday += $row["friday"];
                            $totalEncodedSaturday += $row["saturday"];
                            echo "<tr>";
                            echo "<td class='table-info'>" . $row["handler"] . "</td>";
                            echo "<td class='table-danger'>" . $row["sunday"] . "</td>";
                            echo "<td class='table-warning'>" . $row["monday"] . "</td>";
                            echo "<td class='table-warning'>" . $row["tuesday"] . "</td>";
                            echo "<td class='table-warning'>" . $row["wednesday"] . "</td>";
                            echo "<td class='table-warning'>" . $row["thursday"] . "</td>";
                            echo "<td class='table-warning'>" . $row["friday"] . "</td>";
                            echo "<td class='table-danger'>" . $row["saturday"] . "</td>";
                            echo "<td class='table-success'>" . ($row["sunday"] + $row["monday"] + $row["tuesday"] + $row["wednesday"] + $row["thursday"] + $row["friday"] + $row["saturday"]) . "</td>";

                            echo "</tr>";

                            // Pie Report
                            $pieChartDataLastWeek[] = array(
                                'value' => intval($row["count"]),
                                'name' => $row["handler"]
                            );
                        }
                        echo "<tr class='table-success'>";
                        echo "<td>Grand Total</td>";
                        echo "<td class='table-danger'>" . $totalEncodedSunday . "</td>";
                        echo "<td class='table-success'>" . $totalEncodedMonday . "</td>";
                        echo "<td class='table-success'>" . $totalEncodedTuesday . "</td>";
                        echo "<td class='table-success'>" . $totalEncodedWednesday . "</td>";
                        echo "<td class='table-success'>" . $totalEncodedThursday . "</td>";
                        echo "<td class='table-success'>" . $totalEncodedFriday . "</td>";
                        echo "<td class='table-danger'>" . $totalEncodedSaturday . "</td>";
                        echo "<td class='table-success'>" . $totalEncoded . "</td>";
                        echo "</tr>";

                        echo "</table>";
                    } else {
                        echo "<table class='table table-hover table-bordered mt-3 table-width scroll-animation'>";
                        echo "<thead class='table-primary'>";
                        echo "<tr><th>Encoder</th><th colspan='7'>No Encoded this Week</th>";
                        echo "</thead>";
                        echo "<tr>";
                        echo "<td colspan='7' class='text-center'>No data encoded for today.</td>";
                        echo "</tr>";
                    }

                    ?>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployerModal">
            Add Employer
        </button>

        <?php
        // Fetch all data from the database
        $sql = "SELECT * FROM encoded";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display data in a table
            echo "<table class='table table-hover table-bordered mt-3 text-center scroll-animation'>";
            echo "<thead class='table-primary'>";
            echo "<tr><th>ID</th><th>Handler</th><th>Firstname</th><th>Lastname</th><th>Middlename</th><th>Jobtitle</th><th>Date Encoded</th></tr>";
            echo "</thead>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td class='table-info'>" . $row["handler"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["middlename"] . "</td>";
                echo "<td>" . $row["jobtitle"] . "</td>";
                echo "<td>" . $row["date_encoded"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<table class='table table-hover table-bordered mt-3 scroll-animation'>";
            echo "<thead class='table-primary'>";
            echo "<tr><th>ID</th><th>Handler</th><th>Firstname</th><th>Lastname</th><th>Middlename</th><th>Jobtitle</th><th>Date Encoded</th></tr>";
            echo "</thead>";
            echo "<tr>";
            echo "<td colspan='7' class='text-center'>No data found in the database.</td>";
            echo "</tr>";
        }
        ?>

        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Collect form data
            $handler = $_POST['handler'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $middlename = $_POST['middlename'];
            $jobtitle = $_POST['jobtitle'];

            // Insert data into the database
            $sql2 = "INSERT INTO `encoded` (`handler`, `firstname`, `lastname`, `middlename`, `jobtitle`) VALUES ('$handler', '$firstname', '$lastname', '$middlename', '$jobtitle')";

            if ($conn->query($sql2) === TRUE) {
                echo "Data added successfully!";
                echo "<script>window.location.href='index.php'</script>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();
        }
        ?>

        <!-- Add Employer Modal -->
        <div class="modal fade" id="addEmployerModal" tabindex="-1" aria-labelledby="addEmployerLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addEmployerLabel">Add Employer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="handler" class="form-label">Handler</label>
                                <input type="text" class="form-control" id="handler" name="handler"
                                    placeholder="ex. letty" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="ex. Juan" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="ex. Dela Cruz" required>
                            </div>
                            <div class="mb-3">
                                <label for="middlename" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="middlename" name="middlename"
                                    placeholder="ex. Cardo" required>
                            </div>
                            <div class="mb-3">
                                <label for="hanjobtitledler" class="form-label">Jobtitle</label>
                                <input type="text" class="form-control" id="jobtitle" name="jobtitle"
                                    placeholder="ex. Pipe Fitter" required>
                            </div>

                            <div class="modal-footer">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Employer">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <script src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
            <script>
            // today
            var dom = document.getElementById('chart-container');
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option;

            option = {
                title: {
                    text: 'Encoding Report Today',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: '50%',
                    data: <?php echo json_encode($pieChartData); ?>,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            if (option && typeof option === 'object') {
                myChart.setOption(option);
            }

            window.addEventListener('resize', myChart.resize);

            // yesterday
            var dom1 = document.getElementById('chart-container-yesterday');
            var myChart1 = echarts.init(dom1, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option1;

            option1 = {
                title: {
                    text: 'Encoding Report Yesterday',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: '50%',
                    data: <?php echo json_encode($pieChartDataYesterday); ?>,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            if (option1 && typeof option1 === 'object') {
                myChart1.setOption(option1);
            }

            window.addEventListener('resize', myChart1.resize);

            //last week
            var dom2 = document.getElementById('chart-container-last-week');
            var myChart2 = echarts.init(dom2, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option2;

            option2 = {
                title: {
                    text: 'Encoding Report Last Week',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: '50%',
                    data: <?php echo json_encode($pieChartDataLastWeek); ?>,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            if (option2 && typeof option2 === 'object') {
                myChart2.setOption(option2);
            }

            window.addEventListener('resize', myChart2.resize);
            </script>

            <script>
            function handleScroll() {
                var animatedElements = document.getElementsByClassName('scroll-animation');

                for (var i = 0; i < animatedElements.length; i++) {
                    var element = animatedElements[i];
                    var elementPosition = element.getBoundingClientRect().top;
                    var windowHeight = window.innerHeight;

                    if (elementPosition < windowHeight * 0.8 && !element.classList.contains('fade-in')) {
                        if (element.classList.contains('slide-left')) {
                            element.classList.add('slide-left');
                        } else if (element.classList.contains('scale-up')) {
                            element.classList.add('scale-up');
                        } else {
                            element.classList.add('fade-in');
                        }
                    }
                }
            }

            window.addEventListener('scroll', handleScroll);
            </script>

            <!-- Bootstrap JS Link -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
                crossorigin="anonymous"></script>
</body>

</html>