<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Cue\Validator;

use Yeda\Subtitling\Cue\CuePoint;
use Yeda\Subtitling\Cue\Exception\ValidatorException;

/**
 * Common subtitle validator interface.
 * All format specific validators should implement this interface.
 *
 * @package Yeda\Subtitling\Cue\Validator
 */
interface CueValidator
{
    /**
     * Validate the current subtitle data object.
     * This validation checks the input subtitle data object in the flow context.
     * That means that information about previous validated subtitles (like index,
     * or time) will be considered.
     *
     * @param CuePoint $cue Subtitle data object.
     * @throws ValidatorException Thrown if validation doesn't pass.
     */
    public function validate(CuePoint $cue);
}
