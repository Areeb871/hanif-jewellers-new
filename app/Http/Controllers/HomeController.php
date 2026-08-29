<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories;
use App\Models\Subcategory;
use App\Models\Products;
use App\Models\PageContent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\ProductImages;
use App\Models\ProductTags;
use App\Models\Tags;
use App\Models\EhedGalleryImage;
use App\Models\PureLockGalleryImage;
use App\Models\RefundPolicy;
use App\Models\TermsService;
use App\Models\ShippingPolicy;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\SolitaireProduct;
use App\Models\Review;
class HomeController extends Controller
{
    /**
     * Add tag matching clauses for slug and (optionally) strict word-boundary names.
     */
    protected function addTagMatchCondition($query, string $variant, bool $useWordBoundary = false): void
    {
        $normalized = strtolower($variant);

        $query->orWhereRaw('LOWER(slug) = ?', [$normalized]);

        if ($useWordBoundary) {
            $query->orWhereRaw('LOWER(name) REGEXP ?', [$this->buildWordBoundaryPattern($normalized)]);
        } else {
            $query->orWhereRaw('LOWER(name) LIKE ?', ["%{$normalized}%"]);
        }
    }

    /**
     * Build a case-insensitive word-boundary regexp for gender tags.
     */
    protected function buildWordBoundaryPattern(string $variant): string
    {
        $safeVariant = preg_quote(strtolower($variant), '/');

        return '(^|[^a-z0-9])' . $safeVariant . '([^a-z0-9]|$)';
    }

    /**
     * Apply a gender-specific filter that guards against partial substring matches.
     */
    protected function applyGenderFilter(Builder $query, Collection $genderTags, callable $expandToSlugVariants): void
    {
        if ($genderTags->isEmpty()) {
            return;
        }

        $variants = $genderTags
            ->flatMap(function ($g) use ($expandToSlugVariants) {
                return $expandToSlugVariants($g);
            })
            ->map(function ($variant) {
                return strtolower($variant);
            })
            ->filter()
            ->unique()
            ->values();

        if ($variants->isEmpty()) {
            return;
        }

        $query->whereHas('tags', function($q) use ($variants) {
            $q->where(function($qq) use ($variants) {
                foreach ($variants as $index => $variant) {
                    $method = $index === 0 ? 'where' : 'orWhere';
                    $qq->{$method}(function($group) use ($variant) {
                        $group->whereRaw('LOWER(slug) = ?', [$variant])
                              ->orWhereRaw('LOWER(name) = ?', [$variant]);
                    });
                }
            });
        });
    }
    public function highend()
{
  return view('public.highend_jewellery');
 
}
    public function haphazard_new()
{
    $allProducts = Products::whereHas('category', function ($q) {
            $q->whereRaw('LOWER(name) = ?', ['jewellery']);
        })
        ->whereHas('subcategory', function ($q) {
            $q->whereRaw('LOWER(name) = ?', ['haphazard']);
        })
        ->where('status', 'published')
        ->get();

    // Fixed sections
    $featuredProducts     = $allProducts->slice(0, 4);   // 1–4
    $sideProducts         = $allProducts->slice(4, 2);   // 5–6

    $bottomProducts       = $allProducts->slice(6, 4);   // 7–10
    $bottomProductsRow2   = $allProducts->slice(10, 4);  // 11–14

    // ✅ This is your promo-left 2 images row
    $bottomProductsRow3   = $allProducts->slice(14, 2);  // 15–16

    // ✅ Dynamic: after Row3 (start from index 16 till end) in rows of 4
    $dynamicBottomRows = $allProducts->slice(16)->chunk(4);

    $subcategory = Subcategory::where(function ($q) {
            $q->whereRaw('LOWER(slug) = ?', ['haphazard'])
              ->orWhereRaw('LOWER(name) = ?', ['haphazard']);
        })
        ->first();

    return view('public.haphazard', compact(
        'featuredProducts',
        'sideProducts',
        'bottomProducts',
        'bottomProductsRow2',
        'bottomProductsRow3',
        'dynamicBottomRows',
        'subcategory'
    ));
}
public function masterpiece()
{
  return view('public.masterpiece');
 
}

public function forevermark()
{
    return view('public.forevermark');
}

    public function corumCollection(Request $request)
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $corumSeries = [
            'admiral' => 'Admiral',
            'golden-bridge' => 'Golden Bridge',
            'bubble' => 'Bubble',
        ];

        $parseCsv = static function ($value): Collection {
            return collect(explode(',', (string) $value))
                ->map(fn ($item) => strtolower(trim($item)))
                ->filter()
                ->unique()
                ->values();
        };

        // Keep old `tags=` links working while the UI sends grouped parameters.
        $legacyTags = $parseCsv($request->input('tags', ''));
        $genderValues = ['mens', 'men', 'male', 'ladies', 'women', 'womens', 'female'];
        $seriesValues = array_keys($corumSeries);

        $gender = $parseCsv($request->input('gender', ''))
            ->merge($legacyTags->filter(fn ($tag) => in_array($tag, $genderValues, true)))
            ->unique()
            ->values();
        $series = $parseCsv($request->input('series', ''))
            ->merge($legacyTags->filter(fn ($tag) => in_array($tag, $seriesValues, true)))
            ->unique()
            ->values();
        $otherTags = $legacyTags
            ->reject(fn ($tag) => in_array($tag, $genderValues, true) || in_array($tag, $seriesValues, true))
            ->values();

        // Constrain the collection to Corum watches.
        $corumSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['corum'])
                  ->orWhereRaw('LOWER(name) = ?', ['corum']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory.watchPricingSetting', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function ($q) use ($corumSubcat) {
                if ($corumSubcat) {
                    $q->orWhere('subcategory_id', $corumSubcat->id);
                }
                $q->orWhereHas('subcategory', function ($qq) {
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%corum%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%corum%']);
                })
                ->orWhereHas('tags', function ($qq) {
                    $qq->whereRaw('LOWER(slug) = ?', ['corum'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%corum%']);
                });
            });
        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            if (in_array($base, ['mens', 'men', 'male'], true)) {
                $candidates = array_merge($candidates, ['mens', 'men', 'male']);
            }
            if (in_array($base, ['ladies', 'women', 'womens', 'female'], true)) {
                $candidates = array_merge($candidates, ['ladies', 'women', 'womens', 'female']);
            }
            if (in_array($base, ['admiral', 'admirals-cup', 'admiral-s-cup'], true)) {
                $candidates = array_merge($candidates, ['admiral', 'admirals-cup', "admiral's cup"]);
            }
            if (in_array($base, ['golden-bridge', 'corum-bridges', 'bridges'], true)) {
                $candidates = array_merge($candidates, ['golden-bridge', 'golden bridge', 'corum-bridges', 'corum bridges']);
            }
            if (in_array($base, ['lab', 'lab-01'], true)) {
                $candidates = array_merge($candidates, ['lab', 'lab-01', 'lab 01']);
            }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = $request->input('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Use the paginator's pre-limit total; the query builder now has page limit/offset.
        $totalFilteredProducts = $products->total();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Corum Collection Query:', [
            'corum_subcat_id' => $corumSubcat ? $corumSubcat->id : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
        ]);

        // Get the Corum subcategory for banner display
        $corumSubcategory = $corumSubcat;
        return view('public.collections.corum', compact('categories', 'watchCategories', 'products', 'corumSubcategory', 'corumSeries', 'totalFilteredProducts', 'currentPageProducts'));
    }

