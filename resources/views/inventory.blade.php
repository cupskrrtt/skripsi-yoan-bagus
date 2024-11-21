@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Inventory Page</h2>
        </div>
        {{-- <div class="dropdown-top" class="inventory-link">
            <a href="/inventory">Inventory</a> |
            <a href="/input-output">Input-Output Item</a>|
            <a href="/distribution">Distribution</a>
        </div> --}}
        <div class="dropdown-top" class="inventory-link">
            <a href="/production">Product</a> |
            <a href="/material">Material</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

<section class="breadcrumbs">
    <div class="breadcrumbs-all">
        <a href="/inventory">Inventory</a>
    </div>
</section>
</div>
@endsection

