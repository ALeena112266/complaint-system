

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Feedback List</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('feedback.create')); ?>" class="btn btn-primary">Submit New Feedback</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Complaint</th>
                <th>Feedback</th>
                <th>Submitted On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($feedback->id); ?></td>
                    <td><?php echo e($feedback->user->name); ?></td>
                    <td><?php echo e($feedback->complaint ? $feedback->complaint->title : 'N/A'); ?></td>
                    <td><?php echo e($feedback->message); ?></td>
                    <td><?php echo e($feedback->created_at->format('d M Y, h:i A')); ?></td>
                    <td>
                        <a href="<?php echo e(route('feedback.show', $feedback->id)); ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?php echo e(route('feedback.edit', $feedback->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('feedback.destroy', $feedback->id)); ?>" method="POST" class="d-inline">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\student-app\resources\views/feedback/index.blade.php ENDPATH**/ ?>