<!DOCTYPE html>
<html lang="en">
<head>
    <title> <?php echo e($info->company_name); ?> </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo e(asset('/')); ?>images/logo/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/bootstrap.min.css')); ?>">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,700i" rel="stylesheet">

</head>
<body>

<?php echo $__env->yieldContent('content'); ?>

<!--===============================================================================================-->

<!--===============================================================================================-->
<script src="<?php echo e(asset('/')); ?>backend/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo e(asset('/')); ?>backend/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('/backend/assets/sweetalert2.all.min.js')); ?>"></script>

<?php if(Session::has('success')): ?>
    <script type="text/javascript">
        swal({
            type: 'success',
            title: '<?php echo e(Session::get("success")); ?>',
            showConfirmButton: true,

        })
    </script>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <script type="text/javascript">
        swal({
            type: 'error',
            title: '<?php echo e(Session::get("error")); ?>',
            showConfirmButton: true
        })
    </script>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/auth/master.blade.php ENDPATH**/ ?>