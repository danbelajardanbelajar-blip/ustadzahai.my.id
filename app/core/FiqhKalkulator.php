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

    public static function getMinHaidDateObj($tglLahir, $jamLahir) {
        $born = new DateTime("$tglLahir $jamLahir");
        // Usia minimal haid secara astronomis: 3173 hari, 7 jam, 17 menit.
        $minHaidObj = clone $born;
        $minHaidObj->modify('+3173 days 7 hours 17 minutes');
        return $minHaidObj;
    }

    public static function getMinHaidInfo($tglLahir, $jamLahir) {
        $born = new DateTime("$tglLahir $jamLahir");
        $hijri = \GeniusTS\HijriDate\Hijri::convertToHijri($born->format('Y-m-d'));
        
        $minHaidObj = self::getMinHaidDateObj($tglLahir, $jamLahir);
        $minHaidHijri = \GeniusTS\HijriDate\Hijri::convertToHijri($minHaidObj->format('Y-m-d'));
        
        $bulanHijri = [
            1 => 'Muharram', 2 => 'Safar', 3 => 'Rabiul Awal', 4 => 'Rabiul Akhir',
            5 => 'Jumadil Awal', 6 => 'Jumadil Akhir', 7 => 'Rajab', 8 => 'Syaban',
            9 => 'Ramadhan', 10 => 'Syawal', 11 => 'Dzulqaidah', 12 => 'Dzulhijjah'
        ];
        
        $bulanMasehi = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return [
            'lahirMasehi' => $born->format('d') . ' ' . $bulanMasehi[(int)$born->format('n')] . ' ' . $born->format('Y') . ' jam ' . $born->format('H:i'),
            'lahirHijriah' => $hijri->day . ' ' . $bulanHijri[(int)$hijri->month] . ' ' . $hijri->year . ' H',
            'minHaidMasehi' => $minHaidObj->format('d') . ' ' . $bulanMasehi[(int)$minHaidObj->format('n')] . ' ' . $minHaidObj->format('Y') . ' jam ' . $minHaidObj->format('H:i'),
            'minHaidHijriah' => $minHaidHijri->day . ' ' . $bulanHijri[(int)$minHaidHijri->month] . ' ' . $minHaidHijri->year . ' H'
        ];
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
            $minHaidObj = self::getMinHaidDateObj($tglLahir, $jamLahir);
            $kd1 = $siklus[0];
            
            if ($kd1['start'] < $minHaidObj) {
                // Darah dimulai sebelum usia minimal.
                if ($kd1['end'] <= $minHaidObj) {
                    // Semua Darah Fasad
                    foreach ($siklus as &$s) {
                        if ($s['type'] === 'KD') $s['status'] = 'Darah Fasad';
                    }
                    return [
                        'status' => 'success',
                        'kesimpulan' => 'Darah Fasad (Belum mencapai usia memungkinkan haid)',
                        'siklus' => $siklus
                    ];
                } else {
                    // Ada perpotongan (split)
                    $fasadInterval = $kd1['start']->diff($minHaidObj);
                    $fasadHours = ($fasadInterval->days * 24) + $fasadInterval->h + ($fasadInterval->i / 60);
                    
                    $haidInterval = $minHaidObj->diff($kd1['end']);
                    $haidHours = ($haidInterval->days * 24) + $haidInterval->h + ($haidInterval->i / 60);
                    
                    $haidDays = round($haidHours / 24, 1);
                    $hukumHaid = '';
                    $hukumDesc = '';
                    if ($haidHours >= 24 && $haidHours <= 360) {
                        $hukumHaid = 'HAID';
                        $hukumDesc = "Darah $haidDays hari (≤ 15 hari) = Haid.";
                    } else if ($haidHours < 24) {
                        $hukumHaid = 'DARAH FASAD';
                        $hukumDesc = "Darah $haidDays hari (< 24 jam) = Darah Fasad.";
                    } else {
                        $hukumHaid = 'ISTIHADHAH';
                        $hukumDesc = "Darah $haidDays hari (> 15 hari) = Istihadhah.";
                    }

                    $minHaidInfo = self::getMinHaidInfo($tglLahir, $jamLahir);
                    $minHaidStr = $minHaidInfo['minHaidMasehi'] . ' (' . $minHaidInfo['minHaidHijriah'] . ')';

                    return [
                        'status' => 'success',
                        'kesimpulan' => 'Darah Fasad + ' . ($hukumHaid === 'HAID' ? 'Haid' : ($hukumHaid === 'ISTIHADHAH' ? 'Istihadhah' : 'Fasad')),
                        'is_fasad_split' => true,
                        'fasad_data' => [
                            'min_haid_str' => $minHaidStr,
                            'fasad_hours' => round($fasadHours, 1),
                            'haid_hours' => round($haidHours, 1),
                            'hukum_haid' => $hukumHaid,
                            'hukum_desc' => $hukumDesc
                        ],
                        'siklus' => []
                    ];
                }
            }
        }

        // Langkah 1.5: Cek Istihadoh Takmil (Penyempurna Suci)
        if (count($siklus) >= 3 && $siklus[0]['type'] === 'KD' && $siklus[1]['type'] === 'B' && $siklus[2]['type'] === 'KD') {
            $kd1 = $siklus[0];
            $b1 = $siklus[1];
            $kd2 = $siklus[2];

            // Syarat Takmil:
            // 1. KD 1 adalah Haid valid (<= 15 hari)
            // 2. B 1 < 15 hari
            // 3. KD 2 mulai di luar 15 hari sejak awal KD 1
            if ($kd1['hours'] <= 360 && $b1['hours'] < 360 && ($kd1['hours'] + $b1['hours']) > 360) {
                $takmilHours = 360 - $b1['hours'];
                $sisaKd2Hours = $kd2['hours'] - $takmilHours;

                $takmilEndObj = clone $kd2['start'];
                $takmilEndObj->modify('+' . round($takmilHours * 60) . ' minutes');
                
                $bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                $takmilEndStr = $takmilEndObj->format('d') . ' ' . $bulanIndo[(int)$takmilEndObj->format('n')] . ' ' . $takmilEndObj->format('Y') . ' jam ' . $takmilEndObj->format('H.i');
                $kd2EndStr = $kd2['end']->format('d') . ' ' . $bulanIndo[(int)$kd2['end']->format('n')] . ' ' . $kd2['end']->format('Y') . ' jam ' . $kd2['end']->format('H.i');

                // Tentukan hukum sisa KD 2
                $sisaHukum = '';
                $sisaDesc = '';
                if ($sisaKd2Hours <= 360) {
                    $sisaHukum = 'HAID SEMUA';
                    $sisaDesc = '(Sisa &le; 15 hari)';
                } else {
                    $sisaHukum = 'ISTIHADHAH';
                    $sisaDesc = '(Sisa &gt; 15 hari)';
                }

                return [
                    'status' => 'success',
                    'kesimpulan' => 'ISTIHADOH TAKMIL',
                    'is_takmil_split' => true,
                    'takmil_data' => [
                        'takmil_days' => round($takmilHours / 24, 1),
                        'takmil_end_str' => $takmilEndStr,
                        'sisa_kd2_days' => round($sisaKd2Hours / 24, 1),
                        'sisa_start_str' => $takmilEndStr,
                        'sisa_end_str' => $kd2EndStr,
                        'sisa_hukum' => $sisaHukum,
                        'sisa_desc' => $sisaDesc
                    ],
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
