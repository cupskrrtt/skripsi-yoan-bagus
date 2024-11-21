@extends('layouts/main')

@section('container')


<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Item</h2>
        </div>
        <div class="dropdown-top">
            <a href="/purchase">Purchase</a>
            <a href="">|</a>
            <a href="/purchase/transaction">Transaction</a>
            <a href="">|</a>
            <a href="/purchase/item" class="active">Item</a>
        </div>
        <div class="user-info">
            <img src="../image2.jpg" alt="">
        </div>
        </div>
    </div>  

<div class="filter-container-item">
    <label for="">Position:
    <select id="position-filter">
        <option value="">All</option>
        <option value="">Potong</option>
        <option value="">Setrika</option>
        <option value="">Jahit</option>
    </select>
    </label>
    <label for="">Status:
    <select id="status-filter">
        <option value="">All</option>
        <option value="">Masuk</option>
        <option value="">Izin</option>
        <option value="">Sakit</option>
        <option value="">Bolos</option>
    </select>
    </label>
</div>

<section class="home">
    <table id="transaction-table" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Paid</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Product</th>
                <th scope="col">Time</th>
                <th scope="col">Time</th>
                <th scope="col">Time</th>
                <th scope="col">Time</th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</section>
<script src="/js/purchaseItem.js"></script>

@endsection

