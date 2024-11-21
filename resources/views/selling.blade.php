@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Selling</h2>
        </div>
        <div class="dropdown-top">
            <a href="/selling" class="active">Selling</a>
            <a href="">|</a>
            <a href="/selling/transaction">Transaction</a>
            <a href="">|</a>
            <a href="/selling/item">Item</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

{{-- form --}}
<div class="form">
  @csrf
    <div class="row g-3 mb-3">
        <div class="col-new">
            <input id="ID" type="text" class="form-control" placeholder="Selling" aria-label="ID" readonly>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="customerName">Customer</label>
            <select name="name" id="customerName" class="form-control" aria-label="Customer Name">
                <option selected hidden>Select a customer</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}" data-discount="{{ $customer->customerclass->discount }}">
                    {{ $customer->name }} ({{ $customer->customerclass->discount }}%)
                </option>
                @endforeach 
            </select>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col">
            <label for="" class="form-label">Total</label>
            <input id="totalPrice" type="text" class="form-control" placeholder="Total" readonly>
        </div>
        <div class="col">
            <label for="" class="form-label">Paid</label>
            <input id="paid" type="text" class="form-control" placeholder="Paid">
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <label for="">Payment</label>
            <select id="Payment" class="form-select mb-3" aria-label="Default select example">
                <option selected hidden>Payment</option>
                @foreach($payments as $payment)
                    <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="button" id="pilih-product" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Choose Products</button>
  
{{---Modal---}}
<div class="modal fade mb-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal-sell">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose Product</h1>
                <button type="button" onclick="revertModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <!-- Selected Materials Section -->
                    <div class="flex-fill me-3">
                        <h3>Selected Products</h3>
                        <table id="selectedItemsTable" class="table">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Code</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Afer Discount</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="selectedItemsBody">
                                <!-- Selected materials will be dynamically added here -->
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <h3>Total HTM: <span id="totalHTM">0</span></h3>
                        </div>
                    </div>
                    <!-- Materials Table Section -->
                    <div class="flex-fill">
                        <h3>Available Products</h3>
                        <table id="products-table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">After Discount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="revertModal()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveChanges" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

    <div>
        <button type="button" id="create-button" class="btn btn-primary">Sell</button>
        <button type="button" id="saveChangesOut" class="btn btn-primary">Save changes</button>
    </div>
</div>

<div class="filter-container">
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

<div class="home-tbl">
    <table id="selling-table" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Size</th>
                <th scope="col">Code</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Afer Discount</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</section>


<script src="/js/selling.js"></script>

@endsection

