<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
<!--         <div class="col-md-8 col-md-offset-2"> -->

            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                Daftar Siap UAT
                            </div>

                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <?php $__currentLoopData = $useritem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ust): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <?php if($ust->FK_ID_ITEM == $itm->ID
                                                    && $itm->STATUS != "COMPLETED" && $ust->STATUS != 'REJECTED'): ?>
                                                    <a href="/QA/history/item/<?php echo e($itm->ID); ?>"}}> 
                                                        <?php echo e($itm->NM_ITEM); ?>

                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td width="50%">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                Daftar Siap PIR
                            </div>

                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <?php $__currentLoopData = $hisotem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $his): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php $__currentLoopData = $pir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <?php if($his->UPLOAD_STAT == 'NOT'
                                                    && $his->FK_ID_ITEM == $pr->FK_ID_PROJECT): ?>

                                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                                            <?php if($his->FK_ID_ITEM == $itm->ID): ?>
                                                                <a href="/QA/upload/doc/<?php echo e($his->FK_ID_ITEM); ?>"}}> 
                                                                    <?php echo e($itm->NM_ITEM); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
<!--         </div> -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>