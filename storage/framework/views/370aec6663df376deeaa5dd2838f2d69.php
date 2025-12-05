<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?php echo e($invoice->id); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        .invoice-container { max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-header img { max-width: 150px; margin-bottom: 10px; max-height: 150px; }
        .invoice-header h1 { margin: 0; font-size: 24px; color: #333; }
        .invoice-header p { margin: 5px 0; color: #777; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .invoice-table th { background-color: #f5f5f5; font-weight: bold; color: #333; }
        .invoice-table td { background-color: #fff; }
        .total { font-weight: bold; text-align: right; font-size: 18px; color: #333; margin-top: 20px; }
        .footer { text-align: center; margin-top: 20px; color: #777; font-size: 14px; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Learning Center Invoice #<?php echo e($invoice->id); ?></h1>
            <p>Date: <?php echo e(now()->format('m-d-Y')); ?></p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Amount</th>
                    <th>Remaining Balance</th>
                    <th>Date of Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item['full_name']); ?></td>
                        <td><?php echo e(number_format($item['amount'], 2)); ?></td>
                        <td><?php echo e(number_format($item['total_balance'], 2)); ?></td>
                        <td><?php echo e($item['date_of_payment']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="footer">
            <p>Thank you for choosing BridgeHope. If you have any questions, please contact us at BridgeHope number</p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\xampp\htdocs\lcms\resources\views/invoices/invoice.blade.php ENDPATH**/ ?>