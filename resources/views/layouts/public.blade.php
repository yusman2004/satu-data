<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $title ?? 'Satu Data' }} - Portal Data Terpadu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
:root{--primary:#1d4ed8;--dark:#0f172a;--soft:#f1f5f9}
body{font-family:Inter,system-ui,-apple-system,Segoe UI,sans-serif;background:#f8fafc;color:#172033}
.navbar{background:#fff;border-bottom:1px solid #e5e7eb}.brand-dot{width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#2563eb,#7c3aed);display:inline-flex;align-items:center;justify-content:center;color:#fff}
.hero{background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 55%,#4f46e5 100%);color:#fff;padding:72px 0 90px}.hero h1{font-weight:800;font-size:clamp(2rem,4vw,3.4rem)}
.search-box{margin-top:-38px;position:relative}.card{border:0;border-radius:18px;box-shadow:0 8px 30px rgba(15,23,42,.06)}
.dataset-card{transition:.2s}.dataset-card:hover{transform:translateY(-4px);box-shadow:0 15px 35px rgba(15,23,42,.11)}
.badge-soft{background:#eff6ff;color:#1d4ed8}.footer{background:#0f172a;color:#cbd5e1}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top"><div class="container py-2">
<a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}"><span class="brand-dot"><i class="bi bi-database-fill"></i></span>Satu Data</a>
<div class="ms-auto"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.login') }}"><i class="bi bi-shield-lock me-1"></i>Admin</a></div>
</div></nav>
@yield('content')
<footer class="footer mt-5 py-5"><div class="container"><div class="fw-bold fs-5 mb-2">Portal Satu Data</div><div>Data terpadu untuk mendukung transparansi, analisis, dan pengambilan keputusan.</div><div class="small mt-4">© {{ date('Y') }} Satu Data</div></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body></html>