

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Complaints List</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('complaints.create')); ?>" class="btn btn-primary">Submit New Complaint</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Department</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Attachments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($complaint->id); ?></td>
                    <td><?php echo e($complaint->category->name); ?></td>
                    <td><?php echo e($complaint->department ? $complaint->department->name : 'N/A'); ?></td>
                    <td><?php echo e($complaint->title); ?></td>
                    <td><?php echo e($complaint->description); ?></td>
                    <td><?php echo e(ucfirst($complaint->status)); ?></td>
                    <td><?php echo e(ucfirst($complaint->priority)); ?></td>
                    <td>
                        <div class="d-flex flex-wrap">
                            <?php if($complaint->attachments->isNotEmpty()): ?>
                                <?php $__currentLoopData = $complaint->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(Str::endsWith($attachment->file_path, ['.jpg', '.png', '.jpeg'])): ?>
                                        <img src="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" width="50" class="m-1">
                                    <?php elseif(Str::endsWith($attachment->file_path, ['.mp4', '.mov', '.avi'])): ?>
                                        <video width="50" controls class="m-1">
                                            <source src="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" type="video/mp4">
                                        </video>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span>No Attachments</span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo e(route('complaints.edit', $complaint->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('complaints.destroy', $complaint->id)); ?>" method="POST" class="d-inline">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\student-app\resources\views/complaints/index.blade.php ENDPATH**/ ?>