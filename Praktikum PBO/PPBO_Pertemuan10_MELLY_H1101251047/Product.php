<?php

require_once __DIR__ . '/DatabaseConnection.php';

class Product
{
    private string $nama;
    private float $harga;
    private PDO $db;

    public function __construct(
        string $nama = '',
        float $harga = 0
    ) {
        $this->nama = $nama;
        $this->harga = $harga;

        $this->db = DatabaseConnection::getInstance()
            ->getConnection();
    }

    // Menambahkan produk
    public function save(): bool
    {
        $sql = "INSERT INTO `manajemen produk` (nama, harga)
                VALUES (:nama, :harga)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nama' => $this->nama,
            ':harga' => $this->harga
        ]);
    }

    // Menampilkan semua produk
    public function findAll(): array
    {
        $sql = "SELECT * FROM `manajemen produk` ORDER BY id DESC";

        return $this->db->query($sql)->fetchAll();
    }

    // Mencari produk berdasarkan ID
    public function findById($id): ?array
    {
        $sql = "SELECT * FROM `manajemen produk` WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    // Mengubah produk berdasarkan ID
    public function update($id): bool
    {
        $sql = "UPDATE `manajemen produk`
                SET nama = :nama, harga = :harga
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nama' => $this->nama,
            ':harga' => $this->harga,
            ':id' => $id
        ]);
    }

    // Menghapus produk berdasarkan ID
    public function delete($id): bool
    {
        $sql = "DELETE FROM `manajemen produk` WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}