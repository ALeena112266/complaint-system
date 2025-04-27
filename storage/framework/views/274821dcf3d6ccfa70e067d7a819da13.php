

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Complaint</h2>
    <form action="<?php echo e(route('complaints.update', $complaint->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($complaint->category_id == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo e($complaint->title); ?>" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?php echo e($complaint->description); ?></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" <?php echo e($complaint->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="in progress" <?php echo e($complaint->status == 'in progress' ? 'selected' : ''); ?>>In Progress</option>
                <option value="rejected" <?php echo e($complaint->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                <option value="resolved" <?php echo e($complaint->status == 'resolved' ? 'selected' : ''); ?>>Resolved</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-control">
                <option value="low" <?php echo e($complaint->priority == 'low' ? 'selected' : ''); ?>>Low</option>
                <option value="medium" <?php echo e($complaint->priority == 'medium' ? 'selected' : ''); ?>>Medium</option>
                <option value="high" <?php echo e($complaint->priority == 'high' ? 'selected' : ''); ?>>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Existing Attachments</label>
            <div>
                <?php $__currentLoopData = $complaint->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Str::endsWith($attachment->file_path, ['.jpg', '.png', '.jpeg'])): ?>
                        <img src="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" width="100" class="mb-2">
                    <?php elseif(Str::endsWith($attachment->file_path, ['.mp4', '.mov', '.avi'])): ?>
                        <video width="100" controls class="mb-2">
                            <source src="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="mb-3">
            <label>New Attachments (Optional)</label>
            <input type="file" name="attachments[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success">Update Complaint</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\student-app\resources\views/complaints/edit.blade.php ENDPATH**/ ?>