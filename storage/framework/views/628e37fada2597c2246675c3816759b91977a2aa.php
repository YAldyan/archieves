<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buat User Profile Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/store/profile')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('cd_profile') ? ' has-error' : ''); ?>">
                            <label for="cd_profile" class="col-md-4 control-label">Kode Profile</label>

                            <div class="col-md-6">
                                <input id="cd_profile" type="text" class="form-control" name="cd_profile" value="<?php echo e(old('cd_profile')); ?>" required autofocus>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('nm_profile') ? ' has-error' : ''); ?>">
                            <label for="nm_profile" class="col-md-4 control-label">Nama Profile</label>

                            <div class="col-md-6">
                                <input id="nm_profile" type="text" class="form-control" name="nm_profile" value="<?php echo e(old('nm_profile')); ?>" required autofocus>
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