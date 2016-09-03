<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\Exception;

/**
 * Exception throwing by parser.
 * This type of exception must be thrown when parsing data is incorrect.
 *
 * @package Yeda\Subtitling\Parser\Exception
 */
class ParserException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Exception in ' . __CLASS__ . ', line: ' . __LINE__);
    }
}
