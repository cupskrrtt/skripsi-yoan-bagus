@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Schedule</h2>
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

<section class="timeline-container">
    <div class="timeline-header">
        <h2>Timeline</h2>
        <div>
            <button class="btn btn-secondary">Calendar View</button>
            <button class="btn btn-primary">Project View</button>
            <select class="btn btn-light" id="monthSelect">
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
            <button class="btn btn-success" id="addNewButton">Add New</button>
        </div>
    </div>
        <div id="calendar"></div>
</section>

<!-- Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <div class="form-group">
                        <label for="eventTitle">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="eventStart">Start Date</label>
                        <input type="text" class="form-control datepicker" id="eventStart" required>
                    </div>
                    <div class="form-group">
                        <label for="eventEnd">End Date</label>
                        <input type="text" class="form-control datepicker" id="eventEnd">
                    </div>
                    <div class="form-group">
                        <label for="eventColor">Event Color</label>
                        <input type="color" class="form-control" id="eventColor" value="#ff9f89">
                    </div>
                    <div class="form-group">
                        <label for="eventTextColor">Text Color</label>
                        <input type="color" class="form-control" id="eventTextColor" value="#000000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="revertModal()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEventButton">Save Event</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2024-02-14',
            editable: true,
            buttonText: {
                today: 'Today',
                month: 'Month View',
                week: 'Week View',
                day: 'Day View'
            },
            events: [
                {
                    title: 'Hijab Design',
                    start: '2024-02-14',
                    end: '2024-02-15'
                },
                {
                    title: 'Hijab Cutting',
                    start: '2024-02-16'
                },
                {
                    title: 'Hijab Sewing',
                    start: '2024-02-17',
                    end: '2024-02-18'
                },
                {
                    title: 'Hijab Finishing',
                    start: '2024-02-19'
                },
                {
                    title: 'Hijab Packaging',
                    start: '2024-02-20'
                }
            ],
            dayClick: function(date) {
                $('#eventStart').val(date.format('YYYY-MM-DD'));
                $('#eventEnd').val(date.format('YYYY-MM-DD'));
                $('#addEventModal').modal('show');
            }
        });
    });

    // Initialize datepicker
    $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });

        // Show modal on button click
        $('#addNewButton').click(function() {
            $('#addEventModal').modal('show');
        });

        // Save event
    $('#saveEventButton').click(function() {
        var eventTitle = $('#eventTitle').val();
        var eventStart = $('#eventStart').val();
        var eventEnd = $('#eventEnd').val();
        var eventColor = $('#eventColor').val();
        var eventTextColor = $('#eventTextColor').val();


        if(eventTitle && eventStart) {
            $('#calendar').fullCalendar('renderEvent', {
                title: eventTitle,
                start: eventStart,
                end: eventEnd,
                color: eventColor,
                textColor: eventTextColor
            }, true); // stick the event

            $('#addEventModal').modal('hide');
            $('#addEventForm')[0].reset();
        } else {
                alert("Please enter the required details.");
        }
        });

    // Change calendar month based on dropdown selection
    $('#monthSelect').change(function() {
        var selectedMonth = $(this).val();
        var currentYear = (new Date()).getFullYear();
        var date = new Date(currentYear, selectedMonth, 1);

        $('#calendar').fullCalendar('gotoDate', date);
    });

</script>
@endsection

