<?php

class Product
{
    public $nama;
    public $harga;
    public $kategori;

    public function __construct($nama, $harga, $kategori)
    {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
    }

    public function getInfo()
    {
        return "Produk $this->nama dengan harga $this->harga dan kategori $this->kategori";
    }

    public function applyDiskon($persen)
    {
        $this->harga = $this->harga - ($this->harga * $persen / 100);
    }
}

$product1 = new Product("Laptop", 8000000, "Elektronik");
$product2 = new Product("Mouse", 300000, "Aksesoris");

echo $product1->getInfo();
echo "<br>";

$product1->applyDiskon(10);

echo "Setelah diskon: ";
echo $product1->getInfo();

echo "<br><br>";

echo $product2->getInfo();
echo "<br>";

$product2->applyDiskon(20);

echo "Setelah diskon: ";
echo $product2->getInfo();

?>