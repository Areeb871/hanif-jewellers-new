<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\Categories;
use App\Models\Subcategory;
use App\Models\ProductTags;
use App\Models\SubcatImages;
use App\Models\Tags;
use Str;
use App\Services\GoldPriceCalculator;
use App\Services\DiamondPriceCalculator;

class ProductController extends Controller
{
    private function requestUsesDiamondPricing(Request $request, ?Products $product = null): bool
    {
        $name = strtolower($request->name ?? $product?->name ?? '');
        if (str_contains($name, 'watch')) {
            return false;
        }

        $tags = json_decode($request->tags ?? '[]', true);
        if (is_array($tags)) {
            foreach ($tags as $tagData) {
                $tag = strtolower(is_array($tagData) ? ($tagData['value'] ?? '') : (string) $tagData);
                if (str_contains($tag, 'diamond')) {
                    return true;
                }
            }
        }

        return $product ? $product->hasDiamondTag() : false;
    }

    private function calculateAutoPrice(Request $request, ?Products $product = null): ?float
    {
        $description = $request->description ?? '';
        $goldWeight = $request->filled('gold_weight') ? (float) $request->gold_weight : null;

        if ($this->requestUsesDiamondPricing($request, $product) && $request->filled('diamond_price')) {
            return DiamondPriceCalculator::calculateFromDescription(
                $description,
                (float) $request->diamond_price,
                $goldWeight
            );
        }

        return GoldPriceCalculator::calculateFromDescription($description, $goldWeight);
    }

