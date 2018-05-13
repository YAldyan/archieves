<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Upload Document Proyek Pengembangan</h3>
            <div class="panel panel-default">
                <div class="panel-body">       
                    <table class="table table-striped" id="table">
                        <tr>
                            <th scope="col" width="4%" >
                                No
                            </th>
                            <th scope="col" width="52%" >
                                Jenis Dokumen
                            </th>
                            <th scope="col" width="44%" >
                                Download File
                            </th>
                        </tr>
                        <!-- <form id="upload-file" class="form-horizontal" role="form" method="post" action="<?php echo e(url('/upload/doc')); ?>"  enctype="multipart/form-data"> -->
                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $his): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <form id="upload-file" class="form-horizontal" role="form" method="post" action="<?php echo e(url('/upload/doc')); ?>"  enctype="multipart/form-data">
                            <?php $__currentLoopData = $document; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php if($his->FK_ARSIP_REQ == $doc->ID ): ?>
                                <tr class="$doc<?php echo e($doc->ID); ?>">
                                    <td align="center"> <?php echo e($doc->ID); ?> </td>
                                    <td><?php echo e($doc->NM_ARSIP); ?></td>
                                    <td>
                                    	<div class="row">
        									<div class="input-field col s6">

          										<?php if($his->UPLOAD_STAT == "OK"): ?>
                                                    <a href="/download/<?php echo e($his-> FK_ID_ITEM); ?>/<?php echo e($his->FK_ARSIP_REQ); ?>"}}>
                                                    <?php echo e($doc->NM_ARSIP); ?>

                                                    </a>
                                                <?php endif; ?>
        									</div>
      									</div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </form>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group">
        <?php if($useritem->STATUS == "OPEN"): ?>
            <button id-item='<?php echo e($his-> FK_ID_ITEM); ?>' id="rejected-png" type="button" class="btn btn-info btn-sm">
                Reject
            </button> 
        <?php endif; ?>
        <a href="/QA/upload/doc/<?php echo e($his->FK_ID_ITEM); ?>"}} align="right">
            <button type="button" class="btn btn-info btn-sm">
                Lanjut
            </button>                              
        </a>
    </div>
</div>

<?php echo e($history->render()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>