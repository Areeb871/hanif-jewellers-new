<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EhedGalleryImage;
use App\Models\PageContent;
use App\Models\RefundPolicy;
use App\Models\PureLockGalleryImage;
use App\Models\TermsService;
use App\Models\ShippingPolicy;

class PagesController extends Controller
{
    public function home()
    {
        try {
            return view('admin.pages.home');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ehedGallery()
    {
        try {
            $images = EhedGalleryImage::orderBy('display_order', 'asc')->orderBy('created_at', 'desc')->get();
            return view('admin.pages.ehed_gallery', compact('images'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storeEhedGalleryImages(Request $request)
    {
        try {
              $request->validate([
              'images' => 'required|array',
              'images.*' => 'mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            ]);


            $uploadedCount = 0;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/ehed_gallery'), $name);
                    
                    $maxOrder = EhedGalleryImage::max('display_order') ?? 0;
                    
                    EhedGalleryImage::create([
                        'image' => 'uploads/ehed_gallery/' . $name,
                        'display_order' => $maxOrder + 1,
                        'is_active' => true,
                    ]);
                    $uploadedCount++;
                }
            }

            return redirect()->route('admin.ehed-gallery')->with('success', $uploadedCount . ' image(s) uploaded successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteEhedGalleryImage($id)
    {
        try {
            $image = EhedGalleryImage::findOrFail($id);
            
            // Delete file from folder
            if ($image->image && file_exists(public_path($image->image))) {
                unlink(public_path($image->image));
            }
            
            $image->delete();
            
            return redirect()->route('admin.ehed-gallery')->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateEhedGalleryImageOrder(Request $request)
    {
        try {
            $request->validate([
                'image_ids' => 'required|array',
            ]);

            foreach ($request->image_ids as $index => $id) {
                EhedGalleryImage::where('id', $id)->update(['display_order' => $index + 1]);
            }

            return response()->json(['success' => true, 'message' => 'Order updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function toggleEhedGalleryImageStatus($id)
    {
        try {
            $image = EhedGalleryImage::findOrFail($id);
            $image->is_active = !$image->is_active;
            $image->save();
            
            return redirect()->route('admin.ehed-gallery')->with('success', 'Image status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pureLockGallery()
    {
        try {
            $images = PureLockGalleryImage::orderBy('display_order', 'asc')->orderBy('created_at', 'desc')->get();
            return view('admin.pages.pure_lock_gallery', compact('images'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storePureLockGalleryImages(Request $request)
    {
        try {
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $uploadedCount = 0;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/pure_lock_gallery'), $name);
                    
                    $maxOrder = PureLockGalleryImage::max('display_order') ?? 0;
                    
                    PureLockGalleryImage::create([
                        'image' => 'uploads/pure_lock_gallery/' . $name,
                        'display_order' => $maxOrder + 1,
                        'is_active' => true,
                    ]);
                    $uploadedCount++;
                }
            }

            return redirect()->route('admin.pure-lock-gallery')->with('success', $uploadedCount . ' image(s) uploaded successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deletePureLockGalleryImage($id)
    {
        try {
            $image = PureLockGalleryImage::findOrFail($id);
            
            if ($image->image && file_exists(public_path($image->image))) {
                unlink(public_path($image->image));
            }
            
            $image->delete();
            
            return redirect()->route('admin.pure-lock-gallery')->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePureLockGalleryImageOrder(Request $request)
    {
        try {
            $request->validate([
                'image_ids' => 'required|array',
            ]);

            foreach ($request->image_ids as $index => $id) {
                PureLockGalleryImage::where('id', $id)->update(['display_order' => $index + 1]);
            }

            return response()->json(['success' => true, 'message' => 'Order updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function togglePureLockGalleryImageStatus($id)
    {
        try {
            $image = PureLockGalleryImage::findOrFail($id);
            $image->is_active = !$image->is_active;
            $image->save();
            
            return redirect()->route('admin.pure-lock-gallery')->with('success', 'Image status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function contact()
    {
        try {
            return view('public.contact');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function privacy()
    {
        try {
            return view('public.privacy');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function terms()
    {
        try {
            return view('public.terms');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function privacyPolicy()
    {
        try {
            $page = PageContent::firstOrCreate(
                ['slug' => 'privacy-policy'],
                ['title' => 'Privacy Policy']
            );

            return view('admin.pages.privacy_policy', compact('page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePrivacyPolicy(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
            ]);

            $page = PageContent::firstOrCreate(
                ['slug' => 'privacy-policy'],
                ['title' => 'Privacy Policy']
            );

            $page->update([
                'title' => 'Privacy Policy',
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.privacy-policy.edit')->with('success', 'Privacy policy updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function refundPolicy()
    {
        try {
            $page = RefundPolicy::firstOrCreate(
                ['slug' => 'refund-policy'],
                ['title' => 'Refund Policy']
            );

            return view('admin.pages.refund_policy', compact('page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateRefundPolicy(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
            ]);

            $page = RefundPolicy::firstOrCreate(
                ['slug' => 'refund-policy'],
                ['title' => 'Refund Policy']
            );

            $page->update([
                'title' => 'Refund Policy',
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.refund-policy.edit')->with('success', 'Refund policy updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function termsOfService()
    {
        try {
            $page = TermsService::firstOrCreate(
                ['slug' => 'terms-of-service'],
                ['title' => 'Terms of Service']
            );

            return view('admin.pages.terms_service', compact('page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateTermsOfService(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
            ]);

            $page = TermsService::firstOrCreate(
                ['slug' => 'terms-of-service'],
                ['title' => 'Terms of Service']
            );

            $page->update([
                'title' => 'Terms of Service',
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.terms-service.edit')->with('success', 'Terms of Service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function shippingPolicy()
    {
        try {
            $page = ShippingPolicy::firstOrCreate(
                ['slug' => 'shipping-policy'],
                ['title' => 'Shipping Policy']
            );

            return view('admin.pages.shipping_policy', compact('page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateShippingPolicy(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
            ]);

            $page = ShippingPolicy::firstOrCreate(
                ['slug' => 'shipping-policy'],
                ['title' => 'Shipping Policy']
            );

            $page->update([
                'title' => 'Shipping Policy',
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.shipping-policy.edit')->with('success', 'Shipping policy updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
