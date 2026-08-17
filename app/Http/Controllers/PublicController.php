<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dataset;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Dataset::with(['category','organization'])->where('status', 'published');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($builder) use ($q) {
                $builder->where('title','like',"%{$q}%")
                    ->orWhere('description','like',"%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('organization')) {
            $query->where('organization_id', $request->organization);
        }

        $datasets = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $organizations = Organization::orderBy('name')->get();

        return view('public.home', compact('datasets','categories','organizations'));
    }

    public function show(Dataset $dataset)
    {
        abort_if($dataset->status !== 'published', 404);
        $dataset->load(['category','organization']);
        return view('public.show', compact('dataset'));
    }

    public function download(Dataset $dataset)
    {
        abort_if($dataset->status !== 'published' || !$dataset->file_path, 404);
        $dataset->increment('downloads');
        return Storage::disk('public')->download($dataset->file_path);
    }
}