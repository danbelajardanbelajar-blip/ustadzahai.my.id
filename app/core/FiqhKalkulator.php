<?php

use GeniusTS\HijriDate\Hijri;
use GeniusTS\HijriDate\Date;

class FiqhKalkulator {

    /**
     * Hitung usia hijriah dalam hari, lalu cek apakah memenuhi 9 tahun - 16 hari - 1 detik
     */
    public static function cekUsiaMemungkinkanHaid($tglLahir, $jamLahir, $tglKeluarDarah, $jamKeluarDarah) {
        $born = new DateTime("$tglLahir $jamLahir");
        $bloodDate = new DateTime("$tglKeluarDarah $jamKeluarDarah");
        
        $bornHijri = Hijri::convertToHijri($born->format('Y-m-d'));
        // Minimal usia = 9 tahun (kurang 16 hari kurang 1 detik)
        // Kita hitung jumlah hari antara bornHijri dan bloodDateHijri
        // Cara termudah: hitung selisih hari di masehi
        $diff = $born->diff($bloodDate);
        $diffDays = $diff->days;
        
        // Asumsi kasar 1 tahun Hijriah = 354.36 hari
        // 9 tahun Hijriah = 3189 hari.
        // 3189 hari - 16 hari = 3173 hari.
        $minDays = 3173; 

        if ($diffDays < $minDays) {
            return false;
        }

        // Jika persis 3173 hari, cek detiknya (harus lebih dari 0)
        if ($diffDays == $minDays) {
            if ($diff->h == 0 && $diff->i == 0 && $diff->s == 0) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Algoritma utama berdasarkan Decision Tree
     */
    public static function analisa($kategori, $tglLahir, $jamLahir, $adatHaid, $adatSuci, $darahBlocks) {
        // Normalisasi darahBlocks: hitung durasi masing-masing
        $siklus = [];
        for ($i = 0; $i < count($darahBlocks); $i++) {
            $keluar = new DateTime($darahBlocks[$i]['tgl_keluar'] . ' ' . $darahBlocks[$i]['jam_keluar']);
            $bersih = new DateTime($darahBlocks[$i]['tgl_bersih'] . ' ' . $darahBlocks[$i]['jam_bersih']);
            
            $interval = $keluar->diff($bersih);
            $hours = ($interval->days * 24) + $interval->h + ($interval->i / 60);
            
            $siklus[] = [
                'type' => 'KD',
                'start' => $keluar,
                'end' => $bersih,
                'hours' => $hours,
                'status' => 'Belum Dianalisa'
            ];

            if ($i < count($darahBlocks) - 1) {
                $nextKeluar = new DateTime($darahBlocks[$i+1]['tgl_keluar'] . ' ' . $darahBlocks[$i+1]['jam_keluar']);
                $bInterval = $bersih->diff($nextKeluar);
                $bHours = ($bInterval->days * 24) + $bInterval->h + ($bInterval->i / 60);
                $siklus[] = [
                    'type' => 'B',
                    'start' => $bersih,
                    'end' => $nextKeluar,
                    'hours' => $bHours,
                    'status' => 'Suci'
                ];
            }
        }

        // Langkah 1: Cek masa memungkinkan haid (Untuk Mubtadaah)
        if ($kategori === 'mubtadaah') {
            $kd1 = $siklus[0];
            if (!self::cekUsiaMemungkinkanHaid($tglLahir, $jamLahir, $kd1['start']->format('Y-m-d'), $kd1['start']->format('H:i:s'))) {
                foreach ($siklus as &$s) {
                    if ($s['type'] === 'KD') $s['status'] = 'Darah Fasad';
                }
                return [
                    'status' => 'success',
                    'kesimpulan' => 'Darah Fasad (Belum mencapai usia memungkinkan haid)',
                    'siklus' => $siklus
                ];
            }
        }

        // Langkah 2: Cek Syarat Haid (Total KD dalam 15 hari >= 24 jam)
        // Batas 15 hari = 15 * 24 = 360 jam
        $firstKDStart = $siklus[0]['start'];
        $limit15Days = clone $firstKDStart;
        $limit15Days->modify('+15 days');

        $totalKDIn15Days = 0;
        $allWithin15Days = true;
        foreach ($siklus as $s) {
            if ($s['type'] === 'KD') {
                if ($s['end'] <= $limit15Days) {
                    $totalKDIn15Days += $s['hours'];
                } else if ($s['start'] < $limit15Days) {
                    // Parsial di dalam 15 hari
                    $interval = $s['start']->diff($limit15Days);
                    $hours = ($interval->days * 24) + $interval->h + ($interval->i / 60);
                    $totalKDIn15Days += $hours;
                    $allWithin15Days = false;
                } else {
                    $allWithin15Days = false;
                }
            } else {
                if ($s['end'] > $limit15Days) {
                    $allWithin15Days = false;
                }
            }
        }

        if ($totalKDIn15Days < 24) {
            // Semua Darah Fasad
            foreach ($siklus as &$s) {
                if ($s['type'] === 'KD') $s['status'] = 'Darah Fasad';
                else $s['status'] = 'Suci';
            }
            return [
                'status' => 'success',
                'kesimpulan' => 'Darah Fasad (Total darah < 24 jam dalam 15 hari)',
                'siklus' => $siklus
            ];
        }

        // Langkah 3 & Cabang-cabangnya
        // Jika seluruh darah selesai sebelum 15 hari
        if ($allWithin15Days) {
            // Cabang A (Normal) atau B (Taqatthu)
            $kdCount = 0;
            foreach ($siklus as $s) if ($s['type'] === 'KD') $kdCount++;

            if ($kdCount == 1) {
                // Cabang A: Haid Normal
                foreach ($siklus as &$s) {
                    if ($s['type'] === 'KD') $s['status'] = 'Haid Normal';
                }
                return [
                    'status' => 'success',
                    'kesimpulan' => 'Haid Normal',
                    'siklus' => $siklus
                ];
            } else {
                // Cabang B: Haid Taqatthu'
                foreach ($siklus as &$s) {
                    if ($s['type'] === 'KD') {
                        $s['status'] = 'Haid (Taqatthu\')';
                    } else if ($s['type'] === 'B') {
                        // Qaul Sahbi = Haid
                        $s['status'] = 'Haid (Qaul Sahbi) / Suci (Qaul Laqthi)';
                    }
                }
                return [
                    'status' => 'success',
                    'kesimpulan' => 'Haid Taqatthu\' (Qaul Sahbi = Darah & Bersih dianggap Haid)',
                    'siklus' => $siklus
                ];
            }
        } else {
            // Melebihi 15 hari: Cabang D (Mustahadhah Fil Haid) / Cabang E (Istihadhah Taqatthu)
            // Untuk simplifikasi (Kalkulator minimal):
            // Kembalikan ke adat
            $adatHaidJam = $adatHaid * 24;
            $adatSuciJam = $adatSuci * 24;

            if ($kategori === 'mubtadaah') {
                $adatHaidJam = 24; // 1 hari
                $adatSuciJam = 29 * 24; // 29 hari
            }

            // Aturan Adat:
            // Darah masuk adat haid -> Haid
            // Lewat -> Istihadhah
            $currentTotalHours = 0;
            foreach ($siklus as &$s) {
                if ($currentTotalHours < $adatHaidJam) {
                    if ($currentTotalHours + $s['hours'] <= $adatHaidJam) {
                        $s['status'] = $s['type'] === 'KD' ? 'Haid' : 'Haid (Qaul Sahbi)';
                    } else {
                        // Split block (simplified for now, marking the whole block with note)
                        $s['status'] = ($s['type'] === 'KD' ? 'Haid parsial, lanjut Istihadhah' : 'Suci parsial');
                    }
                } else {
                    $s['status'] = $s['type'] === 'KD' ? 'Istihadhah' : 'Suci';
                }
                $currentTotalHours += $s['hours'];
            }

            return [
                'status' => 'success',
                'kesimpulan' => 'Istihadhah (Melebihi 15 hari). Dikembalikan ke Adat.',
                'siklus' => $siklus
            ];
        }

    }
}
