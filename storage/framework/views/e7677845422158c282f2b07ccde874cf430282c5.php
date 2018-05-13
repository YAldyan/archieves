<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Project Accomplished</h3>
            <div class="panel panel-default">
                <div class="panel-body">    
                    <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="/QA/history/item/<?php echo e($itm->ID); ?>">
                                <?php echo e($itm->NM_ITEM); ?>

                            </a>
                        </li>
                    </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>