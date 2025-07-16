<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KecanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penyakit::insert([
            [
                'id' => 'K001',
                'nama' => 'Kecenderungan Rendah',
                'slug' => Str::slug('Kecenderungan Rendah'),
                'deskripsi' => 'Kecenderungan rendah pada perilaku adiktif umumnya terlihat pada individu yang sesekali terlibat dalam kebiasaan adiktif seperti perjudian online, tetapi tidak mengganggu keseharian mereka secara signifikan. Hal ini biasanya dipicu oleh rasa penasaran atau pelarian sementara dari stres atau kecemasan ringan.',
                'solusi' => 'Pendidikan tentang dampak negatif perjudian dapat sangat membantu. Intervensi berbasis edukasi, seperti memberi informasi mengenai risiko kecanduan, dapat memperkecil peluang perkembangan adiksi. Mendorong individu untuk menemukan pengalihan positif seperti olahraga, meditasi, atau kegiatan sosial dapat menjadi langkah preventif yang efektif.',
                'gambar' => 'public/assets/gambar/Judi1.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'K002',
                'nama' => 'Kecenderungan Sedang',
                'slug' => Str::slug('Kecenderungan Sedang'),
                'deskripsi' => 'Kecenderungan sedang pada perjudian ditandai dengan perilaku yang mulai mempengaruhi kehidupan sehari-hari individu, seperti penurunan produktivitas, gangguan pada hubungan sosial, dan kesehatan mental yang menurun. Pada tahap ini, individu lebih sering terlibat dalam perjudian untuk mengatasi tekanan emosional atau masalah pribadi.',
                'solusi' => 'Terapi perilaku kognitif (CBT) dapat membantu individu mengenali dan mengubah pola pikir negatif yang memicu perilaku adiktif. Dukungan sosial, seperti bantuan keluarga dan teman, sangat penting dalam membantu individu menjalani perubahan positif dan mempertahankan kontrol diri.',
                'gambar' => 'assets/gambar/Judi2.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'K003',
                'nama' => 'Kecenderungan Tinggi',
                'slug' => Str::slug('Kecenderungan Tinggi'),
                'deskripsi' => 'Kecenderungan tinggi pada perjudian mengarah pada kecanduan serius, di mana individu kehilangan kontrol penuh terhadap perilaku mereka meskipun menyadari konsekuensi negatif yang ditimbulkan. Dampak dari perilaku ini sangat merugikan, mencakup kerusakan pada kesehatan fisik dan mental, hubungan interpersonal, serta keuangan.',
                'solusi' => 'Penanganan intensif dibutuhkan untuk individu dengan kecanduan tingkat tinggi, seperti program rehabilitasi yang mencakup terapi medis dan psikoterapi. Terapi perilaku kognitif yang lebih intensif dapat membantu individu menggali akar penyebab kecanduannya dan mengembangkan strategi pengelolaan stres yang lebih sehat. Penggunaan kelompok dukungan seperti 12-step programs, yang didasarkan pada pemulihan berbasis komunitas, dapat memberikan bantuan berkelanjutan selama pemulihan.',
                'gambar' => 'assets/gambar/Judi3.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
