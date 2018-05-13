<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Jenis Dokumen</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/store/document')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('fk_req') ? ' has-error' : ''); ?>">
                            <label for="fk_req" class="col-md-4 control-label">Jenis Request</label>

                            <div class="col-md-6">
                                <select name="fk_req" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($req->ID); ?>">
                                            <?php echo e($req->NM_REQ); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <?php if($errors->has('fk_req')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('fk_req')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('fk_user_id') ? ' has-error' : ''); ?>">
                            <label for="fk_user_id" class="col-md-4 control-label">Jenis User</label>

                            <div class="col-md-6">
                                <select name="fk_user_id" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    <?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($prof->ID); ?>">
                                            <?php echo e($prof->NM_PROFILE); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <?php if($errors->has('fk_user_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('fk_user_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('nm_arsip') ? ' has-error' : ''); ?>">
                            <label for="nm_arsip" class="col-md-4 control-label">Nama Dokumen</label>

                            <div class="col-md-6">
                                <input id="nm_arsip" type="text" class="form-control" name="nm_arsip" value="<?php echo e(old('nm_arsip')); ?>" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>