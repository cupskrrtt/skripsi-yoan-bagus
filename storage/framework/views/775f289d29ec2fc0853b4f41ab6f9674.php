<?php $__env->startSection('container'); ?>

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Inventory Page</h2>
        </div>
        
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cup/personal/dev/projects/skripsi-yoan-bagus/resources/views/inventory.blade.php ENDPATH**/ ?>