@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Distribution Page</h2>
        </div>
        <div class="dropdown-top">
            <a href="/inventory">Inventory</a> |
            <a href="/input-output">Input-Output Item</a>|
            <a href="/distribution">Distribution</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

<section class="breadcrumbs">
    <div class="breadcrumbs-all">
        <a href="/inventory">Inventory ></a>
        <a href="/input-output">Input-Output Item ></a>
        <a href="/distribution">Distribution</a>
    </div>
</section>
</div>
@endsection

