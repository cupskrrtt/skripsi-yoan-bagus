@extends('layouts/main')

@section('container')



<style>
        .calendar {
            max-width: 100%;
            margin: 20px auto;
        }
        .calendar table {
            table-layout: fixed;
        }
        .calendar th, .calendar td {
            text-align: center;
            padding: 10px;
            vertical-align: top;
        }
        .calendar .header {
            background-color: #f8f9fa;
        }
        .calendar .day {
            height: 120px;
            position: relative;
            overflow: hidden;
        }
        .calendar .today {
            background-color: #e9ecef;
        }
        .event {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            padding: 2px;
            margin: 2px 0;
            font-size: 0.8em;
            text-align: left;
            cursor: pointer;
            display: inline-block;
        }
        .event-wrapper {
            white-space: nowrap;
            overflow-x: auto;
        }
        .remove-btn {
            position: relative;
            margin-left: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            display: none;
        }
        .event:hover .remove-btn {
            display: inline-block;
        }
        @media (max-width: 576px) {
            .calendar .day {
                height: 80px;
            }
        }
    </style>
</head>
<body>
<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Schedule Page</h2>
        </div>
        <div class="dropdown-top">
            <a href="/planning">Capacity Production</a>
            <a href="">|</a>
            <a href="/workforce">Workforce Availability</a>
            <a href="">|</a>
            <a href="/schedule">Schedule</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

<section class="breadcrumbs">
    <div class="breadcrumbs-all">
        <a href="/planning">Capacity Production ></a>
        <a href="/workforce">Workforce Availability ></a>
        <a href="/schedule">Schedule</a>
    </div>
</section>
    <div class="container">
        <div class="mb-3">
            <h2>Add Event</h2>
            <form id="eventForm">
                <div class="mb-3">
                    <label for="eventStartDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="eventStartDate" required>
                </div>
                <div class="mb-3">
                    <label for="eventEndDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="eventEndDate" required>
                </div>
                <div class="mb-3">
                    <label for="eventTitle" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="eventTitle" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Event</button>
            </form>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button id="prevMonth" class="btn btn-secondary">&lt; Previous</button>
            <h3 id="monthYear"></h3>
            <button id="nextMonth" class="btn btn-secondary">Next &gt;</button>
        </div>
        <div id="calendar" class="calendar"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script>
        $(document).ready(function () {
            let events = [

            ];

            let currentMonth = new Date().getMonth();
            let currentYear = new Date().getFullYear();

            function generateCalendar(month, year) {
                const calendar = $('#calendar');
                calendar.empty();
                
                const firstDay = (new Date(year, month)).getDay();
                const daysInMonth = 32 - new Date(year, month, 32).getDate();
                const today = new Date();
                
                $('#monthYear').text(`${moment().month(month).format('MMMM')} ${year}`);
                
                let table = '<table class="table table-bordered">';
                table += '<thead><tr class="header">';
                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                daysOfWeek.forEach(day => {
                    table += `<th>${day}</th>`;
                });
                table += '</tr></thead><tbody>';
                
                let date = 1;
                for (let i = 0; i < 6; i++) {
                    table += '<tr>';
                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < firstDay) {
                            table += '<td></td>';
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            const isToday = (date === today.getDate() && month === today.getMonth() && year === today.getFullYear());
                            const dayClass = isToday ? 'day today' : 'day';

                            // Check for events on this date
                            const currentDate = new Date(year, month, date);
                            const eventList = events.filter(event => moment(currentDate).isBetween(event.startDate, event.endDate, undefined, '[]'));
                            let eventHTML = '';
                            if (eventList.length > 0) {
                                eventHTML = '<div class="event-wrapper">';
                                eventList.forEach(event => {
                                    eventHTML += `<div class="event">${event.title}<button class="remove-btn" data-start-date="${event.startDate}" data-end-date="${event.endDate}" data-title="${event.title}">&times;</button></div>`;
                                });
                                eventHTML += '</div>';
                            }

                            table += `<td class="${dayClass}">${date}${eventHTML}</td>`;
                            date++;
                        }
                    }
                    table += '</tr>';
                }
                table += '</tbody></table>';
                
                calendar.append(table);
            }

            function addEvent(startDate, endDate, title) {
                events.push({ startDate, endDate, title });
                generateCalendar(currentMonth, currentYear);
            }

            function removeEvent(startDate, endDate, title) {
                events = events.filter(event => !(event.startDate === startDate && event.endDate === endDate && event.title === title));
                generateCalendar(currentMonth, currentYear);
            }

            $('#eventForm').on('submit', function (e) {
                e.preventDefault();
                const startDate = $('#eventStartDate').val();
                const endDate = $('#eventEndDate').val();
                const title = $('#eventTitle').val();
                addEvent(startDate, endDate, title);
                $('#eventForm')[0].reset();
            });

            $('#calendar').on('click', '.remove-btn', function () {
                const startDate = $(this).data('start-date');
                const endDate = $(this).data('end-date');
                const title = $(this).data('title');
                removeEvent(startDate, endDate, title);
            });

            $('#prevMonth').on('click', function () {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
            });

            $('#nextMonth').on('click', function () {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
            });

            generateCalendar(currentMonth, currentYear);
        });

        function fetchEvents() {
                $.ajax({
                    url: '<?php echo $_SERVER["PHP_SELF"]; ?>',
                    method: 'GET',
                    data: { action: 'get_events' },
                    dataType: 'json',
                    success: function (data) {
                        events = data;
                        generateCalendar(currentMonth, currentYear);
                    },
                    error: function (error) {
                        console.error("Error fetching events:", error);
                    }
                });
            }

            let currentMonth = new Date().getMonth();
            let currentYear = new Date().getFullYear();

            // JavaScript functions here

            // PHP code for handling form submission and database interaction
            <?php
            $servername = "localhost"; // Change this to your MySQL server name
            $username = "root"; // Change this to your MySQL username
            $password = ""; // Change this to your MySQL password
            $dbname = "test"; // Change this to your database name

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $start_date = $_POST['startDate'];
                $end_date = $_POST['endDate'];
                $title = $_POST['title'];

                $stmt = $conn->prepare("INSERT INTO events (start_date, end_date, title) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $start_date, $end_date, $title);

                if ($stmt->execute()) {
                    echo "fetchEvents();"; // Refresh events after adding
                } else {
                    echo "alert('Error adding event');";
                }

                $stmt->close();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_events') {
                $sql = "SELECT * FROM events";
                $result = $conn->query($sql);

                $events = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $events[] = $row;
                    }
                }

                echo "var events = " . json_encode($events) . ";";
            }

            $conn->close();
            ?>

            // Initialize calendar after PHP processing
            fetchEvents();
    </script>
    </script>
    </div>
    @endsection