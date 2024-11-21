@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Report Page</h2>
        </div>
        <div class="dropdown-top">
            <a href="/cash">Cash Book</a>
            <a href="">|</a>
            <a href="/report" class="active">Report</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

<!-- @AR, start -->
    <div class="row row-cols-2 row-cols-md-2 g-3">
        <div class="col">
            <h3>Profit (All-Time)</h3>
            <div class="container">
                <table id="all-time-profit-report-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Period</th>
                            <th scope="col">Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <h3>Expenditure (All-Time)</h3>
            <div class="container">
                <table id="all-time-expenditure-per-material-report-table"  class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Period</th>
                            <th scope="col">Material</th>
                            <th scope="col">Expenditure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />

<script src="/js/reportScript.js"></script>
<!-- @AR, end -->

@endsection

