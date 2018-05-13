<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Jenis Dokumen</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('fk_req') ? ' has-error' : ''); ?>">
                            <label for="fk_req" class="col-md-4 control-label">Tipe User</label>

                            <div class="col-md-6">
                                <select id="prof_id" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    <?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($prof->ID); ?>">
                                            <?php echo e($prof->NM_PROFILE); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <?php if($errors->has('prof_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('prof_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('fk_user_id') ? ' has-error' : ''); ?>">
                            <label for="fk_user_id" class="col-md-4 control-label">Assign To</label>

                            <div class="col-md-6">
                                <select id="nm_prof" class="form-control">
                                    <option value="Please Select">
                                        Please Select
                                    </option>
                                    <?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($prof->CD_PROFILE); ?>">
                                            <?php echo e($prof->NM_PROFILE); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <?php if($errors->has('nm_prof')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('nm_prof')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-primary" id="flow-profile">
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