    public function allProducts(){
        try {
            $categories = Categories::all();
            $subcategories = Subcategory::all();
            // $products = Products::with('category', 'tags')->get();
            $products = Products::with('category', 'tags')->orderByDesc('created_at')->paginate(20);
            return view('admin.product.all_products', compact('products', 'categories', 'subcategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

     public function getProductsAjax(Request $request)
    {
        // dd($request->all());
        $query = Products::query();

        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', $term)
                    ->orWhere('online_store_name', 'LIKE', $term);
            });
        }
        
        if ($request->filled('status') && $request->status !== 'Status') {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id') && $request->category_id !== 'Category') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('subcategory_id') && $request->subcategory_id !== 'Subcategory') {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        // $products = $query->get();
        $products = $query->paginate(20);

        // $html = view('admin.product.product_rows', compact('products'))->render();

        // return response()->json(['html' => $html]);
        $html = view('admin.product.product_rows', compact('products'))->render();
        $pagination = $products->links()->render();

        return response()->json([
            'html' => $html,
            'pagination' => $pagination
        ]);
    }


    public function addProductShow(Request $request){
        try {
            $categories = Categories::all();
            $subcategories = Subcategory::all();
            return view('admin.product.add_product', compact('categories', 'subcategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function updateProductShow(Request $request, $id){
        try {
            $categories = Categories::all();
            $subcategories = Subcategory::all();
            $product = Products::with('images', 'tags','category')->findOrFail($id); // get product with images and tags
            return view('admin.product.update_product', compact('categories', 'product', 'subcategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function createProduct(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                'name' => 'required',
               'image' => 'required|file|mimetypes:image/jpeg,image/png,image/avif',
                'category_id' => 'required',
                'price' => 'nullable|numeric|min:0',
                'diamond_price' => 'nullable|numeric|min:0',
                'gold_weight' => 'nullable|numeric|min:0',
                // AED price is optional / nullable
                'price_aed' => 'nullable|numeric|min:0',
            ]);
            $originalSlug = Str::slug($request->name, '-');
            $slug = $originalSlug;
            $i=1;
            while (Products::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i;
                $i++;
            }
            $product = new Products();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $image_name);
                $product->image = 'uploads/product/' . $image_name;
            }
            if($request->hasFile('hover_image')){
                $image = $request->file('hover_image');
                $image_name = $slug.'_hover.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $image_name);
                $product->hover_image = 'uploads/product/' . $image_name;
            }
            $discounted_price = 0;
            if($request->discount_percentage > 0){
                $discounted_price = $request->price - ($request->price * $request->discount_percentage / 100);
            }elseif($request->discounted_price > 0){
                $discounted_price = $request->discounted_price;
            }

            $product->name = $request->name;
            $product->online_store_name = $request->online_store_name;
            $product->slug = $slug;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->description = $request->description;
            $product->online_store_description = $request->online_store_description;
            $product->price = $request->price;
            // // Try to auto-calculate price from description (weight + karat)
            $calculatedPrice = $this->calculateAutoPrice($request);
            $basePrice = $calculatedPrice ?? ($request->price ?? 0);
            $product->price = $basePrice;
            $product->diamond_price = $request->filled('diamond_price') ? $request->diamond_price : null;
            $product->gold_weight = $request->filled('gold_weight') ? $request->gold_weight : null;
            // If AED price not provided, keep it null
            $product->price_aed = $request->filled('price_aed') ? $request->price_aed : null;
            $product->discounted_price = $discounted_price??0;
            $product->discount_percentage = $request->discount_percentage??0;
            $product->quantity = $request->filled('quantity') ? $request->quantity : null;  
            $product->status = $request->status;
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_keywords = $request->meta_keywords;
            $product->show_price = $request->show_price? '1': '0';
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->is_featured = $request->is_featured? '1': '0';
            $product->is_pinned = $request->boolean('is_pinned');
            $product->save();

            if($request->hasFile('uploaded_files')){
                foreach($request->file('uploaded_files') as $file){
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/product'), $name);
                    ProductImages::create([
                        'product_id' => $product->id,
                        'image' => 'uploads/product/' . $name,
                    ]);
                }
            }
            $tags = $request->tags;
            $tags = json_decode($tags,true);
            if($tags){
                foreach($tags as $tag){
                    $tag = $tag['value'];
                    // if tags are not exist then create
                    $tagExist = Tags::where('name', $tag)->first();
                    if(!$tagExist){
                        $tagExist = new Tags();
                        $tagExist->name = $tag;
                        $originalTagSlug = Str::slug($tag, '-');
                        $tagSlug = $originalTagSlug;
                        $i = 1;
                        while (Tags::where('slug', $tagSlug)->exists()) {
                            $tagSlug = $originalTagSlug . '-' . $i;
                            $i++;
                        }
                        $tagExist->slug = $tagSlug;
                        $tagExist->save();
                    }
                    ProductTags::updateOrCreate(
                        ['product_id' => $product->id, 'category_id' => $request->category_id, 'tag_id' => $tagExist->id],
                        ['product_id' => $product->id, 'category_id' => $request->category_id, 'tag_id' => $tagExist->id]
                    );
                }
            }

            return redirect()->route('all-products')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
   public function updateProduct(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'price' => 'nullable|numeric|min:0',
                'diamond_price' => 'nullable|numeric|min:0',
                'gold_weight' => 'nullable|numeric|min:0',
                // AED price is optional / nullable
                'price_aed' => 'nullable|numeric|min:0',
                'image' => 'nullable|file|mimetypes:image/jpeg,image/png,image/avif',
            ]);

            $product = Products::findOrFail($id);

            // Debug: Log the request data
            \Log::info('Update Product Request:', [
                'has_image' => $request->hasFile('image'),
                'image_name' => $request->file('image') ? $request->file('image')->getClientOriginalName() : 'no file',
                'all_files' => $request->allFiles(),
                'avatar_remove' => $request->input('avatar_remove'),
                'avatar_remove_hover_image' => $request->input('avatar_remove_hover_image'),
                'has_debug_image' => $request->hasFile('debug_image'),
                'debug_image_name' => $request->file('debug_image') ? $request->file('debug_image')->getClientOriginalName() : 'no file',
                'all_inputs' => $request->all()
            ]);

            // Slug generation
            if ($request->name != $product->name) {
                $originalSlug = Str::slug($request->name, '-');
                $slug = $originalSlug;
                $i = 1;
                while (Products::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $originalSlug . '-' . $i;
                    $i++;
                }
                $product->slug = $slug;
            } else {
                $slug = $product->slug;
            }

            // Main Image
            // Check if image should be removed
            if ($request->has('avatar_remove') && $request->avatar_remove == '1') {
                \Log::info('Removing main image');
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
                $product->image = null;
            } elseif ($request->hasFile('image')) {
                \Log::info('Processing main image upload');
                // Delete old image file if exists
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
                $image = $request->file('image');
                $image_name = $slug . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $image_name);
                $product->image = 'uploads/product/' . $image_name;
                \Log::info('Main image updated to: ' . $product->image);
            } else {
                \Log::info('No main image file uploaded');
            }

            // Debug: Try debug image input as fallback
            if ($request->hasFile('debug_image')) {
                \Log::info('Processing debug image upload as fallback');
                // Delete old image file if exists
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
                $image = $request->file('debug_image');
                $image_name = $slug . '_debug.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $image_name);
                $product->image = 'uploads/product/' . $image_name;
                \Log::info('Debug image updated to: ' . $product->image);
            }

            // Hover Image
            // Check if hover image should be removed
            if ($request->has('avatar_remove_hover_image') && $request->avatar_remove_hover_image == '1') {
                \Log::info('Removing hover image');
                if ($product->hover_image && file_exists(public_path($product->hover_image))) {
                    unlink(public_path($product->hover_image));
                }
                $product->hover_image = null;
            } elseif ($request->hasFile('hover_image')) {
                // Delete old hover image file if exists
                if ($product->hover_image && file_exists(public_path($product->hover_image))) {
                    unlink(public_path($product->hover_image));
                }
                $hoverImage = $request->file('hover_image');
                $hover_image_name = $slug . '_hover.' . $hoverImage->getClientOriginalExtension();
                $hoverImage->move(public_path('uploads/product'), $hover_image_name);
                $product->hover_image = 'uploads/product/' . $hover_image_name;
            }

            // Discounted price logic
            $discounted_price = 0;
            if ($request->discount_percentage > 0) {
                $discounted_price = $request->price - ($request->price * $request->discount_percentage / 100);
            } elseif ($request->discounted_price > 0) {
                $discounted_price = $request->discounted_price;
            }

            // Update product fields
            $product->name = $request->name;
            $product->online_store_name = $request->online_store_name;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->description = $request->description;
            $product->online_store_description = $request->online_store_description;
            $product->price = $request->price;
            // Try to auto-calculate price from description (weight + karat)
            $calculatedPrice = $this->calculateAutoPrice($request, $product);
            $basePrice = $calculatedPrice ?? ($request->price ?? 0);
            $product->price = $basePrice;
            $product->diamond_price = $request->filled('diamond_price') ? $request->diamond_price : null;
            $product->gold_weight = $request->filled('gold_weight') ? $request->gold_weight : null;
            // If AED price not provided, keep it null
            $product->price_aed = $request->filled('price_aed') ? $request->price_aed : null;
            $product->discount_type = $request->discount_option ?? 1;
            if($request->discount_option == 1){
                $product->discounted_price = 0.00;
                $product->discount_percentage = 0;
            }elseif($request->discount_option == 2){
                $product->discounted_price = 0.00;
                $product->discount_percentage = $request->discount_percentage ?? 0;
            }elseif($request->discount_option == 3){
                $product->discounted_price = $discounted_price ?? 0;
                $product->discount_percentage = 0;
            }
            $product->quantity = $request->filled('quantity') ? $request->quantity : null;
            $product->status = $request->status;
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_keywords = $request->meta_keywords;
            $product->show_price = $request->show_price ? '1' : '0';
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->is_featured = $request->is_featured? '1': '0';
            $product->is_pinned = $request->boolean('is_pinned');
            $product->save();

            // --- GALLERY IMAGES LOGIC ---

            // 1. Remove images not in keep_gallery_images[]
            $keepIds = $request->input('keep_gallery_images', []);
            $imagesToDelete = $product->images()->whereNotIn('id', $keepIds)->get();
            foreach ($imagesToDelete as $img) {
                // Delete file from folder
                if ($img->image && file_exists(public_path($img->image))) {
                    unlink(public_path($img->image));
                }
                $img->delete();
            }

            // 2. Add new uploaded files
            if ($request->hasFile('uploaded_files')) {
                foreach ($request->file('uploaded_files') as $file) {
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/product'), $name);
                    ProductImages::create([
                        'product_id' => $product->id,
                        'image' => 'uploads/product/' . $name,
                    ]);
                }
            }

            // --- TAGS LOGIC ---
            $tags = json_decode($request->tags, true);
            if ($tags) {
                // Remove old tags
                ProductTags::where('product_id', $product->id)->delete();

                foreach ($tags as $tagData) {
                    $tag = $tagData['value'];
                    $tagExist = Tags::where('name', $tag)->first();

                    if (!$tagExist) {
                        $tagExist = new Tags();
                        $tagExist->name = $tag;
                        $originalTagSlug = Str::slug($tag, '-');
                        $tagSlug = $originalTagSlug;
                        $i = 1;
                        while (Tags::where('slug', $tagSlug)->exists()) {
                            $tagSlug = $originalTagSlug . '-' . $i;
                            $i++;
                        }
                        $tagExist->slug = $tagSlug;
                        $tagExist->save();
                    }

                    ProductTags::updateOrCreate(
                        ['product_id' => $product->id, 'category_id' => $request->category_id, 'tag_id' => $tagExist->id],
                        ['product_id' => $product->id, 'category_id' => $request->category_id, 'tag_id' => $tagExist->id]
                    );
                }
            }

            return redirect()->route('all-products')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('product.index');
    }
    public function deleteProduct($id)
    {
        $product = Products::find($id);
        if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
        if ($product->hover_image && file_exists(public_path($product->hover_image))) {
                    unlink(public_path($product->hover_image));
                }
         $imagesToDelete = $product->images()->get();
            foreach ($imagesToDelete as $img) {
                // Delete file from folder
                if ($img->image && file_exists(public_path($img->image))) {
                    unlink(public_path($img->image));
                }
                $img->delete();
            }
        $product->delete();
        return redirect()->route('all-products')->with('success', 'Product deleted successfully');
    }

    public function bulkDeleteProducts(Request $request)
    {
        try {
            $request->validate([
                'product_ids' => 'required|array',
                'product_ids.*' => 'required|integer|exists:products,id',
            ]);

            $productIds = $request->product_ids;
            $deletedCount = 0;
            $errors = [];

            foreach ($productIds as $productId) {
                try {
                    $product = Products::find($productId);
                    if ($product) {
                        // Delete main image
                        if ($product->image && file_exists(public_path($product->image))) {
                            unlink(public_path($product->image));
                        }
                        // Delete hover image
                        if ($product->hover_image && file_exists(public_path($product->hover_image))) {
                            unlink(public_path($product->hover_image));
                        }
                        // Delete gallery images
                        $imagesToDelete = $product->images()->get();
                        foreach ($imagesToDelete as $img) {
                            if ($img->image && file_exists(public_path($img->image))) {
                                unlink(public_path($img->image));
                            }
                            $img->delete();
                        }
                        // Delete product
                        $product->delete();
                        $deletedCount++;
                    }
                } catch (\Exception $e) {
                    $errors[] = "Failed to delete product ID: {$productId} - " . $e->getMessage();
                }
            }

            if ($deletedCount > 0) {
                $message = $deletedCount === 1 
                    ? 'Product deleted successfully.' 
                    : "{$deletedCount} products deleted successfully.";
                
                if (!empty($errors)) {
                    $message .= ' Some errors occurred: ' . implode(', ', $errors);
                }

                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No products were deleted. ' . (!empty($errors) ? implode(', ', $errors) : '')
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete products: ' . $e->getMessage()
            ], 500);
        }
    }




    public function productCategories(){
        try {
            $productCategories = Categories::all();
            return view('admin.product.category', compact('productCategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function addProductCategoryShow(Request $request){
        try {
            return view('admin.product.add_category');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editProductCategoryShow($cat_id){
        try {
            $category = Categories::where('id', $cat_id)->first();
            return view('admin.product.edit_category', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function productCategoryStoreUpdate(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'status' => 'required|in:active,inactive',
            ]);
            $originalSlug = Str::slug($request->name, '-');
            $slug = $originalSlug;
            if($request->id){
                $i=1;
                $temp_slug = $slug;
                while (Categories::where('slug', $slug)->where('id', '!=', $request->id)->exists()) {
                    $slug = $originalSlug . '-' . $i;
                    $i++;
                }
                $productCategory = Categories::find($request->id);
                if($request->hasFile('image')){
                    if ($productCategory->image && file_exists(public_path($productCategory->image))) {
                        unlink(public_path($productCategory->image));
                    }
                    $image = $request->file('image');
                    $image_name = $slug.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/category'), $image_name);
                    $productCategory->image = 'uploads/category/' . $image_name;
                }
                if($request->banner_type == 'image'){
                    if($request->hasFile('banner_image')){
                        if ($productCategory->banner_url && file_exists(public_path($productCategory->banner_url))) {
                            unlink(public_path($productCategory->banner_url));
                        }
                        $banner = $request->file('banner_image');
                        $banner_name = $slug.'_banner_image.'.$banner->getClientOriginalExtension();
                        $banner->move(public_path('uploads/category'), $banner_name);
                        $productCategory->banner_url = 'uploads/category/' . $banner_name;
                    }
                } elseif($request->banner_type == 'video'){
                    if($request->hasFile('banner_video')){
                        if ($productCategory->banner_url && file_exists(public_path($productCategory->banner_url))) {
                            unlink(public_path($productCategory->banner_url));
                        }
                        $banner = $request->file('banner_video');
                        $banner_name = $slug.'_banner_video.'.$banner->getClientOriginalExtension();
                        $banner->move(public_path('uploads/category'), $banner_name);
                        $productCategory->banner_url = 'uploads/category/' . $banner_name;
                    }
                }
                $productCategory->name = $request->name;
                $productCategory->slug = $slug;
                $productCategory->description = $request->description??$productCategory->description??'';
                $productCategory->meta_title = $request->meta_title??$productCategory->meta_title??'';
                $productCategory->meta_description = $request->meta_description??$productCategory->meta_description??'';
                $productCategory->meta_keywords = $request->meta_keywords??$productCategory->meta_keywords??'';
                $productCategory->status = $request->status;
                $productCategory->banner_type = $request->banner_type;
                $productCategory->save();
                return redirect()->route('product-category');
            }
            $i=1;
            $slug = $originalSlug;
            while (Categories::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i;
                $i++;
            }
            $productCategory = new Categories();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $image_name);
                $productCategory->image = 'uploads/category/' . $image_name;
            }
            if($request->banner_type == 'image'){
                if($request->hasFile('banner_image')){
                    $banner = $request->file('banner_image');
                    $banner_name = $slug.'_banner_image.'.$banner->getClientOriginalExtension();
                    $banner->move(public_path('uploads/category'), $banner_name);
                    $productCategory->banner_url = 'uploads/category/' . $banner_name;
                }
            } elseif($request->banner_type == 'video'){
                if($request->hasFile('banner_video')){
                    $banner = $request->file('banner_video');
                    $banner_name = $slug.'_banner_video.'.$banner->getClientOriginalExtension();
                    $banner->move(public_path('uploads/category'), $banner_name);
                    $productCategory->banner_url = 'uploads/category/' . $banner_name;
                }
            }
            $productCategory->name = $request->name;
            $productCategory->slug = $slug;
            $productCategory->description = $request->description??'';
            $productCategory->meta_title = $request->meta_title??'';
            $productCategory->meta_description = $request->meta_description??'';
            $productCategory->meta_keywords = $request->meta_keywords??'';
            $productCategory->status = $request->status;
            $productCategory->banner_type = $request->banner_type;
            $productCategory->save();
            return redirect()->route('product-category');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteProductCategory($id)
    {
        $productCategory = Categories::find($id);
        if ($productCategory->banner_url && file_exists(public_path('uploads/category/' . $productCategory->banner_url))) {
            unlink(public_path('uploads/category/' . $productCategory->banner_url));
        }
        $productCategory->delete();
        return redirect()->route('product-category');
    }


     public function productSubCategories(){
        try {
            $productSubCategories = Subcategory::with('category')->get();
            return view('admin.product.sub_category', compact('productSubCategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
     public function addProductSubCategoryShow(Request $request){
        try {
            $productCategories = Categories::all();
            return view('admin.product.add_sub_category', compact('productCategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
     public function productSubCategoryStoreUpdate(Request $request)
    {
        // dd($request->all());
        try{
            $request->validate([
                'name' => 'required',
                'status' => 'required|in:active,inactive',
            ]);
            $originalSlug = Str::slug($request->name, '-');
            $slug = $originalSlug;
            if($request->id){
                $i=1;
                $temp_slug = $slug;
                while (Subcategory::where('slug', $slug)->where('id', '!=', $request->id)->exists()) {
                    $slug = $originalSlug . '-' . $i;
                    $i++;
                }
                $productCategory = Subcategory::find($request->id);
                if($request->hasFile('image')){
                    if ($productCategory->image && file_exists(public_path($productCategory->image))) {
                        unlink(public_path($productCategory->image));
                    }
                    $image = $request->file('image');
                    $image_name = $slug.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/subcategory'), $image_name);
                    $productCategory->image = 'uploads/subcategory/' . $image_name;
                }
                if($request->banner_type == 'image'){
                    if($request->hasFile('banner_image')){
                        if ($productCategory->banner_url && file_exists(public_path($productCategory->banner_url))) {
                            unlink(public_path($productCategory->banner_url));
                        }
                        $banner = $request->file('banner_image');
                        $banner_name = $slug.'_banner_image.'.$banner->getClientOriginalExtension();
                        $banner->move(public_path('uploads/subcategory'), $banner_name);
                        $productCategory->banner_url = 'uploads/subcategory/' . $banner_name;
                    }
                } elseif($request->banner_type == 'video'){
                    if($request->hasFile('banner_video')){
                        if ($productCategory->banner_url && file_exists(public_path($productCategory->banner_url))) {
                            unlink(public_path($productCategory->banner_url));
                        }
                        $banner = $request->file('banner_video');
                        $banner_name = $slug.'_banner_video.'.$banner->getClientOriginalExtension();
                        $banner->move(public_path('uploads/subcategory'), $banner_name);
                        $productCategory->banner_url = 'uploads/subcategory/' . $banner_name;
                    }
                }
                $productCategory->name = $request->name;
                $productCategory->slug = $slug;
                $productCategory->description = $request->description??$productCategory->description??'';
                $productCategory->meta_title = $request->meta_title??$productCategory->meta_title??'';
                $productCategory->meta_description = $request->meta_description??$productCategory->meta_description??'';
                $productCategory->meta_keywords = $request->meta_keywords??$productCategory->meta_keywords??'';
                $productCategory->status = $request->status;
                $productCategory->banner_type = $request->banner_type;
                $productCategory->category_id = $request->category;
                $productCategory->save();
                   $keepIds = $request->input('keep_gallery_images', []);
                $imagesToDelete = $productCategory->images()->whereNotIn('id', $keepIds)->get();
                foreach ($imagesToDelete as $img) {
                    // Delete file from folder
                    if ($img->image && file_exists(public_path($img->image))) {
                        unlink(public_path($img->image));
                    }
                    $img->delete();
                }
                  if($request->hasFile('uploaded_files')){
                foreach($request->file('uploaded_files') as $file){
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/product'), $name);
                    SubcatImages::create([
                        'sub_category_id' => $productCategory->id,
                        'image' => 'uploads/product/' . $name,
                    ]);
                }
            }
                return redirect()->route('product-sub-category');
            }
            $i=1;
            $slug = $originalSlug;
            while (Subcategory::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i;
                $i++;
            }
            $productCategory = new Subcategory();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/subcategory'), $image_name);
                $productCategory->image = 'uploads/subcategory/' . $image_name;
            }
            if($request->banner_type == 'image'){
                if($request->hasFile('banner_image')){
                    $banner = $request->file('banner_image');
                    $banner_name = $slug.'_banner_image.'.$banner->getClientOriginalExtension();
                    $banner->move(public_path('uploads/subcategory'), $banner_name);
                    $productCategory->banner_url = 'uploads/subcategory/' . $banner_name;
                }
            } elseif($request->banner_type == 'video'){
                if($request->hasFile('banner_video')){
                    $banner = $request->file('banner_video');
                    $banner_name = $slug.'_banner_video.'.$banner->getClientOriginalExtension();
                    $banner->move(public_path('uploads/subcategory'), $banner_name);
                    $productCategory->banner_url = 'uploads/subcategory/' . $banner_name;
                }
            }
            $productCategory->name = $request->name;
            $productCategory->slug = $slug;
            $productCategory->description = $request->description??'';
            $productCategory->meta_title = $request->meta_title??'';
            $productCategory->meta_description = $request->meta_description??'';
            $productCategory->meta_keywords = $request->meta_keywords??'';
            $productCategory->status = $request->status;
            $productCategory->banner_type = $request->banner_type;
            $productCategory->category_id = $request->category;
            $productCategory->save();
             if($request->hasFile('uploaded_files')){
                foreach($request->file('uploaded_files') as $file){
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/product'), $name);
                    SubcatImages::create([
                        'sub_category_id' => $productCategory->id,
                        'image' => 'uploads/product/' . $name,
                    ]);
                }
            }
            return redirect()->route('product-sub-category');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
     public function editProductSubCategoryShow($cat_id){
        try {
            $productCategories = Categories::all();
            $subcategory = Subcategory::where('id', $cat_id)->with('images')->first();
            return view('admin.product.edit_sub_category', compact('subcategory','productCategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }public function deleteProductSubCategory($id)
    {
        $productCategory = Subcategory::find($id);
        if ($productCategory->banner_url && file_exists(public_path('uploads/category/' . $productCategory->banner_url))) {
            unlink(public_path('uploads/category/' . $productCategory->banner_url));
        }
        $productCategory->delete();
        return redirect()->route('product-sub-category');
    }
    public function updateFeaturedProduct(Request $request, $id)
    {
        try {
            $product = Products::findOrFail($id);
            $product->is_featured = $request->is_featured? '1': '0';
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product featured status updated successfully.',
            ]);
        } catch (\Exception $e) {
             return response()->json([
                'success' => false,
                'message' => 'Failed to update product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function category($category)
    {
        $category = Categories::where('slug', $category)->firstOrFail();
        $products = $category->products()->pinnedFirst()->latest()->get(); // assuming relationship
         $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
                $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.category', compact('categories','watchCategories'));
    }

    public function subcategory($subcategory)
    {
        // $category = Categories::where('slug', $category)->firstOrFail();
        $category = Subcategory::where('slug', $subcategory)
        ->with('category') // eager-load the category 
        ->first()
        ?->category;
        if((isset($category) && stripos($category->name, 'watch') !== false) || (isset($category) && stripos($category->name, 'watches') !== false)){
        $subcategory = Subcategory::where('slug', $subcategory)
                // ->where('category_id', $category->id)
                ->firstOrFail();
                
            $products = $subcategory->products()->with('images')->where('status', 'published')->pinnedFirst()->latest()->paginate(20); // assuming relationship
            // dd($subcategory);
            $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
            $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
            // dd($products);
            
            // Check if this is Louis Moinet subcategory
            if (stripos($subcategory->slug, 'louis-moinet') !== false || stripos($subcategory->name, 'louis-moinet') !== false) {
                return view('public.collections.louis-moinet', compact('categories', 'products', 'subcategory','watchCategories'));
            }
            
            return view('public.bovet', compact('categories', 'products', 'subcategory','watchCategories'));
        }
        $subcategory = Subcategory::where('slug', $subcategory)
            // ->where('category_id', $category->id)
            ->first();
        $products = [];
        if($subcategory) {
            $products = $subcategory->products()->where('status', 'published')->pinnedFirst()->latest()->paginate(20);
        }else{
            return view('public.not_available');
        }
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        if ($subcategory && strtolower($subcategory->slug ?? '') === 'heritage') {
            return view('public.collections.heritage', compact('categories', 'products', 'subcategory', 'watchCategories'));
        }
        if ($subcategory && (strtolower($subcategory->slug ?? '') === 'ferragamo' || strtolower($subcategory->name ?? '') === 'ferragamo')) {
            return view('public.collections.ferragamo', compact('categories', 'products', 'subcategory', 'watchCategories'));
        }
        return view('public.category', compact('categories', 'products', 'subcategory','watchCategories'));
    }
}
