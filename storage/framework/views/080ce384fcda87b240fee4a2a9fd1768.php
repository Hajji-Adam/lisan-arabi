<!-- resources/views/students/show.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Student Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($student->name); ?></h5>
            <p class="card-text"><strong>Phone:</strong> <?php echo e($student->phone); ?></p>
            <p class="card-text"><strong>Last Payment Date:</strong> <?php echo e($student->last_payment_date ? $student->last_payment_date->format('Y-m-d') : 'Never'); ?></p>
            <p class="card-text"><strong>Payment Status:</strong>
                <?php if($student->last_payment_date && $student->last_payment_date->startOfMonth()->eq(now()->startOfMonth())): ?>
                    <span class="badge bg-success">Paid</span>
                <?php else: ?>
                    <span class="badge bg-danger">Payment Due</span>
                <?php endif; ?>
            </p>
    
            <!-- Payment History -->
            <div class="mt-4">
                <h6>Payment History</h6>
                <?php if($student->payments->count() > 0): ?>
                    <ul>
                        <?php $__currentLoopData = $student->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($payment->payment_date->format('F Y')); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p>No payment history available.</p>
                <?php endif; ?>
            </div>
    
            <!-- Record Payment Form -->
            <div class="mt-4">
                <h6>Record New Payment</h6>
                <form action="<?php echo e(route('students.recordPayment', $student->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Record Payment</button>
                </form>
            </div>
    
            <a href="<?php echo e(route('students.edit', $student->id)); ?>" class="btn btn-warning">Edit</a>
            <form action="<?php echo e(route('students.destroy', $student->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    <a href="<?php echo e(route('students.index')); ?>" class="btn btn-secondary mt-3">Back to List</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aa\Desktop\LS\lisan-arabi\resources\views/students/show.blade.php ENDPATH**/ ?>