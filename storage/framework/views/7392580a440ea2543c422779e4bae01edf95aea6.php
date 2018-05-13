<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Upload Document</h3>
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
                            <th scope="col" width="34%" >
                                Upload File
                            </th>
                            <th scope="col" width="10%" >
                            </th>
                        </tr>
                        <!-- <form id="upload-file" class="form-horizontal" role="form" method="post" action="<?php echo e(url('/upload/doc')); ?>"  enctype="multipart/form-data"> -->
                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $his): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <form id="upload-file" class="form-horizontal" role="form" method="post" action="<?php echo e(url('/QA/store/doc')); ?>"  enctype="multipart/form-data">
                            <?php $__currentLoopData = $document; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php if($his->FK_ARSIP_REQ == $doc->ID && $doc->Mandatory == "YES"): ?>
                                <tr class="$doc<?php echo e($doc->ID); ?>">
                                    <td align="center"> <?php echo e($doc->ID); ?> </td>
                                    <td><?php echo e($doc->NM_ARSIP); ?></td>
                                    <td>
                                    	<div class="row">
        									<div class="input-field col s6">
        										<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

        										<input type="hidden" id="fk_arsip_req" name="fk_arsip_req" value="<?php echo e($his->FK_ARSIP_REQ); ?>">

        										<input type="hidden" id="fk_id_item" name="fk_id_item" value="<?php echo e($his->FK_ID_ITEM); ?>">
        										
        										<input type="hidden" id="nm_arsip" name="nm_arsip" value="<?php echo e($doc->NM_ARSIP); ?>">
          										
          										<input type="file" id="inputDOC" name="inputDOC" class="validate">

          										<?php if($his->UPLOAD_STAT == "OK"): ?>
                                                    <a href="/download/<?php echo e($his-> FK_ID_ITEM); ?>/<?php echo e($his->FK_ARSIP_REQ); ?>"}}>
                                                    <?php echo e($doc->NM_ARSIP); ?>

                                                    </a>
                                                <?php endif; ?>
        									</div>
      									</div>
                                    </td>
                                    <td>
                                    <?php if($useritem->STATUS == 'OPEN'): ?>
                                    	<button type="submit" class="btn btn-primary">
                                    		Upload
                                		</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-primary" disabled="true">
                                            Upload
                                        </button>
                                    <?php endif; ?>
                                    </td>
                                <?php else: ?>
                                    <?php if($his->FK_ARSIP_REQ == $doc->ID && 
                                    $doc->Mandatory == "NO"): ?>
                                        <?php if($pir): ?>
                                            <tr class="$doc<?php echo e($doc->ID); ?>">
                                                <td align="center"> <?php echo e($doc->ID); ?> </td>
                                                <td><?php echo e($doc->NM_ARSIP); ?></td>
                                                <td>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                                        <input type="hidden" id="fk_arsip_req" name="fk_arsip_req" value="<?php echo e($his->FK_ARSIP_REQ); ?>">

                                                        <input type="hidden" id="fk_id_item" name="fk_id_item" value="<?php echo e($his->FK_ID_ITEM); ?>">
                                                
                                                        <input type="hidden" id="nm_arsip" name="nm_arsip" value="<?php echo e($doc->NM_ARSIP); ?>">
                                                
                                                        <input type="file" id="inputDOC" name="inputDOC" class="validate">

                                                        <?php if($his->UPLOAD_STAT == "OK"): ?>
                                                            <a href="/download/<?php echo e($his-> FK_ID_ITEM); ?>/<?php echo e($his->FK_ARSIP_REQ); ?>"}}>
                                                                <?php echo e($doc->NM_ARSIP); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">
                                                Upload
                                            </button>
                                        </td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </tr>
                        </form>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if($useritem->STATUS == 'OPEN'): ?>
        <div class="input-group">
            <textarea id="textarea-input-QA" class="form-control custom-control" rows="5" style="resize:none">
            </textarea>     
            <span id="textarea-button-QA" class="input-group-addon btn btn-primary">Submit</span>
        </div>
    <?php endif; ?>

    <?php if($userOPR->STATUS == 'APPROVED'): ?>
        <div class="input-group">
            <a href="/document/opr/<?php echo e($his-> FK_ID_ITEM); ?>"}} align="right">
                <button type="button" class="btn btn-info btn-sm">
                    Lanjut
                </button>                              
            </a>
        </div>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>