<?php
require_once 'medicines.php';
require_once 'functions.php';

$totalAset = hitungTotalNilaiStok($katalogObat);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris Apotek</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f8f9fa; }
        h2 { color: #2c3e50; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        
        .summary-card {
            background-color: #ffffff;
            border-left: 5px solid #27ae60;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table { width: 100%; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #e0e0e0; padding: 12px; text-align: left; }
        th { background-color: #34495e; color: white; }
        
        /* Highlight khusus untuk stok kritis (< 3)[cite: 1] */
        .baris-kritis { background-color: #ffe6e6; color: #900; }
        .baris-normal { background-color: #ffffff; }
        
        .peringatan-stok { color: #d63031; font-weight: bold; font-size: 0.85em; margin-left: 5px; }
    </style>
</head>
<body>

    <h2>Sistem Inventaris Apotek</h2>

    <div class="summary-card">
        <strong>Total Nilai Aset Obat Gudang:</strong> 
        Rp <?= number_format($totalAset, 0, ',', '.'); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Stok</th>
                <th>Indikasi / Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($katalogObat as $obat): ?>
                <?php $cssClass = getKondisiStokClass($obat['stok']); ?>
                <tr class="<?= $cssClass; ?>">
                    <td><?= htmlspecialchars($obat['id']); ?></td>
                    <td><strong><?= htmlspecialchars($obat['nama']); ?></strong></td>
                    <td><?= htmlspecialchars($obat['kategori']); ?></td>
                    <td>Rp <?= number_format($obat['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <?= $obat['stok']; ?>
                        <?php if ($obat['stok'] < 3): ?>
                            <span class="peringatan-stok">(Stok Kritis!)</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($obat['deskripsi']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>