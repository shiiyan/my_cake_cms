<?php
declare(strict_types=1);

namespace App\Error\CustomException;

use Cake\Core\Exception\CakeException;

class UnprocessableEntityException extends CakeException
{
    // Context data is interpolated into this format string.
    protected $_messageTemplate = 'Unprocessable Entity of %s.';

    // You can set a default exception code as well.
    protected $_defaultCode = 424;
}
