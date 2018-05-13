<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <!-- <?php if(Auth::user()->jabatan == 'Admin'): ?>
                    <div class="panel-heading">Welcome Administrator</div>
                <?php else: ?>{
                    <!-- <div class="panel-heading">Welcome Member</div> -->
                    <!-- <script type="text/javascript">
                        window.location = "http://google.com";
                        //here double curly bracket
                    </script>
                <?php endif; ?> -->

                <!-- <div class="panel-heading">Welcome Dashboard</div> -->

                <?php if(Auth::user()->type == 'QA'): ?>
                    <script type="text/javascript">
                        window.location = "/QA/home";
                        //here double curly bracket
                    </script>
                <?php elseif(Auth::user()->type == 'PNG'): ?>
                    <script type="text/javascript">
                        window.location = "/PNG/home";
                        //here double curly bracket
                    </script>
                <?php elseif(Auth::user()->type == 'OPR'): ?>
                    <script type="text/javascript">
                        window.location = "/OPR/home";
                        //here double curly bracket
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>