<?php

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    protected $message = 'Stok menu tidak mencukupi untuk dipesan.';
}
