<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dataset;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@satudata.test'],
            ['name'=>'Administrator Satu Data','password'=>Hash::make('password')]
        );

        $categories = collect([
            ['name'=>'Pendidikan','description'=>'Data pendidikan dan satuan pendidikan.'],
            ['name'=>'Kesehatan','description'=>'Data fasilitas dan layanan kesehatan.'],
            ['name'=>'Ekonomi','description'=>'Data ekonomi, UMKM, perdagangan dan investasi.'],
            ['name'=>'Kependudukan','description'=>'Data penduduk dan sosial.'],
            ['name'=>'Infrastruktur','description'=>'Data infrastruktur dan fasilitas umum.'],
        ])->mapWithKeys(function($item){
            $item['slug'] = Str::slug($item['name']);
            $cat = Category::updateOrCreate(['slug'=>$item['slug']],$item);
            return [$item['name']=>$cat];
        });

        $orgs = collect([
            ['name'=>'Dinas Komunikasi dan Informatika','code'=>'DISKOMINFO'],
            ['name'=>'Dinas Pendidikan','code'=>'DISDIK'],
            ['name'=>'Dinas Kesehatan','code'=>'DINKES'],
            ['name'=>'Badan Pusat Statistik Daerah','code'=>'BPSDA'],
            ['name'=>'Bappeda','code'=>'BAPPEDA'],
        ])->mapWithKeys(function($item){
            $org = Organization::updateOrCreate(['code'=>$item['code']],$item);
            return [$item['code']=>$org];
        });

        $samples = [
            ['title'=>'Data Sekolah Menurut Kecamatan','cat'=>'Pendidikan','org'=>'DISDIK','year'=>2025,'format'=>'CSV'],
            ['title'=>'Data Fasilitas Kesehatan','cat'=>'Kesehatan','org'=>'DINKES','year'=>2025,'format'=>'XLSX'],
            ['title'=>'Data UMKM Aktif','cat'=>'Ekonomi','org'=>'BAPPEDA','year'=>2025,'format'=>'CSV'],
            ['title'=>'Data Penduduk Menurut Kelompok Umur','cat'=>'Kependudukan','org'=>'BPSDA','year'=>2024,'format'=>'CSV'],
            ['title'=>'Data Infrastruktur Jalan','cat'=>'Infrastruktur','org'=>'BAPPEDA','year'=>2025,'format'=>'XLSX'],
            ['title'=>'Data Guru dan Tenaga Kependidikan','cat'=>'Pendidikan','org'=>'DISDIK','year'=>2024,'format'=>'CSV'],
            ['title'=>'Data Posyandu','cat'=>'Kesehatan','org'=>'DINKES','year'=>2025,'format'=>'CSV'],
            ['title'=>'Data Pasar Tradisional','cat'=>'Ekonomi','org'=>'BAPPEDA','year'=>2024,'format'=>'XLSX'],
        ];

        foreach($samples as $s){
            Dataset::updateOrCreate(
                ['slug'=>Str::slug($s['title'])],
                [
                    'category_id'=>$categories[$s['cat']]->id,
                    'organization_id'=>$orgs[$s['org']]->id,
                    'title'=>$s['title'],
                    'description'=>'Dataset resmi untuk kebutuhan analisis, perencanaan, monitoring, dan pelayanan publik.',
                    'metadata'=>['sumber'=>'Portal Satu Data','cakupan'=>'Kabupaten/Kota','lisensi'=>'Terbuka'],
                    'year'=>$s['year'],
                    'format'=>$s['format'],
                    'downloads'=>rand(10,450),
                    'status'=>'published'
                ]
            );
        }
    }
}