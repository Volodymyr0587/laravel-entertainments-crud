<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function destroy(Image $image)
    {
        Gate::authorize('delete', $image->entertainment);

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Image deleted');
    }

}
