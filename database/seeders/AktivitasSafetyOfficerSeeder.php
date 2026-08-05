<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SafetyOfficer;
use App\Models\AktivitasKpiK3;

class AktivitasSafetyOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil mapping Kode -> ID dari AktivitasKpiK3 (menghindari query berulang di dalam loop)
        $aktivitasMap = AktivitasKpiK3::pluck('id', 'kode')->toArray();

        // 2. Mapping data dari Spreadsheet (hanya memasukkan kode aktivitas yang bernilai 'v')
        $assignments = [
            // 1. K.200384 - MUKHLISIN (Semua 'v')
            'K.200384' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 2. K.202860 - SYAFRIZAL FIRDAUS (C.5 = x)
            'K.202860' => ['C.1', 'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 3. K.210050 - RAHMAT BUDI PRASETYO (C.1, C.5, E.6 = x)
            'K.210050' => [/*'C.1',*/'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', /*'E.6'*/],

            // 4. K.210112 - M FARIZ ALEXFAN (Semua 'v')
            'K.210112' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 5. K.210282 - FUADUR ZAKKI KURNIAWAN (Semua 'v')
            'K.210282' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 6. K.210835 - ADITYA PRADANA PUTRA (Semua 'v')
            'K.210835' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 7. K.210836 - LUKI NURDIANSYAH (C.1, C.4, C.5, E.1, E.2, E.4, E.6 = x)
            'K.210836' => [/*'C.1',*/'C.2', /*'C.4', 'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', /*'E.1', 'E.2', 'E.4',*/ 'E.5' /*,'E.6'*/],

            // 8. K.210837 - MUHAMMAD SYAMSUL HUDA (C.5 = x)
            'K.210837' => ['C.1', 'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 9. K.230218 - YOGA PRASETYA BHASKARA (Semua 'v')
            'K.230218' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 10. K.230219 - RICKO ADISETYO (Semua 'v')
            'K.230219' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 11. K.230229 - GIGIH PRILLA ADITAMA (Semua 'v')
            'K.230229' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 12. K.210283 - ABDUL HAMID JUNAIDI (Semua 'v')
            'K.210283' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 13. K.240394 - GLADIOL QUEEN DANATAMA (Semua 'v')
            'K.240394' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 14. K.250351 - AYU PUSPA ARUM M.K.W (C.5 = x)
            'K.250351' => ['C.1', 'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 15. K.230205 - ANANG ALAMSYAH (C.5 = x)
            'K.230205' => ['C.1', 'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 16. K.230200 - MOCHAMMAD YUSUF FERDIANSYAH (C.5 = x)
            'K.230200' => ['C.1', 'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 17. K.260061 - DWI ELLA MAGAREZA (C.5 = x)
            'K.260061' => ['C.1', 'C.2', 'C.4', /*'C.5',*/ 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],

            // 18. K.210462 - RIZKI IRVAN (Semua 'v')
            'K.210462' => ['C.1', 'C.2', 'C.4', 'C.5', 'D.1', 'D.2', 'D.3', 'D.4', 'E.1', 'E.2', 'E.4', 'E.5', 'E.6'],
        ];

        // 3. Proses injeksi relasi ke Database
        foreach ($assignments as $badge => $kodes) {

            // Pastikan data Safety Officer exist agar foreign key tidak bermasalah
            $safetyOfficer = SafetyOfficer::firstOrCreate(
                ['badge' => $badge],
                [
                    'is_active' => true,
                    'assigned_at' => now(),
                    'assigned_by' => 'system:seed',
                ]
            );

            // Kumpulkan ID aktivitas yang sesuai dengan kode
            $activityIds = [];
            foreach ($kodes as $kode) {
                if (isset($aktivitasMap[$kode])) {
                    $activityIds[] = $aktivitasMap[$kode];
                }
            }

            // Gunakan ->sync() untuk melampirkan ke tabel pivot secara bersih (replace data)
            $safetyOfficer->aktivitasKpi()->sync($activityIds);
        }
    }
}
