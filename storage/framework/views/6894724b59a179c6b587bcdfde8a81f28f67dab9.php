<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Daftar Project Release</div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <?php $__currentLoopData = $useritem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ust): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($ust->FK_ID_ITEM == $itm->ID 
                                        && $itm->STATUS != "COMPLETED"
                                        && $ust->STATUS == "OPEN"): ?>
                                        <a href="/OPR/history/item/<?php echo e($itm->ID); ?>"}}> 
                                            <?php echo e($itm->NM_ITEM); ?>

                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>