<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::withCount('datasets')->latest()->paginate(10);
        return view('admin.organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.organizations.form', ['organization' => new Organization()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>['required','max:150'],
            'code'=>['required','max:50','unique:organizations,code'],
            'description'=>['nullable','string']
        ]);
        Organization::create($data);
        return redirect()->route('admin.organizations.index')->with('success','Instansi ditambahkan.');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.form', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name'=>['required','max:150'],
            'code'=>['required','max:50','unique:organizations,code,'.$organization->id],
            'description'=>['nullable','string']
        ]);
        $organization->update($data);
        return redirect()->route('admin.organizations.index')->with('success','Instansi diperbarui.');
    }

    public function destroy(Organization $organization)
    {
        if ($organization->datasets()->exists()) return back()->with('error','Instansi masih digunakan dataset.');
        $organization->delete();
        return back()->with('success','Instansi dihapus.');
    }
}