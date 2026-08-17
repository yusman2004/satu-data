<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dataset;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatasetController extends Controller
{
    public function index(Request $request)
    {
        $query = Dataset::with(['category','organization'])->latest();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('title','like',"%{$q}%");
        }

        $datasets = $query->paginate(10)->withQueryString();
        return view('admin.datasets.index', compact('datasets'));
    }

    public function create()
    {
        return view('admin.datasets.form', [
            'dataset' => new Dataset(),
            'categories' => Category::orderBy('name')->get(),
            'organizations' => Organization::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(5));

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('datasets','public');
        }

        Dataset::create($data);
        return redirect()->route('admin.datasets.index')->with('success','Dataset berhasil ditambahkan.');
    }

    public function edit(Dataset $dataset)
    {
        return view('admin.datasets.form', [
            'dataset' => $dataset,
            'categories' => Category::orderBy('name')->get(),
            'organizations' => Organization::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Dataset $dataset)
    {
        $data = $this->validated($request);
        $data['slug'] = $dataset->slug;

        if ($request->hasFile('file')) {
            if ($dataset->file_path) Storage::disk('public')->delete($dataset->file_path);
            $data['file_path'] = $request->file('file')->store('datasets','public');
        }

        $dataset->update($data);
        return redirect()->route('admin.datasets.index')->with('success','Dataset berhasil diperbarui.');
    }

    public function destroy(Dataset $dataset)
    {
        if ($dataset->file_path) Storage::disk('public')->delete($dataset->file_path);
        $dataset->delete();
        return back()->with('success','Dataset berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required','exists:categories,id'],
            'organization_id' => ['required','exists:organizations,id'],
            'title' => ['required','string','max:200'],
            'description' => ['required','string'],
            'metadata' => ['nullable','string'],
            'year' => ['required','integer','min:2000','max:2100'],
            'format' => ['required','string','max:30'],
            'status' => ['required','in:published,draft'],
            'file' => ['nullable','file','max:20480','mimes:csv,xlsx,xls,pdf,zip'],
        ]);
    }
}