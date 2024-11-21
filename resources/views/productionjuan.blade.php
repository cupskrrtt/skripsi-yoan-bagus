@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Production</h2>
            </div>
            <div class="dropdown-top">
                <a href="/planning">Production</a> |
                <a href="/workforce">Schedule</a>
            </div>
            <div class="user-info">
                <img src="image2.jpg" alt="">
            </div>
        </div>
    </div>  

    {{-- datepicker --}}
    <section class="container-date">
        <div class="row g-3">
            <div class="col-date">
                <div class="input-group date" id="startdatepicker">
                    <input type="text" class="form-control" placeholder="Start Date" style="font-size: 12px">
                    <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                </div>
            </div>
            <div class="col-date">
                <div class="input-group date" id="enddatepicker">
                    <input type="text" class="form-control" placeholder="End Date" style="font-size: 12px">
                    <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- form --}}
    <section class="form">
      @csrf
        <div class="row g-3 mb-3">
            <div class="col-new">
                <input id="selectedID" type="text" class="form-control" placeholder="New Item" aria-label="ID" readonly>
            </div>
        </div>
        <div class="row g-3">
            <div class="col production">
                <input name="name" id="productName" type="text" class="form-control" placeholder="Nama" aria-label="Nama">
            </div>
            <div class="col">
                <select name="type_id" id="productType" placeholder="Tipe" class="form-select mb-3" aria-label="Default select example">
                    <option selected>Tipe</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3">
            <div class="container mt-3">
                <div class="col">
                    <select name="category_id" id="productCategory" class="form-select mb-3" aria-label="Default select example">
                        <option selected>Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
            <select name="size_id" id="productSize" class="form-select mb-3" aria-label="Default select example">
                <option selected>Size</option>
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
            </div>
          </div>
        <div class="row g-3">
            <div class="col">
            <select name="color_id" id="productColor" class="form-select mb-3" aria-label="Default select example">
                <option selected>Warna</option>
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="col">
            <select name="sign_id" id="productSign" class="form-select mb-3" aria-label="Default select example">
                <option selected>Merk</option>
                @foreach($signs as $sign)
                    <option value="{{ $sign->id }}">{{ $sign->name }}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col">
              <input name="code" id="productCode" type="text" class="form-control" placeholder="Kode" aria-label="Kode">
            </div>
            <div class="col">
              <input name="purchase_price" id="productPurchasePrice" type="text" class="form-control" placeholder="Harga Beli" aria-label="Harga Beli" readonly>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col">
              <input name="selling_price" id="productSellingPrice" type="text" class="form-control" placeholder="Harga Jual" aria-label="Harga Jual">
            </div>
            <div class="col">
              <input name="stock" id="productStock" type="text" class="form-control" placeholder="Stok" aria-label="Stok">
            </div>
        </div>

    <button type="button" id="pilih-material" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Pilih Material</button>
      
    {{---Modal---}}
    <div class="modal fade mb-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Material</h1>
                    <button type="button" onclick="revertModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <!-- Selected Materials Section -->
                        <div id="selectedMaterials" class="flex-fill me-3">
                            <h3>Selected Materials</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Material</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">HTM</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedMaterialsBody">
                                    <!-- Selected materials will be dynamically added here -->
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <h3>Total HTM: <span id="totalHTM">0</span></h3>
                            </div>
                        </div>
                        <!-- Materials Table Section -->
                        <div class="flex-fill">
                            <h3>Available Materials</h3>
                            <table id="materials-table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Material</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">HTM</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Materials data will be dynamically added here by DataTables -->
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
    </section>

    {{-- Tables --}}
    <section class="home-tbl">
            <table id="products-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Size</th>
                        <th scope="col">Warna</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Materials</th>
                        <th scope="col">Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
    </section>

    <!-- Include jQuery -->

    <script>
        $(document).ready(function() {
            $('#productCategory').select2({
                placeholder: "Pilih kategori",
                allowClear: true,
                width: '100%'  // Menyesuaikan lebar select2 dengan elemen aslinya
            });
        });
    </script>

    <script src="/js/productScript.js"></script>
@endsection
