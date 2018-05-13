<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Daftar Proyek Pengembangan</h3>
            <div class="panel panel-default">
                <div class="panel-body">   
                    <table class="table table-striped" id="table">    
                        <tr>
                            <th scope="col" width="8%" >
                                ID Item
                            </th>
                            <th scope="col" width="15%" >
                                Jenis Request
                            </th>
                            <th scope="col" width="52%" >
                                Nama Item
                            </th>
                            <th scope="col" width="25%" >
                            </th>
                        </tr>
                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <?php if($itm->FK_CAT_REQ == $req->ID ): ?>

                                    <?php $__currentLoopData = $useritem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ust): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <?php if(Auth::user()->id == $ust->FK_USERS_ID &&
                                       $itm->ID == $ust->FK_ID_ITEM): ?>

                                        <?php if($profile->ID == $ust->FK_ID_USER): ?>
                                        <tr class="item<?php echo e($itm->ID); ?>">
                                            <td align='center' ><?php echo e($itm->ID); ?></td>
                                            <td><?php echo e($req->NM_REQ); ?></td>
                                            <td>
                                                <a href="/history/item/<?php echo e($itm->ID); ?>"}}> 
                                                    <?php echo e($itm->NM_ITEM); ?>

                                                </a>
                                            </td>
                                            <td>
                                                <?php if($ust->STATUS == "APPROVED"): ?> 
                                                    <h6>Submitted</h6>  
                                                <?php elseif($itm->STATUS != "COMPLETED"): ?>
                                                    <button class="edit-item btn btn-info btn-sm" data-id="<?php echo e($itm->ID); ?>" data-nama="<?php echo e($itm->NM_ITEM); ?>" req-id='<?php echo e($req->ID); ?>'>
                                                        Edit
                                                    </button>

                                                    <button class="delete-item btn btn-danger btn-sm" data-id="<?php echo e($itm->ID); ?>">
                                                        Delete
                                                    </button>
                                                <?php else: ?> 
                                                    <h6>Completed</h6>   
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </table>
                    <!-- <!-- Edit modal -->
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

                                                    <input type="text" name="id-item" class="form-control" id="id-item" disabled="true">
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
                                                    <input type="text" name="nm-item" id="nm-item" class="form-control" placeholder="Nama Item">
                                                </div>
                                                <div class="form-group" align="right">
                                                    <button type="button" id="ubahItem" class="btn btn-primary" data-dismiss="modal">Ubah</button>
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

                                        <input type="hidden" name="id-item" 
                                        id="id-item">
                                        <p>Yakin Ingin Menghapus Data? </p>
                                    </div>
                                    <div class="form-group" align="right">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="delete-item" class="btn btn-danger" data-dismiss="modal">Delete</button>
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

<?php echo e($item->render()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>