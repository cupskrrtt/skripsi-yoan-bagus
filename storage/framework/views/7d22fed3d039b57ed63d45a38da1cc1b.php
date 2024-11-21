

<?php $__env->startSection('container'); ?>

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Product</h2>
            </div>
            <div class="dropdown-top">
                <a href="/product" class="active">Product</a>
                <a href="">|</a>
                <a href="/material">Material</a>
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
            <input id="ID" type="text" class="form-control" placeholder="New Product" aria-label="ID" readonly>
        </div>
    </div>
    <div class="row g-3">
        <div class="col production">
            <label for="" class="form-label">Product Name</label>
            <input name="name" id="productName" type="text" class="form-control" placeholder="Product Name" aria-label="Nama">
        </div>
        <div class="col">
            <label for="" class="form-label">Type</label>
            <select name="type_id" id="productType" placeholder="Type" class="form-select mb-3" aria-label="Default select example">
                <option selected hidden>Type</option>
                <?php $__currentLoopData = $typess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <label for="" class="form-label">Category</label>
            <select name="category_id" id="productCategory" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Category</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        <div class="col">
            <label for="" class="form-label">Size</label>
            <select name="size_id" id="productSize" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Size</option>
            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($size->id); ?>"><?php echo e($size->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
      </div>
    <div class="row g-3">
        <div class="col">
            <label for="" class="form-label">Color</label>
            <select name="color_id" id="productColor" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Color</option>
            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        <div class="col">
            <label for="" class="form-label">Merk</label>
            <select name="sign_id" id="productSign" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Merk</option>
            <?php $__currentLoopData = $signs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($sign->id); ?>"><?php echo e($sign->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="" class="form-label">Product Code</label>
            <input name="code" id="productCode" type="text" class="form-control" placeholder="Product Code" aria-label="Kode">
        </div>
        <div class="col">
            <label for="" class="form-label">Purchase Price</label>
            <input name="purchase_price" id="productPurchasePrice" type="text" class="form-control" placeholder="Purchase Price" aria-label="Harga Beli" readonly>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="" class="form-label">Selling Price</label>
            <input name="selling_price" id="productSellingPrice" type="text" class="form-control" placeholder="Selling Price" aria-label="Harga Jual">
        </div>
        <div class="col">
            <label for="" class="form-label">Stock</label>
          <input name="stock" id="productStock" type="text" class="form-control" placeholder="Stock" aria-label="Stok">
        </div>
    </div>

<button type="button" id="pilih-material" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Choose Material</button>
  

<div class="modal fade mb-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose Material</h1>
                <button type="button" onclick="revertModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <!-- Selected Materials Section -->
                    <div class="flex-fill me-3">
                        <h3>Selected Materials</h3>
                        <table id="selectedMaterialsTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Material Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Amount</th>
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
                                    <th scope="col">Material Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Amount</th>
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
</div>


<div class="home-tbl">
        <table id="products-table" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Material Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Category</th>
                    <th scope="col">Size</th>
                    <th scope="col">Color</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Code</th>
                    <th scope="col">Purchase Price</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Materials</th>
                    <th scope="col">Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</div>

<script src="/js/productScript.js"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RYZEN\OneDrive\Documents\ta\TA-2 @AR2 20241016\resources\views/product.blade.php ENDPATH**/ ?>