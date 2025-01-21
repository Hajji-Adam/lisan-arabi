

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Subscriptions</h1>
    <div class="mb-3">
        <a href="<?php echo e(route('subscriptions.create')); ?>" class="btn btn-primary">Add New Subscription</a>
        <a href="<?php echo e(route('students.index')); ?>" class="btn btn-secondary">Go to Students</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($subscription->id); ?></td>
                    <td><?php echo e($subscription->student->name); ?></td>
                    <td><?php echo e($subscription->start_date->format('Y-m-d')); ?></td>
                    <td><?php echo e($subscription->end_date->format('Y-m-d')); ?></td>
                    <td>
                        <form action="<?php echo e(route('subscriptions.toggleActive', $subscription->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-sm <?php echo e($subscription->is_active ? 'btn-success' : 'btn-secondary'); ?>">
                                <?php echo e($subscription->is_active ? 'Active' : 'Inactive'); ?>

                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="<?php echo e(route('subscriptions.show', $subscription->id)); ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?php echo e(route('subscriptions.edit', $subscription->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('subscriptions.destroy', $subscription->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aa\Desktop\LS\lisan-arabi\resources\views/subscriptions/index.blade.php ENDPATH**/ ?>