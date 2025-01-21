<!-- resources/views/subscriptions/edit.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Subscription</h1>
    <form action="<?php echo e(route('subscriptions.update', $subscription->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($student->id); ?>" <?php echo e($subscription->student_id == $student->id ? 'selected' : ''); ?>>
                        <?php echo e($student->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="is_active">Is Active</label>
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" <?php echo e($subscription->is_active ? 'checked' : ''); ?>>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e($subscription->start_date->format('Y-m-d')); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aa\Desktop\LS\lisan-arabi\resources\views/subscriptions/edit.blade.php ENDPATH**/ ?>