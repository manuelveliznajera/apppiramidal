<?php

namespace App\Traits;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Storage;

final class TicketRestaurante extends Fpdf
{

    private $altoCelda;
    private $incrementoCelda;

    function __construct($orientation, $unit, $size)
    {
        parent::__construct($orientation, $unit, $size);
    }

    public function setHeader()
    {
    }

    public function setAffiliated($customer)
    {

    }

    public function setBody($products)
    {

    }

    public function setTotal()
    {

    }

    public function setFooter()
    {

    }

    private function getHeightCell()
    {
        $this->altoCelda += $this->incrementoCelda;
        return $this->altoCelda;
    }

    private function getCenterPositionX()
    {
        return 35;
    }

    private function getInitialPositionX()
    {
        return 3;
    }
}
