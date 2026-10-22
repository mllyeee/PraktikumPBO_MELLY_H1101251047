<?php

require_once __DIR__ . '/Product.php';

function e($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

$message = '';
$error = '';
$editing = null;
$products = [];

try {
    $product = new Product();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $id = (int) ($_POST['id'] ?? 0);

        if ($action === 'save' || $action === 'update') {
            $nama = trim($_POST['nama'] ?? '');
            $harga = $_POST['harga'] ?? '';

            if (
                $nama === '' ||
                !is_numeric($harga) ||
                (float) $harga < 0
            ) {
                throw new InvalidArgumentException(
                    'Nama dan harga produk harus diisi dengan benar.'
                );
            }

            $item = new Product($nama, (float) $harga);

            if ($action === 'save') {
                $item->save();
                $message = 'Produk berhasil ditambahkan.';
            } else {
                if ($product->findById($id) === null) {
                    throw new InvalidArgumentException(
                        'Produk tidak ditemukan.'
                    );
                }

                $item->update($id);
                $message = 'Produk berhasil diperbarui.';
            }
        } elseif ($action === 'delete') {
            if ($product->delete($id)) {
                $message = 'Produk berhasil dihapus.';
            } else {
                $message = 'Produk tidak ditemukan.';
            }
        }
    }

    if (isset($_GET['edit'])) {
        $editing = $product->findById((int) $_GET['edit']);

        if ($editing === null) {
            $error = 'Produk tidak ditemukan.';
        }
    }

    $products = $product->findAll();

} catch (Throwable $e) {
    $error = $e instanceof PDOException
        ? 'Database gagal diakses: ' . $e->getMessage()
        : $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 35px auto;
            padding: 20px;
            background: #f4f6f9;
        }

        h1, h2 {
            color: #244b78;
        }

        form, .daftar {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        input {
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
        }

        button, .btn {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            background: #285ea8;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .hapus {
            background: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #e8eef7;
        }

        .pesan {
            color: green;
        }

        .error {
            color: red;
            overflow-wrap: anywhere;
        }
    </style>
</head>

<body>

    <h1>Sistem Manajemen Produk</h1>

    <?php if ($message): ?>
        <p class="pesan"><?= e($message) ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <h2><?= $editing ? 'Ubah Produk' : 'Tambah Produk' ?></h2>

        <input
            type="hidden"
            name="action"
            value="<?= $editing ? 'update' : 'save' ?>"
        >

        <?php if ($editing): ?>
            <input
                type="hidden"
                name="id"
                value="<?= e($editing['id']) ?>"
            >
        <?php endif; ?>

        <label>Nama Produk</label>
        <input
            type="text"
            name="nama"
            required
            value="<?= e($editing['nama'] ?? '') ?>"
        >

        <label>Harga Produk (Rp)</label>
        <input
            type="number"
            name="harga"
            min="0"
            step="0.01"
            required
            value="<?= e($editing['harga'] ?? '') ?>"
        >

        <button type="submit">
            <?= $editing ? 'Simpan Perubahan' : 'Tambah Produk' ?>
        </button>

        <?php if ($editing): ?>
            <a href="index.php">Batal</a>
        <?php endif; ?>
    </form>

    <div class="daftar">
        <h2>Daftar Produk</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="4">Belum ada data produk.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $item): ?>
                        <tr>
                            <td><?= e($item['id']) ?></td>
                            <td><?= e($item['nama']) ?></td>
                            <td>
                                Rp <?= number_format(
                                    (float) $item['harga'],
                                    0,
                                    ',',
                                    '.'
                                ) ?>
                            </td>
                            <td>
                                <a
                                    class="btn"
                                    href="?edit=<?= e($item['id']) ?>"
                                >Ubah</a>

                                <form
                                    method="post"
                                    style="display:inline; padding:0; margin:0;"
                                    onsubmit="return confirm('Hapus produk ini?')"
                                >
                                    <input
                                        type="hidden"
                                        name="action"
                                        value="delete"
                                    >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= e($item['id']) ?>"
                                    >

                                    <button class="hapus" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>