

<?php $__env->startSection('container'); ?>


<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Material</h2>
            </div>
            <div class="dropdown-top">
                <a href="/product">Product</a>
                <a href="">|</a>
                <a href="/material" class="active">Material</a>
            </div>
            <div class="user-info">
                <img src="image2.jpg" alt="">
            </div>
        </div>
    </div>


<div class="form">
  <?php echo csrf_field(); ?>
    <div class="row g-3 mb-3">
        <div class="col-new">
            <input id="ID" type="text" class="form-control" placeholder="New Material" aria-label="ID" readonly>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="" class="form-label">Material Name</label>
            <input name="name" id="materialName" type="text" class="form-control" placeholder="Material Name" aria-label="Nama">
        </div>
        <div class="col">
            <label for="" class="form-label">Stock</label>
          <input name="stock" id="materialStock" type="text" class="form-control" placeholder="Stock" aria-label="Stock">
        </div>
    </div>

    <div class="row g-3">
        <div class="col">
            <label for="" class="form-label">Unit</label>
            <select name="unit_id" id="materialUnit" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Unit</option>
            <?php $__currentLoopData = $materialunits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        <div class="col">
            <label for="" class="form-label">Category</label>
            <select name="category_id" id="materialCategory" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Category</option>
            <?php $__currentLoopData = $materialcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col">
            <label for="" class="form-label">Material Code</label>
            <input name="code" id="materialCode" type="text" class="form-control" placeholder="Material Code" aria-label="Kode">
        </div>
        <div class="col">
            <label for="" class="form-label">Purchase Price</label>
            <!-- @AR, start -->
            <!-- <input name="purchase_price" id="materialPurchasePrice" type="text" class="form-control" placeholder="Purchase Price" aria-label="Harga Beli"> -->
            <!-- sementara pake inline style dulu -->
            <input name="purchase_price" id="materialPurchasePrice" type="text" class="form-control" placeholder="Purchase Price" aria-label="Purchase Price" style="background-color: #FFFF; color: #000">
            <!-- @AR, end -->
        </div>
    </div>

<div>
    <button type="button" id="create-button" class="btn btn-primary">Create</button>
    <button type="button" id="update-button" class="btn btn-success">Update</button>
    <button type="button" id="delete-button" class="btn btn-danger">Delete</button>
    <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear Form</button>
</div>

</div>

<div class="home-tbl">
    <table id="materials-table" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Material Name</th>
                <th scope="col">Stock</th>
                <th scope="col">Unit</th>
                <th scope="col">Category</th>
                <th scope="col">Code</th>
                <th scope="col">Purchase Price</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script src="/js/materialScript.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel2.0\TA-2\resources\views/material.blade.php ENDPATH**/ ?>