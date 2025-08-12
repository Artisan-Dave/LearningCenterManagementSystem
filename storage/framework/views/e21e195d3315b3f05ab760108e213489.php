<h2>Mark Attendance</h2>

<?php if(session('success')): ?>
    <div><?php echo e(session('success')); ?></div>
<?php endif; ?>

<form action="<?php echo e(route('attendance.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <label for="date">Select Date:</label>
    <input type="date" name="date" required value="<?php echo e(date('Y-m-d')); ?>">

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><input type="radio" name="attendances[<?php echo e($user->id); ?>]" value="present" required></td>
                    <td><input type="radio" name="attendances[<?php echo e($user->id); ?>]" value="absent"></td>
                    <td><input type="radio" name="attendances[<?php echo e($user->id); ?>]" value="late"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <button type="submit">Save Attendance</button>
</form>
<?php /**PATH D:\xampp\htdocs\payment-system\resources\views/attendance/index.blade.php ENDPATH**/ ?>