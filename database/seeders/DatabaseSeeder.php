<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;use App\Models\User;use App\Models\Book;use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {public function run():void{
 User::firstOrCreate(['email'=>'admin@perpus.test'],['name'=>'Admin Perpustakaan','password'=>Hash::make('admin12345'),'role'=>'admin']);
 User::firstOrCreate(['email'=>'siswa@perpus.test'],['name'=>'Siswa Contoh','password'=>Hash::make('siswa12345'),'nis'=>'123456','class_name'=>'XII RPL','role'=>'siswa']);
 foreach([['Laskar Pelangi','Andrea Hirata','Bentang Pustaka',2005,8],['Bumi','Tere Liye','Gramedia',2014,5],['Negeri 5 Menara','Ahmad Fuadi','Gramedia',2009,4],['Laut Bercerita','Leila S. Chudori','Kepustakaan Populer Gramedia',2017,3]] as $b)Book::firstOrCreate(['title'=>$b[0]],['author'=>$b[1],'publisher'=>$b[2],'year'=>$b[3],'stock'=>$b[4]]);
}}
