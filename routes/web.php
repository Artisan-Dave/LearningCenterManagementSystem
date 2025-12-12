<?php
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Invoice\DownloadInvoiceController;
use App\Http\Controllers\Invoice\ViewInvoiceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\SavePaymentController;
use App\Http\Controllers\Payment\SearchPaymentController;
use App\Http\Controllers\Student\BalanceController;
use App\Http\Controllers\Student\SearchStudentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\SerializableClosure\Serializers\Signed;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //Mailtrap Testing Route
    // Route::get('send-email',[MailController::class,'sendEmail']);
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

    Route::get('/student/create-balance/{student}', [BalanceController::class, 'create'])->name('student.create-balance');
    Route::post('student/create-balance/{student}', [BalanceController::class, 'update'])->name('student.update-balance');

    //Student Routes
    Route::resource('students', StudentController::class);
    Route::get('/student/search', SearchStudentController::class)->name('student.search');

    Route::resource('payments', PaymentController::class)->except(['show', 'edit', 'destroy','create']);
    Route::get('/payments/create/{student}', [PaymentController::class, 'create'])->name('payments.create');
    Route::get('/payment/search', SearchPaymentController::class)->name('payment.search');

    Route::get('/invoice/view/{payment}', ViewInvoiceController::class)->name('invoice.view');
    Route::get('/invoice/download/{payment}', DownloadInvoiceController::class)->name('invoice.download');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
