<?php

namespace App\Lake\Modules\Birds\Finder\Exceptions;

use Core\Modules\Generics\Collections\HasDataCollection;

class CountDucksDatabaseException extends \Exception
{
    use HasDataCollection;
    public function __construct(\Throwable $previous = null, string $message = '', int $code = 0)
    {
        parent::__construct($message, $code, $previous);
    }
}
