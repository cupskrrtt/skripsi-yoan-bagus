@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Utility Page</h2>
            </div>
            <div class="dropdown-top"></div>
            <div class="user-info">
                <img src="image2.jpg" alt="">
            </div>
        </div>
    </div>  

    <!-- @Utility, start -->
    <div class="row row-cols-2 row-cols-md-2 g-3">
        <!-- Machine Table -->
        <div class="col">
            <h3>Machine</h3>
            <div class="container">
                <table id="machine-utility-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Project</th>
                            <th scope="col">Machine</th>
                            <th scope="col">Date</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody id="machine-utility-table-body">
                        <!-- Data from the database will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Employee Table -->
        <div class="col">
            <h3>Employee</h3>
            <div class="container">
                <table id="employee-utility-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Project</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody id="employee-utility-table-body">
                        <!-- Data from the database will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br />
    <!-- Report Table -->
    <div class="row row-cols-3 row-cols-md-2 g-3">
        <div class="col">
            <h3>Report</h3>
            <div class="container">
                <form id="reportForm">
                    @csrf
                    <div class="mb-3">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="project">ID Project</label>
                        <input type="text" class="form-control" id="idProject" required>
                    </div>
                    <div class="mb-3">
                        <label for="product">Product</label>
                        <input type="text" class="form-control" id="product" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Description</label>
                        <textarea class="form-control" id="description" rows="2" required></textarea>
                    </div>    
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
        <!-- Utility Table -->
        <div class="col">
            <h3>Utility Table</h3>
            <div class="container">
                <table id="report-utility-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">ID Project</th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                        <!-- Data from AJAX will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br />
    <!-- New Section for Employee and Machine Reports -->
    <div class="row row-cols-2 row-cols-md-2 g-3">
        <!-- Machine Report -->
        <div class="col">
            <h3>Machine Report</h3>

            <!-- Form to select year and month for machine report -->
            <form method="GET" action="{{ route('utility') }}">
                <div class="form-group">
                    <label for="year_machine">Pilih Tahun</label>
                    <select id="year_machine" name="year_machine" class="form-control">
                        @for ($i = 2020; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" {{ request('year_machine') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="month_machine">Pilih Bulan</label>
                    <select id="month_machine" name="month_machine" class="form-control">
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month_machine') == $m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Lihat Laporan</button>
            </form>

            <!-- Display the machine report -->
            @if(isset($machineReport) && $machineReport->isNotEmpty())
            <div class="table-responsive mt-5">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project</th>
                            <th>Machine</th>
                            <th>Date</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($machineReport as $report)
                        <tr>
                            <td>{{ $report->machine ? $report->machine->id : 'No Machine ID' }}</td>
                            <td>{{ $report->project_id }}</td>
                            <td>{{ $report->machine ? $report->machine->name : 'No Machine Name' }}</td>
                            <td>{{ $report->date }}</td>
                            <td>{{ $report->task }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p>No machine reports available for the selected month and year.</p>
            @endif
        </div>

        <!-- Employee Report -->
        <div class="col">
            <h3>Employee Report</h3>

            <!-- Form to select year and month for employee report -->
            <form method="GET" action="{{ route('utility') }}">
                <div class="form-group">
                    <label for="year">Pilih Tahun</label>
                    <select id="year" name="year" class="form-control">
                        @for ($i = 2020; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="month">Pilih Bulan</label>
                    <select id="month" name="month" class="form-control">
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Lihat Laporan</button>
            </form>

            <!-- Display the employee report with work count -->
            @if(isset($workReport) && $workReport->isNotEmpty())
            <div class="table-responsive mt-5">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Bekerja Selama Bulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workReport as $report)
                        <tr>
                            <td>{{ $report->workforce ? $report->workforce->name : 'No Name' }}</td>
                            <td>{{ $report->work_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p>No reports available for the selected month and year.</p>
            @endif
        </div>
    </div>

    <script src="/js/utilityScript.js"></script>
    <!-- @Utility, end -->

@endsection
