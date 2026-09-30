<?php

namespace App\Exceptions;

use Exception;

class TransaksiFailedException extends Exception
{
    protected $message = 'Proses transaksi gagal dijalankan.';
}
