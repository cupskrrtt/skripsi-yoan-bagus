@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Project</h2>
            </div>
            <div class="dropdown-top">
                {{-- <a href="/planning">Capacity Production</a>
                <a href="">|</a> --}}
                <a href="/schedule">Schedule</a>
                <a href="">|</a>
                <a href="/project" class="active">Project</a>
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
            <input id="ID" type="text" class="form-control" placeholder="New Project" aria-label="ID" readonly>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col production">
            <label for="" class="form-label">Project Name</label>
            <input name="name" id="projectName" type="text" class="form-control" placeholder="Project Name" aria-label="Nama">
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">Start Date</label>
        <input type="text" class="form-control datepicker" id="projectStartDate" placeholder=" Start Date" required>
    </div>
    <div class="form-group mb-3">
        <label for="" class="form-label">End Date</label>
        <input type="text" class="form-control datepicker" id="projectEndDate" placeholder=" End Date">
    </div>
    <div class="row g-3 ">
        <div class="col-new">
            <label for="" class="form-label">Status</label>
        <select id="projectStatus" class="form-select mb-3" placeholder="Status" aria-label="Status">
            <option selected hidden>Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>    
        </div>
    </div>
    
<button type="button" id="pilih-product" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Choose Product</button>
  
{{---Modal---}}
<div class="modal fade mb-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose Product</h1>
                <button type="button" onclick="revertModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <!-- Selected Products Section -->
                    <div class="flex-fill me-3">
                        <h3>Selected Products</h3>
                        <table id="selectedProductsTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="selectedProductsBody">
                                <!-- Selected Products will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Products Table Section -->
                    <div class="flex-fill">
                        <h3>Available Products</h3>
                        <table id="products-table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Products data will be dynamically added here by DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="revertModal()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="closeModal();selectedModal();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div>
    <button type="button" id="create-button" class="btn btn-primary">Create</button>
    <button type="button" id="update-button" class="btn btn-success">Update</button>
    <button type="button" id="delete-button" class="btn btn-danger">Delete</button>
    <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear Form</button>
</div>
</div>

{{-- filter --}}
<div class="filter-container">
    <label for="">Start Date:
        <input type="text" id="date-filter-start">
    </label>
    <label for="">End Date:
        <input type="text" id="date-filter-end">
    </label>
    <label for="">Status:
        <select id="status-filter">
            <option value="">All</option>
            <option value="">Scheduled</option>
            <option value="">Modeling</option>
            <option value="">Packing</option>
            <option value="">Cutting</option>
        </select>
    </label>    
</div>

{{-- Tables --}}
<div class="home-tbl">
        <table id="projects-table" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Products</th>
                    <th scope="col">Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</div>

<style>

.dropdown-button {
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: white;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
    outline: none;
}

.dropdown-menu {
    position: absolute;
    width: 300px; /* Adjust as needed */
    border: 1px solid #ccc;
    background: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 10px;
    border-radius: 5px;
    display: none; /* Initially hidden */
    z-index: 1000;
}

.search-input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.contact-list label {
    display: block;
    margin-bottom: 5px;
}

button {
    padding: 5px 10px;
    margin-right: 5px;
    border-radius: 4px;
    border: none;
    background-color: #f1f1f1;
    cursor: pointer;
}

button:hover {
    background-color: #ddd;
}

</style>

<script>
    function toggleDropdown() {
    var dropdown = document.querySelector('.dropdown-menu');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

function closeDropdown() {
    document.querySelector('.dropdown-menu').style.display = 'none';
}

function clearSearch() {
    document.getElementById('searchInput').value = '';
    filterContacts();
    document.getElementById('dropdownButton').innerHTML = 'Contacts: All'; // Reset button label
}

function filterContacts() {
    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    var labels = document.querySelectorAll('.contact-list label');

    labels.forEach(label => {
        var txtValue = label.textContent || label.innerText;
        label.style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
    });
}

document.getElementById('searchInput').addEventListener('keyup', function() {
    var value = this.value;
    document.getElementById('dropdownButton').innerHTML = value ? `Contacts: ${value}` : 'Contacts: All';
});


</script>

<script src="/js/projectScript.js"></script>


@endsection
