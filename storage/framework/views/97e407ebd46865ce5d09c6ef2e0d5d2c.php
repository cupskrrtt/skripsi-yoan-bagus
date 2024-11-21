<?php $__env->startSection('container'); ?>

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cup/personal/dev/projects/skripsi-yoan-bagus/resources/views/distribution.blade.php ENDPATH**/ ?>