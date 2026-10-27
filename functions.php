<?php
function hitungTotalNilaiStok(array $katalog): float {
    $totalNilai = 0;
    foreach ($katalog as $obat) {
        $totalNilai += $obat['harga'] * $obat['stok'];
    }
    return $totalNilai;
}

function getKondisiStokClass(int $stok): string {
    if ($stok < 3) {
        return "baris-kritis"; // Kelas CSS untuk penandaan visual
    }
    return "baris-normal";
}