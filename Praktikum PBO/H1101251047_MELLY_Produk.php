<?php

class Sepatu
{
    private $nama;
    private $harga;
    private $stok;
    private $kategori;
    private $merek;
    private $warna;

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setHarga($harga)
    {
        if ($harga > 0) {
            $this->harga = $harga;
        } else {
            echo "Harga tidak boleh 0 atau negatif.<br>";
        }
    }

    public function getHarga()
    {
        return $this->harga;
    }

    public function setStok($stok)
    {
        if ($stok >= 0) {
            $this->stok = $stok;
        } else {
            echo "Stok tidak boleh negatif.<br>";
        }
    }

    public function getStok()
    {
        return $this->stok;
    }

    public function setKategori($kategori)
    {
        $this->kategori = $kategori;
    }

    public function getKategori()
    {
        return $this->kategori;
    }

    public function setMerek($merek)
    {
        $this->merek = $merek;
    }

    public function getMerek()
    {
        return $this->merek;
    }

    public function setWarna($warna)
    {
        $this->warna = $warna;
    }

    public function getWarna()
    {
        return $this->warna;
    }
}

$sepatu = new Sepatu();

$sepatu->setNama("Onitsuka Tiger Mexico 66");
$sepatu->setHarga(2300000);
$sepatu->setStok(14);
$sepatu->setKategori("Sepatu");
$sepatu->setMerek("Onitsuka Tiger");
$sepatu->setWarna("Kuning");

echo "Nama: " . $sepatu->getNama() . "<br>";
echo "Harga: Rp " . $sepatu->getHarga() . "<br>";
echo "Stok: " . $sepatu->getStok() . "<br>";
echo "Kategori: " . $sepatu->getKategori() . "<br>";
echo "Merek: " . $sepatu->getMerek() . "<br>";
echo "Warna: " . $sepatu->getWarna() . "<br>";