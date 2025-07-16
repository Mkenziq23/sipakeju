<?php

namespace Database\Seeders;

use App\Models\Gejala;
use DateTime;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gejala = Gejala::insert([
            [
                'id' => 'P001',
                'nama' => 'Saya bermain judi online lebih dari lima kali sehari',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P002',
                'nama' => 'Saya bermain judi online semalaman sambil begadang',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P003',
                'nama' => 'Saya bermain judi online demi mendapatkan uang yang banyak',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P004',
                'nama' => 'Saya bermain judi online karena bujukan teman',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P005',
                'nama' => 'Saya merasa bahagia ketika mendapat kemenangan besar',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P006',
                'nama' => 'Saya mampu bermain satu jam lebih dalam sekali bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P007',
                'nama' => 'Saya bermain judi online saat memiliki uang saja',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P008',
                'nama' => 'Saya bergantian dengan teman ketika bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P009',
                'nama' => 'Saya bermain judi online dengan meminjam uang teman',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P010',
                'nama' => 'Saya bermain judi online karna iseng',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P011',
                'nama' => 'Saya iri ketika teman mendapat kemenangan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P012',
                'nama' => 'Saya bermain judi online sambil makan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P013',
                'nama' => 'Saya bermain judi online lebih dari sepuluh kali sehari',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P014',
                'nama' => 'Saya bersaing dengan teman siapa yang mendapat kemenangan terlebih dulu ketika bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P015',
                'nama' => 'Saya akan terus bermain judi online sekalipun kalah',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P016',
                'nama' => 'Saya bermain judi online karena mengikuti teman juga bermain',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P017',
                'nama' => 'Saya khawatir ketika uang akan habis saat bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P018',
                'nama' => 'Saya mampu bermain 3 jam lebih dalam sekali bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P019',
                'nama' => 'Saya bermain judi online dengan modal meminjam uang teman',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P020',
                'nama' => 'Saya tidak berhenti main judi online jika belum menang',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P021',
                'nama' => 'Saya memilih pinjol untuk bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P022',
                'nama' => 'Saya bermain judi online untuk menghibur diri',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P023',
                'nama' => 'Saya merasa panas ketika melihat teman bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P024',
                'nama' => 'Saya bermain judi online ketika akan tidur',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P025',
                'nama' => 'Saya bermain judi online lebih dari lima belas kali sehari',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P026',
                'nama' => 'Saya bermain judi online ketika akhir pekan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P027',
                'nama' => 'Saya berhenti bermain judi online jika uang habis',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P028',
                'nama' => 'Saya berusaha mendapatkan uang dalam bermain judi',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P029',
                'nama' => 'Saya merasa tegang ketka bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P030',
                'nama' => 'Saya mampu bermain 5 jam lebih dalam sekali bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P031',
                'nama' => 'Saya menunggu teman menang untuk bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P032',
                'nama' => 'Saya bermain judi online ketika akhir pekan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P033',
                'nama' => 'Saya patungan dengan teman untuk bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P034',
                'nama' => 'Saya bermain judi online untuk bersenang senang',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P035',
                'nama' => 'Saya merasa panik jika saldo akan habis ketika bermain judi online',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 'P036',
                'nama' => 'Saya bermain judi online ketika nongkrong dengan teman',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
