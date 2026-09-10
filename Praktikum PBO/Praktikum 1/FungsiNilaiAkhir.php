<?php

function hitungNilaiAkhir($uts, $uas, $tugas) {
    $nilaiAkhir = ($uts * 0.30) + ($uas * 0.40) + ($tugas * 0.30);

    return (float) $nilaiAkhir;
}

$uts = 90;
$uas = 89;
$tugas = 92;

$hasil = hitungNilaiAkhir($uts, $uas, $tugas);

echo "Nilai Akhir: " . $hasil;

?>