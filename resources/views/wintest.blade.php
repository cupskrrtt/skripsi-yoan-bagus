<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Schedule</title>
    <style>
        /* Custom styles for the timeline view */
        .timeline-container {
            margin-top: 20px;
        }
        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .timeline-header h2 {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container-cs timeline-container">
    <div class="timeline-header">
        <h2>Timeline</h2>
        <div>
            <button class="btn btn-primary">Project View</button>
            <button class="btn btn-secondary">Calendar View</button>
            <select class="btn btn-light">
                <option>February</option>
                <!-- Add more months as needed -->
            </select>
            <button class="btn btn-success">Add New</button>
        </div>
    </div>
    <div id="calendar"></div>
</div>


</body>
</html>
@extends('layouts/main')

@section('container')

<div class="container-cs timeline-container">
    <div class="timeline-header">
        <h2>Timeline</h2>
        <div>
            <button class="btn btn-primary">Project View</button>
            <button class="btn btn-secondary">Calendar View</button>
            <select class="btn btn-light">
                <option>February</option>
                <!-- Add more months as needed -->
            </select>
            <button class="btn btn-success">Add New</button>
        </div>
    </div>
    <div id="calendar"></div>
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
            ]
        });
    });
</script>


@endsection