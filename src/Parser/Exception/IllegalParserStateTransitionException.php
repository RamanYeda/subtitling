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
 * This type of exception must be thrown when parser goes to incorrect state.
 *
 * @package Yeda\Subtitling\Parser\Exception
 */
class IllegalParserStateTransitionException extends \Exception
{
    
}
