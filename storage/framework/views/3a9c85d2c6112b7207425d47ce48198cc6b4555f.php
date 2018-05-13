<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Daftar Dokumen</h3>
            <div class="panel panel-default">
                <div class="panel-body">       
                    <table class="table table-striped" id="table">
                        <tr>
                            <th scope="col" width="8%" >
                                ID Arsip
                            </th>
                            <th scope="col" width="15%" >
                                Jenis User
                            </th>
                            <th scope="col" width="15%" >
                                Jenis Arsip
                            </th>
                            <th scope="col" width="42%" >
                                Nama Arsip/Document
                            </th>
                            <th scope="col" width="20%" >
                            </th>
                        </tr>
                        <?php $__currentLoopData = $document; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <?php if($doc->FK_REQ == $req->ID ): ?>
                                <tr class="document<?php echo e($doc->ID); ?>">
                                    <td align='center' ><?php echo e($doc->ID); ?></td>

                                    <?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if($doc->FK_USER_ID == $prof->ID): ?>
                                            <td><?php echo e($prof->NM_PROFILE); ?></td>
                                            <td><?php echo e($req->NM_REQ); ?></td>
                                            <td><?php echo e($doc->NM_ARSIP); ?></td>
                                            <td>
                                                <button class="edit-document btn btn-info btn-sm" data-id="<?php echo e($doc->ID); ?>" data-nama="<?php echo e($doc->NM_ARSIP); ?>" user-id="<?php echo e($prof->ID); ?>" req-id='<?php echo e($req->ID); ?>'>
                                                    Edit
                                                </button>

                                                <!-- <button class="delete-document btn btn-danger btn-sm" data-id="<?php echo e($doc->ID); ?>">
                                                    Delete
                                                </button> -->
                                            </td>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </table>
                    <!-- Edit modal -->
                    <!-- class="modal-dialog modal-sm" -->
                    <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="panel panel-default">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>

                                        <div class="panel-heading">Ubah Data</div>

                                 <!--    <h4 class="modal-title">Ubah Data</h4> -->
                                    </div>

                                    <div class="panel-body">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="text" name="id-document" class="form-control" id="id-document" disabled="true">
                                                </div>
                                                <div class="form-group">
                                                    <select id="fk_req" name="fk_req" class="form-control">
                                                        <option value="Please Select">
                                                            Please Select
                                                        </option>
                                                        <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                            <option value="<?php echo e($req->ID); ?>">
                                                                <?php echo e($req->NM_REQ); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select id="fk_user_id" name="fk_user_id" class="form-control">
                                                        <option value="Please Select">
                                                            Please Select
                                                        </option>
                                                        <?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                        <option value="<?php echo e($prof->ID); ?>">
                                                            <?php echo e($prof->NM_PROFILE); ?>

                                                        </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="nm-doc" id="nm-doc" class="form-control" placeholder="Nama Document">
                                                </div>
                                                <div class="form-group" align="right">
                                                    <button type="button" id="ubahDocument" class="btn btn-primary" data-dismiss="modal">Ubah</button>
                                                </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                    <!-- Delete modal -->
                    <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Delete Data</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="id-document" 
                                        id="id-document">
                                        <p>Yakin Ingin Menghapus Data? </p>
                                    </div>
                                    <div class="form-group" align="right">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="delete-document" class="btn btn-danger" data-dismiss="modal">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo e($document->render()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>