public function monalisa()
{
        $subcategory = \App\Models\Subcategory::where('slug', 'mona-lisa')->first();
$products = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->whereHas('category', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['jewellery']))
    ->whereHas('subcategory', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['Mona Lisa']))
    ->orderBy('id') // or ->orderBy('created_at')
    ->get();


    return view('public.mona_lisa', compact('subcategory','products'));
}
public function jewelphabets()
{
        $subcategory = \App\Models\Subcategory::where('slug', 'jewelphabets')->first();
$products = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->whereHas('category', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['jewellery']))
    ->whereHas('subcategory', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['jewelphabets']))
    ->orderBy('id') // or ->orderBy('created_at')
    ->get();

    return view('public.jewelphabets', compact('subcategory','products'));
}
public function tawoos()
{
    $categoryId = Categories::where('name', 'jewellery')->value('id');
$subcategoryId = Subcategory::where('name', 'tawoos')->value('id');

$products = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->where('category_id', $categoryId)
    ->where('subcategory_id', $subcategoryId)
    ->orderBy('id')
    ->get();
    return view('public.tawoos',compact('products'));
}
public function selene()
{
        $subcategory = \App\Models\Subcategory::where('slug', 'selene')->first();
$products = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->whereHas('category', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['jewellery']))
    ->whereHas('subcategory', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['Selene']))
    ->orderBy('id') // or ->orderBy('created_at')
    ->get();

    return view('public.selene', compact('subcategory','products'));
}
 public function mauriceLacroixCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $gender = collect(explode(',', request()->input('gender', '')))->map(fn($s)=>trim($s))->filter();
        $series = collect(explode(',', request()->input('series', '')))->map(fn($s)=>trim($s))->filter();
        $sizes  = collect(explode(',', request()->input('size', '')))->map(fn($s)=>trim($s))->filter();
        $tags   = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();

        // Constrain to category "Watches" and subcategory "maurice-lacroix"
        $mauriceLacroixSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['maurice-lacroix'])
                  ->orWhereRaw('LOWER(name) = ?', ['maurice lacroix']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($mauriceLacroixSubcat) {
                if ($mauriceLacroixSubcat) {
                    $q->orWhere('subcategory_id', $mauriceLacroixSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%maurice%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%maurice%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['maurice-lacroix'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%maurice lacroix%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];

            // Gender synonyms
            if (in_array($base, ['mens','men','gents','gent'], true)) { $candidates = array_merge($candidates, ['mens','men','gents']); }
            if (in_array($base, ['ladies','women','womens','female'], true)) { $candidates = array_merge($candidates, ['ladies','women','womens']); }

            // Sizes: accept 43, 43mm, etc.
            if (preg_match('/^([0-9]{2}(?:\.[0-9]{1,2})?)$/', $base, $m)) {
                $n = $m[1];
                $candidates = array_merge($candidates, [$n, $n.'mm']);
            }

            // Deduplicate
            return array_values(array_unique(array_filter($candidates)));
        };

        // Apply filters via tags if present (single consolidated param like online store)
        if ($tags->isNotEmpty()) {
            $tagValues = $tags->flatMap(function ($t) use ($expandToSlugVariants) { return $expandToSlugVariants($t); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($tagValues) {
                $q->where(function($qq) use ($tagValues){
                    $qq->whereIn('slug', $tagValues)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $tagValues->map(fn($v)=> strtolower($v))->all());
                });
            });
        }

        // Backwards compatibility: apply grouped params if used
        if ($tags->isEmpty() && $gender->isNotEmpty()) {
            $genderVals = $gender->flatMap(function ($g) use ($expandToSlugVariants) { return $expandToSlugVariants($g); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($genderVals) {
                $q->where(function($qq) use ($genderVals){
                    $qq->whereIn('slug', $genderVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $genderVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }
        if ($tags->isEmpty() && $series->isNotEmpty()) {
            $seriesVals = $series->flatMap(function ($s) use ($expandToSlugVariants) { return $expandToSlugVariants($s); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($seriesVals) {
                $q->where(function($qq) use ($seriesVals){
                    $qq->whereIn('slug', $seriesVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $seriesVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }
        if ($tags->isEmpty() && $sizes->isNotEmpty()) {
            $sizeVals = $sizes->flatMap(function ($s) use ($expandToSlugVariants) { return $expandToSlugVariants($s); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($sizeVals) {
                $q->where(function($qq) use ($sizeVals){
                    $qq->whereIn('slug', $sizeVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $sizeVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
                $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        \Log::info('Maurice Lacroix Collection Query:', [
            'maurice_lacroix_subcat_id' => $mauriceLacroixSubcat ? $mauriceLacroixSubcat->id : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings()
        ]);

        $mauriceLacroixSubcategory = $mauriceLacroixSubcat;
        return view('public.collections.maurice-lacroix', compact('categories', 'watchCategories', 'products', 'mauriceLacroixSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }
        public function eid()
    {
$baseQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->whereHas('category', fn($q) => $q->where('slug', 'jewellery'))
    ->whereHas('subcategory', fn($q) => $q->where('slug', 'eid-par-sony-ki-choriyan'))
    ->orderBy('id');

$firstFour = (clone $baseQuery)->take(4)->get();

$elevenToTwentyTwo = (clone $baseQuery)
    ->skip(4)
    ->take(13)
    ->get();

        return view('public.eid', compact('firstFour','elevenToTwentyTwo'));
    }
// public function haphazard_new(Request $request)
// {
//     $categories = Categories::with('subcategories')
//         ->where('name', 'not like', '%watch%')
//         ->get();

//     $watchCategories = Categories::with('subcategories')
//         ->where('name', 'like', '%watch%')
//         ->get();

//     // ✅ Base query: ONLY Jewellery -> Haphazard -> Published
//     $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
//         ->published()
//         ->whereHas('category', function ($qc) {
//             $qc->whereRaw('LOWER(name) = ?', ['jewellery']);
//         })
//         ->whereHas('subcategory', function ($qs) {
//             $qs->whereRaw('LOWER(name) = ?', ['haphazard']);
//         });

//     // ✅ STATIC TOP MENU TAG FILTER (single)
//     // URL example: ?tag=PENDANTS or ?tag=pendants
//     $allowedTagNames = ['PENDANTS','NECKLACES','RINGS','EARRINGS','EARCLIPS','BRACELETS'];

//     $tag = strtoupper(trim($request->input('tag', '')));

//     if (!empty($tag) && in_array($tag, $allowedTagNames)) {
//         // ✅ This works with multiple tags per product (pivot table)
//         $productsQuery->whereHas('tags', function ($qt) use ($tag) {
//             $qt->whereRaw('UPPER(tags.name) = ?', [$tag]);
//         });
//     }

//     // ✅ Sorting (your exact switch)
//     $sort = $request->input('sort');
//     switch ($sort) {
//         case 'az':
//             $productsQuery->orderBy('name', 'asc');
//             break;
//         case 'za':
//             $productsQuery->orderBy('name', 'desc');
//             break;
//         case 'price_low_high':
//             $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
//             break;
//         case 'price_high_low':
//             $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
//             break;
//         case 'new_old':
//             $productsQuery->orderBy('created_at', 'desc');
//             break;
//         case 'old_new':
//             $productsQuery->orderBy('created_at', 'asc');
//             break;
//         default:
//             $productsQuery->orderByDesc('created_at');
//     }

//     $products = $productsQuery->paginate(24)->withQueryString();

//     $subcategory = Subcategory::where(function ($q) {
//         $q->whereRaw('LOWER(slug) = ?', ['haphazard'])
//           ->orWhereRaw('LOWER(name) = ?', ['haphazard']);
//     })->first();

//     return view('public.haphazard', compact(
//         'categories',
//         'watchCategories',
//         'products',
//         'subcategory'
//     ));
// }
public function nagar(Request $request)
{
   $products = Products::with(['category', 'subcategory', 'images', 'tags'])
        ->where('status', 'published')
        ->whereHas('category', function ($qc) {
            $qc->whereRaw('LOWER(name) = ?', ['jewellery']);
        })
        ->whereHas('subcategory', function ($qs) {
            $qs->whereRaw('LOWER(name) = ?', ['nagar']);
        })
        ->get();

    return view('public.nagar_collection', compact('products'));
}
public function valentine(Request $request)
{
    $products = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->whereHas('category', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['jewellery']))
    ->whereHas('subcategory', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['valentine jewels']))
    ->orderBy('id') // or ->orderBy('created_at')
    ->get();
        return view('public.valentine', compact('products'));

}

public function index()
{
    try {
        if (Auth::check()) {
            return redirect()->intended('/admin/dashboard');
        }

        // Jewellery categories
        $categories = Categories::with('subcategories')
            ->where('name', 'not like', '%watch%')
            ->get();

        // Watch categories
        $watchCategories = Categories::with('subcategories')
            ->where('name', 'like', '%watch%')
            ->get();

        // New products section
        $products_new = Products::with('category', 'subcategory')
            ->where([
                ['status', 'published'],
                ['subcategory_id', 54]
            ])
            ->get();

        // Number of products per category
        $perCategory = 5;

        // Get any featured jewellery
        // category_id != 3 means watches will be excluded
        $jewellery = Products::with(['category', 'subcategory', 'images'])
            ->where('status', 'published')
            ->where('is_featured', 1)
            ->where('category_id', '!=', 3)
            ->inRandomOrder()
            ->take($perCategory)
            ->get();

        // Get featured watches for mixed products section
        $mixedWatches = Products::with(['category', 'subcategory', 'images'])
            ->where('status', 'published')
            ->where('is_featured', 1)
            ->where('category_id', 3)
            // ->whereIn('subcategory_id', [32, 33, 34, 35, 37, 28])
            ->inRandomOrder()
            ->take($perCategory)
            ->get();

        // Interleave: Jewellery, Watch, Jewellery, Watch
        $products = collect();
        $max = max($jewellery->count(), $mixedWatches->count());

        for ($i = 0; $i < $max; $i++) {
            if (isset($jewellery[$i])) {
                $products->push($jewellery[$i]);
            }

            if (isset($mixedWatches[$i])) {
                $products->push($mixedWatches[$i]);
            }
        }

        // Reset keys
        $products = $products->values();

        // All featured watches section
        $watches = Products::with('category', 'subcategory')
            ->where([
                ['status', 'published'],
                ['is_featured', 1],
                ['category_id', 3]
            ])
            ->get();

        return view('public.index', compact(
            'categories',
            'products',
            'watchCategories',
            'watches',
            'products_new'
        ));

    } catch (\Throwable $th) {
        return response()->json([
            'message' => 'SOMETHING WENT WRONG',
            'error' => $th->getMessage()
        ], 500);
    }
}
    
// public function Online_Shopping_Store(Request $request)
// {
//     $categories = Categories::with('subcategories')
//         ->where('name', 'not like', '%watch%')
//         ->get();

//     $watchCategories = Categories::with('subcategories')
//         ->where('name', 'like', '%watch%')
//         ->get();

//     $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
//         ->where('status', 'published');

//     $hasExplicitFilters = $request->filled('tags')
//         || $request->filled('subcat_pairs')
//         || $request->filled('subcat_name')
//         || $request->filled('cat_name');

//     $useDefaults = !$hasExplicitFilters;

//     /*
//     |--------------------------------------------------------------------------
//     | DEFAULT GOLD FILTER
//     |--------------------------------------------------------------------------
//     */
//     $applyDefaultGold = function ($q) {
//         $goldRegex = '(?i)[[:<:]]gold[[:>:]]';
//         $excludeGoldVariants = '(?i)(rose[-[:space:]]*gold|white[-[:space:]]*gold)';

//         $itemPatterns = [
//             '(?i)[[:<:]]mens[-[:space:]_]*rings?[[:>:]]',
//             '(?i)[[:<:]]rings?[[:>:]]',
//             '(?i)[[:<:]]earrings?[[:>:]]',
//             '(?i)[[:<:]]tops?[[:>:]]',
//             '(?i)[[:<:]]pendants?[[:>:]]',
//             '(?i)[[:<:]]chains?[[:>:]]',
//             '(?i)[[:<:]]bangles?[[:>:]]',
//             '(?i)[[:<:]]bracelets?[[:>:]]',
//         ];

//         $q->where(function ($qq) use ($goldRegex, $itemPatterns, $excludeGoldVariants) {
//             foreach ($itemPatterns as $pattern) {
//                 $qq->orWhere(function ($qqq) use ($goldRegex, $pattern, $excludeGoldVariants) {
//                     $orderedPattern = $goldRegex . '.*' . $pattern;

//                     $qqq->whereRaw('products.name REGEXP ?', [$orderedPattern])
//                         ->whereRaw('products.name NOT REGEXP ?', [$excludeGoldVariants]);
//                 });
//             }
//         });
//     };

//     /*
//     |--------------------------------------------------------------------------
//     | DEFAULT MODE
//     |--------------------------------------------------------------------------
//     */
//     if ($useDefaults) {
//         $productsQuery->where(function ($q) use ($applyDefaultGold) {
//             $q->where(function ($qq) use ($applyDefaultGold) {
//                 $applyDefaultGold($qq);
//             });

//             $q->orWhereHas('subcategory', function ($qs) {
//                 $qs->whereRaw('LOWER(name) = ?', ['haphazard']);
//             });
//         });
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | TAG FILTER
//     |--------------------------------------------------------------------------
//     */
//     if ($request->filled('tags')) {
//         $tagValues = array_filter(array_map('trim', explode(',', $request->input('tags'))));

//         $productsQuery->where(function ($mainQuery) use ($tagValues) {
//             foreach ($tagValues as $tag) {
//                 $tag = strtolower(trim($tag));

//                 $mainQuery->orWhere(function ($q) use ($tag) {

//                     // MEN RINGS
//                     if ($tag === 'mens_rings') {
//                         $q->where(function ($qq) {
//                             $qq->whereHas('subcategory', function ($subQ) {
//                                 $subQ->where(function ($sq) {
//                                     $sq->whereRaw('LOWER(name) IN (?, ?, ?, ?)', [
//                                         'mens rings',
//                                         'mens ring',
//                                         'men rings',
//                                         'men ring'
//                                     ])->orWhereRaw('LOWER(slug) IN (?, ?, ?, ?)', [
//                                         'mens-rings',
//                                         'mens_ring',
//                                         'men-rings',
//                                         'mens_rings'
//                                     ]);
//                                 });
//                             })
//                             ->orWhereHas('tags', function ($tagQ) {
//                                 $tagQ->where(function ($tq) {
//                                     $tq->whereRaw('LOWER(slug) IN (?, ?)', ['mens_rings', 'mens-rings'])
//                                       ->orWhereRaw('LOWER(name) IN (?, ?, ?, ?)', [
//                                           'mens rings',
//                                           'mens ring',
//                                           'men rings',
//                                           'men ring'
//                                       ]);
//                                 });
//                             })
//                             ->orWhere(function ($nameQ) {
//                                 $nameQ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]men[[:>:]]|[[:<:]]mens[[:>:]]'])
//                                       ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]ring[[:>:]]|[[:<:]]rings[[:>:]]']);
//                             });
//                         });
//                         return;
//                     }

//                     // GOLD RINGS (exclude men's — use mens_rings filter for those)
//                     if ($tag === 'gold_rings') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]ring[[:>:]]|[[:<:]]rings[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['[[:<:]]men[[:>:]]|[[:<:]]mens[[:>:]]|[[:<:]]gents?[[:>:]]']);
//                         return;
//                     }

//                     // GOLD TOPS
//                     if ($tag === 'gold_tops') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]top[[:>:]]|[[:<:]]tops[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
//                         return;
//                     }

//                     // GOLD CHAINS
//                     if ($tag === 'gold_chains') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]chain[[:>:]]|[[:<:]]chains[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
//                         return;
//                     }

//                     // GOLD PENDANTS
//                     if ($tag === 'gold_pendants') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]pendant[[:>:]]|[[:<:]]pendants[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
//                         return;
//                     }

//                     // GOLD BANGLES
//                     if ($tag === 'gold_bangles') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]bangle[[:>:]]|[[:<:]]bangles[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
//                         return;
//                     }

//                     // GOLD BRACELETS
//                     if ($tag === 'gold_bracelets') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]bracelet[[:>:]]|[[:<:]]bracelets[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
//                         return;
//                     }

//                     // GOLD EARRINGS
//                     if ($tag === 'gold_earrings') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]earring[[:>:]]|[[:<:]]earrings[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
//                         return;
//                     }

//                     // ALL DIAMONDS
//                     if ($tag === 'diamond_all') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]']);
//                         return;
//                     }

//                     // DIAMOND RINGS (exclude men's — use mens_rings filter for those)
//                     if ($tag === 'diamond_rings') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]ring[[:>:]]|[[:<:]]rings[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['[[:<:]]men[[:>:]]|[[:<:]]mens[[:>:]]|[[:<:]]gents?[[:>:]]']);
//                         return;
//                     }

//                     // DIAMOND PENDANTS
//                     if ($tag === 'diamond_pendants') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]pendant[[:>:]]|[[:<:]]pendants[[:>:]]']);
//                         return;
//                     }

//                     // DIAMOND EARRINGS
//                     if ($tag === 'diamond_earrings') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]earring[[:>:]]|[[:<:]]earrings[[:>:]]']);
//                         return;
//                     }

//                     // DIAMOND BANDS
//                     if ($tag === 'diamond_bands') {
//                         $q->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]'])
//                           ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]band[[:>:]]|[[:<:]]bands[[:>:]]']);
//                         return;
//                     }

//                     // NORMAL TAG MATCH
//                     $q->whereHas('tags', function ($tagQ) use ($tag) {
//                         $tagQ->whereRaw('LOWER(slug) = ?', [$tag])
//                              ->orWhereRaw('LOWER(name) = ?', [$tag]);
//                     });
//                 });
//             }
//         });
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | MULTI SUBCATEGORY FILTER
//     |--------------------------------------------------------------------------
//     */
//     if ($request->filled('subcat_pairs')) {
//         $pairs = collect(explode(',', $request->input('subcat_pairs')))
//             ->map(fn ($s) => trim($s))
//             ->filter();

//         if ($pairs->isNotEmpty()) {
//             $subcatIds = [];

//             foreach ($pairs as $pair) {
//                 [$catLabel, $subLabel] = array_pad(explode('|', $pair, 2), 2, '');
//                 $catLabel = trim($catLabel);
//                 $subLabel = trim($subLabel);

//                 if ($subLabel === '') {
//                     continue;
//                 }

//                 $map = [
//                     'mens_rings' => ['mens_rings', 'mens', 'men rings', 'men ring'],
//                     'rings'      => ['rings', 'ring'],
//                     'earrings'   => ['earrings', 'earring'],
//                     'bangles'    => ['bangles', 'bangle'],
//                     'bracelets'  => ['bracelets', 'bracelet'],
//                     'bands'      => ['bands', 'band'],
//                     'tops'       => ['tops', 'top'],
//                     'pendants'   => ['pendants', 'pendant'],
//                     'chains'     => ['chains', 'chain'],
//                 ];

//                 $low = strtolower($subLabel);
//                 $alts = $map[$low] ?? [$subLabel];

//                 $subQuery = Subcategory::query()->where(function ($q) use ($alts) {
//                     foreach ($alts as $a) {
//                         $q->orWhereRaw('LOWER(name) = ?', [strtolower($a)]);
//                         $q->orWhereRaw('LOWER(slug) = ?', [strtolower(str_replace(' ', '-', $a))]);
//                     }
//                 });

//                 if ($catLabel !== '') {
//                     $subQuery->whereHas('category', function ($q) use ($catLabel) {
//                         $q->whereRaw('LOWER(name) = ?', [strtolower($catLabel)]);
//                     });
//                 }

//                 $found = $subQuery->first();

//                 if ($found) {
//                     $subcatIds[] = $found->id;
//                 }
//             }

//             if (!empty($subcatIds)) {
//                 $productsQuery->whereIn('subcategory_id', $subcatIds);
//             }
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | SINGLE SUBCATEGORY FILTER
//     |--------------------------------------------------------------------------
//     */
//     if ($request->filled('subcat_name')) {
//         $subName = trim($request->input('subcat_name'));
//         $catName = trim($request->input('cat_name', ''));

//         $map = [
//             'mens_rings' => ['mens_rings', 'mens', 'men rings', 'men ring'],
//             'rings'      => ['rings', 'ring'],
//             'earrings'   => ['earrings', 'earring'],
//             'bangles'    => ['bangles', 'bangle'],
//             'bracelets'  => ['bracelets', 'bracelet'],
//             'bands'      => ['bands', 'band'],
//             'tops'       => ['tops', 'top'],
//             'pendants'   => ['pendants', 'pendant'],
//             'chains'     => ['chains', 'chain'],
//         ];

//         $lower = strtolower($subName);
//         $alternates = $map[$lower] ?? [$subName];

//         $subQuery = Subcategory::query()->where(function ($q) use ($alternates) {
//             foreach ($alternates as $a) {
//                 $q->orWhereRaw('LOWER(name) = ?', [strtolower($a)]);
//                 $q->orWhereRaw('LOWER(slug) = ?', [strtolower(str_replace(' ', '-', $a))]);
//             }
//         });

//         if ($catName !== '') {
//             $subQuery->whereHas('category', function ($q) use ($catName) {
//                 $q->whereRaw('LOWER(name) = ?', [strtolower($catName)]);
//             });
//         }

//         $sub = $subQuery->first();

//         if ($sub) {
//             $productsQuery->where('subcategory_id', $sub->id);
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | SORT
//     |--------------------------------------------------------------------------
//     */
//     $sort = $request->input('sort');

//     $applySorting = function ($query) use ($sort) {
//         if ($sort === 'price_low_high' || $sort === 'price_high_low') {
//             return $query;
//         }

//         switch ($sort) {
//             case 'az':
//                 $query->orderBy('name', 'asc');
//                 break;

//             case 'za':
//                 $query->orderBy('name', 'desc');
//                 break;

//             case 'old_new':
//                 $query->orderBy('created_at', 'asc');
//                 break;

//             case 'new_old':
//             default:
//                 $query->orderBy('created_at', 'desc');
//                 break;
//         }

//         return $query;
//     };

//     /*
//     |--------------------------------------------------------------------------
//     | SPLIT PRODUCTS
//     |--------------------------------------------------------------------------
//     */
//     $haphazardQuery = (clone $productsQuery)->whereHas('subcategory', function ($q) {
//         $q->whereRaw('LOWER(name) = ?', ['haphazard']);
//     });

//     $onlineShoppingQuery = (clone $productsQuery)->where(function ($q) {
//         $q->whereDoesntHave('subcategory', function ($qs) {
//             $qs->whereRaw('LOWER(name) = ?', ['haphazard']);
//         });
//     });

//     $haphazardQuery = $applySorting($haphazardQuery);
//     $onlineShoppingQuery = $applySorting($onlineShoppingQuery);

//     $haphazardProducts = $haphazardQuery->get();
//     $onlineShoppingProducts = $onlineShoppingQuery->get();

//     /*
//     |--------------------------------------------------------------------------
//     | PRICE SORTING
//     |--------------------------------------------------------------------------
//     */
//     if ($sort === 'price_low_high') {
//         $haphazardProducts = $haphazardProducts->sortBy(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();

//         $onlineShoppingProducts = $onlineShoppingProducts->sortBy(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();
//     } elseif ($sort === 'price_high_low') {
//         $haphazardProducts = $haphazardProducts->sortByDesc(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();

//         $onlineShoppingProducts = $onlineShoppingProducts->sortByDesc(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();
//     } else {
//         $haphazardProducts = $haphazardProducts->values();
//         $onlineShoppingProducts = $onlineShoppingProducts->values();
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | CUSTOM PRIORITY SORTING
//     |--------------------------------------------------------------------------
//     */
//     $sortByGoldPriority = function ($products) {
//         return $products->sortBy(function ($product) {
//             $name = strtolower($product->name ?? '');

//             if (preg_match('/\bgold\b/', $name) && preg_match('/\bmens?\b/', $name) && preg_match('/\brings?\b/', $name)) {
//                 return 0;
//             }

//             if (preg_match('/\bgold\b/', $name) && preg_match('/\brings?\b/', $name)) {
//                 return 1;
//             }

//             if (preg_match('/\bgold\b/', $name) && preg_match('/\btops?\b/', $name)) {
//                 return 2;
//             }

//             if (preg_match('/\bgold\b/', $name) && preg_match('/\bearrings?\b/', $name)) {
//                 return 3;
//             }

//             if (preg_match('/\bgold\b/', $name) && preg_match('/\bpendants?\b/', $name)) {
//                 return 4;
//             }

//             if (preg_match('/\bgold\b/', $name) && preg_match('/\bbracelets?\b/', $name)) {
//                 return 5;
//             }

//             return 999;
//         })->values();
//     };

//     if ($useDefaults) {
//         $onlineShoppingProducts = $sortByGoldPriority($onlineShoppingProducts);
//         $haphazardProducts = $sortByGoldPriority($haphazardProducts);
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | MERGE PATTERN
//     |--------------------------------------------------------------------------
//     */
//     $mergedProducts = collect();

//     $oChunks = $onlineShoppingProducts->chunk(4)->values();
//     $hChunks = $haphazardProducts->chunk(4)->values();

//     $maxChunks = max($oChunks->count(), $hChunks->count());

//     for ($i = 0; $i < $maxChunks; $i++) {
//         if (isset($oChunks[$i])) {
//             $mergedProducts = $mergedProducts->merge($oChunks[$i]);
//         }

//         if (isset($hChunks[$i])) {
//             $mergedProducts = $mergedProducts->merge($hChunks[$i]);
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | PAGINATION
//     |--------------------------------------------------------------------------
//     */
//     $perPage = 24;
//     $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;

//     $currentItems = $mergedProducts
//         ->slice(($currentPage - 1) * $perPage, $perPage)
//         ->values();

//     $products = new \Illuminate\Pagination\LengthAwarePaginator(
//         $currentItems,
//         $mergedProducts->count(),
//         $perPage,
//         $currentPage,
//         [
//             'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
//             'query' => $request->query(),
//         ]
//     );

//     $currentPageProducts = $products->count();
//     $totalFilteredProducts = $products->total();

//     /*
//     |--------------------------------------------------------------------------
//     | AVAILABLE TAGS
//     |--------------------------------------------------------------------------
//     */
//     $availableTags = Tags::select('tags.id', 'tags.name', 'tags.slug')
//         ->join('product_tags', 'product_tags.tag_id', '=', 'tags.id')
//         ->join('products', 'products.id', '=', 'product_tags.product_id')
//         ->whereRaw('LOWER(products.status) = ?', ['published'])
//         ->when($useDefaults, function ($q) use ($applyDefaultGold) {
//             $q->where(function ($qq) use ($applyDefaultGold) {
//                 $applyDefaultGold($qq);
//             });
//         })
//         ->distinct()
//         ->orderBy('tags.name')
//         ->get();

//     if (!$availableTags->contains(function ($tag) {
//         return strtolower($tag->slug) === 'mens_rings';
//     })) {
//         $availableTags->prepend((object) [
//             'id' => 'mens_rings',
//             'name' => 'Men Rings',
//             'slug' => 'mens_rings',
//         ]);
//     }

//     return view('public.online-shopping-store', compact(
//         'categories',
//         'watchCategories',
//         'products',
//         'availableTags',
//         'currentPageProducts',
//         'totalFilteredProducts'
//     ));
// }

public function Online_Shopping_Store(Request $request)
{
    $categories = Categories::with('subcategories')
        ->where('name', 'not like', '%watch%')
        ->get();

    $watchCategories = Categories::with('subcategories')
        ->where('name', 'like', '%watch%')
        ->get();

    $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
        ->where('status', 'published');

    $hasExplicitFilters = $request->filled('tags')
        || $request->filled('subcat_pairs')
        || $request->filled('subcat_name')
        || $request->filled('cat_name');

    $useDefaults = !$hasExplicitFilters;
    $activeTags = trim((string) $request->input('tags', ''));

    // Default page: featured collections only (backend-only; not tied to filter buttons).
    if ($activeTags === '' && $useDefaults) {
        $activeTags = 'Hania Amir,monalisa,heritage-jewellery,purelook,breathtaking,jewelphabets,ehed,hasht,onlinestoreeid,';
    }

    // Featured collections: subcategory slugs (primary) + tag aliases (fallback for ordering/filters).
    $featuredCollections = [
        ['monalisa', 'mona-lisa'],
        ['purelook', 'pure-lock'],
        ['jewelphabets'],
        ['heritage'],
        // ['ehed'],
          ['ehed', 'love-engagement', 'love engagement'],
        ['selene'],
        ['hasht'],
    ];

    $productBelongsToCollection = function ($product, array $aliases): bool {
        $aliases = array_map('strtolower', $aliases);
        $sub = $product->subcategory ?? null;

        if ($sub) {
            $subSlug = strtolower((string) ($sub->slug ?? ''));
            $subName = strtolower((string) ($sub->name ?? ''));
            foreach ($aliases as $alias) {
                if ($subSlug === $alias || $subName === $alias) {
                    return true;
                }
            }
        }

        foreach ($product->tags ?? [] as $pt) {
            $tagSlug = strtolower((string) ($pt->slug ?? ''));
            $tagName = strtolower((string) ($pt->name ?? ''));
            foreach ($aliases as $alias) {
                if ($tagSlug === $alias || $tagName === $alias) {
                    return true;
                }
            }
        }

        return false;
    };

    /*
    |--------------------------------------------------------------------------
    | TAG / FILTER (name OR tags OR subcategory — depending on filter key)
    |--------------------------------------------------------------------------
    */
    $tagVariants = function (string $tag): array {
        $tag = strtolower(trim($tag));

        return array_values(array_unique([
            $tag,
            str_replace('_', ' ', $tag),
            str_replace('_', '-', $tag),
        ]));
    };

    $filterTagAliases = [
        'gold_rings'       => ['ring', 'rings'],
        'gold_earrings'    => ['earring', 'earrings'],
        'gold_pendants'    => ['pendant', 'pendants'],
        'gold_bangles'     => ['bangle', 'bangles', 'gold-bangles'],
        'gold_bracelets'   => ['bracelet', 'bracelets'],
        'gold_chains'      => ['chain', 'chains'],
        'gold_tops'        => ['top', 'tops'],
        'diamond_rings'    => ['diamond-ring'],
        'diamond_earrings' => ['diamond-earring'],
        'diamond_pendants' => ['diamond-pendant'],
        'diamond_bands'    => ['band', 'bands', 'diamond-band'],
        'diamond_all'      => ['diamond', 'diamonds'],
    ];

    $filterTagVariants = function (string $tag) use ($tagVariants, $filterTagAliases): array {
        $tag = strtolower(trim($tag));

        return array_values(array_unique(array_merge(
            $tagVariants($tag),
            $filterTagAliases[$tag] ?? []
        )));
    };

    $applyTagFilterToQuery = function ($q, string $tag) use ($tagVariants, $featuredCollections, $filterTagVariants) {
        $tag = strtolower(trim($tag));

        if ($tag === 'mens_rings') {
            $q->where(function ($qq) {
                $qq->whereHas('subcategory', function ($subQ) {
                    $subQ->where(function ($sq) {
                        $sq->whereRaw('LOWER(name) IN (?, ?, ?, ?)', [
                            'mens rings', 'mens ring', 'men rings', 'men ring',
                        ])->orWhereRaw('LOWER(slug) IN (?, ?, ?, ?)', [
                            'mens-rings', 'mens_ring', 'men-rings', 'mens_rings',
                        ]);
                    });
                })
                ->orWhereHas('tags', function ($tagQ) {
                    $tagQ->where(function ($tq) {
                        $tq->whereRaw('LOWER(slug) IN (?, ?)', ['mens_rings', 'mens-rings'])
                           ->orWhereRaw('LOWER(name) IN (?, ?, ?, ?)', [
                               'mens rings', 'mens ring', 'men rings', 'men ring',
                           ]);
                    });
                })
                ->orWhere(function ($nameQ) {
                    $nameQ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]men[[:>:]]|[[:<:]]mens[[:>:]]'])
                          ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]ring[[:>:]]|[[:<:]]rings[[:>:]]']);
                });
            });

            return;
        }

        $nameFilters = [
            'gold_rings'      => ['gold', 'ring', true, true],
            'gold_tops'       => ['gold', 'top', true, false],
            'gold_chains'     => ['gold', 'chain', true, false],
            'gold_pendants'   => ['gold', 'pendant', true, false],
            'gold_bangles'    => ['gold', 'bangle', true, false],
            'gold_bracelets'  => ['gold', 'bracelet', true, false],
            'gold_earrings'   => ['gold', 'earring', true, false],
            'diamond_all'     => ['diamond', null, false, false],
            'diamond_rings'   => ['diamond', 'ring', false, true],
            'diamond_pendants'=> ['diamond', 'pendant', false, false],
            'diamond_earrings'=> ['diamond', 'earring', false, false],
            'diamond_bands'   => ['diamond', 'band', false, false],
        ];

        if (isset($nameFilters[$tag])) {
            [$metal, $item, $excludeGoldVariants, $excludeMens] = $nameFilters[$tag];
            $tagVariantsForFilter = $filterTagVariants($tag);

            $q->where(function ($qq) use ($metal, $item, $excludeGoldVariants, $excludeMens, $tagVariantsForFilter) {
                $qq->where(function ($nameQ) use ($metal, $item, $excludeGoldVariants, $excludeMens) {
                    if ($item === null) {
                        $nameQ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]']);
                    } elseif ($metal === 'gold') {
                        $nameQ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]gold[[:>:]]'])
                            ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]' . $item . '[[:>:]]|[[:<:]]' . $item . 's[[:>:]]']);
                        if ($excludeGoldVariants) {
                            $nameQ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['rose[[:space:]-]*gold|white[[:space:]-]*gold']);
                        }
                        if ($excludeMens) {
                            $nameQ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['[[:<:]]men[[:>:]]|[[:<:]]mens[[:>:]]|[[:<:]]gents?[[:>:]]']);
                        }
                    } else {
                        $nameQ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]diamond[[:>:]]|[[:<:]]diamonds[[:>:]]'])
                            ->whereRaw('LOWER(products.name) REGEXP ?', ['[[:<:]]' . $item . '[[:>:]]|[[:<:]]' . $item . 's[[:>:]]']);
                        if ($excludeMens) {
                            $nameQ->whereRaw('LOWER(products.name) NOT REGEXP ?', ['[[:<:]]men[[:>:]]|[[:<:]]mens[[:>:]]|[[:<:]]gents?[[:>:]]']);
                        }
                    }
                });

                $qq->orWhereHas('tags', function ($tagQ) use ($tagVariantsForFilter) {
                    $tagQ->where(function ($tq) use ($tagVariantsForFilter) {
                        foreach ($tagVariantsForFilter as $lower) {
                            $tq->orWhereRaw('LOWER(slug) = ?', [$lower])
                               ->orWhereRaw('LOWER(TRIM(name)) = ?', [$lower]);
                        }
                    });
                });
            });

            return;
        }

        foreach ($featuredCollections as $aliases) {
            if (in_array($tag, array_map('strtolower', $aliases), true)) {
                $q->where(function ($qq) use ($aliases) {
                    $qq->whereHas('subcategory', function ($subQ) use ($aliases) {
                        $subQ->where(function ($sq) use ($aliases) {
                            foreach ($aliases as $alias) {
                                $lower = strtolower($alias);
                                $sq->orWhereRaw('LOWER(slug) = ?', [$lower])
                                   ->orWhereRaw('LOWER(name) = ?', [$lower]);
                            }
                        });
                    })->orWhereHas('tags', function ($tagQ) use ($aliases) {
                        $tagQ->where(function ($tq) use ($aliases) {
                            foreach ($aliases as $alias) {
                                $lower = strtolower($alias);
                                $tq->orWhereRaw('LOWER(slug) = ?', [$lower])
                                   ->orWhereRaw('LOWER(name) = ?', [$lower]);
                            }
                        });
                    });
                });

                return;
            }
        }

        $variants = $tagVariants($tag);
        $q->where(function ($qq) use ($variants) {
            $qq->whereHas('tags', function ($tagQ) use ($variants) {
                $tagQ->where(function ($tq) use ($variants) {
                    foreach ($variants as $lower) {
                        $tq->orWhereRaw('LOWER(slug) = ?', [$lower])
                           ->orWhereRaw('LOWER(name) = ?', [$lower]);
                    }
                });
            })->orWhereHas('subcategory', function ($subQ) use ($variants) {
                $subQ->where(function ($sq) use ($variants) {
                    foreach ($variants as $lower) {
                        $sq->orWhereRaw('LOWER(slug) = ?', [$lower])
                           ->orWhereRaw('LOWER(name) = ?', [$lower]);
                    }
                });
            });
        });
    };

    $productMatchesTag = function ($product, string $tag) use ($tagVariants, $featuredCollections, $productBelongsToCollection, $filterTagVariants) {
        $tag = strtolower(trim($tag));
        $name = strtolower($product->name ?? '');

        $productHasFilterTag = function ($product, string $tag) use ($filterTagVariants): bool {
            $variants = $filterTagVariants($tag);

            return collect($product->tags ?? [])->contains(function ($pt) use ($variants) {
                $slug = strtolower(trim((string) ($pt->slug ?? '')));
                $tagName = strtolower(trim((string) ($pt->name ?? '')));

                return in_array($slug, $variants, true) || in_array($tagName, $variants, true);
            });
        };

        if ($tag === 'mens_rings') {
            $sub = $product->subcategory ?? null;
            $subSlug = strtolower((string) ($sub->slug ?? ''));
            $subName = strtolower((string) ($sub->name ?? ''));

            return (preg_match('/\b(men|mens)\b/', $name) && preg_match('/\brings?\b/', $name))
                || in_array($subSlug, ['mens_rings', 'mens-rings', 'men-rings', 'mens_ring'], true)
                || in_array($subName, ['mens rings', 'mens ring', 'men rings', 'men ring'], true)
                || collect($product->tags ?? [])->contains(function ($pt) {
                    $slug = strtolower(trim((string) ($pt->slug ?? '')));
                    $tagName = strtolower(trim((string) ($pt->name ?? '')));

                    return in_array($slug, ['mens_rings', 'mens-rings'], true)
                        || in_array($tagName, ['mens rings', 'mens ring', 'men rings', 'men ring'], true);
                });
        }

        $nameChecks = [
            'gold_rings'       => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\brings?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name) && !preg_match('/\b(men|mens|gent)\b/', $name),
            'gold_tops'        => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\btops?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name),
            'gold_chains'      => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\bchains?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name),
            'gold_pendants'    => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\bpendants?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name),
            'gold_bangles'     => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\bbangles?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name),
            'gold_bracelets'   => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\bbracelets?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name),
            'gold_earrings'    => fn () => preg_match('/\bgold\b/', $name) && preg_match('/\bearrings?\b/', $name) && !preg_match('/rose[- ]*gold|white[- ]*gold/', $name),
            'diamond_all'      => fn () => preg_match('/\bdiamonds?\b/', $name),
            'diamond_rings'    => fn () => preg_match('/\bdiamonds?\b/', $name) && preg_match('/\brings?\b/', $name) && !preg_match('/\b(men|mens|gent)\b/', $name),
            'diamond_pendants' => fn () => preg_match('/\bdiamonds?\b/', $name) && preg_match('/\bpendants?\b/', $name),
            'diamond_earrings' => fn () => preg_match('/\bdiamonds?\b/', $name) && preg_match('/\bearrings?\b/', $name),
            'diamond_bands'    => fn () => preg_match('/\bdiamonds?\b/', $name) && preg_match('/\bbands?\b/', $name),
        ];

        if (isset($nameChecks[$tag])) {
            return $nameChecks[$tag]() || $productHasFilterTag($product, $tag);
        }

        foreach ($featuredCollections as $aliases) {
            if (in_array($tag, array_map('strtolower', $aliases), true)
                && $productBelongsToCollection($product, $aliases)) {
                return true;
            }
        }

        if ($productHasFilterTag($product, $tag)) {
            return true;
        }

        $sub = $product->subcategory ?? null;
        foreach ($tagVariants($tag) as $lower) {
            if (collect($product->tags ?? [])->contains(function ($pt) use ($lower) {
                return strtolower((string) ($pt->slug ?? '')) === $lower
                    || strtolower((string) ($pt->name ?? '')) === $lower;
            })) {
                return true;
            }
            if ($sub) {
                $subSlug = strtolower((string) ($sub->slug ?? ''));
                $subName = strtolower((string) ($sub->name ?? ''));
                if ($subSlug === $lower || $subName === $lower) {
                    return true;
                }
            }
        }

        return false;
    };

    if ($activeTags !== '') {
        $tagValues = array_filter(array_map('trim', explode(',', $activeTags)));

        $productsQuery->where(function ($mainQuery) use ($tagValues, $applyTagFilterToQuery) {
            foreach ($tagValues as $tag) {
                $mainQuery->orWhere(function ($q) use ($tag, $applyTagFilterToQuery) {
                    $applyTagFilterToQuery($q, strtolower(trim($tag)));
                });
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | MULTI SUBCATEGORY FILTER
    |--------------------------------------------------------------------------
    */
    if ($request->filled('subcat_pairs')) {
        $pairs = collect(explode(',', $request->input('subcat_pairs')))
            ->map(fn ($s) => trim($s))
            ->filter();

        if ($pairs->isNotEmpty()) {
            $subcatIds = [];

            foreach ($pairs as $pair) {
                [$catLabel, $subLabel] = array_pad(explode('|', $pair, 2), 2, '');
                $catLabel = trim($catLabel);
                $subLabel = trim($subLabel);

                if ($subLabel === '') {
                    continue;
                }

                $map = [
                    'mens_rings' => ['mens_rings', 'mens', 'men rings', 'men ring'],
                    'rings'      => ['rings', 'ring'],
                    'earrings'   => ['earrings', 'earring'],
                    'bangles'    => ['bangles', 'bangle'],
                    'bracelets'  => ['bracelets', 'bracelet'],
                    'bands'      => ['bands', 'band'],
                    'tops'       => ['tops', 'top'],
                    'pendants'   => ['pendants', 'pendant'],
                    'chains'     => ['chains', 'chain'],
                ];

                $low = strtolower($subLabel);
                $alts = $map[$low] ?? [$subLabel];

                $subQuery = Subcategory::query()->where(function ($q) use ($alts) {
                    foreach ($alts as $a) {
                        $q->orWhereRaw('LOWER(name) = ?', [strtolower($a)]);
                        $q->orWhereRaw('LOWER(slug) = ?', [strtolower(str_replace(' ', '-', $a))]);
                    }
                });

                if ($catLabel !== '') {
                    $subQuery->whereHas('category', function ($q) use ($catLabel) {
                        $q->whereRaw('LOWER(name) = ?', [strtolower($catLabel)]);
                    });
                }

                $found = $subQuery->first();

                if ($found) {
                    $subcatIds[] = $found->id;
                }
            }

            if (!empty($subcatIds)) {
                $productsQuery->whereIn('subcategory_id', $subcatIds);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SINGLE SUBCATEGORY FILTER
    |--------------------------------------------------------------------------
    */
    if ($request->filled('subcat_name')) {
        $subName = trim($request->input('subcat_name'));
        $catName = trim($request->input('cat_name', ''));

        $map = [
            'mens_rings' => ['mens_rings', 'mens', 'men rings', 'men ring'],
            'rings'      => ['rings', 'ring'],
            'earrings'   => ['earrings', 'earring'],
            'bangles'    => ['bangles', 'bangle'],
            'bracelets'  => ['bracelets', 'bracelet'],
            'bands'      => ['bands', 'band'],
            'tops'       => ['tops', 'top'],
            'pendants'   => ['pendants', 'pendant'],
            'chains'     => ['chains', 'chain'],
        ];

        $lower = strtolower($subName);
        $alternates = $map[$lower] ?? [$subName];

        $subQuery = Subcategory::query()->where(function ($q) use ($alternates) {
            foreach ($alternates as $a) {
                $q->orWhereRaw('LOWER(name) = ?', [strtolower($a)]);
                $q->orWhereRaw('LOWER(slug) = ?', [strtolower(str_replace(' ', '-', $a))]);
            }
        });

        if ($catName !== '') {
            $subQuery->whereHas('category', function ($q) use ($catName) {
                $q->whereRaw('LOWER(name) = ?', [strtolower($catName)]);
            });
        }

        $sub = $subQuery->first();

        if ($sub) {
            $productsQuery->where('subcategory_id', $sub->id);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SORT
    |--------------------------------------------------------------------------
    */
    $sort = $request->input('sort');

    $applySorting = function ($query) use ($sort) {
        $query->pinnedFirst();
        if ($sort === 'price_low_high' || $sort === 'price_high_low') {
            return $query;
        }

        switch ($sort) {
            case 'az':
                $query->orderBy('name', 'asc');
                break;

            case 'za':
                $query->orderBy('name', 'desc');
                break;

            case 'old_new':
                $query->orderBy('created_at', 'asc');
                break;

            case 'new_old':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;
    };

    /*
    |--------------------------------------------------------------------------
    | SIMPLE ARRANGEMENT (MIXING DISABLED)
    |--------------------------------------------------------------------------
    | NOTE:
    | Previous haphazard/non-haphazard split + chunk merge logic is intentionally
    | disabled so products render in a straightforward single ordered list.
    */
    $orderedProductsQuery = $applySorting(clone $productsQuery);
    $orderedProducts = $orderedProductsQuery->get();

    /*
    |--------------------------------------------------------------------------
    | PRICE SORTING
    |--------------------------------------------------------------------------
    */
    if ($sort === 'price_low_high') {
        $orderedProducts = $orderedProducts->sortBy(function ($product) {
            $desc = filled($product->online_store_description) ? $product->online_store_description : ($product->description ?? '');
            return (float) $product->finalPriceForDescription($desc);
        })->values();
    } elseif ($sort === 'price_high_low') {
        $orderedProducts = $orderedProducts->sortByDesc(function ($product) {
            $desc = filled($product->online_store_description) ? $product->online_store_description : ($product->description ?? '');
            return (float) $product->finalPriceForDescription($desc);
        })->values();
    } else {
        $orderedProducts = $orderedProducts->values();
    }

    /*
    |--------------------------------------------------------------------------
    | ENFORCE TAG SEQUENCE ORDER (AS WRITTEN IN tags PARAM)
    |--------------------------------------------------------------------------
    | Keep products grouped by incoming tag order, e.g.
    | heritage,monalisa,purelook => heritage first, then monalisa, then purelook.
    */
    if ($activeTags !== '') {
        $tagSequence = array_values(array_unique(array_filter(array_map(function ($tag) {
            return strtolower(trim($tag));
        }, explode(',', $activeTags)))));

        if (!empty($tagSequence)) {
            $matchesTag = $productMatchesTag;

            $orderedBySequence = collect();
            $seenProductIds = [];

            foreach ($tagSequence as $tag) {
                $matched = $orderedProducts->filter(function ($product) use ($matchesTag, $tag, &$seenProductIds) {
                    $id = (int) ($product->id ?? 0);
                    if ($id <= 0 || isset($seenProductIds[$id])) {
                        return false;
                    }
                    if (!$matchesTag($product, $tag)) {
                        return false;
                    }
                    $seenProductIds[$id] = true;
                    return true;
                });

                $orderedBySequence = $orderedBySequence->merge($matched);
            }

            // Keep non-matching items at the end without dropping anything.
            $remaining = $orderedProducts->filter(function ($product) use ($seenProductIds) {
                $id = (int) ($product->id ?? 0);
                return $id <= 0 || !isset($seenProductIds[$id]);
            });

            $orderedProducts = $orderedBySequence->merge($remaining)->values();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FINAL PRODUCT LIST
    |--------------------------------------------------------------------------
    */
    $mergedProducts = $orderedProducts->values();

    /*
    |--------------------------------------------------------------------------
    | PAGINATION
    |--------------------------------------------------------------------------
    */
    $perPage = 24;
    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;

    $currentItems = $mergedProducts
        ->slice(($currentPage - 1) * $perPage, $perPage)
        ->values();

    $products = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentItems,
        $mergedProducts->count(),
        $perPage,
        $currentPage,
        [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]
    );

    $currentPageProducts = $products->count();
    $totalFilteredProducts = $products->total();

    /*
    |--------------------------------------------------------------------------
    | AVAILABLE TAGS
    |--------------------------------------------------------------------------
    */
    $availableTags = Tags::select('tags.id', 'tags.name', 'tags.slug')
        ->join('product_tags', 'product_tags.tag_id', '=', 'tags.id')
        ->join('products', 'products.id', '=', 'product_tags.product_id')
        ->whereRaw('LOWER(products.status) = ?', ['published'])
        ->distinct()
        ->orderBy('tags.name')
        ->get();

    if (!$availableTags->contains(function ($tag) {
        return strtolower($tag->slug) === 'mens_rings';
    })) {
        $availableTags->prepend((object) [
            'id' => 'mens_rings',
            'name' => 'Men Rings',
            'slug' => 'mens_rings',
        ]);
    }

    return view('public.online-shopping-store', compact(
        'categories',
        'watchCategories',
        'products',
        'availableTags',
        'currentPageProducts',
        'totalFilteredProducts'
    ));
}


//   public function Online_Shopping_Store(Request $request)
// {
//     $categories = Categories::with('subcategories')
//         ->where('name', 'not like', '%watch%')
//         ->get();

//     $watchCategories = Categories::with('subcategories')
//         ->where('name', 'like', '%watch%')
//         ->get();

//     // Base query
//     $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
//         ->where('status', 'published');

//     // If user hasn't selected any filters, default to GOLD-only items
//     $hasExplicitFilters = $request->filled('tags')
//         || $request->filled('subcat_pairs')
//         || $request->filled('subcat_name')
//         || $request->filled('cat_name');

//     $useDefaults = !$hasExplicitFilters;

//     // Default gold filter
//     $applyDefaultGold = function ($q) {
//         $goldRegex = '(?i)[[:<:]]gold[[:>:]]';
//         $excludeGoldVariants = '(?i)(rose[-[:space:]]*gold|white[-[:space:]]*gold)';
//         $itemPatterns = [
//             '(?i)[[:<:]]rings?[[:>:]]',
//             '(?i)[[:<:]]earrings?[[:>:]]',
//             '(?i)[[:<:]]tops?[[:>:]]',
//             '(?i)[[:<:]]pendants?[[:>:]]',
//             '(?i)[[:<:]]chains?[[:>:]]',
//             '(?i)[[:<:]]bangles?[[:>:]]',
//             '(?i)[[:<:]]bracelets?[[:>:]]',
//         ];

//         $q->where(function ($qq) use ($goldRegex, $itemPatterns, $excludeGoldVariants) {
//             foreach ($itemPatterns as $pattern) {
//                 $qq->orWhere(function ($qqq) use ($goldRegex, $pattern, $excludeGoldVariants) {
//                     $orderedPattern = $goldRegex . '.*' . $pattern;

//                     $qqq->whereRaw('products.name REGEXP ?', [$orderedPattern])
//                         ->whereRaw('products.name NOT REGEXP ?', [$excludeGoldVariants]);
//                 });
//             }
//         });
//     };

//     /*
//     |--------------------------------------------------------------------------
//     | DEFAULT MODE
//     | Show gold online shopping products + include haphazard
//     |--------------------------------------------------------------------------
//     */
//     if ($useDefaults) {
//         $productsQuery->where(function ($q) use ($applyDefaultGold) {
//             $q->where(function ($qq) use ($applyDefaultGold) {
//                 $applyDefaultGold($qq);
//             });

//             $q->orWhereHas('subcategory', function ($qs) {
//                 $qs->whereRaw('LOWER(name) = ?', ['haphazard']);
//             });
//         });
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | TAG FILTER
//     |--------------------------------------------------------------------------
//     */
//     if ($request->filled('tags')) {
//         $tagValues = array_filter(array_map('trim', explode(',', $request->input('tags'))));

//         $customCombos = [
//             'gold_rings' => ['gold', 'ring'],
//             'gold_pendants' => ['gold', 'pendant'],
//             'gold_earrings' => ['gold', 'earring'],
//             'gold_bangles' => ['gold', 'bangle'],
//             'gold_bracelets' => ['gold', 'bracelet'],
//             'gold_chains' => ['gold', 'chain'],
//             'gold_tops' => ['gold', 'top'],
//             'diamond_rings' => ['diamond', 'ring'],
//             'diamond_pendants' => ['diamond', 'pendant'],
//             'diamond_earrings' => ['diamond', 'earring'],
//             'diamond_bands' => ['diamond', 'band'],
//         ];

//         $selectedCombos = [];

//         foreach ($tagValues as $k => $val) {
//             $key = strtolower($val);
//             if (isset($customCombos[$key])) {
//                 $selectedCombos[] = $customCombos[$key];
//                 unset($tagValues[$k]);
//             }
//         }

//         if (!empty($tagValues)) {
//             $productsQuery->whereHas('tags', function ($q) use ($tagValues) {
//                 $q->whereIn('slug', $tagValues)
//                   ->orWhereIn('tags.id', $tagValues);
//             });
//         }

//         if (!empty($selectedCombos)) {
//             $metalPatterns = [
//                 'gold' => '(?i)[[:<:]]gold[[:>:]]',
//                 'diamond' => '(?i)[[:<:]]diamonds?[[:>:]]',
//             ];

//             $itemPatterns = [
//                 'ring' => '(?i)[[:<:]]rings?[[:>:]]',
//                 'pendant' => '(?i)[[:<:]]pendants?[[:>:]]',
//                 'earring' => '(?i)[[:<:]]earrings?[[:>:]]',
//                 'bangle' => '(?i)[[:<:]]bangles?[[:>:]]',
//                 'bracelet' => '(?i)[[:<:]]bracelets?[[:>:]]',
//                 'chain' => '(?i)[[:<:]]chains?[[:>:]]',
//                 'top' => '(?i)[[:<:]]tops?[[:>:]]',
//                 'band' => '(?i)[[:<:]]bands?[[:>:]]',
//             ];

//             $productsQuery->where(function ($q) use ($selectedCombos, $metalPatterns, $itemPatterns) {
//                 foreach ($selectedCombos as $pair) {
//                     [$metal, $item] = $pair;

//                     $metalPattern = $metalPatterns[$metal] ?? ('(?i)[[:<:]]' . preg_quote($metal, '/') . '[[:>:]]');
//                     $itemPattern  = $itemPatterns[$item] ?? ('(?i)[[:<:]]' . preg_quote($item, '/') . 's?[[:>:]]');

//                     $q->orWhere(function ($qq) use ($metal, $metalPattern, $itemPattern) {
//                         if ($metal === 'gold') {
//                             $orderedPattern = $metalPattern . '.*' . $itemPattern;

//                             $qq->whereRaw('products.name REGEXP ?', [$orderedPattern])
//                               ->whereRaw('products.name NOT REGEXP ?', ['(?i)(rose[-[:space:]]*gold|white[-[:space:]]*gold)']);
//                         } else {
//                             $qq->whereRaw('products.name REGEXP ?', [$metalPattern])
//                               ->whereRaw('products.name REGEXP ?', [$itemPattern]);
//                         }
//                     });
//                 }
//             });
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | MULTI SUBCATEGORY FILTER
//     |--------------------------------------------------------------------------
//     */
//     if ($request->filled('subcat_pairs')) {
//         $pairs = collect(explode(',', $request->input('subcat_pairs')))
//             ->map(fn ($s) => trim($s))
//             ->filter();

//         if ($pairs->isNotEmpty()) {
//             $subcatIds = [];

//             foreach ($pairs as $pair) {
//                 [$catLabel, $subLabel] = array_pad(explode('|', $pair, 2), 2, '');
//                 $catLabel = trim($catLabel);
//                 $subLabel = trim($subLabel);

//                 if ($subLabel === '') {
//                     continue;
//                 }

//                 $map = [
//                     'rings' => 'ring',
//                     'earrings' => 'earring',
//                     'bangles' => 'bangle',
//                     'bracelets' => 'bracelet',
//                     'bands' => 'band',
//                     'tops' => 'top',
//                     'pendants' => 'pendant',
//                     'chains' => 'chain',
//                 ];

//                 $alts = [$subLabel];
//                 $low = strtolower($subLabel);

//                 if (isset($map[$low])) {
//                     $alts[] = $map[$low];
//                 }

//                 $subQuery = Subcategory::query()->where(function ($q) use ($alts) {
//                     foreach ($alts as $a) {
//                         $q->orWhereRaw('LOWER(name) = ?', [strtolower($a)]);
//                     }
//                 });

//                 if ($catLabel !== '') {
//                     $subQuery->whereHas('category', function ($q) use ($catLabel) {
//                         $q->whereRaw('LOWER(name) = ?', [strtolower($catLabel)]);
//                     });
//                 }

//                 $found = $subQuery->first();
//                 if ($found) {
//                     $subcatIds[] = $found->id;
//                 }
//             }

//             if (!empty($subcatIds)) {
//                 $productsQuery->whereIn('subcategory_id', $subcatIds);
//             }
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | SINGLE SUBCATEGORY FILTER
//     |--------------------------------------------------------------------------
//     */
//     if ($request->filled('subcat_name')) {
//         $subName = trim($request->input('subcat_name'));
//         $catName = trim($request->input('cat_name', ''));

//         $normalized = rtrim($subName);
//         $alternates = [$normalized];

//         $map = [
//             'rings' => 'ring',
//             'earrings' => 'earring',
//             'bangles' => 'bangle',
//             'bracelets' => 'bracelet',
//             'bands' => 'band',
//             'tops' => 'top',
//             'pendants' => 'pendant',
//             'chains' => 'chain',
//         ];

//         $lower = strtolower($normalized);
//         if (isset($map[$lower])) {
//             $alternates[] = $map[$lower];
//         }

//         $subQuery = Subcategory::query()->where(function ($q) use ($alternates) {
//             foreach ($alternates as $a) {
//                 $q->orWhereRaw('LOWER(name) = ?', [strtolower($a)]);
//             }
//         });

//         if ($catName !== '') {
//             $subQuery->whereHas('category', function ($q) use ($catName) {
//                 $q->whereRaw('LOWER(name) = ?', [strtolower($catName)]);
//             });
//         }

//         $sub = $subQuery->first();
//         if ($sub) {
//             $productsQuery->where('subcategory_id', $sub->id);
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | SORT
//     | No default low-to-high
//     |--------------------------------------------------------------------------
//     */
//     $sort = $request->input('sort');

//     $applySorting = function ($query) use ($sort) {
//         if ($sort === 'price_low_high' || $sort === 'price_high_low') {
//             return $query;
//         }

//         switch ($sort) {
//             case 'az':
//                 $query->orderBy('name', 'asc');
//                 break;

//             case 'za':
//                 $query->orderBy('name', 'desc');
//                 break;

//             case 'old_new':
//                 $query->orderBy('created_at', 'asc');
//                 break;

//             case 'new_old':
//             default:
//                 $query->orderBy('created_at', 'desc');
//                 break;
//         }

//         return $query;
//     };

//     /*
//     |--------------------------------------------------------------------------
//     | SPLIT PRODUCTS
//     |--------------------------------------------------------------------------
//     */
//     $haphazardQuery = (clone $productsQuery)->whereHas('subcategory', function ($q) {
//         $q->whereRaw('LOWER(name) = ?', ['haphazard']);
//     });

//     $onlineShoppingQuery = (clone $productsQuery)->where(function ($q) {
//         $q->whereDoesntHave('subcategory', function ($qs) {
//             $qs->whereRaw('LOWER(name) = ?', ['haphazard']);
//         });
//     });

//     $haphazardQuery = $applySorting($haphazardQuery);
//     $onlineShoppingQuery = $applySorting($onlineShoppingQuery);

//     $haphazardProducts = $haphazardQuery->get();
//     $onlineShoppingProducts = $onlineShoppingQuery->get();

//     /*
//     |--------------------------------------------------------------------------
//     | PRICE SORTING ONLY WHEN SELECTED
//     |--------------------------------------------------------------------------
//     */
//     if ($sort === 'price_low_high') {
//         $haphazardProducts = $haphazardProducts->sortBy(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();

//         $onlineShoppingProducts = $onlineShoppingProducts->sortBy(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();
//     } elseif ($sort === 'price_high_low') {
//         $haphazardProducts = $haphazardProducts->sortByDesc(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();

//         $onlineShoppingProducts = $onlineShoppingProducts->sortByDesc(function ($product) {
//             return (float) ($product->final_price ?? 0);
//         })->values();
//     } else {
//         $haphazardProducts = $haphazardProducts->values();
//         $onlineShoppingProducts = $onlineShoppingProducts->values();
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | MERGE PATTERN
//     | 4 Haphazard + 4 Online Shopping
//     |--------------------------------------------------------------------------
//     */
//     $mergedProducts = collect();

//     $hChunks = $haphazardProducts->chunk(4)->values();
//     $oChunks = $onlineShoppingProducts->chunk(4)->values();

//     $maxChunks = max($hChunks->count(), $oChunks->count());

//     for ($i = 0; $i < $maxChunks; $i++) {
//         if (isset($hChunks[$i])) {
//             $mergedProducts = $mergedProducts->merge($hChunks[$i]);
//         }

//         if (isset($oChunks[$i])) {
//             $mergedProducts = $mergedProducts->merge($oChunks[$i]);
//         }
//     }

//     /*
//     |--------------------------------------------------------------------------
//     | MANUAL PAGINATION
//     |--------------------------------------------------------------------------
//     */
//     $perPage = 24;
//     $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;

//     $currentItems = $mergedProducts
//         ->slice(($currentPage - 1) * $perPage, $perPage)
//         ->values();

//     $products = new \Illuminate\Pagination\LengthAwarePaginator(
//         $currentItems,
//         $mergedProducts->count(),
//         $perPage,
//         $currentPage,
//         [
//             'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
//             'query' => $request->query(),
//         ]
//     );

//     // Product counter
//     $currentPageProducts = $products->count();
//     $totalFilteredProducts = $products->total();

//     // Available tags
//     $availableTags = Tags::select('tags.id', 'tags.name', 'tags.slug')
//         ->join('product_tags', 'product_tags.tag_id', '=', 'tags.id')
//         ->join('products', 'products.id', '=', 'product_tags.product_id')
//         ->whereRaw('LOWER(products.status) = ?', ['published'])
//         ->when($useDefaults, function ($q) use ($applyDefaultGold) {
//             $q->where(function ($qq) use ($applyDefaultGold) {
//                 $applyDefaultGold($qq);
//             });
//         })
//         ->distinct()
//         ->orderBy('tags.name')
//         ->get();

//     return view('public.online-shopping-store', compact(
//         'categories',
//         'watchCategories',
//         'products',
//         'availableTags',
//         'currentPageProducts',
//         'totalFilteredProducts'
//     ));
// }
  public function contact_us()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.contact-us', compact('categories', 'watchCategories'));
    }
    public function locator()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.locator', compact('categories', 'watchCategories'));
    }
    public function assurance()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.assurance', compact('categories', 'watchCategories'));
    }
    public function about_us()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.about-us', compact('categories', 'watchCategories'));
    }
    public function after_sale_services()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.after-sale-services', compact('categories', 'watchCategories'));
    }
    public function care_instructions()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.care-instructions', compact('categories', 'watchCategories'));
    }
    public function bovet()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.bovet', compact('categories', 'watchCategories'));
    }

    public function privacyPolicy()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $page = PageContent::where('slug', 'privacy-policy')->first();

        return view('public.privacy_policy', compact('categories', 'watchCategories', 'page'));
    }

    public function refundPolicy()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $page = RefundPolicy::where('slug', 'refund-policy')->first();

        return view('public.refund_policy', compact('categories', 'watchCategories', 'page'));
    }

    public function termsOfService()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $page = TermsService::where('slug', 'terms-of-service')->first();

        return view('public.term_of_service', compact('categories', 'watchCategories', 'page'));
    }

    public function shippingPolicy()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $page = ShippingPolicy::where('slug', 'shipping-policy')->first();

        return view('public.shopping_policy', compact('categories', 'watchCategories', 'page'));
    }
         public function product_details($slug)
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $product = Products::with(
            'images',
            'tags',
            'category',
            'subcategory.watchPricingSetting'
        )
            ->where('slug', $slug)
            ->firstOrFail();

        $storeContext = request()->boolean('store');
        $isJewelleryProduct = strtolower(trim((string) $product->category?->name)) === 'jewellery';

        $recommendedProducts = Products::where('category_id', $product->category_id)
            ->where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->with(['category', 'images'])
            ->inRandomOrder()
            ->take(12)
            ->get();

        if ($storeContext && $isJewelleryProduct && $recommendedProducts->isEmpty()) {
            $recommendedProducts = Products::where('id', '!=', $product->id)
                ->where('status', 'published')
                ->whereHas('category', function ($query) {
                    $query->whereRaw('LOWER(name) = ?', ['jewellery']);
                })
                ->whereHas('subcategory', function ($query) {
                    $query->where(function ($subcategoryQuery) {
                        $subcategoryQuery
                            ->whereRaw('LOWER(name) = ?', ['breathtaking'])
                            ->orWhereRaw('LOWER(slug) = ?', ['breathtaking']);
                    });
                })
                ->with(['category', 'images'])
                ->inRandomOrder()
                ->take(12)
                ->get();
        }
        
        // changes for product details watches
        
        // return view('public.product-details', compact(
        $detailsView = $product->isWatchProduct()
            ? 'public.product-details-watches'
            : 'public.product-details';

        return view($detailsView, compact(
            'categories',
            'product',
            'watchCategories',
            'recommendedProducts',
            'storeContext'
        ));
    }

    public function high_end()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.high-end', compact('categories', 'watchCategories'));
    }
    public function ehed()
    {
        // Get all active gallery images ordered by display_order (we need up to 14 images)
        $allImages = EhedGalleryImage::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit(14)
            ->get();
        
        // First 4 images for gallery
        $galleryImages = $allImages->take(4);
        
        // Next 2 images for side by side (images 5-6, index 4-5)
        $productImages = $allImages->slice(4, 2);
        
        // Next 4 images for bottom section first row (images 7-10, index 6-9)
        $bottomImages = $allImages->slice(6, 4);
        
        // Next 4 images for bottom section second row (images 11-14, index 10-13)
        $bottomImagesRow2 = $allImages->slice(10, 4);

        // Ehed subcategory for dynamic banner (fallback handled on the view)
        $subcategory = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['ehed'])
                  ->orWhereRaw('LOWER(name) = ?', ['ehed']);
            })
            ->first();
        
        return view('public.ehed', compact(
            'galleryImages',
            'productImages',
            'bottomImages',
            'bottomImagesRow2',
            'subcategory'
        ));
    }
    public function cleopatra()
    {
        return view('public.cleopatra');
    }
    public function gehnawa()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        return view('public.gehnawa', compact('categories', 'watchCategories'));
    }
    public function gulposh()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $subcategory = Subcategory::where(function ($q) {
            $q->whereRaw('LOWER(slug) = ?', ['gulposh'])
              ->orWhereRaw('LOWER(name) = ?', ['gulposh']);
        })
        ->first();
        return view('public.gulposh', compact('subcategory', 'categories', 'watchCategories'));
    }

    public function pureLock()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $subcategory = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['pure-lock'])
                  ->orWhereRaw('LOWER(name) = ?', ['pure lock'])
                  ->orWhereRaw('LOWER(name) = ?', ['pure-lock']);
            })
            ->first();

        $allImages = PureLockGalleryImage::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit(14)
            ->get();

        $galleryImages = $allImages->take(4);
        $bottomImages = $allImages->slice(4, 4);
        $productImages = $allImages->slice(8, 2);

        return view('public.Pure-Lock', compact(
            'subcategory',
            'categories',
            'watchCategories',
            'galleryImages',
            'productImages',
            'bottomImages'
        ));
    }

    public function navratan()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        
        // Get the navratan subcategory for banner display
        $subcategory = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['navratan'])
                  ->orWhereRaw('LOWER(name) = ?', ['navratan']);
            })
            ->first();
        
        return view('public.navratan', compact('categories', 'watchCategories', 'subcategory'));
    }

    public function tajMahal()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        
        // Get the taj-mahal subcategory for banner display
        $subcategory = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['taj-mahal'])
                  ->orWhereRaw('LOWER(name) = ?', ['taj-mahal']);
            })
            ->first();
        
        return view('public.taj-mahal', compact('categories', 'watchCategories', 'subcategory'));
    }

    public function watches()
    {
        return view('public.watches');
    }
    public function import_csv()
    {
        $categories = Categories::all();
        $subcategories = Subcategory::all();
        return view('public.import_csv', compact('categories', 'subcategories'));
    }

    public function read_csv(Request $request)
    {
        // $path = storage_path('app/public/products.csv'); // Adjust the path as needed
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ]);


        // Get the real path to the uploaded CSV file (temporary path)
        $path = $request->file('csv_file')->getRealPath();


        if (($handle = fopen($path, "r")) !== FALSE) {
            $header = fgetcsv($handle); // Get column headers
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // $row = array_combine($header, $data);

                $row = $data;

                // Example: Check if 'Title' column matches 'ehed'
                // Do something with $row, like insert into DB or process
                //  if (isset($row[6]) && strtolower(trim($row[6])) === strtolower($request->keyword)) {
                if (isset($row[6]) && stripos(strtolower(trim($row[6])), strtolower($request->keyword)) !== false) {
                    // dd($row); // Example: dump the matching row and stop
                    $imageUrl = null;

                    try {
                        $imageUrl = $this->save_image($row[27], $row[1]);
                    } catch (\Exception $e) {
                        // Log or handle the error gracefully
                        Log::error('Image save failed for row: ' . $row[1] . ' — ' . $e->getMessage());

                        // Optional fallback
                        $imageUrl = 'uploads/product/default.jpg'; // or keep it null
                    } // Call the save_image function with image URL and title

                    // Do something with this row
                    $originalSlug = Str::slug($row[1], '-');
                    $slug = $originalSlug;
                    $i = 1;
                    while (Products::where('slug', $slug)->exists()) {
                        $slug = $originalSlug . '-' . $i;
                        $i++;
                    }
                    $product = new Products();
                    $product->name = $row[1];
                    $product->image = $imageUrl;
                    $product->slug = $slug;
                    // $product->sku = $row['SKU'];
                    // $product->barcode = $row['Barcode'];
                    $product->description = $row[2] ?? '';
                    if (strtolower($row[7]) == "true") {
                        $product->status = 'published';
                    } else {
                        $product->status = 'draft';
                    }
                    // $product->status = $row[7] ? 'published' : 'draft';
                    $product->price = $row[22] ?? 0;
                    $product->show_price = '1'; // Default to show price
                    if ($row[22] == 0 || $row[22] == 0.0 || $row[22] == null) {
                        $product->show_price = '0';
                    }
                    // $product->discounted_price = $discounted_price??0;
                    // $product->discount_percentage = $row['Discount Percentage']??0;
                    // $product->quantity = $row['Quantity']??0;
                    // $product->status = $row['Status'];
                    $product->meta_title = $row[31] ?? $row[1];
                    $product->meta_description = $row[32] ?? '';
                    // $product->meta_keywords = $row['Meta Keywords'];
                    $product->category_id = $request->category_id;
                    $product->subcategory_id = $request->subcategory_id;
                    $product->save();

                    $tags = $row[6] ? explode(',', $row[6]) : []; // Assuming tags are comma-separated
                    if ($tags) {
                        foreach ($tags as $tag) {
                            if (is_array($tag) && isset($tag['value'])) {
                                $tag = $tag['value'];
                            }
                            // if tags are not exist then create
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
                                ['product_id' => $product->id, 'category_id' => 1, 'tag_id' => $tagExist->id],
                                ['product_id' => $product->id, 'category_id' => 1, 'tag_id' => $tagExist->id]
                            );
                        }
                    }
                    // dd($row); // Example: dump the matching row and stop
                }
            }
            fclose($handle);
            $categories = Categories::all();
            $subcategories = Subcategory::all();
            return view('public.import_csv', compact('categories', 'subcategories'));
        } else {
            // Handle the error if the file cannot be opened
            return response()->json(['message' => 'Failed to open CSV file'], 500);
        }
    }

    public function save_image($imageUrl, $name)
    {

        // Generate a unique filename
        $timestamp = now()->format('Ymd_His');
        $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION); // jpg
        $filename = $name . '_' . $timestamp . '.' . $extension;

        // Destination path in public directory
        $savePath = public_path('uploads/product/' . $filename);

        // Ensure directory exists
        if (!file_exists(dirname($savePath))) {
            mkdir(dirname($savePath), 0755, true);
        }

        // Download and save the image
        $response = Http::get($imageUrl);
        if ($response->successful()) {
            file_put_contents($savePath, $response->body());
            return 'uploads/product/' . $filename; // Return the filename if successful
        } else {
            // Handle the error if the image download fails
            Log::error('Failed to download image from ' . $imageUrl);
            return false;
        }
    }
    
     public function solitaire_new()
{
    $products = Products::with('category', 'subcategory', 'images')->where([
            ['status', 'published'],
            ['category_id', 7],
            ['subcategory_id', 40]
        ])->get();
        return view('public.solitaire_new', compact('products'));
}
public function solitaire(Request $request)
{
    $allProducts = SolitaireProduct::where('status', 1)
        ->latest()
        ->get();

    $availableShapes = [
        'round' => 'Round',
        'oval' => 'Oval',
        'princess' => 'Princess',
    ];

    $availableMetals = $allProducts
        ->flatMap(function ($product) {
            return collect($product->metals ?? []);
        })
        ->filter(function ($metal) {
            return !empty($metal['code']);
        })
        ->unique('code')
        ->values();

    $allPrices = $allProducts
        ->flatMap(function ($product) {
            return collect($product->variants ?? [])
                ->filter(function ($variant) {
                    return !isset($variant['status'])
                        || $variant['status'] === true
                        || $variant['status'] === 1
                        || $variant['status'] === '1';
                })
                ->pluck('price');
        })
        ->filter(function ($price) {
            return $price !== null && $price !== '';
        })
        ->map(function ($price) {
            return (float) $price;
        });

    $maxFilterPrice = $allPrices->max() ?: 200000;

    $selectedShape = $request->query('shape');
    $selectedMetal = $request->query('metal');
    $selectedMinPrice = $request->query('min_price');
    $selectedMaxPrice = $request->query('max_price');
    $selectedSort = $request->query('sort', 'featured');

    $productsCollection = $allProducts->filter(function ($product) use (
        $selectedShape,
        $selectedMetal,
        $selectedMinPrice,
        $selectedMaxPrice
    ) {
        if ($selectedShape && strtolower($product->shape ?? '') !== strtolower($selectedShape)) {
            return false;
        }

        $variants = collect($product->variants ?? [])->filter(function ($variant) {
            return !isset($variant['status'])
                || $variant['status'] === true
                || $variant['status'] === 1
                || $variant['status'] === '1';
        });

        $hasVariantFilter = false;

        if ($selectedMetal) {
            $hasVariantFilter = true;

            $variants = $variants->filter(function ($variant) use ($selectedMetal) {
                return ($variant['metal_code'] ?? '') === $selectedMetal;
            });
        }

        if (
            ($selectedMinPrice !== null && $selectedMinPrice !== '') ||
            ($selectedMaxPrice !== null && $selectedMaxPrice !== '')
        ) {
            $hasVariantFilter = true;

            $minPrice = $selectedMinPrice !== null && $selectedMinPrice !== ''
                ? (float) $selectedMinPrice
                : 0;

            $maxPrice = $selectedMaxPrice !== null && $selectedMaxPrice !== ''
                ? (float) $selectedMaxPrice
                : PHP_INT_MAX;

            $variants = $variants->filter(function ($variant) use ($minPrice, $maxPrice) {
                $price = isset($variant['price']) && $variant['price'] !== ''
                    ? (float) $variant['price']
                    : null;

                return $price !== null
                    && $price >= $minPrice
                    && $price <= $maxPrice;
            });
        }

        if ($hasVariantFilter) {
            return $variants->isNotEmpty();
        }

        return true;
    })->values();

    $getProductPrice = function ($product) use ($selectedMetal) {
        $variants = collect($product->variants ?? [])->filter(function ($variant) {
            return !isset($variant['status'])
                || $variant['status'] === true
                || $variant['status'] === 1
                || $variant['status'] === '1';
        });

        if ($selectedMetal) {
            $variants = $variants->filter(function ($variant) use ($selectedMetal) {
                return ($variant['metal_code'] ?? '') === $selectedMetal;
            });
        }

        return $variants
            ->pluck('price')
            ->filter(function ($price) {
                return $price !== null && $price !== '';
            })
            ->map(function ($price) {
                return (float) $price;
            })
            ->min() ?? 999999999;
    };

    if ($selectedSort === 'price_low_high') {
        $productsCollection = $productsCollection->sortBy($getProductPrice)->values();
    } elseif ($selectedSort === 'price_high_low') {
        $productsCollection = $productsCollection->sortByDesc($getProductPrice)->values();
    } elseif ($selectedSort === 'newest') {
        $productsCollection = $productsCollection->sortByDesc('created_at')->values();
    }

    $perPage = 4;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    $products = new LengthAwarePaginator(
        $productsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values(),
        $productsCollection->count(),
        $perPage,
        $currentPage,
        [
            'path' => $request->url(),
            'query' => $request->query(),
        ]
    );

    return view('public.solitaire', compact(
        'products',
        'availableShapes',
        'availableMetals',
        'maxFilterPrice',
        'selectedShape',
        'selectedMetal',
        'selectedMinPrice',
        'selectedMaxPrice',
        'selectedSort'
    ));
}
public function solitaire_details($slug, Request $request)
{
    $product = SolitaireProduct::where('slug', $slug)
        ->where('status', 1)
        ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | Collections
    |--------------------------------------------------------------------------
    */
    $metals = collect($product->metals ?? [])->values();
    $carats = collect($product->diamond_carats ?? [])->values();
    $variants = collect($product->variants ?? [])->values();
    $metalImages = collect($product->metal_images ?? [])->values();
    $galleryImages = collect($product->gallery_images ?? [])->values();

    /*
    |--------------------------------------------------------------------------
    | Active Variants Only
    |--------------------------------------------------------------------------
    */
    $activeVariants = $variants->filter(function ($variant) {
        return !isset($variant['status'])
            || $variant['status'] === true
            || $variant['status'] === 1
            || $variant['status'] === '1';
    })->values();

    /*
    |--------------------------------------------------------------------------
    | Selected Metal From Previous Page URL
    |--------------------------------------------------------------------------
    */
    $selectedMetalCode = $request->query('metal')
        ?: ($product->default_metal_code ?: data_get($metals->first(), 'code'));

    $selectedMetal = $metals->firstWhere('code', $selectedMetalCode);

    if (!$selectedMetal) {
        $selectedMetal = $metals->first();
        $selectedMetalCode = data_get($selectedMetal, 'code');
    }

    /*
    |--------------------------------------------------------------------------
    | Selected Carat From Previous Page URL
    |--------------------------------------------------------------------------
    */
    $selectedCarat = $request->query('carat')
        ?: ($product->default_diamond_carat ?: data_get($carats->first(), 'value'));

    $selectedCaratIndex = $carats->search(function ($carat) use ($selectedCarat) {
        return number_format((float) data_get($carat, 'value', 0), 2, '.', '')
            === number_format((float) $selectedCarat, 2, '.', '');
    });

    if ($selectedCaratIndex === false) {
        $selectedCaratIndex = 0;
        $selectedCarat = data_get($carats->first(), 'value');
    }

    /*
    |--------------------------------------------------------------------------
    | Selected Variant Price
    | Exact: selected metal + selected carat
    |--------------------------------------------------------------------------
    */
    $selectedVariant = $activeVariants->first(function ($variant) use ($selectedMetalCode, $selectedCarat) {
        return ($variant['metal_code'] ?? '') === $selectedMetalCode
            && number_format((float) ($variant['diamond_carat'] ?? 0), 2, '.', '')
            === number_format((float) $selectedCarat, 2, '.', '');
    });

    /*
    |--------------------------------------------------------------------------
    | Selected Metal Images Only
    |--------------------------------------------------------------------------
    */
    $selectedMetalImageGroup = $metalImages->firstWhere('metal_code', $selectedMetalCode);

    $detailImages = collect(data_get($selectedMetalImageGroup, 'images', []));

    if ($detailImages->isEmpty() && $galleryImages->isNotEmpty()) {
        $detailImages = $galleryImages;
    }

    /*
    |--------------------------------------------------------------------------
    | Money Format
    |--------------------------------------------------------------------------
    */
    $currency = $product->currency ?? 'PKR';

    $formatMoney = function ($value) use ($currency) {
        if ($value === null || $value === '') {
            return '';
        }

        return $currency . ' ' . number_format((float) $value, 0);
    };

    /*
    |--------------------------------------------------------------------------
    | Related Products
    |--------------------------------------------------------------------------
    */
    $relatedProducts = SolitaireProduct::where('status', 1)
        ->where('id', '!=', $product->id)
        ->latest()
        ->take(6)
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Reviews
    |--------------------------------------------------------------------------
    */
    $reviews = Review::where('status', 1)
        ->latest()
        ->get();

    return view('public.solitaire_product_details', compact(
        'product',
        'metals',
        'carats',
        'variants',
        'activeVariants',
        'metalImages',
        'galleryImages',
        'detailImages',
        'selectedMetalCode',
        'selectedMetal',
        'selectedCarat',
        'selectedCaratIndex',
        'selectedVariant',
        'currency',
        'formatMoney',
        'relatedProducts',
        'reviews'
    ));
}





