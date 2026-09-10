<?php

class Mobil
{
    private $merek;
    private $warna;
    private $kecepatan;

    public function __construct($merek, $warna, $kecepatan)
    {
        $this->merek = $merek;
        $this->setWarna($warna);
        $this->setKecepatan($kecepatan);
    }

    public function getMerek()
    {
        return $this->merek;
    }

    public function getWarna()
    {
        return $this->warna;
    }

    public function getKecepatan()
    {
        return $this->kecepatan;
    }

    public function setKecepatan($kecepatan)
    {
        if ($kecepatan < 0) {
            echo "Kecepatan tidak boleh negatif";
        } elseif ($kecepatan > 200) {
            echo "Kecepatan maksimal 200 km/jam";
        } else {
            $this->kecepatan = $kecepatan;
        }
    }

    public function setWarna($warna)
    {
        if (empty(trim($warna))) {
            echo "Warna tidak boleh kosong";
        } elseif (strlen($warna) < 3) {
            echo "Warna minimal 3 karakter";
        } else {
            $this->warna = $warna;
        }
    }

    public function getInfo()
    {
        return "Mobil " . $this->getMerek() .
               " berwarna " . $this->getWarna() .
               " dengan kecepatan " . $this->getKecepatan() . " km/jam";
    }

    public function jalankan()
    {
        return "Mobil berjalan...";
    }

    public function berhenti()
    {
        return "Mobil berhenti";
    }
}


$mobil1 = new Mobil("Porsche", "Merah", 100);
$mobil2 = new Mobil("Ferrari", "Hitam", 120);
$mobil3 = new Mobil("BMW", "Putih", 150);


echo $mobil1->getInfo();
echo "<br>";
echo $mobil1->jalankan();
echo "<br>";
echo $mobil1->berhenti();

echo "<br><br>";

echo $mobil2->getInfo();
echo "<br>";
echo $mobil2->jalankan();
echo "<br>";
echo $mobil2->berhenti();

echo "<br><br>";


echo $mobil3->getInfo();
echo "<br>";
echo $mobil3->jalankan();
echo "<br>";
echo $mobil3->berhenti();

echo "<br><br>";


echo "Pengujian validasi:<br>";

$mobil1->setKecepatan(250);
echo "<br>";

$mobil1->setWarna("");
echo "<br>";

$mobil1->setWarna("AB");
echo "<br>";

?>