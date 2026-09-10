<?php
class PersegiPanjang{
    public $panjang;
    public $lebar;

    public function Luas() {
        return $this->panjang * $this->lebar;
    }
}

$kotak = new PersegiPanjang();
$kotak->panjang = 35;
$kotak->lebar = 15;

echo $kotak->Luas(); //525

?>