<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorReportController;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;
use App\Http\Controllers\AffiliateTemplateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanySettingsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MediaDeleteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\customerProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Auth\OtpLoginController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about-us',[HomeController::class, 'about_us'])->name('aboutus');
Route::get('/store',[HomeController::class, 'show_store'])->name('show_store');
Route::get('/contact-us',[HomeController::class, 'contact_us'])->name('contactus');
Route::post('/contact-us',[ContactFormController::class, 'sendContactForm'])->name('send_mail');
Route::get('/shop',[ShopController::class, 'shop'])->name('shop');
Route::get('/shop/sub-category/{category_id}/{sub_category_id}',[ShopController::class, 'sub_catogory_view'])->name('shop.sub_category');

Route::get('/search-suggestions', [HomeController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/search-results', [HomeController::class, 'searchResults'])->name('search.results');


Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');


//OTP Routes
// Route::get('/verify-otp', [OtpLoginController::class, 'showOtpLoginForm'])->name('otp.login');
// Route::post('/send-otp', [OtpLoginController::class, 'sendOtp'])->name('send-otp');
Route::get('/send-otp', [OtpLoginController::class, 'showOtpLoginForm'])->name('show_otp_form');
Route::post('/send-otp', [OtpLoginController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [OtpLoginController::class, 'verifyOtp'])->name('verify_otp');
Route::get('/verify-finish', [OtpLoginController::class, 'finish'])->name('otp-msg');


Route::get('/forget-password', [OtpLoginController::class, 'showRestpasswordForm'])->name('frogeten_psw');


//profile
Route::get('/user-profile',[customerProfileController::class, 'viewProfile'])->name('viewProfile');
Route::post('/user-profile/update/{id}',[customerProfileController::class, 'updateProfile'])->name('updateProfile');
Route::post('/user-profile/update-password/{id}',[customerProfileController::class, 'updatePassword'])->name('updatePassword');
Route::get('/track-order/{orderCode}', [customerProfileController::class, 'trackOrder'])->name('user.track-order');
Route::get('/customer/logout', [customerProfileController::class, 'logout'])->name('customer.logout');

Route::get('/blogs', [BlogController::class, 'viewBlogs'])->name('blogs');
Route::get('/blogs/deatils/{id}', [BlogController::class, 'viewBlogDetails'])->name('blog.show');

// returns
Route::get('/returns',[ReturnController::class, 'returns'])->name('returns');
Route::post('/returns/store',[ReturnController::class, 'storeReturn'])->name('returns.store');

Route::get('/shop-details/{product_id}', [ShopController::class, 'shop_details'])->name('shop_details');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
//Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/buy-now-checkout/{product_id}', [CartController::class, 'buyNowCheckout'])->name('buyNow.checkout');
Route::post('/buy_now_place-order', [OrderController::class, 'buynow_placeOrder'])->name('buynow_placeOrder');
Route::post('/place-order', [CustomerOrderController::class, 'placeOrder'])->name('placeOrder');

Route::post('order/place', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/paymentpage',[OrderController::class, 'paymentpage'])->name('paymentpage');


Route::get('/checkout',[CartController::class, 'checkout'])->name('checkout');
Route::get('/payment/{order_code}', [PaymentController::class, 'showPaymentPage'])->name('payment');

Route::post('/confirm-cod-order/{order_code}', [PaymentController::class, 'confirmCODOrder'])->name('confirm.cod.order');
Route::get('/order/order_received/{order_code}', [PaymentController::class, 'getOrderDetails'])->name('order.thankyou');

Route::get('/transaction/{order_code}', [PaymentController::class, 'createTransaction'])->name('transaction');
Route::get('/payment_received', [PaymentController::class, 'getOrderDetails2'])->name('order.thankyou2');

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::delete('/profile/reviews/{review}', [ReviewController::class, 'customerDestroy'])->name('customer.reviews.destroy');

Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist');
Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
Route::get('/wishlist/count', [WishlistController::class, 'getWishlistCount'])->name('wishlist.count');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
Route::post('/wishlist/check-multiple', [WishlistController::class, 'checkMultipleWishlist'])->name('wishlist.checkMultiple');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/',[HomeController::class,'index'])->name('home');



//admin dashboard
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminAuth;


Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::middleware([App\Http\Middleware\AdminAuth::class])->group(function () {
    Route::get('/admin',[AdminTemplateController::class,'index'])->name('admin.index');
});

Route::get('/cus-register', function () {
    return view('frontend.register');
})->name('cus-register'); 

Route::get('/cus-login', function () {
    return view('frontend.login');
})->name('cus-login');


Route::post('/cus-register/store', [RegisterController::class, 'store'])->name('registerStore');

Route::get('/logo', [AdminTemplateController::class, 'sidebar'])->name('Sidebar');


//notification

Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
Route::post('/admin/notifications/add-user/{user}', [NotificationController::class, 'addUserNotification'])->name('notifications.addUser');
Route::post('/admin/notifications/add-order/{order}', [NotificationController::class, 'addOrderNotification'])->name('notifications.addOrder');
Route::post('/admin/notifications/clear', [NotificationController::class, 'clearNotifications'])->name('notifications.clear');


Route::get('/admin/profile', [AdminProfileController::class, 'showProfile'])->name('profile');
Route::post('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
Route::post('/admin/profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.password.update');

Route::get('/admin/products_list', [ProductController::class, 'showproducts'])->name('products_list');

Route::get('products/{product}/view', [ProductController::class, 'view_details'])->name('products.view');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/admin/add_products', [ProductController::class, 'displayCategories'])->name('add_products');
Route::get('/api/subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);
Route::get('/api/sub-subcategories/{subcategoryId}', [ProductController::class, 'getSubSubcategories']);


Route::delete('/delete-media', [MediaDeleteController::class, 'deleteMedia'])->name('deleteMedia');

// Route for deleting products
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::get('/admin/customers', [CustomerController::class, 'show'])->name('customers');
Route::get('/admin/customer-details/{user_id}', [CustomerController::class, 'showCustomerDetails'])->name('customer-details');

Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders');
Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('order.delete');
Route::get('/admin/order-details/{orderCode}', [OrderController::class, 'showOrderDetails'])->name('order-details');
Route::patch('/order/update-status/{order_code}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');



Route::view('/admin/affiliate_customers', 'AdminDashboard.affiliate_customers')->name('affiliate_customers');

Route::get('/admin/affiliate_rules', [AffiliateRulesController::class, 'index'])->name('affiliate_rules');
Route::post('/admin/affiliate_rules', [AffiliateRulesController::class, 'store'])->name('admin_rules.store');
Route::delete('/admin/affiliate_rules/{id}', [AffiliateRulesController::class, 'destroy'])->name('affiliate_rules.destroy');
Route::put('/admin/affiliate_rules/{id}', [AffiliateRulesController::class, 'update'])->name('admin_users.update');

Route::get('/admin/affiliate_withdrawals', [AffiliateWithdrawalsController::class, 'index'])->name('affiliate_withdrawals');
Route::post('/admin/affiliate_withdrawals/update/{id}', [AffiliateWithdrawalsController::class, 'updatePaymentStatus'])->name('affiliate.updatePaymentStatus');

Route::get('/admin/affiliate_customers', [AffiliateUserController::class, 'showAffiliates'])->name('affiliate_customers');
Route::post('/admin/affiliates/{id}/status/{status}', [AffiliateUserController::class, 'updateStatus'])->name('admin.affiliates.updateStatus');
Route::get('/admin/Affiliatecustomer-details/{id}', [AffiliateUserController::class, 'showDetails'])->name('admin.affiliates.show');

Route::get('/admin/reviews', [ReviewController::class, 'adminView'])->name('adminReviews');
Route::get('/admin/reviews-details/{id}', [ReviewController::class, 'adminViewDetails'])->name('viewReviewDetails');
Route::patch('/reviews/{id}/status', [ReviewController::class, 'updateStatus'])->name('reviews.updateStatus');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

Route::get('/admin/returns', [ReturnController::class, 'adminView'])->name('adminReturns');
Route::get('/admin/return-details/{id}', [ReturnController::class, 'adminViewDetails'])->name('viewReturnDetails');
Route::patch('/returns/{id}/status', [ReturnController::class, 'updateStatus'])->name('returns.updateStatus');
Route::delete('/returns/{return}', [ReturnController::class, 'destroy'])->name('admin.return.destroy');

Route::view('/admin/customer_inquiries', 'AdminDashboard.inquiries')->name('admin.customer.inquiries');

Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('/admin/blogs/store', [BlogController::class, 'store'])->name('blog.store');
Route::get('/admin/blogs/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/admin/blogs/update/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/admin/blogs/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

Route::get('/admin/vendors', [VendorAccountController::class, 'show'])->name('vendors');
Route::get('/admin/vendors/payments', [VendorPaymentRequestController::class, 'index'])->name('admin.vendor.payments');
Route::post('/admin/vendors/payments/update/{id}', [VendorPaymentRequestController::class, 'updatePaymentStatus'])->name('vendor.updatePaymentStatus');

Route::post('/admin/vendors/{id}/status/{status}', [VendorAccountController::class, 'updateStatus'])->name('admin.vendors.updateStatus');
Route::get('/admin/vendor-details/{vendorId}', [VendorAccountController::class, 'showVendorDetails'])->name('vendor-details');


Route::view('/admin/role_list', 'AdminDashboard.role_list')->name('role_list');

Route::get('/admin/manage_company', [CompanySettingsController::class, 'index'])->name('manage_company');
Route::post('/admin/manage_company', [CompanySettingsController::class, 'store'])->name('manage_company.store');

Route::resource('system_users', UserController::class);
Route::get('/admin/users', [UserController::class, 'show'])->name('users');
Route::post('/admin/users', [UserController::class, 'store'])->name('system_users.store');
Route::get('/admin/edit_users/{id}', [UserController::class, 'edit'])->name('edit_users');
Route::post('/admin/edit_users/{id}', [UserController::class, 'update'])->name('update_users');
Route::delete('/admin/edit_users/{id}', [UserController::class, 'destroy'])->name('delete_users');


// admin_reports
Route::get('/admin/report/customer_report', [AdminReportController::class, 'customerReport'])->name('customerReport');
Route::get('/admin/report/affiliate_customer_report', [AdminReportController::class, 'affiliateCustomerReport'])->name('affiliateCustomerReport');
Route::get('/admin/report/affiliate_bank_data', [AdminReportController::class, 'affiliateCusBankData'])->name('affiliateCusBankData');
Route::get('/admin/report/vendor_report', [AdminReportController::class, 'vendorReport'])->name('vendorReport');
Route::get('/admin/report/order_report', [AdminReportController::class, 'orderReport'])->name('orderReport');
Route::get('/admin/report/product_report', [AdminReportController::class, 'productReport'])->name('productReport');
require __DIR__.'/auth.php';
