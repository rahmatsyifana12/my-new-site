<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomFormatter extends LineFormatter
{
    public function __construct()
    {
        // Define the format, including a timestamp
        $format = "%datetime% %level_name% %message% %context% %extra%\n";
        $dateFormat = "Y-m-d H:i:s";

        parent::__construct($format, $dateFormat);
    }
}
