<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\GoldRateController;
use App\Http\Controllers\Admin\DiamondRateController;
use App\Http\Controllers\Admin\WatchPricingController;
use App\Http\Controllers\CheckoutLeadController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SolitaireProductAdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BankAlfalahPaymentController;


use App\Models\Tags;
Route::get('/clear/{key}', function ($key) {
    abort_unless($key === env('CLEAR_CACHE_KEY'), 403);

    Artisan::call('optimize:clear');

    return 'Cache cleared';
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/set-currency', [CurrencyController::class, 'set'])->name('set.currency');
Route::get('/collections/online-shopping-store', [HomeController::class, 'Online_Shopping_Store']);
Route::get('/pages/contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
Route::get('/pages/locator', [HomeController::class, 'locator']);
Route::get('/pages/assurance', [HomeController::class, 'assurance']);
Route::get('/pages/about-us', [HomeController::class, 'about_us']);
Route::get('/pages/after-sale-services', [HomeController::class, 'after_sale_services']);
Route::get('/pages/care-instructions', [HomeController::class, 'care_instructions']);
Route::get('/forevermark', [HomeController::class, 'forevermark'])->name('forevermark');
Route::redirect('/contact-us', '/pages/contact-us', 301);
Route::redirect('/locator', '/pages/locator', 301);
Route::redirect('/assurance', '/pages/assurance', 301);
Route::redirect('/about-us', '/pages/about-us', 301);
Route::redirect('/after-sale-services', '/pages/after-sale-services', 301);
Route::redirect('/care-instructions', '/pages/care-instructions', 301);
Route::get('/collections/bovet', [HomeController::class, 'bovet']);
Route::get('/collections/high-end', [HomeController::class, 'high_end']);
Route::get('/highend-jewellery', [HomeController::class, 'highend']);
Route::get('ehed', [HomeController::class, 'ehed'])->name('ehed');
Route::get('collections/cleopatra', [HomeController::class, 'cleopatra'])->name('cleopatra');
Route::redirect('cleopatra', '/collections/cleopatra', 301);
// EHÉD Collection - shows only Rose Gold, White Gold, and Yellow Gold products
Route::get('/collections/ehed', [HomeController::class, 'ehedCollection'])->name('collections.ehed');
Route::get('collections/hasht', [HomeController::class, 'hasht'])->name('hasht');
Route::get('collections/misterio', [HomeController::class, 'misterio'])->name('misterio');
Route::get('collections/gohar', [HomeController::class, 'gohar'])->name('gohar');
Route::get('collections/qaws-al-matar', [HomeController::class, 'qaws_al_matar'])->name('qaws-al-matar');
Route::get('collections/marchisio', [HomeController::class, 'marchisio'])->name('marchisio');
Route::get('collections/timeless-jewels', [HomeController::class, 'timeless_jewels'])->name('timeless-jewels');
Route::get('/policies/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/policies/refund-policy', [HomeController::class, 'refundPolicy'])->name('refund-policy');
Route::get('/policies/terms-of-service', [HomeController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/policies/shipping-policy', [HomeController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/collections/valentine-jewels', [HomeController::class, 'valentine'])->name('collections.valentine');
Route::get('collections/eid-par-sony-ki-choriyan', [HomeController::class, 'eid'])->name('eid');
Route::get('/collections/selene', [HomeController::class, 'selene'])->name('collections.selene');


// Route::get('divine', [HomeController::class, 'divine'])->name('divine');
Route::get('collections/gehnawa', [HomeController::class, 'gehnawa'])->name('gehnawa');
// Temporary direct route for Taj Mahal page view
Route::get('collections/taj-mahal', [HomeController::class, 'tajMahal'])->name('taj-mahal');
// Temporary direct route for Gulposh page view
Route::get('/collections/gulposh', [HomeController::class, 'gulposh'])->name('gulposh');
// Temporary direct route for Pure Lock page view
Route::get('/collections/pure-lock', [HomeController::class, 'pureLock'])->name('pure-lock');
Route::get('watches', [HomeController::class, 'watches']);
Route::get('solitaire/details/{slug}', [HomeController::class, 'solitaire_details'])->name('solitaire.details');
Route::get('solitaire', [HomeController::class, 'solitaire'])->name('solitaire');
Route::get('products/{slug}', [HomeController::class, 'product_details'])->name('product.details');
Route::get('/collections/farah-khan', [HomeController::class, 'farahKhan'])->name('farah-khan');
Route::get('/collections/divine-treasures', [HomeController::class, 'divineTreasures'])->name('divine-treasures');
Route::get('/collections/haphazard', [HomeController::class, 'haphazard_new'])->name('collections.haphazard_new');
Route::get('/collections/nagar', [HomeController::class, 'nagar'])->name('collections.nagar');
Route::get('/solitaire-old', [HomeController::class, 'solitaire_new'])->name('collections.solitaire_new');
// Route::get('/collection/qaws-al-matar', [HomeController::class, 'qaws_al_matar_collection'])->name('qaws-al-matar-collection-page');
// Specific collection routes must be defined BEFORE the generic wildcard

// Route for category only
Route::get('/category/{category}', [ProductController::class, 'category'])->name('category');

// Route for category + subcategory
// Specific collection routes must be defined BEFORE the generic wildcard
Route::get('/collections/bovet', [HomeController::class, 'bovetCollection'])->name('collections.bovet');
Route::get('/collections/carl-f-bucherer', [HomeController::class, 'carlFBuchererCollection'])->name('collections.carl-f-bucherer');
Route::get('/collections/cuervo-y-sobrinos', [HomeController::class, 'cysCollection'])->name('collections.cys');
Route::get('/collections/maurice-lacroix', [HomeController::class, 'mauriceLacroixCollection'])->name('collections.maurice-lacroix');
Route::get('/collections/louis-moinet', [HomeController::class, 'louisMoinetCollection'])->name('collections.louis-moinet');
Route::get('/collections/franck-muller', [HomeController::class, 'franckmullerCollection'])->name('collections.franckmuller');
Route::get('/collections/chronoswiss', [HomeController::class, 'chronoswissCollection'])->name('collections.chronoswiss');
Route::get('/collections/tissot', [HomeController::class, 'tissotCollection'])->name('collections.tissot');
Route::get('/collections/swiss-military', [HomeController::class, 'swissMilitary'])->name('collections.swiss-military');
Route::get('/collections/Artya', [HomeController::class, 'artyaCollection'])->name('collections.artya');
Route::get('/collections/armand-nicolet', [HomeController::class, 'armandNicoletCollection'])->name('collections.armand-nicolet');
Route::get('/collections/louis-erard', [HomeController::class, 'louisErard'])->name('collections.louis-erard');
Route::get('/collections/graham', [HomeController::class, 'grahamCollection'])->name('collections.graham');
Route::get('/collections/rado', [HomeController::class, 'radoCollection'])->name('collections.rado');
Route::get('/collections/versace', [HomeController::class, 'versaceCollection'])->name('collections.versace');
Route::get('/collections/epos', [HomeController::class, 'eposCollection'])->name('collections.epos');
Route::get('/collections/navratan', [HomeController::class, 'navratan'])->name('collections.navratan');
Route::get('/collections/breathtaking', [HomeController::class, 'breathtakingCollection'])->name('collections.breathtaking');
Route::get('/collections/ferragamo', [HomeController::class, 'ferragamoCollection'])->name('collections.ferragamo');
Route::get('/collections/perrelet', [HomeController::class, 'perreletCollection'])->name('collections.perrelet');
Route::get('/collections/favre-leuba', [HomeController::class, 'favreLeubaCollection'])->name('collections.favre-leuba');
Route::get('/collections/corum', [HomeController::class, 'corumCollection'])->name('collections.corum');

Route::get('/collections/jewelphabets', [HomeController::class, 'jewelphabets'])->name('collections.jewelphabets');
Route::get('/collections/mona-lisa', [HomeController::class, 'monalisa'])->name('collections.monalisa');
Route::get('/collections/tawoos', [HomeController::class, 'tawoos'])->name('collections.tawoos');
Route::get('/masterpiece', [HomeController::class, 'masterpiece'])->name('collections.masterpiece');
Route::get('/checkout-leads/{id}', [OrderController::class, 'showcheckoutlead'])->name('checkout-leads.show');


Route::get('/collections/{subcategory}', [ProductController::class, 'subcategory'])->name('subcategory');

Route::post('/read_csv', [HomeController::class, 'read_csv'])->name('read_csv');
Route::get('/import-csv', [HomeController::class, 'import_csv'])->name('import-csv');

// Add to Cart Route
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::get('/payments/alfalah/{order}/start', [BankAlfalahPaymentController::class, 'start'])
    ->middleware('signed')
    ->name('bank-alfalah.start');
Route::get('/payments/alfalah/return/{callbackPath?}', [BankAlfalahPaymentController::class, 'handleReturn'])
    ->where('callbackPath', '.*')
    ->name('bank-alfalah.return');

// Keep the bank-provided manual sandbox page available locally only.
if (app()->environment('local')) {
    Route::view('/bank-alfalah-payment', 'public.bank-alfalah-payment')
        ->name('bank-alfalah.payment');
    Route::post('/bank-alfalah-payment/handshake', [BankAlfalahPaymentController::class, 'handshake'])
        ->name('bank-alfalah.handshake');
}
Route::get('/cart/header', function () {
    return view('public.partials.cart-header');
})->name('cart.header');

Route::post('/checkout/lead/save', [CheckoutLeadController::class, 'save'])->name('checkout.lead.save');
Route::post('/checkout/lead/exit', [CheckoutLeadController::class, 'exit'])->name('checkout.lead.exit');
// blog section 
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['web', 'auth'])->prefix('admin')->group(function () {


    Route::resource('solitaire-products', SolitaireProductAdminController::class);
    Route::resource('reviews', ReviewController::class);

     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/blogs', [BlogController::class, 'adminIndex'])->name('admin.blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/product/all', [ProductController::class, 'allProducts'])->name('all-products');
    Route::get('/product/add', [ProductController::class, 'addProductShow'])->name('add-product');
    Route::get('/product/update/{id}', [ProductController::class, 'updateProductShow'])->name('update-product');
    Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
    Route::post('/product/bulk-delete', [ProductController::class, 'bulkDeleteProducts'])->name('bulk-delete-products');
    Route::get('/product/get_Products_ajax', [ProductController::class, 'getProductsAjax']);


    Route::get('/product/categories', [ProductController::class, 'productCategories'])->name('product-category');
    Route::get('/product/add-category', [ProductController::class, 'addProductCategoryShow'])->name('add-product-category');
    Route::get('/product/edit-category/{cat_id}', [ProductController::class, 'editProductCategoryShow'])->name('edit-product-category');


    Route::get('/product/sub-categories', [ProductController::class, 'productSubCategories'])->name('product-sub-category');
    Route::get('/product/add-sub-category', [ProductController::class, 'addProductSubCategoryShow'])->name('add-product-sub-category');
    Route::post('/product/create-update-sub-category', [ProductController::class, 'productSubCategoryStoreUpdate'])->name('create-update-sub-category');
    Route::get('/product/edit-sub-category/{cat_id}', [ProductController::class, 'editProductSubCategoryShow'])->name('edit-product-sub-category');
    Route::get('/product/delete-sub-category/{id}', [ProductController::class, 'deleteProductSubCategory'])->name('delete-product-sub-category');

    Route::post('/product/create-update-category', [ProductController::class, 'productCategoryStoreUpdate'])->name('create-update-category');
    Route::get('/product/delete-category/{id}', [ProductController::class, 'deleteProductCategory'])->name('delete-product-category');

    Route::post('/product/create', [ProductController::class, 'createProduct'])->name('product-create');
    Route::put('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::put('/product/updatefeatured/{id}', [ProductController::class, 'updateFeaturedProduct'])->name('product.updatefeatured');
    // Route::post('/product/update/{id}',[ProductController::class, 'update'])->name('product-update');

    // Order Management Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/orders/{id}/verify-payment', [OrderController::class, 'verifyPayment'])->name('orders.verifyPayment');
    Route::get('/orders/dashboard/stats', [OrderController::class, 'getDashboardStats'])->name('orders.dashboardStats');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
    ->name('orders.destroy');
    Route::get('/orders/abandoned/clear', [OrderController::class, 'abandonedOrders'])
    ->name('admin.orders.abandoned');
    Route::post('/orders/{id}/save-cancel-reason', [OrderController::class, 'saveCancelReason'])
    ->name('admin.orders.saveCancelReason');
    Route::get('/page/home', [PagesController::class, 'home'])->name('page-home');
    Route::get('/page/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('admin.privacy-policy.edit');
    Route::post('/page/privacy-policy', [PagesController::class, 'updatePrivacyPolicy'])->name('admin.privacy-policy.update');
    Route::get('/page/refund-policy', [PagesController::class, 'refundPolicy'])->name('admin.refund-policy.edit');
    Route::post('/page/refund-policy', [PagesController::class, 'updateRefundPolicy'])->name('admin.refund-policy.update');
    Route::get('/page/terms-of-service', [PagesController::class, 'termsOfService'])->name('admin.terms-service.edit');
    Route::post('/page/terms-of-service', [PagesController::class, 'updateTermsOfService'])->name('admin.terms-service.update');
    Route::get('/page/shipping-policy', [PagesController::class, 'shippingPolicy'])->name('admin.shipping-policy.edit');
    Route::post('/page/shipping-policy', [PagesController::class, 'updateShippingPolicy'])->name('admin.shipping-policy.update');

    // Ehed Gallery Management Routes
    Route::get('/page/ehed-gallery', [PagesController::class, 'ehedGallery'])->name('admin.ehed-gallery');
    Route::post('/page/ehed-gallery/store', [PagesController::class, 'storeEhedGalleryImages'])->name('admin.ehed-gallery.store');
    Route::delete('/page/ehed-gallery/{id}', [PagesController::class, 'deleteEhedGalleryImage'])->name('admin.ehed-gallery.delete');
    Route::post('/page/ehed-gallery/update-order', [PagesController::class, 'updateEhedGalleryImageOrder'])->name('admin.ehed-gallery.update-order');
    Route::put('/page/ehed-gallery/{id}/toggle-status', [PagesController::class, 'toggleEhedGalleryImageStatus'])->name('admin.ehed-gallery.toggle-status');

    // Pure Lock Gallery Management Routes
    Route::get('/page/pure-lock-gallery', [PagesController::class, 'pureLockGallery'])->name('admin.pure-lock-gallery');
    Route::post('/page/pure-lock-gallery/store', [PagesController::class, 'storePureLockGalleryImages'])->name('admin.pure-lock-gallery.store');
    Route::delete('/page/pure-lock-gallery/{id}', [PagesController::class, 'deletePureLockGalleryImage'])->name('admin.pure-lock-gallery.delete');
    Route::post('/page/pure-lock-gallery/update-order', [PagesController::class, 'updatePureLockGalleryImageOrder'])->name('admin.pure-lock-gallery.update-order');
    Route::put('/page/pure-lock-gallery/{id}/toggle-status', [PagesController::class, 'togglePureLockGalleryImageStatus'])->name('admin.pure-lock-gallery.toggle-status');

    // Gold rate settings
    Route::get('/gold-rates', [GoldRateController::class, 'index'])->name('admin.gold-rates.index');
    Route::post('/gold-rates', [GoldRateController::class, 'update'])->name('admin.gold-rates.update');

    // Diamond rate settings (admin storage only; does not change product pricing yet)
    Route::get('/diamond-rates', [DiamondRateController::class, 'index'])->name('admin.diamond-rates.index');
    Route::post('/diamond-rates', [DiamondRateController::class, 'update'])->name('admin.diamond-rates.update');

    // Watch pricing settings by watch subcategory
    Route::get('/watch-pricing', [WatchPricingController::class, 'index'])->name('admin.watch-pricing.index');
    Route::post('/watch-pricing', [WatchPricingController::class, 'update'])->name('admin.watch-pricing.update');
    

});

// Product card partial rendering route
Route::post('/api/render-product-card', function (Request $request) {
    $productData = $request->input('product');
    
    // Create a mock product object from the data
    $product = new \stdClass();
    $product->id = $productData['id'] ?? 0;
    $product->name = $productData['name'] ?? '';
    $product->slug = $productData['slug'] ?? '';
    $product->price = $productData['price'] ?? 0;
    $product->show_price = $productData['show_price'] ?? false;
    $product->image = $productData['image'] ?? '';
    
    // Handle images - convert array to collection of objects
    if (isset($productData['images']) && is_array($productData['images'])) {
        $product->images = collect($productData['images'])->map(function($image) {
            $img = new \stdClass();
            $img->image = $image;
            return $img;
        });
    } else {
        $product->images = collect();
    }
    
    // Handle category if present
    if (isset($productData['category'])) {
        $product->category = new \stdClass();
        $product->category->name = $productData['category'];
    }
    
    return view('public.partials.product-card', compact('product'))->render();
})->name('api.render-product-card');

// Simple route to list all tags for debugging/reference
Route::get('/debug/tags', function() {
    $tags = Tags::orderBy('name')->get(['id','name','slug']);
    return view('public.debug.tags', compact('tags'));
})->name('debug.tags');

Route::get('/sitemap.xml', function () {
    $products = \App\Models\Products::where('status', 'published')->get();
    $categories = \App\Models\Categories::where('status', 'active')->get();
    $subcategories = \App\Models\Subcategory::where('status', 'active')->get();

    return response()->view('public.debug.sitemap', compact('products', 'categories', 'subcategories'))
        ->header('Content-Type', 'text/xml');
});
