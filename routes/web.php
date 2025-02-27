<?php



use App\Http\Controllers\client\AccountSettingController;
use App\Http\Controllers\client\AccountDashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\client\ShopController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\CategoryController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\SecretController;
use App\Http\Controllers\client\AccountOrderController;
use App\Http\Controllers\client\CommentClientController;
use App\Http\Controllers\client\wishlistController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\client\HomepageController;


Auth::routes([
    'reset' => false,     // Tắt route reset mật khẩu
    'verify' => false,     // Tắt route xác minh email
    'confirm' => false     // Tắt route xác minh email
]);



Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::middleware(['auth'])->group(function () {
    // Trang quản trị chỉ dành cho admin
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard cho admin
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::resource('website', AdminController::class);

        // Quản lý khách hàng và nhân viên
        Route::view('qlkhachhang', 'admin.qlkhachhang.index')->name('qlkhachhang.index');
        Route::view('qlnhanvien', 'admin.qlnhanvien.index')->name('qlnhanvien.index');

        // Quản lý bình luận, đơn hàng, liên hệ và danh mục
        Route::resource('qlbinhluan', CommentController::class);
        Route::resource('qldonhang', OrderController::class);
        Route::resource('qllienhe', ContactController::class);
        Route::resource('qldanhmuc', CategoryController::class);


        // Quản lý sản phẩm
        Route::get('qlsanpham', [ProductController::class, 'index'])->name('qlsanpham.index');
        Route::resource('products', ProductController::class);
        Route::post('products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');
        Route::delete('delete-image/{imageId}', [ProductController::class, 'deleteImage'])->name('deleteImage');

        // Quản lý màu sắc và kích thước
        Route::resource('colors', ColorController::class);
        Route::resource('sizes', SizeController::class);
    });


    
    // Trang nhân viên chỉ dành cho nhân viên và admins
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::get('/staff', function () {
            return view('staff.home.index');
        })->name('staff.home.index');
    });

    // User routes
    Route::prefix('user')->group(function () {
        Route::prefix('account-setting')->group(function () {
            Route::get('/', [AccountSettingController::class, 'index'])->name('client.user.account-setting');
            Route::post('/', [AccountSettingController::class, 'changePassword'])->name('client.user.account-setting');
            Route::post('/changeAddress', [AccountSettingController::class, 'changeAddress'])->name('client.user.account-settingchangeAddress');
            Route::post('/changeInfo', [AccountSettingController::class, 'changeInfo'])->name('client.user.account-settingchangeInfo');
            Route::post('/changeAvatar', [AccountSettingController::class, 'changeAvatar'])->name('client.user.account-settingchangeAvatar');
        });
        Route::prefix('user-dashboard')->group(function () {
            Route::get('/', [AccountDashboardController::class, 'index'])->name('client.user.user-dashboard');
        });
        Route::prefix('order')->group(function () {
            Route::get('/history', [AccountOrderController::class, 'index'])->name('client.user.order-history');
            Route::get('/details/{id}', [AccountOrderController::class, 'details'])->name('client.user.order-details');
            Route::put('/{id}', [AccountOrderController::class, 'cancelOrder'])->name('client.user.cancel-order');
            Route::get('/product/{slug}', [AccountOrderController::class, 'product_details'])->name('client.user.product_details');
            Route::post('/product/{slug}/comment', [AccountOrderController::class, 'comment'])->name('product.comment');
        });
    });
    Route::get('/bought', [CommentClientController::class, 'index'])->name('client.user.bought');
    // Cart routes
    Route::prefix('cart')->group(function () {
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('client.cart.checkout');
        Route::post('/checkout/{cart}', [CheckoutController::class, 'processCheckout'])->name('checkout');
        Route::resource('/wishlist', wishlistController::class);
        // Route hiển thị giỏ hàng
        Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('client.cart.shopping-cart');
        Route::post('/toggle-favorite/{productId}', [wishlistController::class, 'toggleFavorite'])->name('wishlist.toggle-favorite');

        // Route thêm sản phẩm vào giỏ hàng
        Route::post('/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/addjs/{productId}', [CartController::class, 'addToCartJS'])->name('cart.addjs');


        Route::put('/update/{cartItemId}', [CartController::class, 'updateQuantity'])->name('cart.update');
        Route::patch('/cart/item/update/{cartItem}', [CartController::class, 'update'])->name('cart.item.update');

        Route::get('/cart-data', [CartController::class, 'getCartData'])->name('cart.data');
        Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'removeCart']);

        // Route xóa sản phẩm khỏi giỏ hàng
        Route::delete('/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::delete('/cart/remove-all', [CartController::class, 'removeAll'])->name('cart.removeAll');
    });

    // Secret route
    Route::get('/secretkey', [App\Http\Controllers\Auth\SecretController::class, 'showSecret'])->name('secretkey');
});
// Các route khác không cần đăng nhập
// Route::get('/', function () {
//     return view('client.homepage');
// });

Route::prefix('auth')->name('auth.')->group(function () {
    // Route để nhập email (GET)
    Route::get('/forgotpassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'nhapEmail'])->name('forgotpassword');
    // Route để kiểm tra email va secret (POST)
    Route::post('/forgotpassword', [App\Http\Controllers\Auth\ResetPasswordController::class, 'checkInfo'])->name('checkInfo');
    // Route hiển thị form xác nhận mật khẩu (GET)
    Route::get('/confirmpassword', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirmPassword'])->name('confirmpassword');
    // Route xử lý việc thay đổi mật khẩu (POST)
    Route::post('/confirmpassword', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword'])->name('updatePassword');
});

// Public routes

// Route::get('/', function () {

//     return view('client.pages.homepage');
// })->name('client.pages.homepage');

// Route::get('/', function () {
//     return view('client.pages.homepage');
// })->name('client.pages.homepage');

Route::get('/', [HomepageController::class, 'index'])->name('client.pages.homepage');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('shop')->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('client.shop.shop');

    Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('client.shop.shopdetails');

    Route::get('/search_results', [ProductController::class, 'filterAndSearch'])->name('search');
    Route::get('/product-details', function () {
        return view('client.shop.product-details');
    })->name('client.shop.product-details');
    // Route lọc sản phẩm
    // Route::get('/filter', [ShopController::class, 'filter'])->name('client.shop.filter');
    // Route::get('/shop/{id}', [ShopController::class, 'getViews'])->name('client.shop.shopdetails');
    Route::get('/{slug}/quantity', [ShopController::class, 'getProductQuantity']);
    // Route::get('/product-details', function () {
    //     return view('client.shop.product-details');
    // })->name('client.shop.product-details');
});

// Blog routes
Route::prefix('blog')->group(function () {
    // Route::get('/list', function () {
    //     return view('client.blog.blog-list');
    // })->name('client.blog.blog-list');

    // Route::get('/single', function () {
    //     return view('client.blog.single-blog');
    // })->name('client.blog.single-blog');
    Route::get('/list', [ArticleController::class, 'index'])->name('client.blog.blog-list');
    Route::get('/list/{id}', [ArticleController::class, 'show'])->name('article.show');
    Route::get('/blog/search', [ArticleController::class, 'search'])->name('client.blog.search');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.articles');
});

// Static pages
Route::prefix('pages')->group(function () {
    Route::get('/about', function () {
        return view('client.pages.about');
    })->name('client.pages.about');

    Route::get('/contact', function () {
        return view('client.pages.contact');
    })->name('client.pages.contact');
});
//trang thanh toán
Route::get('vnpay_return', [CheckoutController::class, 'vnpay_return'])->name('vnpay.return');
