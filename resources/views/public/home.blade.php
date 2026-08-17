@extends('layouts.public')
@section('content')
<section class="hero"><div class="container"><div class="row align-items-center"><div class="col-lg-8">
<div class="text-uppercase small fw-semibold opacity-75 mb-3"><i class="bi bi-bar-chart-fill me-2"></i>Portal Data Terpadu</div>
<h1>Temukan data publik dalam satu portal.</h1>
<p class="lead opacity-75 mt-3">Cari, jelajahi, dan unduh dataset dari berbagai sektor dan instansi.</p>
</div></div></div></section>

<div class="container search-box"><div class="card p-4"><form class="row g-3" method="get">
<div class="col-lg-5"><label class="small text-muted">Kata kunci</label><div class="input-group"><span class="input-group-text bg-white"><i class="bi bi-search"></i></span><input name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari dataset..."></div></div>
<div class="col-lg-3"><label class="small text-muted">Kategori</label><select name="category" class="form-select"><option value="">Semua kategori</option>@foreach($categories as $c)<option value="{{ $c->id }}" @selected(request('category')==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div class="col-lg-3"><label class="small text-muted">Instansi</label><select name="organization" class="form-select"><option value="">Semua instansi</option>@foreach($organizations as $o)<option value="{{ $o->id }}" @selected(request('organization')==$o->id)>{{ $o->name }}</option>@endforeach</select></div>
<div class="col-lg-1 d-flex align-items-end"><button class="btn btn-primary w-100"><i class="bi bi-search"></i></button></div>
</form></div></div>

<div class="container py-5"><div class="d-flex justify-content-between align-items-center mb-4"><div><h2 class="fw-bold mb-1">Dataset Terbaru</h2><div class="text-muted">Menampilkan dataset yang tersedia untuk publik</div></div><span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">{{ $datasets->total() }} dataset</span></div>
<div class="row g-4">@forelse($datasets as $d)<div class="col-md-6 col-lg-4"><div class="card dataset-card h-100 p-4">
<div class="d-flex justify-content-between mb-3"><span class="badge badge-soft rounded-pill">{{ $d->category->name }}</span><span class="small text-muted">{{ $d->year }}</span></div>
<h5 class="fw-bold"><a class="text-decoration-none text-dark" href="{{ route('dataset.show',$d) }}">{{ $d->title }}</a></h5>
<p class="text-muted small flex-grow-1">{{ Str::limit($d->description,110) }}</p>
<div class="small text-muted border-top pt-3"><i class="bi bi-building me-1"></i>{{ $d->organization->name }} · <b>{{ $d->format }}</b></div>
</div></div>@empty<div class="col-12"><div class="card p-5 text-center">Dataset tidak ditemukan.</div></div>@endforelse</div>
<div class="mt-5">{{ $datasets->links() }}</div></div>
@endsection