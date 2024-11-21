<?php $__env->startSection('container'); ?>

<script src="/js/workforceScript.js"></script>
<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Workforce Availability</h2>
        </div>
        <div class="dropdown-top">
            <a href="/machine">Machine</a>
            <a href="">|</a>
            <a href="/workforce" class="active">Workforce</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  





<section class="form">
  <?php echo csrf_field(); ?>
    <div class="row g-3 mb-3">
        <div class="col-new">
            <!-- @AR, start -->
            <!-- <input id="ID" type="text" class="form-control" placeholder="Workforce" aria-label="ID" readonly> -->
            <input id="ID" type="text" class="form-control" placeholder="New Workforce" aria-label="ID" readonly>
            <!-- @AR, end -->
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="">Name</label>
            <!-- @AR, start -->
            <!-- <input name="name" id="workforceName" type="text" class="form-control" placeholder="Name" aria-label="Nama"> -->
            <input name="name" id="workforceName" type="text" class="form-control" placeholder="Workforce Name" aria-label="Nama">
            <!-- @AR, end -->
        </div>
    </div>

    <div class="row g-3">
        <div class="col">
            <label for="">Position</label>
        <select name="position_id" id="workforcePosition" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Position</option>
            <?php $__currentLoopData = $workforcepositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($position->id); ?>"><?php echo e($position->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        <div class="col">
            <label for="">Status</label>
            <select name="status_id" id="workforceStatus" class="form-select mb-3" aria-label="Default select example">
                <option selected hidden>Status</option>
                <?php $__currentLoopData = $workforcestatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

<div>
    <button type="button" id="create-button" class="btn btn-primary">Create</button>
    <button type="button" id="update-button" class="btn btn-success">Update</button>
    <button type="button" id="delete-button" class="btn btn-danger">Delete</button>
    <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear Form</button>
</div>

</section>

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

<style>
    .selected {
        background-color: #d1e7dd !important; /* Highlight color */
    }
</style>

<section class="home-tbl">
    <table id="workforce-table" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cup/personal/dev/projects/skripsi-yoan-bagus/resources/views/workforce.blade.php ENDPATH**/ ?>