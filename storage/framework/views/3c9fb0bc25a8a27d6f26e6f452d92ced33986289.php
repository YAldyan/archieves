<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Daftar Profile Type</h3>
            <div class="panel panel-default">
                <div class="panel-body">       
                    <table class="table table-striped" id="table">
                        <tr>
                            <th scope="col" width="10%" >
                                Request ID
                            </th>
                            <th scope="col" width="70%" >
                                Request Name
                            </th>
                            <th scope="col" width="20%" >
                            </th>
                        </tr>
                        <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr class="request<?php echo e($req->ID); ?>">
                            <td><?php echo e($req->ID); ?></td>
                            <td><?php echo e($req->NM_REQ); ?></td>
                            <td>
                                <button class="edit-request btn btn-info btn-sm" data-id="<?php echo e($req->ID); ?>" data-nama="<?php echo e($req->NM_REQ); ?>">
                                    Edit
                                </button>

                                <!-- <button class="delete-request btn btn-danger btn-sm" data-id="<?php echo e($req->ID); ?>">
                                    Delete
                                </button> -->
                            </td>
                        </tr>
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

                                                    <input type="text" name="id-request" class="form-control" id="id-request" disabled="true">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="nm-req" id="nm-req" class="form-control" placeholder="Nama Request">
                                                </div>
                                                <div class="form-group" align="right">
                                                    <button type="button" id="ubahRequest" class="btn btn-primary" data-dismiss="modal">Ubah</button>
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

                                        <input type="hidden" name="id-request" 
                                        id="id-request">
                                        <p>Yakin Ingin Menghapus Data? </p>
                                    </div>
                                    <div class="form-group" align="right">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="delete-request" class="btn btn-danger" data-dismiss="modal">Delete</button>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>