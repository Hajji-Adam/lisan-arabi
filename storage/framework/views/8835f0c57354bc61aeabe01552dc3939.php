

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Students</h1>
    <div class="mb-3">
        <a href="<?php echo e(route('students.create')); ?>" class="btn btn-primary">Add New Student</a>
        <a href="<?php echo e(route('subscriptions.index')); ?>" class="btn btn-secondary">Go to Subscriptions</a>
    </div>

    <!-- Search Form -->
    <form action="<?php echo e(route('students.index')); ?>" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?php echo e(request('search')); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Last Payment Date</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="<?php echo e(!$student->last_payment_date || $student->last_payment_date->startOfMonth()->lt(now()->startOfMonth()) ? 'table-warning' : ''); ?>">
                    <td><?php echo e($student->name); ?></td>
                    <td><?php echo e($student->phone); ?></td>
                    <td><?php echo e($student->last_payment_date ? $student->last_payment_date->format('Y-m-d') : 'Never'); ?></td>
                    <td>
                        <?php if($student->last_payment_date && $student->last_payment_date->startOfMonth()->eq(now()->startOfMonth())): ?>
                            <span class="badge bg-success">Paid</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Payment Due</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('students.show', $student->id)); ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?php echo e(route('students.edit', $student->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('students.destroy', $student->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <form action="<?php echo e(route('students.markAsPaid', $student->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <button type="submit" class="btn btn-success btn-sm">Mark as Paid</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($students->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aa\Desktop\LS\lisan-arabi\resources\views/students/index.blade.php ENDPATH**/ ?>