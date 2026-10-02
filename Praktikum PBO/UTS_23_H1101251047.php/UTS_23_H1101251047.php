<?php
// ABSTRACT CLASS
abstract class LayananGame
{
    protected $id;
    protected $nama;
    protected $hargaDasar;

    public function __construct($id, $nama, $hargaDasar)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getHargaDasar()
    {
        return $this->hargaDasar;
    }

    abstract public function hitungTotal();
    abstract public function getJenis();
}


// CHILD CLASS PS4
class PS4 extends LayananGame
{
    private $jam;

    public function __construct($id, $nama, $hargaDasar, $jam)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->jam = $jam;
    }

// OVERRIDE
    public function hitungTotal()
    {
        return $this->hargaDasar + (5000 * $this->jam);
    }

    public function getJenis()
    {
        return "PS4";
    }
}


// CHILD CLASS PC
class PC extends LayananGame
{
    private $jam;

    public function __construct($id, $nama, $hargaDasar, $jam)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->jam = $jam;
    }

// OVERRIDE
    public function hitungTotal()
    {
        $total = $this->hargaDasar + (8000 * $this->jam);

        if ($this->jam > 5)
        {
            $total = $total * 0.20;
        }

        return $total;
    }

    public function getJenis()
    {
        return "PC";
    }
}


// CHILD CLASS VR
class VR extends LayananGame
{
    private $jam;

    public function __construct($id, $nama, $hargaDasar, $jam)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->jam = $jam;
    }

// OVERRIDE
    public function hitungTotal()
    {
        return $this->hargaDasar + (15000 * $this->jam);
    }

    public function getJenis()
    {
        return "VR";
    }
}


// OBJECT
$data = [
    new PS4(1, "Melly", 10000, 3),
    new PC(2, "Listy", 15000, 6),
    new VR(3, "Cika", 20000, 2),
    new PS4(4, "Anisa", 12000, 4),
    new PC(5, "Zafier", 15000, 3)
];


$totalSemua = 0;

foreach ($data as $game)
{
    echo "ID : " . $game->getId() . "<br>";
    echo "Nama : " . $game->getNama() . "<br>";
    echo "Jenis : " . $game->getJenis() . "<br>";
    echo "Harga Dasar : " . $game->getHargaDasar() . "<br>";
    echo "Total : " . $game->hitungTotal() . "<br>";
    echo "__________________________<br>";

    $totalSemua = $totalSemua + $game->hitungTotal();
}


// Nomor 6 TOTAL KESELURUHAN
echo "Total Keseluruhan : " . $totalSemua;

?>