public function ehedCollection(Request $request)
{
    /*
     * Live data can contain duplicate tag slugs generated by Laravel, such as
     * "rose-gold-1" and "rose-gold-2". Treat only those numbered duplicates as
     * the canonical tag; do not match unrelated slugs containing the same words.
     */
    $whereCanonicalTagSlugIn = static function ($query, array $slugs): void {
        $query->where(function ($slugQuery) use ($slugs) {
            foreach ($slugs as $slug) {
                $slug = strtolower(trim($slug));

                if ($slug === '') {
                    continue;
                }

                $slugQuery->orWhere(function ($variantQuery) use ($slug) {
                    $variantQuery
                        ->whereRaw('LOWER(tags.slug) = ?', [$slug])
                        ->orWhereRaw('LOWER(tags.slug) REGEXP ?', [
                            '^' . preg_quote($slug, '/') . '-[0-9]+$'
                        ]);
                });
            }
        });
    };

    $categories = Categories::with('subcategories')
        ->where('name', 'not like', '%watch%')
        ->get();

    $watchCategories = Categories::with('subcategories')
        ->where('name', 'like', '%watch%')
        ->get();

    $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
        ->where('status', 'published')
        ->whereHas('category', function ($q) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%jewellery%']);
        })
        ->whereHas('subcategory', function ($q) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%love engagement%']);
        });

    if ($request->filled('tags')) {
        $tagValues = array_filter(array_map(function ($tag) {
            return strtolower(trim($tag));
        }, explode(',', $request->input('tags'))));

        if (!empty($tagValues)) {
            $productsQuery->whereHas('tags', function ($q) use ($tagValues, $whereCanonicalTagSlugIn) {
                $whereCanonicalTagSlugIn($q, $tagValues);
            });
        }
    }

    $sort = $request->input('sort');
     $productsQuery->pinnedFirst();

    switch ($sort) {
        case 'az':
            $productsQuery->orderBy('name', 'asc');
            break;

        case 'za':
            $productsQuery->orderBy('name', 'desc');
            break;

        case 'price_low_high':
            $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
            break;

        case 'price_high_low':
            $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
            break;

        case 'new_old':
            $productsQuery->orderBy('created_at', 'desc');
            break;

        case 'old_new':
            $productsQuery->orderBy('created_at', 'asc');
            break;

        default:
            $productsQuery->orderByDesc('created_at');
            break;
    }

    $products = $productsQuery->paginate(24)->withQueryString();

    $filterTagSlugs = [
        'white-gold',
        'rose-gold',
        'yellow-gold',
        '2mm',
        '3mm',
        '4mm',
        '5mm',
        '6mm',
        'sand',
        'silk',
        'polish',
    ];

    $availableTags = Tags::select('tags.id', 'tags.name', 'tags.slug')
        ->where(function ($q) use ($filterTagSlugs, $whereCanonicalTagSlugIn) {
            $whereCanonicalTagSlugIn($q, $filterTagSlugs);
        })
        ->whereHas('products', function ($q) {
            $q->where('status', 'published')
              ->whereHas('category', function ($subQ) {
                  $subQ->whereRaw('LOWER(name) LIKE ?', ['%jewellery%']);
              })
              ->whereHas('subcategory', function ($subQ) {
                  $subQ->whereRaw('LOWER(name) LIKE ?', ['%love engagement%']);
              });
        })
        ->orderBy('tags.name')
        ->get()
        ->map(function ($tag) {
            $tag->slug = preg_replace('/-[0-9]+$/', '', strtolower($tag->slug));
            return $tag;
        })
        ->unique('slug')
        ->values();

    return view('public.ehedShop', compact(
        'categories',
        'watchCategories',
        'products',
        'availableTags'
    ));
}


  public function hasht()
{
    $subcategory = \App\Models\Subcategory::where('slug', 'hasht')->first();

    return view('public.hasht', compact('subcategory'));
}
    public function misterio()
    {
        return view('public.misterio');
    }
    public function gohar()
    {
        return view('public.gohar');
    }
   public function qaws_al_matar()
{
    $subcategory = \App\Models\Subcategory::where('slug', 'qaws-al-matar')->first();

    return view('public.qaws-al-matar', compact('subcategory'));
}
   public function marchisio()
    {
         $products = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')
    ->whereHas('category', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['jewellery']))
    ->whereHas('subcategory', fn ($q) => $q->whereRaw('LOWER(name) = ?', ['marchisio']))
    ->orderBy('id') // or ->orderBy('created_at')
    ->get();
        return view('public.marchisio',compact('products'));
    }
    public function timeless_jewels()
    {
        return view('public.timeless-jewels');
    }

    public function divine()
    {
        return view('public.divine');
    }

    public function farahKhan()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        $products = Products::with('category', 'subcategory')->where('subcategory_id', '41')->where('status', 'published')->latest()->get();
        return view('public.farah-khan', compact('categories', 'watchCategories', 'products'));
    }

    public function divineTreasures(){
        return view('public.divineTreasures');
    }
    public function qaws_al_matar_collection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();
        // Resolve subcategory strictly as "Qaws-Al-Matar" (by slug or exact name)
        $collectionSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['qaws-al-matar'])
                  ->orWhereRaw('LOWER(name) = ?', ['qaws al matar'])
                  ->orWhereRaw('LOWER(name) = ?', ['qaws-al-matar']);
            })
            ->first();

        $products = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->when($collectionSubcat, function ($q) use ($collectionSubcat) {
                $q->where('subcategory_id', $collectionSubcat->id);
            }, function ($q) {
                // If subcategory not found, ensure no products are returned
                $q->whereRaw('1 = 0');
            })
            ->orderByDesc('created_at')
            ->paginate(24)
            ->withQueryString();

        return view('public.qaws-al-matar-collection', compact('categories', 'watchCategories', 'products'));
    }

    public function gehnawa_collection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        // Resolve subcategory strictly as "gehnawa" (by slug or exact/lower name)
        $collectionSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['gehnawa'])
                  ->orWhereRaw('LOWER(name) = ?', ['gehnawa']);
            })
            ->first();

        $products = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->when($collectionSubcat, function ($q) use ($collectionSubcat) {
                $q->where('subcategory_id', $collectionSubcat->id);
            }, function ($q) {
                // If subcategory not found, ensure no products are returned
                $q->whereRaw('1 = 0');
            })
            ->orderByDesc('created_at')
            ->paginate(24)
            ->withQueryString();

        return view('public.gehnawa-collection', compact('categories', 'watchCategories', 'products'));
    }
    public function favreLeubaCollection(Request $request)
{
    /* ===============================
       BASIC SETUP
    =============================== */
    $categories = Categories::where('status', 'published')->get();

    $watchCategories = Categories::where('status', 'published')
        ->where('name', 'LIKE', '%watch%')
        ->get();

    // Favre Leuba subcategory (case/variant safe)
    $favreSubcat = Subcategory::where(function ($q) {
        $slugVariants = ['favre-leuba', 'favreleuba', 'favre_leuba', 'favre leuba', 'fl'];
        $nameVariants = ['favre-leuba', 'favre leuba'];

        $q->whereIn(\DB::raw('LOWER(slug)'), $slugVariants)
          ->orWhereIn(\DB::raw('LOWER(name)'), $nameVariants);
    })->first();

    /* ===============================
       TAG PARSING
    =============================== */
    $tags = collect();
    if ($request->filled('tags')) {
        $tags = collect(explode(',', $request->tags))
            ->map(fn($t) => trim(strtolower($t)))
            ->filter()
            ->values();
    }

    // Gender tags
    $gender = $tags->filter(fn($t) => in_array($t, ['mens', 'ladies'], true))->values();

    // Favre series keys ONLY (important: do not treat every "-" tag as series)
    $validSeriesKeys = collect([
        'chief-chronograph',
        'chief-date',
        'deep-raider-revival',
        'sea-sky-revival',
        'deep-raider-renaissance',
    ]);

    $series = $tags->filter(fn($t) => $validSeriesKeys->contains($t))->values();

    // Everything else
    $otherTags = $tags->diff($gender)->diff($series)->values();

    /* ===============================
       BASE QUERY
    =============================== */
    $productsQuery = Products::with(['tags', 'subcategory'])
        ->where('status', 'published')
        ->whereHas('category', fn($q) => $q->where('name', 'LIKE', '%watch%'));

    if ($favreSubcat) {
        $productsQuery->where('subcategory_id', $favreSubcat->id);
    } else {
        // Fallback: in case subcategory missing, still try to match by "favre/leuba/fl"
        $productsQuery->where(function ($q) {
            $q->whereHas('tags', function ($tagQ) {
                $tagQ->whereRaw('LOWER(slug) LIKE ?', ['%favre%'])
                     ->orWhereRaw('LOWER(slug) LIKE ?', ['%leuba%'])
                     ->orWhereRaw('LOWER(slug) LIKE ?', ['%favre-leuba%'])
                     ->orWhereRaw('LOWER(slug) LIKE ?', ['%favreleuba%'])
                     ->orWhereRaw('LOWER(slug) = ?', ['fl'])
                     ->orWhereRaw('LOWER(name) LIKE ?', ['%favre%'])
                     ->orWhereRaw('LOWER(name) LIKE ?', ['%leuba%']);
            })
            ->orWhereRaw('LOWER(name) LIKE ?', ['%favre%'])
            ->orWhereRaw('LOWER(name) LIKE ?', ['%leuba%'])
            ->orWhereHas('subcategory', function ($subQ) {
                $subQ->whereRaw('LOWER(slug) LIKE ?', ['%favre%'])
                     ->orWhereRaw('LOWER(slug) LIKE ?', ['%leuba%'])
                     ->orWhereRaw('LOWER(slug) LIKE ?', ['%favre-leuba%'])
                     ->orWhereRaw('LOWER(slug) LIKE ?', ['%favreleuba%'])
                     ->orWhereRaw('LOWER(name) LIKE ?', ['%favre%'])
                     ->orWhereRaw('LOWER(name) LIKE ?', ['%leuba%']);
            });
        });
    }

    /* ===============================
       NORMALIZER + SERIES COMBOS
    =============================== */
    $normalize = fn($v) => str_replace('cheif', 'chief', strtolower(trim($v)));

    $favreSeriesCombos = [
        'chief-chronograph'        => ['chief', 'chronograph'],
        'chief-date'               => ['chief', 'date'],
        'deep-raider-revival'      => ['deep-raider', 'revival'],
        'sea-sky-revival'          => ['sea-sky', 'revival'],
        'deep-raider-renaissance'  => ['deep-raider', 'renaissance'],
    ];

    /* ===============================
       APPLY SERIES FILTER (OR between selected series)
       - Each series matches:
         A) combined slug (e.g. chief-chronograph)
         OR
         B) separate AND tags (chief + chronograph)
    =============================== */
    if ($series->isNotEmpty()) {
        $productsQuery->where(function ($outer) use ($series, $favreSeriesCombos, $normalize) {
            foreach ($series as $selected) {
                $key = $normalize($selected);
                if (!isset($favreSeriesCombos[$key])) continue;

                $outer->orWhere(function ($group) use ($key, $favreSeriesCombos) {
                    $requiredTags = $favreSeriesCombos[$key];

                    // A) combined slug
                    $group->whereHas('tags', function ($q) use ($key) {
                        $q->whereRaw('LOWER(slug) = ?', [$key]);
                    })

                    // B) OR separate AND tags
                    ->orWhere(function ($andBlock) use ($requiredTags) {
                        foreach ($requiredTags as $tag) {
                            $andBlock->whereHas('tags', function ($q2) use ($tag) {
                                $q2->whereRaw('LOWER(slug) = ?', [$tag]);
                            });
                        }
                    });
                });
            }
        });
    }

    /* ===============================
       APPLY GENDER FILTER (FIXED GROUPING)
    =============================== */
    if ($gender->isNotEmpty()) {
        $productsQuery->whereHas('tags', function ($q) use ($gender) {
            $q->where(function ($qq) use ($gender) {
                foreach ($gender as $g) {
                    $gg = strtolower($g);
                    $qq->orWhereRaw('LOWER(slug) = ?', [$gg])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%' . $gg . '%']);
                }
            });
        });
    }

    /* ===============================
       APPLY OTHER TAGS (FIXED GROUPING)
    =============================== */
    if ($otherTags->isNotEmpty()) {
        $productsQuery->whereHas('tags', function ($q) use ($otherTags) {
            $q->where(function ($qq) use ($otherTags) {
                foreach ($otherTags as $tag) {
                    $t = strtolower($tag);
                    $qq->orWhereRaw('LOWER(slug) = ?', [$t])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%' . $t . '%']);
                }
            });
        });
    }

    /* ===============================
       SORTING
    =============================== */
    $productsQuery->pinnedFirst();
    match ($request->get('sort')) {
        'az'              => $productsQuery->orderBy('name', 'asc'),
        'za'              => $productsQuery->orderBy('name', 'desc'),
        'price_low_high'  => $productsQuery->orderBy('price', 'asc'),
        'price_high_low'  => $productsQuery->orderBy('price', 'desc'),
        'old_new'         => $productsQuery->orderBy('created_at', 'asc'),
        'new_old'         => $productsQuery->orderBy('created_at', 'desc'),
        default           => $productsQuery->orderByDesc('created_at'),
    };

    /* ===============================
       COUNT BEFORE PAGINATE (IMPORTANT)
    =============================== */
    $totalFilteredProducts = (clone $productsQuery)->count();

    $products = $productsQuery->paginate(20)->withQueryString();
    $currentPageProducts = $products->count();

    \Log::info('Favre Leuba Collection Query:', [
        'favre_leuba_subcat_id' => $favreSubcat ? $favreSubcat->id : null,
        'tags' => $tags->all(),
        'gender' => $gender->all(),
        'series' => $series->all(),
        'other_tags' => $otherTags->all(),
        'current_page_products' => $currentPageProducts,
        'total_filtered_products' => $totalFilteredProducts,
        'total_products' => $products->total(),
        'current_page' => $products->currentPage(),
        'last_page' => $products->lastPage(),
        'query_sql' => $productsQuery->toSql(),
        'query_bindings' => $productsQuery->getBindings(),
    ]);

    $favreSubcategory = $favreSubcat;

    return view('public.collections.favre-leuba', compact(
        'categories',
        'watchCategories',
        'products',
        'favreSubcategory',
        'totalFilteredProducts',
        'currentPageProducts'
    ));
}

    public function bovetCollection(Request $request)
    {
        // Get all categories and watch categories for navigation
        $categories = Categories::where('status', 'published')->get();
        $watchCategories = Categories::where('status', 'published')->where('name', 'LIKE', '%watch%')->get();

        // Get Bovet subcategory
        $bovetSubcat = Subcategory::where('slug', 'bovet')->first();
        if (!$bovetSubcat) {
            abort(404, 'Bovet collection not found');
        }

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['manero', 'patravi', 'heritage', 'adamavi', 'pathos']));
        $otherTags = $tags->diff($gender)->diff($series);

        // Build query
        $productsQuery = Products::with(['tags', 'subcategory'])
            ->where('status', 'published')
            ->whereHas('category', function($q) {
                $q->where('name', 'LIKE', '%watch%');
            })
            ->where(function($q) use ($bovetSubcat) {
                $q->where('subcategory_id', $bovetSubcat->id)
                  ->orWhereHas('subcategory', function($subQ) use ($bovetSubcat) {
                      $subQ->where('slug', 'LIKE', '%' . $bovetSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $bovetSubcat->name . '%');
                  })
                  ->orWhereHas('tags', function($tagQ) use ($bovetSubcat) {
                      $tagQ->where('slug', 'LIKE', '%' . $bovetSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $bovetSubcat->name . '%');
                  });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Series synonyms - updated for new series
            if (in_array($base, ['manero'], true)) { $candidates = array_merge($candidates, ['manero']); }
            if (in_array($base, ['patravi'], true)) { $candidates = array_merge($candidates, ['patravi']); }
            if (in_array($base, ['heritage'], true)) { $candidates = array_merge($candidates, ['heritage']); }
            if (in_array($base, ['adamavi'], true)) { $candidates = array_merge($candidates, ['adamavi']); }
            if (in_array($base, ['pathos'], true)) { $candidates = array_merge($candidates, ['pathos']); }
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($gender, $expandToSlugVariants) {
                $q->where(function($qq) use ($gender, $expandToSlugVariants) {
                    foreach ($gender as $g) {
                        $variants = $expandToSlugVariants($g);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags) {
                $q->where(function($qq) use ($otherTags) {
                    foreach ($otherTags as $tag) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$tag])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
                    }
                });
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Bovet Collection Query:', [
            'bovet_subcat_id' => $bovetSubcat ? $bovetSubcat->id : null,
            'bovet_subcat_name' => $bovetSubcat ? $bovetSubcat->name : null,
            'bovet_subcat_slug' => $bovetSubcat ? $bovetSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Bovet subcategory for banner display
        $bovetSubcategory = $bovetSubcat;
        return view('public.collections.bovet', compact('categories', 'watchCategories', 'products', 'bovetSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function carlFBuchererCollection(Request $request)
    {
        // Get all categories and watch categories for navigation
        $categories = Categories::where('status', 'published')->get();
        $watchCategories = Categories::where('status', 'published')->where('name', 'LIKE', '%watch%')->get();

        // Get Carl F. Bucherer subcategory
        $carlFBuchererSubcat = Subcategory::where('slug', 'carl-f-bucherer')->first();
        if (!$carlFBuchererSubcat) {
            abort(404, 'Carl F. Bucherer collection not found');
        }

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['manero', 'patravi', 'heritage', 'adamavi', 'pathos']));
        $otherTags = $tags->diff($gender)->diff($series);

        // Build query
        $productsQuery = Products::with(['tags', 'subcategory'])
            ->where('status', 'published')
            ->whereHas('category', function($q) {
                $q->where('name', 'LIKE', '%watch%');
            })
            ->where(function($q) use ($carlFBuchererSubcat) {
                $q->where('subcategory_id', $carlFBuchererSubcat->id)
                  ->orWhereHas('subcategory', function($subQ) use ($carlFBuchererSubcat) {
                      $subQ->where('slug', 'LIKE', '%' . $carlFBuchererSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $carlFBuchererSubcat->name . '%');
                  })
                  ->orWhereHas('tags', function($tagQ) use ($carlFBuchererSubcat) {
                      $tagQ->where('slug', 'LIKE', '%' . $carlFBuchererSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $carlFBuchererSubcat->name . '%');
                  });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Series synonyms
            if (in_array($base, ['manero'], true)) { $candidates = array_merge($candidates, ['manero']); }
            if (in_array($base, ['patravi'], true)) { $candidates = array_merge($candidates, ['patravi']); }
            if (in_array($base, ['heritage'], true)) { $candidates = array_merge($candidates, ['heritage']); }
            if (in_array($base, ['adamavi'], true)) { $candidates = array_merge($candidates, ['adamavi']); }
            if (in_array($base, ['pathos'], true)) { $candidates = array_merge($candidates, ['pathos']); }
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($gender, $expandToSlugVariants) {
                $q->where(function($qq) use ($gender, $expandToSlugVariants) {
                    foreach ($gender as $g) {
                        $variants = $expandToSlugVariants($g);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags) {
                $q->where(function($qq) use ($otherTags) {
                    foreach ($otherTags as $tag) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$tag])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
                    }
                });
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Carl F. Bucherer Collection Query:', [
            'carl_f_bucherer_subcat_id' => $carlFBuchererSubcat ? $carlFBuchererSubcat->id : null,
            'carl_f_bucherer_subcat_name' => $carlFBuchererSubcat ? $carlFBuchererSubcat->name : null,
            'carl_f_bucherer_subcat_slug' => $carlFBuchererSubcat ? $carlFBuchererSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Carl F. Bucherer subcategory for banner display
        $carlFBuchererSubcategory = $carlFBuchererSubcat;
        return view('public.collections.carl-f-bucherer', compact('categories', 'watchCategories', 'products', 'carlFBuchererSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function cysCollection(Request $request)
{
    /* ===============================
       BASIC SETUP
    =============================== */
    $categories = Categories::where('status', 'published')->get();
    $watchCategories = Categories::where('status', 'published')
        ->where('name', 'LIKE', '%watch%')
        ->get();

    // Get CYS subcategory
    $cysSubcat = Subcategory::where('slug', 'cuervo-y-sobrinos')->first();

    /* ===============================
       TAG PARSING
    =============================== */
    $tags = collect();
    if ($request->filled('tags')) {
        $tags = collect(explode(',', $request->tags))
            ->map(fn($t) => trim(strtolower($t)))
            ->filter()
            ->values();
    }

    // Gender tags
    $gender = $tags->filter(fn($t) => in_array($t, ['mens', 'ladies'], true))->values();

    // CYS Series (ONLY these keys)
    $validCysSeriesKeys = collect([
        'historiador',
        'prominente',
        'vuelo',
        'buceador',
        'esplendidos',
        'robusto',
    ]);

    $series = $tags->filter(fn($t) => $validCysSeriesKeys->contains($t))->values();

    // Everything else
    $otherTags = $tags->diff($gender)->diff($series)->values();

    /* ===============================
       BASE QUERY
    =============================== */
    $productsQuery = Products::with(['tags', 'subcategory'])
        ->where('status', 'published')
        ->whereHas('category', function ($q) {
            $q->where('name', 'LIKE', '%watch%');
        });

    // If subcategory exists, filter by it; otherwise fallback
    if ($cysSubcat) {
        $productsQuery->where(function ($q) use ($cysSubcat) {
            $q->where('subcategory_id', $cysSubcat->id)
              ->orWhereHas('subcategory', function ($subQ) use ($cysSubcat) {
                  $subQ->where('slug', 'LIKE', '%' . $cysSubcat->slug . '%')
                       ->orWhere('name', 'LIKE', '%' . $cysSubcat->name . '%');
              })
              ->orWhereHas('tags', function ($tagQ) use ($cysSubcat) {
                  $tagQ->where('slug', 'LIKE', '%' . $cysSubcat->slug . '%')
                       ->orWhere('name', 'LIKE', '%' . $cysSubcat->name . '%');
              });
        });
    } else {
        // Fallback: search by tags or product name containing 'cys'
        $productsQuery->where(function ($q) {
            $q->whereHas('tags', function ($tagQ) {
                $tagQ->whereRaw('LOWER(slug) LIKE ?', ['%cys%'])
                     ->orWhereRaw('LOWER(name) LIKE ?', ['%cys%']);
            })
            ->orWhereRaw('LOWER(name) LIKE ?', ['%cys%'])
            ->orWhereHas('subcategory', function ($subQ) {
                $subQ->whereRaw('LOWER(slug) LIKE ?', ['%cys%'])
                     ->orWhereRaw('LOWER(name) LIKE ?', ['%cys%']);
            });
        });
    }

    /* ===============================
       CYS SERIES COMBOS
       - supports future multi-tag AND logic if you add it
    =============================== */
    $cysSeriesCombos = [
        'historiador' => ['historiador'],
        'prominente'  => ['prominente'],
        'vuelo'       => ['vuelo'],
        'buceador'    => ['buceador'],
        'esplendidos' => ['esplendidos'],
        'robusto'     => ['robusto'],
    ];

    /* ===============================
       APPLY SERIES FILTER (OR between selected series)
       - Each series matches:
         A) combined slug (e.g. historiador)
         OR
         B) separate AND tags (future-proof; here it's single tag)
    =============================== */
    if ($series->isNotEmpty()) {
        $productsQuery->where(function ($outer) use ($series, $cysSeriesCombos) {
            foreach ($series as $selected) {
                if (!isset($cysSeriesCombos[$selected])) continue;

                $outer->orWhere(function ($group) use ($selected, $cysSeriesCombos) {
                    $requiredTags = $cysSeriesCombos[$selected];

                    // A) combined slug
                    $group->whereHas('tags', function ($q) use ($selected) {
                        $q->whereRaw('LOWER(slug) = ?', [$selected]);
                    })

                    // B) OR separate AND tags (future-proof)
                    ->orWhere(function ($andBlock) use ($requiredTags) {
                        foreach ($requiredTags as $tag) {
                            $andBlock->whereHas('tags', function ($q2) use ($tag) {
                                $q2->whereRaw('LOWER(slug) = ?', [$tag]);
                            });
                        }
                    });
                });
            }
        });
    }

    /* ===============================
       APPLY GENDER FILTER (grouped)
    =============================== */
    if ($gender->isNotEmpty()) {
        $productsQuery->whereHas('tags', function ($q) use ($gender) {
            $q->where(function ($qq) use ($gender) {
                foreach ($gender as $g) {
                    $gg = strtolower($g);
                    $qq->orWhereRaw('LOWER(slug) = ?', [$gg])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%' . $gg . '%']);
                }
            });
        });
    }

    /* ===============================
       APPLY OTHER TAGS (grouped)
    =============================== */
    if ($otherTags->isNotEmpty()) {
        $productsQuery->whereHas('tags', function ($q) use ($otherTags) {
            $q->where(function ($qq) use ($otherTags) {
                foreach ($otherTags as $tag) {
                    $t = strtolower($tag);
                    $qq->orWhereRaw('LOWER(slug) = ?', [$t])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%' . $t . '%']);
                }
            });
        });
    }

    /* ===============================
       SORTING
    =============================== */
    $productsQuery->pinnedFirst();
    match ($request->get('sort')) {
        'az'              => $productsQuery->orderBy('name', 'asc'),
        'za'              => $productsQuery->orderBy('name', 'desc'),
        'price_low_high'  => $productsQuery->orderBy('price', 'asc'),
        'price_high_low'  => $productsQuery->orderBy('price', 'desc'),
        'old_new'         => $productsQuery->orderBy('created_at', 'asc'),
        'new_old'         => $productsQuery->orderBy('created_at', 'desc'),
        default           => $productsQuery->orderByDesc('created_at'),
    };

    /* ===============================
       COUNT BEFORE PAGINATE
    =============================== */
    $totalFilteredProducts = (clone $productsQuery)->count();

    $products = $productsQuery->paginate(20)->withQueryString();
    $currentPageProducts = $products->count();

    \Log::info('CYS Collection Query:', [
        'cys_subcat_id' => $cysSubcat ? $cysSubcat->id : null,
        'tags' => $tags->all(),
        'gender' => $gender->all(),
        'series' => $series->all(),
        'other_tags' => $otherTags->all(),
        'current_page_products' => $currentPageProducts,
        'total_filtered_products' => $totalFilteredProducts,
        'total_products' => $products->total(),
        'current_page' => $products->currentPage(),
        'last_page' => $products->lastPage(),
        'query_sql' => $productsQuery->toSql(),
        'query_bindings' => $productsQuery->getBindings(),
    ]);

    $cysSubcategory = $cysSubcat;

    return view('public.collections.cys', compact(
        'categories',
        'watchCategories',
        'products',
        'cysSubcategory',
        'totalFilteredProducts',
        'currentPageProducts'
    ));
}
    public function louisMoinetCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $gender = collect(explode(',', request()->input('gender', '')))->map(fn($s)=>trim($s))->filter();
        $collection = collect(explode(',', request()->input('collection', '')))->map(fn($s)=>trim($s))->filter();
        $sizes  = collect(explode(',', request()->input('size', '')))->map(fn($s)=>trim($s))->filter();
        $tags   = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();

        // Constrain to category "Watches" and subcategory "louis-moinet"
        $louisMoinetSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['louis-moinet'])
                  ->orWhereRaw('LOWER(name) = ?', ['louis-moinet']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($louisMoinetSubcat) {
                if ($louisMoinetSubcat) {
                    $q->orWhere('subcategory_id', $louisMoinetSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%louis-moinet%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%louis-moinet%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['louis-moinet'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%louis-moinet%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics: recítal -> recital, amadéo -> amadeo
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Collection synonyms
            if (in_array($base, ['astronef'], true)) { $candidates = array_merge($candidates, ['astronef']); }
            if (in_array($base, ['memoris-spirit','memoris spirit'], true)) { $candidates = array_merge($candidates, ['memoris-spirit']); }
            if (in_array($base, ['time-to-race','time to race'], true)) { $candidates = array_merge($candidates, ['time-to-race']); }
            if (in_array($base, ['tempograph-spirit','tempograph spirit'], true)) { $candidates = array_merge($candidates, ['tempograph-spirit']); }
            if (in_array($base, ['super-moon','super moon'], true)) { $candidates = array_merge($candidates, ['super-moon']); }
            if (in_array($base, ['mars-mission','mars mission'], true)) { $candidates = array_merge($candidates, ['mars-mission']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($collection->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($collection, $expandToSlugVariants) {
                $q->where(function($qq) use ($collection, $expandToSlugVariants) {
                    foreach ($collection as $c) {
                        $variants = $expandToSlugVariants($c);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($sizes->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($sizes) {
                $q->where(function($qq) use ($sizes) {
                    foreach ($sizes as $size) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [strtolower($size)])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$size}%"]);
                    }
                });
            });
        }

        if ($tags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($tags, $expandToSlugVariants) {
                $q->where(function($qq) use ($tags, $expandToSlugVariants) {
                    foreach ($tags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Apply sorting
        $sort = request()->input('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Louis Moinet Collection Query:', [
            'louis_moinet_subcat_id' => $louisMoinetSubcat ? $louisMoinetSubcat->id : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings()
        ]);

        // Get the Louis Moinet subcategory for banner display
        $louisMoinetSubcategory = $louisMoinetSubcat;
        return view('public.collections.louis-moinet', compact('categories', 'watchCategories', 'products', 'louisMoinetSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function franckmullerCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $gender = collect(explode(',', request()->input('gender', '')))->map(fn($s)=>trim($s))->filter();
        $series = collect(explode(',', request()->input('series', '')))->map(fn($s)=>trim($s))->filter();
        $sizes  = collect(explode(',', request()->input('size', '')))->map(fn($s)=>trim($s))->filter();
        $tags   = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();

        // Constrain to category "Watches" and subcategory "franck-muller"
        $franckMullerSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['franck-muller'])
                  ->orWhereRaw('LOWER(name) = ?', ['franck-muller']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($franckMullerSubcat) {
                if ($franckMullerSubcat) {
                    $q->orWhere('subcategory_id', $franckMullerSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%franck-muller%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%franck-muller%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['franck-muller'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%franck-muller%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics: cintrée -> cintree, etc.
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Franck Muller series synonyms
            if (in_array($base, ['cintree-curvex','cintree curvex'], true)) { $candidates = array_merge($candidates, ['cintree-curvex']); }
            if (in_array($base, ['long-island','long island'], true)) { $candidates = array_merge($candidates, ['long-island']); }
            if (in_array($base, ['master-square','master square'], true)) { $candidates = array_merge($candidates, ['master-square']); }
            if (in_array($base, ['round'], true)) { $candidates = array_merge($candidates, ['round']); }
            if (in_array($base, ['skafander'], true)) { $candidates = array_merge($candidates, ['skafander']); }
            if (in_array($base, ['vanguard'], true)) { $candidates = array_merge($candidates, ['vanguard']); }
            if (in_array($base, ['racing'], true)) { $candidates = array_merge($candidates, ['racing']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($tags->isEmpty() && $sizes->isNotEmpty()) {
            // Accept both raw number and number+mm as tag slugs
            $sizeVals = $sizes->flatMap(function ($s) use ($expandToSlugVariants) { return $expandToSlugVariants($s); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($sizeVals) {
                $q->where(function($qq) use ($sizeVals){
                    $qq->whereIn('slug', $sizeVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $sizeVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }

        if ($tags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($tags, $expandToSlugVariants) {
                $q->where(function($qq) use ($tags, $expandToSlugVariants) {
                    foreach ($tags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Franck Muller Collection Query:', [
            'franck_muller_subcat_id' => $franckMullerSubcat ? $franckMullerSubcat->id : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings()
        ]);

        // Get the Franck Muller subcategory for banner display
        $franckMullerSubcategory = $franckMullerSubcat;
        return view('public.collections.franck-muller', compact('categories', 'watchCategories', 'products', 'franckMullerSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

//   public function chronoswissCollection()
//     {
//         $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
//         $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

//         $gender = collect(explode(',', request()->input('gender', '')))->map(fn($s)=>trim($s))->filter();
//         $series = collect(explode(',', request()->input('series', '')))->map(fn($s)=>trim($s))->filter();
//         $tags   = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();

//         // Constrain to category "Watches" and subcategory "chronoswiss"
//         $chronoswissSubcat = Subcategory::where(function ($q) {
//                 $q->whereRaw('LOWER(slug) = ?', ['chronoswiss'])
//                   ->orWhereRaw('LOWER(name) = ?', ['chronoswiss']);
//             })
//             ->whereHas('category', function ($q) {
//                 $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
//             })
//             ->first();

//         $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
//     ->where('status', 'published')   // ✅ only published products
//     ->whereHas('category', function ($q) {
//         $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
//     })
//     ->where(function($q) use ($chronoswissSubcat) {
//         if ($chronoswissSubcat) {
//             $q->orWhere('subcategory_id', $chronoswissSubcat->id);
//         }
//         $q->orWhereHas('subcategory', function($qq){
//             $qq->whereRaw('LOWER(slug) LIKE ?', ['%chronoswiss%'])
//               ->orWhereRaw('LOWER(name) LIKE ?', ['%chronoswiss%']);
//         })
//         ->orWhereHas('tags', function($qq){
//             $qq->whereRaw('LOWER(slug) = ?', ['chronoswiss'])
//               ->orWhereRaw('LOWER(name) LIKE ?', ['%chronoswiss%']);
//         });
//     });
//         // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
//         $expandToSlugVariants = function (string $val): array {
//             $v = trim(strtolower($val));
//             // normalize diacritics and special characters
//             $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
//             $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
//             $base = preg_replace('/\s+/', '-', $v);

//             $candidates = [$base];
//             // Chronoswiss series synonyms
//             if (in_array($base, ['tourbillon'], true)) { $candidates = array_merge($candidates, ['tourbillon']); }
//             if (in_array($base, ['skeltec','skel-tec'], true)) { $candidates = array_merge($candidates, ['skeltec']); }
//             if (in_array($base, ['open-gear','open gear'], true)) { $candidates = array_merge($candidates, ['open-gear']); }
//             if (in_array($base, ['flying'], true)) { $candidates = array_merge($candidates, ['flying']); }
//             if (in_array($base, ['classic'], true)) { $candidates = array_merge($candidates, ['classic']); }
//             if (in_array($base, ['sirius'], true)) { $candidates = array_merge($candidates, ['sirius']); }
//             if (in_array($base, ['artist-collection','artist collection'], true)) { $candidates = array_merge($candidates, ['artist-collection']); }
//             if (in_array($base, ['heritage'], true)) { $candidates = array_merge($candidates, ['heritage']); }

//             return array_unique($candidates);
//         };

//         // Apply filters
//         $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

//         if ($series->isNotEmpty()) {
//             $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
//                 $q->where(function($qq) use ($series, $expandToSlugVariants) {
//                     foreach ($series as $s) {
//                         $variants = $expandToSlugVariants($s);
//                         foreach ($variants as $variant) {
//                             $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
//                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
//                         }
//                     }
//                 });
//             });
//         }

//         if ($tags->isNotEmpty()) {
//             $productsQuery->whereHas('tags', function($q) use ($tags, $expandToSlugVariants) {
//                 $q->where(function($qq) use ($tags, $expandToSlugVariants) {
//                     foreach ($tags as $tag) {
//                         $variants = $expandToSlugVariants($tag);
//                         foreach ($variants as $variant) {
//                             $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
//                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
//                         }
//                     }
//                 });
//             });
//         }

//         // Optional sorting
//         $sort = request('sort');
//         switch ($sort) {
//             case 'az':
//                 $productsQuery->orderBy('name', 'asc');
//                 break;
//             case 'za':
//                 $productsQuery->orderBy('name', 'desc');
//                 break;
//             case 'price_low_high':
//                 $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
//                 break;
//             case 'price_high_low':
//                 $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
//                 break;
//             case 'new_old':
//                 $productsQuery->orderBy('created_at', 'desc');
//                 break;
//             case 'old_new':
//                 $productsQuery->orderBy('created_at', 'asc');
//                 break;
//             default:
//                 $productsQuery->orderByDesc('created_at');
//         }

//         $products = $productsQuery->paginate(20)->withQueryString();

//         // Get total count of filtered products (not just current page)
//         $totalFilteredProducts = $productsQuery->count();
//         $currentPageProducts = $products->count();
//         $totalProducts = $products->total();

//         // Debug: Log the query and results
//         \Log::info('Chronoswiss Collection Query:', [
//             'chronoswiss_subcat_id' => $chronoswissSubcat ? $chronoswissSubcat->id : null,
//             'current_page_products' => $currentPageProducts,
//             'total_filtered_products' => $totalFilteredProducts,
//             'total_products' => $totalProducts,
//             'current_page' => $products->currentPage(),
//             'last_page' => $products->lastPage(),
//             'query_sql' => $productsQuery->toSql(),
//             'query_bindings' => $productsQuery->getBindings()
//         ]);

//         // Get the Chronoswiss subcategory for banner display
//         $chronoswissSubcategory = $chronoswissSubcat;
//         return view('public.collections.chronoswiss', compact('categories', 'watchCategories', 'products', 'chronoswissSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
//     }
 public function chronoswissCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $gender = collect(explode(',', request()->input('gender', '')))->map(fn($s)=>trim($s))->filter();
        $series = collect(explode(',', request()->input('series', '')))->map(fn($s)=>trim($s))->filter();
        $tags   = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();

        // Constrain to category "Watches" and subcategory "chronoswiss"
        $chronoswissSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['chronoswiss'])
                  ->orWhereRaw('LOWER(name) = ?', ['chronoswiss']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
    ->where('status', 'published')   // ✅ only published products
    ->whereHas('category', function ($q) {
        $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
    })
    ->where(function($q) use ($chronoswissSubcat) {
        if ($chronoswissSubcat) {
            $q->orWhere('subcategory_id', $chronoswissSubcat->id);
        }
        $q->orWhereHas('subcategory', function($qq){
            $qq->whereRaw('LOWER(slug) LIKE ?', ['%chronoswiss%'])
               ->orWhereRaw('LOWER(name) LIKE ?', ['%chronoswiss%']);
        })
        ->orWhereHas('tags', function($qq){
            $qq->whereRaw('LOWER(slug) = ?', ['chronoswiss'])
               ->orWhereRaw('LOWER(name) LIKE ?', ['%chronoswiss%']);
        });
    });
        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Chronoswiss series synonyms.
            $seriesSynonyms = [
                'pulse-one' => ['pulse-one', 'pulse one'],
                'delphis' => ['delphis'],
                'resec' => ['resec'],
                'opus-chronograph' => ['opus-chronograph', 'opus chronograph'],
                'srtike-two' => ['srtike-two', 'srtike two', 'strike-two', 'strike two'],
                'strike-two' => ['strike-two', 'strike two', 'srtike-two', 'srtike two'],
                'open-gear' => ['open-gear', 'open gear'],
                'classic' => ['classic'],
                'flying' => ['flying'],
                'lunar' => ['lunar'],
                'skeltec' => ['skeltec', 'skel-tec'],
                'night-day' => ['night-day', 'night day', 'night & day'],
                'small-second' => ['small-second', 'small second'],
            ];

            if (isset($seriesSynonyms[$base])) {
                $candidates = array_merge($candidates, $seriesSynonyms[$base]);
            }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($tags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($tags, $expandToSlugVariants) {
                $q->where(function($qq) use ($tags, $expandToSlugVariants) {
                    foreach ($tags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Chronoswiss Collection Query:', [
            'chronoswiss_subcat_id' => $chronoswissSubcat ? $chronoswissSubcat->id : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings()
        ]);

        // Get the Chronoswiss subcategory for banner display
        $chronoswissSubcategory = $chronoswissSubcat;
        return view('public.collections.chronoswiss', compact('categories', 'watchCategories', 'products', 'chronoswissSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function tissotCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['prx', 'seastar', 'gentleman', 'bellissima']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', 'prx', 'seastar', 'gentleman', 'bellissima']));

        // Constrain to category "Watches" and subcategory "tissot"
        $tissotSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['tissot'])
                  ->orWhereRaw('LOWER(name) = ?', ['tissot']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($tissotSubcat) {
                if ($tissotSubcat) {
                    $q->where('subcategory_id', $tissotSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%tissot%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%tissot%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['tissot'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%tissot%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Tissot series synonyms
            if (in_array($base, ['prx'], true)) { $candidates = array_merge($candidates, ['prx']); }
            if (in_array($base, ['seastar','sea-star'], true)) { $candidates = array_merge($candidates, ['seastar']); }
            if (in_array($base, ['gentleman'], true)) { $candidates = array_merge($candidates, ['gentleman']); }
            if (in_array($base, ['bellissima'], true)) { $candidates = array_merge($candidates, ['bellissima']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Tissot Collection Query:', [
            'tissot_subcat_id' => $tissotSubcat ? $tissotSubcat->id : null,
            'tissot_subcat_name' => $tissotSubcat ? $tissotSubcat->name : null,
            'tissot_subcat_slug' => $tissotSubcat ? $tissotSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Tissot subcategory for banner display
        $tissotSubcategory = $tissotSubcat;
        return view('public.collections.tissot', compact('categories', 'watchCategories', 'products', 'tissotSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }
    
    public function tissotCollectionFull()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['prx', 'seastar', 'gentleman', 'bellissima']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', 'prx', 'seastar', 'gentleman', 'bellissima']));

        // Constrain to category "Watches" and subcategory "tissot"
        $tissotSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['tissot'])
                  ->orWhereRaw('LOWER(name) = ?', ['tissot']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($tissotSubcat) {
                if ($tissotSubcat) {
                    $q->where('subcategory_id', $tissotSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%tissot%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%tissot%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['tissot'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%tissot%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Tissot series synonyms
            if (in_array($base, ['prx'], true)) { $candidates = array_merge($candidates, ['prx']); }
            if (in_array($base, ['seastar','sea-star'], true)) { $candidates = array_merge($candidates, ['seastar']); }
            if (in_array($base, ['gentleman'], true)) { $candidates = array_merge($candidates, ['gentleman']); }
            if (in_array($base, ['bellissima'], true)) { $candidates = array_merge($candidates, ['bellissima']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($tags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($tags, $expandToSlugVariants) {
                $q->where(function($qq) use ($tags, $expandToSlugVariants) {
                    foreach ($tags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // If no products found, try a more permissive query for debugging
        if ($products->count() === 0) {
            $fallbackQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
                ->where('status', 'published')
                ->whereHas('category', function ($q) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
                })
                ->where(function($q) {
                    $q->whereHas('subcategory', function($qq){
                        $qq->whereRaw('LOWER(slug) LIKE ?', ['%tissot%'])
                           ->orWhereRaw('LOWER(name) LIKE ?', ['%tissot%']);
                    })
                    ->orWhereHas('tags', function($qq){
                        $qq->whereRaw('LOWER(slug) = ?', ['tissot'])
                           ->orWhereRaw('LOWER(name) LIKE ?', ['%tissot%']);
                    })
                    ->orWhere('name', 'LIKE', '%tissot%');
                });
            
            $fallbackProducts = $fallbackQuery->get();
            \Log::info('Tissot Fallback Query Results:', [
                'fallback_count' => $fallbackProducts->count(),
                'fallback_products' => $fallbackProducts->pluck('name', 'id')->toArray()
            ]);
        }

        // Debug: Log the query and results
        \Log::info('Tissot Collection Query:', [
            'tissot_subcat_id' => $tissotSubcat ? $tissotSubcat->id : null,
            'tissot_subcat_name' => $tissotSubcat ? $tissotSubcat->name : null,
            'tissot_subcat_slug' => $tissotSubcat ? $tissotSubcat->slug : null,
            'products_count' => $products->count(),
            'total_products' => $products->total(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Tissot subcategory for banner display
        $tissotSubcategory = $tissotSubcat;
        return view('public.collections.tissot', compact('categories', 'watchCategories', 'products', 'tissotSubcategory'));
    }

    public function swissMilitary()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $caseSize = $tags->filter(fn($tag) => in_array($tag, ['28mm', '30mm', '36mm', '37mm', '39mm', '40mm', '41mm', '42mm', '42.5mm', '43mm', '45mm', '48mm']));
        $movementType = $tags->filter(fn($tag) => in_array($tag, ['quartz', 'automatic', 'chronograph']));
        $caseType = $tags->filter(fn($tag) => in_array($tag, ['steel', 'titanium']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', '28mm', '30mm', '36mm', '37mm', '39mm', '40mm', '41mm', '42mm', '42.5mm', '43mm', '45mm', '48mm', 'quartz', 'automatic', 'chronograph', 'steel', 'titanium']));

        // Constrain to category "Watches" and subcategory "swiss-military"
        $swissMilitarySubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['swiss-military'])
                  ->orWhereRaw('LOWER(name) = ?', ['swiss-military'])
                  ->orWhereRaw('LOWER(slug) = ?', ['swiss_military'])
                  ->orWhereRaw('LOWER(name) = ?', ['swiss_military']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($swissMilitarySubcat) {
                if ($swissMilitarySubcat) {
                    $q->where('subcategory_id', $swissMilitarySubcat->id);
                } else {
                    // Fallback: try to find by subcategory name/slug if no exact match
                    $q->whereHas('subcategory', function($qq){
                        $qq->whereRaw('LOWER(slug) = ?', ['swiss-military'])
                           ->orWhereRaw('LOWER(name) = ?', ['swiss-military'])
                           ->orWhereRaw('LOWER(slug) = ?', ['swiss_military'])
                           ->orWhereRaw('LOWER(name) = ?', ['swiss_military']);
                    });
                }
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Swiss Military filter synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }
            if (in_array($base, ['quartz'], true)) { $candidates = array_merge($candidates, ['quartz']); }
            if (in_array($base, ['automatic'], true)) { $candidates = array_merge($candidates, ['automatic', 'auto']); }
            if (in_array($base, ['chronograph'], true)) { $candidates = array_merge($candidates, ['chronograph', 'chrono']); }
            if (in_array($base, ['steel'], true)) { $candidates = array_merge($candidates, ['steel', 'stainless-steel']); }
            if (in_array($base, ['titanium'], true)) { $candidates = array_merge($candidates, ['titanium', 'ti']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($caseSize->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($caseSize, $expandToSlugVariants) {
                $q->where(function($qq) use ($caseSize, $expandToSlugVariants) {
                    foreach ($caseSize as $size) {
                        $variants = $expandToSlugVariants($size);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($movementType->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($movementType, $expandToSlugVariants) {
                $q->where(function($qq) use ($movementType, $expandToSlugVariants) {
                    foreach ($movementType as $movement) {
                        $variants = $expandToSlugVariants($movement);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($caseType->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($caseType, $expandToSlugVariants) {
                $q->where(function($qq) use ($caseType, $expandToSlugVariants) {
                    foreach ($caseType as $case) {
                        $variants = $expandToSlugVariants($case);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
                $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Swiss Military Collection Query:', [
            'swiss_military_subcat_id' => $swissMilitarySubcat ? $swissMilitarySubcat->id : null,
            'swiss_military_subcat_name' => $swissMilitarySubcat ? $swissMilitarySubcat->name : null,
            'swiss_military_subcat_slug' => $swissMilitarySubcat ? $swissMilitarySubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'caseSize' => $caseSize->toArray(),
                'movementType' => $movementType->toArray(),
                'caseType' => $caseType->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Swiss Military subcategory for banner display
        $swissMilitarySubcategory = $swissMilitarySubcat;
        return view('public.collections.swiss', compact('categories', 'watchCategories', 'products', 'swissMilitarySubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function artyaCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['purity', 'complications', 'butterfly', 'russian-roulette']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', 'purity', 'complications', 'butterfly', 'russian-roulette']));

        // Constrain to category "Watches" and subcategory "artya"
        $artyaSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['artya'])
                  ->orWhereRaw('LOWER(name) = ?', ['artya']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($artyaSubcat) {
                if ($artyaSubcat) {
                    $q->where('subcategory_id', $artyaSubcat->id);
                } else {
                    // Fallback: try to find by subcategory name/slug if no exact match
                    $q->whereHas('subcategory', function($qq){
                        $qq->whereRaw('LOWER(slug) = ?', ['artya'])
                           ->orWhereRaw('LOWER(name) = ?', ['artya']);
                    });
                }
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Artya filter synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }
            if (in_array($base, ['purity'], true)) { $candidates = array_merge($candidates, ['purity']); }
            if (in_array($base, ['complications'], true)) { $candidates = array_merge($candidates, ['complications']); }
            if (in_array($base, ['butterfly'], true)) { $candidates = array_merge($candidates, ['butterfly']); }
            if (in_array($base, ['russian-roulette'], true)) { $candidates = array_merge($candidates, ['russian-roulette', 'russian_roulette', 'russianroulette']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Artya Collection Query:', [
            'artya_subcat_id' => $artyaSubcat ? $artyaSubcat->id : null,
            'artya_subcat_name' => $artyaSubcat ? $artyaSubcat->name : null,
            'artya_subcat_slug' => $artyaSubcat ? $artyaSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Artya subcategory for banner display
        $artyaSubcategory = $artyaSubcat;
        return view('public.collections.artya', compact('categories', 'watchCategories', 'products', 'artyaSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function armandNicoletCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $gender = collect(explode(',', request()->input('gender', '')))->map(fn($s)=>trim($s))->filter();
        $series = collect(explode(',', request()->input('series', '')))->map(fn($s)=>trim($s))->filter();
        $sizes  = collect(explode(',', request()->input('size', '')))->map(fn($s)=>trim($s))->filter();
        $tags   = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();

        // Constrain to category "Watches" and subcategory "armand-nicolet"
        $armandNicoletSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['armand-nicolet'])
                  ->orWhereRaw('LOWER(name) = ?', ['armand-nicolet'])
                  ->orWhereRaw('LOWER(slug) = ?', ['armand_nicolet'])
                  ->orWhereRaw('LOWER(name) = ?', ['armand nicolet']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($armandNicoletSubcat) {
                if ($armandNicoletSubcat) {
                    $q->orWhere('subcategory_id', $armandNicoletSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%armand-nicolet%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%armand-nicolet%'])
                       ->orWhereRaw('LOWER(slug) LIKE ?', ['%armand_nicolet%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%armand nicolet%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['armand-nicolet'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%armand-nicolet%'])
                       ->orWhereRaw('LOWER(slug) = ?', ['armand_nicolet'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%armand nicolet%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics: recítal -> recital, amadéo -> amadeo
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Series synonyms (using same series as bovet for now - can be customized)
            if (in_array($base, ['amadéo','amadeo'], true)) { $candidates = array_merge($candidates, ['amadeo']); }
            if (in_array($base, ['recital','recital'], true)) { $candidates = array_merge($candidates, ['recital']); }
            if ($base === 'miss-audrey') { $candidates[] = 'miss-audrey'; }
            if ($base === 'the-art-of-miniature-painting') { $candidates[] = 'the-art-of-miniature-painting'; }

            // Gender synonyms
            if (in_array($base, ['mens','men','gents','gent'], true)) { $candidates = array_merge($candidates, ['mens','men','gents']); }
            if (in_array($base, ['ladies','women','womens','female'], true)) { $candidates = array_merge($candidates, ['ladies','women','womens']); }

            // Sizes: accept 43, 43mm, 43.30, 43-30, 43-30mm
            if (preg_match('/^([0-9]{2}(?:\.[0-9]{1,2})?)$/', $base, $m)) {
                $n = $m[1];
                $candidates = array_merge($candidates, [$n, $n.'mm']);
            }

            // Deduplicate
            return array_values(array_unique(array_filter($candidates)));
        };

        // Apply filters via tags if present (single consolidated param like online store)
        if ($tags->isNotEmpty()) {
            $tagValues = $tags->flatMap(function ($t) use ($expandToSlugVariants) { return $expandToSlugVariants($t); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($tagValues) {
                $q->where(function($qq) use ($tagValues){
                    $qq->whereIn('slug', $tagValues)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $tagValues->map(fn($v)=> strtolower($v))->all());
                });
            });
        }

        // Backwards compatibility: apply grouped params if used
        if ($tags->isEmpty() && $gender->isNotEmpty()) {
            $genderVals = $gender->flatMap(function ($g) use ($expandToSlugVariants) { return $expandToSlugVariants($g); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($genderVals) {
                $q->where(function($qq) use ($genderVals){
                    $qq->whereIn('slug', $genderVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $genderVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }
        if ($tags->isEmpty() && $series->isNotEmpty()) {
            $seriesVals = $series->flatMap(function ($s) use ($expandToSlugVariants) { return $expandToSlugVariants($s); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($seriesVals) {
                $q->where(function($qq) use ($seriesVals){
                    $qq->whereIn('slug', $seriesVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $seriesVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }
        if ($tags->isEmpty() && $sizes->isNotEmpty()) {
            // Accept both raw number and number+mm as tag slugs
            $sizeVals = $sizes->flatMap(function ($s) use ($expandToSlugVariants) { return $expandToSlugVariants($s); })->values();
            $productsQuery->whereHas('tags', function ($q) use ($sizeVals) {
                $q->where(function($qq) use ($sizeVals){
                    $qq->whereIn('slug', $sizeVals)
                       ->orWhereIn(\DB::raw('LOWER(name)'), $sizeVals->map(fn($v)=> strtolower($v))->all());
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Armand Nicolet Collection Query:', [
            'armand_nicolet_subcat_id' => $armandNicoletSubcat ? $armandNicoletSubcat->id : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings()
        ]);

        // Get the Armand Nicolet subcategory for banner display
        $armandNicoletSubcategory = $armandNicoletSubcat;
        return view('public.collections.armand-nicolet', compact('categories', 'watchCategories', 'products', 'armandNicoletSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function louisErard()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['excellence', 'la-sportive', 'heritage', 'overview-and-straps']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', 'excellence', 'la-sportive', 'heritage', 'overview-and-straps']));

        // Constrain to category "Watches" and subcategory "louis-erard"
        $louisErardSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['louis-erard'])
                  ->orWhereRaw('LOWER(name) = ?', ['louis-erard'])
                  ->orWhereRaw('LOWER(slug) = ?', ['louis_erard'])
                  ->orWhereRaw('LOWER(name) = ?', ['louis_erard']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($louisErardSubcat) {
                if ($louisErardSubcat) {
                    $q->where('subcategory_id', $louisErardSubcat->id);
                } else {
                    // Fallback: try to find by subcategory name/slug if no exact match
                    $q->whereHas('subcategory', function($qq){
                        $qq->whereRaw('LOWER(slug) = ?', ['louis-erard'])
                           ->orWhereRaw('LOWER(name) = ?', ['louis-erard'])
                           ->orWhereRaw('LOWER(slug) = ?', ['louis_erard'])
                           ->orWhereRaw('LOWER(name) = ?', ['louis_erard']);
                    });
                }
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Louis Erard filter synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }
            if (in_array($base, ['excellence'], true)) { $candidates = array_merge($candidates, ['excellence']); }
            if (in_array($base, ['la-sportive'], true)) { $candidates = array_merge($candidates, ['la-sportive', 'la_sportive', 'lasportive']); }
            if (in_array($base, ['heritage'], true)) { $candidates = array_merge($candidates, ['heritage']); }
            if (in_array($base, ['overview-and-straps'], true)) { $candidates = array_merge($candidates, ['overview-and-straps', 'overview_and_straps', 'overviewandstraps']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Louis Erard Collection Query:', [
            'louis_erard_subcat_id' => $louisErardSubcat ? $louisErardSubcat->id : null,
            'louis_erard_subcat_name' => $louisErardSubcat ? $louisErardSubcat->name : null,
            'louis_erard_subcat_slug' => $louisErardSubcat ? $louisErardSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Louis Erard subcategory for banner display
        $louisErardSubcategory = $louisErardSubcat;
        return view('public.collections.louis-erard', compact('categories', 'watchCategories', 'products', 'louisErardSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function grahamCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['chronofighter-vintage', 'swordfish', 'chronofighter-superlight', 'fortress']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', 'chronofighter-vintage', 'swordfish', 'chronofighter-superlight', 'fortress']));

        // Constrain to category "Watches" and subcategory "graham"
        $grahamSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['graham'])
                  ->orWhereRaw('LOWER(name) = ?', ['graham']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($grahamSubcat) {
                if ($grahamSubcat) {
                    $q->where('subcategory_id', $grahamSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%graham%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%graham%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['graham'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%graham%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Graham series synonyms
            if (in_array($base, ['chronofighter-vintage'], true)) { $candidates = array_merge($candidates, ['chronofighter-vintage', 'chronofighter_vintage', 'chronofightervintage']); }
            if (in_array($base, ['swordfish'], true)) { $candidates = array_merge($candidates, ['swordfish']); }
            if (in_array($base, ['chronofighter-superlight'], true)) { $candidates = array_merge($candidates, ['chronofighter-superlight', 'chronofighter_superlight', 'chronofightersuperlight']); }
            if (in_array($base, ['fortress'], true)) { $candidates = array_merge($candidates, ['fortress']); }
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }


        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Graham Collection Query:', [
            'graham_subcat_id' => $grahamSubcat ? $grahamSubcat->id : null,
            'graham_subcat_name' => $grahamSubcat ? $grahamSubcat->name : null,
            'graham_subcat_slug' => $grahamSubcat ? $grahamSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Graham subcategory for banner display
        $grahamSubcategory = $grahamSubcat;
        return view('public.collections.graham', compact('categories', 'watchCategories', 'products', 'grahamSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function radoCollection()
    {
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        $tags = collect(explode(',', request()->input('tags', '')))->map(fn($s)=>trim($s))->filter();
        
        // Separate tags into categories for filtering
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $series = $tags->filter(fn($tag) => in_array($tag, ['captain-cook', 'centrix', 'true', 'true-square', 'true-thinline']));
        $otherTags = $tags->reject(fn($tag) => in_array($tag, ['mens', 'ladies', 'captain-cook', 'centrix', 'true', 'true-square', 'true-thinline']));

        // Constrain to category "Watches" and subcategory "rado"
        $radoSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['rado'])
                  ->orWhereRaw('LOWER(name) = ?', ['rado']);
            })
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->first();

        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->whereHas('category', function ($q) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%watch%']);
            })
            ->where(function($q) use ($radoSubcat) {
                if ($radoSubcat) {
                    $q->where('subcategory_id', $radoSubcat->id);
                }
                $q->orWhereHas('subcategory', function($qq){
                    $qq->whereRaw('LOWER(slug) LIKE ?', ['%rado%'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%rado%']);
                })
                ->orWhereHas('tags', function($qq){
                    $qq->whereRaw('LOWER(slug) = ?', ['rado'])
                       ->orWhereRaw('LOWER(name) LIKE ?', ['%rado%']);
                });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            // Rado series synonyms
            if (in_array($base, ['captain-cook'], true)) { $candidates = array_merge($candidates, ['captain-cook', 'captain_cook', 'captaincook']); }
            if (in_array($base, ['centrix'], true)) { $candidates = array_merge($candidates, ['centrix']); }
            if (in_array($base, ['true'], true)) { $candidates = array_merge($candidates, ['true']); }
            if (in_array($base, ['true-square'], true)) { $candidates = array_merge($candidates, ['true-square', 'true_square', 'truesquare']); }
            if (in_array($base, ['true-thinline'], true)) { $candidates = array_merge($candidates, ['true-thinline', 'true_thinline', 'truethinline']); }
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);
        }

        if ($series->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($series, $expandToSlugVariants) {
                $q->where(function($qq) use ($series, $expandToSlugVariants) {
                    foreach ($series as $s) {
                        $variants = $expandToSlugVariants($s);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags, $expandToSlugVariants) {
                $q->where(function($qq) use ($otherTags, $expandToSlugVariants) {
                    foreach ($otherTags as $tag) {
                        $variants = $expandToSlugVariants($tag);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        // Optional sorting
        $sort = request('sort');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Rado Collection Query:', [
            'rado_subcat_id' => $radoSubcat ? $radoSubcat->id : null,
            'rado_subcat_name' => $radoSubcat ? $radoSubcat->name : null,
            'rado_subcat_slug' => $radoSubcat ? $radoSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'series' => $series->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Rado subcategory for banner display
        $radoSubcategory = $radoSubcat;
        return view('public.collections.rado', compact('categories', 'watchCategories', 'products', 'radoSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function versaceCollection(Request $request)
    {
        // Get all categories and watch categories for navigation
        $categories = Categories::where('status', 'published')->get();
        $watchCategories = Categories::where('status', 'published')->where('name', 'LIKE', '%watch%')->get();

        // Get Versace subcategory
        $versaceSubcat = Subcategory::where('slug', 'versace')->first();
        if (!$versaceSubcat) {
            abort(404, 'Versace collection not found');
        }

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $sizes = $tags->filter(fn($tag) => in_array($tag, ['25','27','28','30','32','34','35','36','37','38','40','41','42','43','44','45']));
        $movements = $tags->filter(fn($tag) => in_array($tag, ['quartz', 'automatic', 'chronograph']));
        $caseTypes = $tags->filter(fn($tag) => in_array($tag, ['steel']));
        $otherTags = $tags->diff($gender)->diff($sizes)->diff($movements)->diff($caseTypes);

        // Build query
        $productsQuery = Products::with(['tags', 'subcategory'])
            ->where('status', 'published')
            ->whereHas('category', function($q) {
                $q->where('name', 'LIKE', '%watch%');
            })
            ->where(function($q) use ($versaceSubcat) {
                $q->where('subcategory_id', $versaceSubcat->id)
                  ->orWhereHas('subcategory', function($subQ) use ($versaceSubcat) {
                      $subQ->where('slug', 'LIKE', '%' . $versaceSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $versaceSubcat->name . '%');
                  })
                  ->orWhereHas('tags', function($tagQ) use ($versaceSubcat) {
                      $tagQ->where('slug', 'LIKE', '%' . $versaceSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $versaceSubcat->name . '%');
                  });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        $applyTagFilter = function (Collection $selected, callable $conditionBuilder) use ($productsQuery): void {
            $values = $selected->map(fn($val) => strtolower($val))->filter()->unique()->values();
            if ($values->isEmpty()) {
                return;
            }

            $productsQuery->whereHas('tags', function($q) use ($values, $conditionBuilder) {
                $q->where(function($qq) use ($values, $conditionBuilder) {
                    foreach ($values as $index => $value) {
                        $method = $index === 0 ? 'where' : 'orWhere';
                        $qq->{$method}(function($group) use ($value, $conditionBuilder) {
                            $conditionBuilder($group, $value);
                        });
                    }
                });
            });
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $this->applyGenderFilter($productsQuery, $gender, $expandToSlugVariants);
        }

        if ($sizes->isNotEmpty()) {
            $applyTagFilter($sizes, function($group, $size) {
                $group->whereRaw('LOWER(slug) = ?', [$size])
                      ->orWhereRaw('LOWER(name) LIKE ?', ["%{$size}%"]);
            });
        }

        if ($movements->isNotEmpty()) {
            $applyTagFilter($movements, function($group, $movement) {
                $group->whereRaw('LOWER(slug) = ?', [$movement])
                      ->orWhereRaw('LOWER(name) LIKE ?', ["%{$movement}%"]);
            });
        }

        if ($caseTypes->isNotEmpty()) {
            $applyTagFilter($caseTypes, function($group, $caseType) {
                $group->whereRaw('LOWER(slug) = ?', [$caseType])
                      ->orWhereRaw('LOWER(name) LIKE ?', ["%{$caseType}%"]);
            });
        }

        if ($otherTags->isNotEmpty()) {
            $applyTagFilter($otherTags, function($group, $tag) {
                $group->whereRaw('LOWER(slug) = ?', [$tag])
                      ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $totalFilteredProducts = (clone $productsQuery)->count();
        $products = $productsQuery->paginate(20)->withQueryString();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Versace Collection Query:', [
            'versace_subcat_id' => $versaceSubcat ? $versaceSubcat->id : null,
            'versace_subcat_name' => $versaceSubcat ? $versaceSubcat->name : null,
            'versace_subcat_slug' => $versaceSubcat ? $versaceSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'sizes' => $sizes->toArray(),
                'movements' => $movements->toArray(),
                'caseTypes' => $caseTypes->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Versace subcategory for banner display
        $versaceSubcategory = $versaceSubcat;
        return view('public.collections.versace', compact('categories', 'watchCategories', 'products', 'versaceSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function eposCollection(Request $request)
    {
        // Get all categories and watch categories for navigation
        $categories = Categories::where('status', 'published')->get();
        $watchCategories = Categories::where('status', 'published')->where('name', 'LIKE', '%watch%')->get();

        // Get Epos subcategory
        $eposSubcat = Subcategory::where('slug', 'epos')->first();
        if (!$eposSubcat) {
            abort(404, 'Epos collection not found');
        }

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $sizes = $tags->filter(fn($tag) => in_array($tag, ['32','41','41.5','45']));
        $movements = $tags->filter(fn($tag) => in_array($tag, ['quartz', 'automatic', 'chronograph']));
        $caseTypes = $tags->filter(fn($tag) => in_array($tag, ['steel', 'titanium']));
        $otherTags = $tags->diff($gender)->diff($sizes)->diff($movements)->diff($caseTypes);

        // Build query
        $productsQuery = Products::with(['tags', 'subcategory'])
            ->where('status', 'published')
            ->whereHas('category', function($q) {
                $q->where('name', 'LIKE', '%watch%');
            })
            ->where(function($q) use ($eposSubcat) {
                $q->where('subcategory_id', $eposSubcat->id)
                  ->orWhereHas('subcategory', function($subQ) use ($eposSubcat) {
                      $subQ->where('slug', 'LIKE', '%' . $eposSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $eposSubcat->name . '%');
                  })
                  ->orWhereHas('tags', function($tagQ) use ($eposSubcat) {
                      $tagQ->where('slug', 'LIKE', '%' . $eposSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $eposSubcat->name . '%');
                  });
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($gender, $expandToSlugVariants) {
                $q->where(function($qq) use ($gender, $expandToSlugVariants) {
                    foreach ($gender as $g) {
                        $variants = $expandToSlugVariants($g);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($sizes->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($sizes) {
                $q->where(function($qq) use ($sizes) {
                    foreach ($sizes as $size) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$size])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$size}%"]);
                    }
                });
            });
        }

        if ($movements->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($movements) {
                $q->where(function($qq) use ($movements) {
                    foreach ($movements as $movement) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$movement])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$movement}%"]);
                    }
                });
            });
        }

        if ($caseTypes->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($caseTypes) {
                $q->where(function($qq) use ($caseTypes) {
                    foreach ($caseTypes as $caseType) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$caseType])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$caseType}%"]);
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags) {
                $q->where(function($qq) use ($otherTags) {
                    foreach ($otherTags as $tag) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$tag])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
                    }
                });
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Debug: Log the query and results
        \Log::info('Epos Collection Query:', [
            'epos_subcat_id' => $eposSubcat ? $eposSubcat->id : null,
            'epos_subcat_name' => $eposSubcat ? $eposSubcat->name : null,
            'epos_subcat_slug' => $eposSubcat ? $eposSubcat->slug : null,
            'current_page_products' => $currentPageProducts,
            'total_filtered_products' => $totalFilteredProducts,
            'total_products' => $totalProducts,
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'query_sql' => $productsQuery->toSql(),
            'query_bindings' => $productsQuery->getBindings(),
            'filters' => [
                'gender' => $gender->toArray(),
                'sizes' => $sizes->toArray(),
                'movements' => $movements->toArray(),
                'caseTypes' => $caseTypes->toArray(),
                'otherTags' => $otherTags->toArray(),
                'all_tags' => $tags->toArray()
            ]
        ]);

        // Get the Epos subcategory for banner display
        $eposSubcategory = $eposSubcat;
        return view('public.collections.epos', compact('categories', 'watchCategories', 'products', 'eposSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function ferragamoCollection(Request $request)
    {
        // Get all categories and watch categories for navigation
        $categories = Categories::where('status', 'published')->get();
        $watchCategories = Categories::where('status', 'published')->where('name', 'LIKE', '%watch%')->get();

        // Get Ferragamo subcategory
        $ferragamoSubcat = Subcategory::where('slug', 'ferragamo')->first();
        if (!$ferragamoSubcat) {
            abort(404, 'Ferragamo collection not found');
        }

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $otherTags = $tags->diff($gender);

        // Build query for Ferragamo products
        $productsQuery = Products::with(['tags', 'subcategory'])
            ->where('status', 'published')
            ->where(function($q) use ($ferragamoSubcat) {
                $q->where('subcategory_id', $ferragamoSubcat->id)
                  ->orWhereHas('subcategory', function($subQ) use ($ferragamoSubcat) {
                      $subQ->where('slug', 'LIKE', '%' . $ferragamoSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $ferragamoSubcat->name . '%');
                  })
                  ->orWhereHas('tags', function($tagQ) use ($ferragamoSubcat) {
                      $tagQ->where('slug', 'LIKE', '%' . $ferragamoSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $ferragamoSubcat->name . '%');
                  });
            });

        // Utility: expand input into likely tag slug variants
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($gender, $expandToSlugVariants) {
                $q->where(function($qq) use ($gender, $expandToSlugVariants) {
                    foreach ($gender as $g) {
                        $variants = $expandToSlugVariants($g);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags) {
                $q->where(function($qq) use ($otherTags) {
                    foreach ($otherTags as $tag) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$tag])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
                    }
                });
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Get the Ferragamo subcategory for banner display
        $ferragamoSubcategory = $ferragamoSubcat;
        return view('public.collections.ferragamo', compact('categories', 'watchCategories', 'products', 'ferragamoSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function perreletCollection(Request $request)
    {
        // Get Perrelet subcategory
        $perreletSubcat = Subcategory::where('slug', 'perrelet')->first();
        if (!$perreletSubcat) {
            abort(404, 'Perrelet collection not found');
        }

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $otherTags = $tags->diff($gender);

        // Build query for Perrelet products
        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->where(function($q) use ($perreletSubcat) {
                $q->where('subcategory_id', $perreletSubcat->id)
                  ->orWhereHas('subcategory', function($subQ) use ($perreletSubcat) {
                      $subQ->where('slug', 'LIKE', '%' . $perreletSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $perreletSubcat->name . '%');
                  })
                  ->orWhereHas('tags', function($tagQ) use ($perreletSubcat) {
                      $tagQ->where('slug', 'LIKE', '%' . $perreletSubcat->slug . '%')
                           ->orWhere('name', 'LIKE', '%' . $perreletSubcat->name . '%');
                  });
            });

        // Utility: expand input into likely tag slug variants
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($gender, $expandToSlugVariants) {
                $q->where(function($qq) use ($gender, $expandToSlugVariants) {
                    foreach ($gender as $g) {
                        $variants = $expandToSlugVariants($g);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags) {
                $q->where(function($qq) use ($otherTags) {
                    foreach ($otherTags as $tag) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [$tag])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
                    }
                });
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
        $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();

        // Get the Perrelet subcategory for banner display
        $subcategory = $perreletSubcat;
        return view('public.collections.perrelet', compact('products', 'subcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }

    public function breathtakingCollection(Request $request)
    {
        // Get all categories and watch categories for navigation
        $categories = Categories::with('subcategories')->where('name', 'not like', '%watch%')->get();
        $watchCategories = Categories::with('subcategories')->where('name', 'like', '%watch%')->get();

        // Resolve subcategory strictly as "breathtaking" (by slug or exact name)
        $breathtakingSubcat = Subcategory::where(function ($q) {
                $q->whereRaw('LOWER(slug) = ?', ['breathtaking'])
                  ->orWhereRaw('LOWER(name) = ?', ['breathtaking']);
            })
            ->first();

        // Parse tags from request
        $tags = collect();
        if ($request->has('tags') && $request->tags) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter();
        }

        // Separate tags by type
        $gender = $tags->filter(fn($tag) => in_array($tag, ['mens', 'ladies']));
        $otherTags = $tags->diff($gender);

        // Build query
        $productsQuery = Products::with(['category', 'subcategory', 'images', 'tags'])
            ->where('status', 'published')
            ->where(function($q) use ($breathtakingSubcat) {
                if ($breathtakingSubcat) {
                    $q->where('subcategory_id', $breathtakingSubcat->id);
                } else {
                    // If subcategory not found, ensure no products are returned
                    $q->whereRaw('1 = 0');
                }
            });

        // Utility: expand input into likely tag slug variants (case/diacritics/spacing)
        $expandToSlugVariants = function (string $val): array {
            $v = trim(strtolower($val));
            // normalize diacritics and special characters
            $v = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $v);
            $v = preg_replace('/[^a-z0-9\.\-\s]/', '', $v);
            $base = preg_replace('/\s+/', '-', $v);

            $candidates = [$base];
            
            // Gender synonyms
            if (in_array($base, ['mens'], true)) { $candidates = array_merge($candidates, ['mens', 'men']); }
            if (in_array($base, ['ladies'], true)) { $candidates = array_merge($candidates, ['ladies', 'women']); }

            return array_unique($candidates);
        };

        // Apply filters
        if ($gender->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($gender, $expandToSlugVariants) {
                $q->where(function($qq) use ($gender, $expandToSlugVariants) {
                    foreach ($gender as $g) {
                        $variants = $expandToSlugVariants($g);
                        foreach ($variants as $variant) {
                            $qq->orWhereRaw('LOWER(slug) = ?', [$variant])
                               ->orWhereRaw('LOWER(name) LIKE ?', ["%{$variant}%"]);
                        }
                    }
                });
            });
        }

        if ($otherTags->isNotEmpty()) {
            $productsQuery->whereHas('tags', function($q) use ($otherTags) {
                $q->where(function($qq) use ($otherTags) {
                    foreach ($otherTags as $tag) {
                        $qq->orWhereRaw('LOWER(slug) = ?', [strtolower($tag)])
                           ->orWhereRaw('LOWER(name) LIKE ?', ["%{$tag}%"]);
                    }
                });
            });
        }

        // Apply sorting
        $sort = $request->get('sort', '');
         $productsQuery->pinnedFirst();
        switch ($sort) {
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'za':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_low_high':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) ASC');
                break;
            case 'price_high_low':
                $productsQuery->orderByRaw('CAST(price AS DECIMAL(15,2)) DESC');
                break;
            case 'old_new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'new_old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
        }

        $products = $productsQuery->paginate(20)->withQueryString();

        // Get total count of filtered products (not just current page)
        $totalFilteredProducts = $productsQuery->count();
        $currentPageProducts = $products->count();
        $totalProducts = $products->total();

        // Get the Breathtaking subcategory for banner display
        $breathtakingSubcategory = $breathtakingSubcat;
        return view('public.collections.breathtaking', compact('categories', 'watchCategories', 'products', 'breathtakingSubcategory', 'totalFilteredProducts', 'currentPageProducts'));
    }
   
}
