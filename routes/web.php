<?php
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Invoice\DownloadInvoiceController;
use App\Http\Controllers\Invoice\ViewInvoiceController;
use App\Http\Controllers\Invoices\ShowInvoiceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Payment\CreatePaymentController;
use App\Http\Controllers\Payment\SavePaymentController;
use App\Http\Controllers\Payment\SearchPaymentController;
use App\Http\Controllers\Payment\ShowAllPaymentsController;
use App\Http\Controllers\Student\AddStudentController;
use App\Http\Controllers\Student\CreateBalanceController;
use App\Http\Controllers\Student\DeleteStudentController;
use App\Http\Controllers\Student\EditStudentController;
use App\Http\Controllers\Student\SaveBalanceController;
use App\Http\Controllers\Student\SaveStudentController;
use App\Http\Controllers\Student\SearchStudentController;
use App\Http\Controllers\Student\ShowAllStudentsController;
use App\Http\Controllers\Student\UpdateBalanceController;
use App\Http\Controllers\Student\UpdateStudentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StudentController;
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

    Route::middleware('admin')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

        Route::get('/student/create-balance/{student_id}', CreateBalanceController::class)->name('student.create-balance')->middleware('signed');
        Route::post('student/create-balance/{student_id}', UpdateBalanceController::class)->name('student.update-balance');
    });

    Route::get('student/add', AddStudentController::class)->name('student.add');
    Route::post('student/', SaveStudentController::class)->name('student.save');
    Route::get('/student/main', ShowAllStudentsController::class)->name('student.main');
    Route::get('/student/edit/{student_id}', EditStudentController::class)->name('student.edit')->middleware('signed');
    Route::post('/student/edit/{student_id}', UpdateStudentController::class);
    Route::delete('/student/delete/{student_id}', DeleteStudentController::class)->name('student.delete');
    Route::get('/student/search', SearchStudentController::class)->name('student.search');


    Route::get('/payment/main', ShowAllPaymentsController::class)->name('payment.main');
    Route::get('/payment/create-payment/{student_id}', CreatePaymentController::class)->name('payment.create');
    Route::post('payment/create-payment/{student_id}', SavePaymentController::class)->name('payment.save');
    Route::get('/payment/search', SearchPaymentController::class)->name('payment.search');

    Route::get('/invoice/view/{payment_id}', ViewInvoiceController::class)->name('invoice.view');
    Route::get('/invoice/download/{payment_id}', DownloadInvoiceController::class)->name('invoice.download');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
