<!-- resources/views/subscriptions/show.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Subscription Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Subscription #<?php echo e($subscription->id); ?></h5>
            <p class="card-text"><strong>Student:</strong> <?php echo e($subscription->student->name); ?></p>
            <p class="card-text"><strong>Start Date:</strong> <?php echo e($subscription->start_date); ?></p>
            <p class="card-text"><strong>End Date:</strong> <?php echo e($subscription->end_date); ?></p>
            <p class="card-text"><strong>Status:</strong> <?php echo e($subscription->is_active ? 'Active' : 'Inactive'); ?></p>
            <a href="<?php echo e(route('subscriptions.edit', $subscription->id)); ?>" class="btn btn-warning">Edit</a>
            <form action="<?php echo e(route('subscriptions.destroy', $subscription->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    <a href="<?php echo e(route('subscriptions.index')); ?>" class="btn btn-secondary mt-3">Back to List</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aa\Desktop\LS\lisan-arabi\resources\views/subscriptions/show.blade.php ENDPATH**/ ?>