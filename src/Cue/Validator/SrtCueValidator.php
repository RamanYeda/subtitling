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
 * Concrete validator realization for SRT subtitles.
 *
 * @package Yeda\Subtitling\Cue\Validator
 */
class SrtCueValidator implements CueValidator
{
    /** @var int Last validated subtitle index. */
    private $lastSrtIndex = 0;
    
    /** @var int Last validated subtitle time mark. */
    private $lastEndTime = 0;
    
    public function validate(CuePoint $cue)
    {
        $this->validateIndex($cue->getIndex());
        $this->validateTime($cue->getStartTime(), $cue->getEndTime());
        $this->validateText($cue->getTextLines());
    }
    
    /**
     * Validate current SRT subtitle index.
     * This validation considers previos validated index (subtitles flow).
     *
     * @param int $number Validating index.
     * @throws ValidatorException Thrown when validation failed.
     */
    private function validateIndex($number)
    {
        if (++$this->lastSrtIndex !== (int) $number) {
            throw new ValidatorException();
        }
    }
    
    /**
     * Validate current SRT subtitle start and end time.
     * This validation considers previos subtitle last time mark (subtitles flow).
     *
     * @param int $startTime Start subtitle time (milliseconds).
     * @param int $endTime End subtitle time (milliseconds).
     * @throws ValidatorException Thrown when validation failed.
     */
    private function validateTime($startTime, $endTime)
    {
        if ((int) $startTime < $this->lastEndTime || $startTime > (int) $endTime) {
            throw new ValidatorException();
        }

        $this->lastEndTime = $endTime;
    }
    
    /**
     * Validate current SRT subtitle text block.
     *
     * @param array $text Subtitle text lines block.
     * @throws ValidatorException Thrown when validation failed.
     */
    private function validateText(array $text)
    {
        foreach ($text as $line) {
            if (!is_string($line)) {
                throw new ValidatorException();
            }
        }
    }
}
