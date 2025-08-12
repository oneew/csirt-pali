<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $galleries = Gallery::byCategory($category)
            ->latest()
            ->paginate(12);
        
        return response()->json([
            'status' => 'success',
            'data' => $galleries
        ]);
    }

    public function featured()
    {
        $galleries = Gallery::featured()->latest()->take(6)->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $galleries
        ]);
    }
}