<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Welcome Technical Support</div>

                <div class="panel-body">
                    Hello  <?php echo e(Auth::user()->name); ?> <br />
                    Email Anda  <?php echo e(Auth::user()->email); ?> <br />
                    Anda Login dengan Username : <?php echo e(Auth::user()->username); ?> <br />
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>