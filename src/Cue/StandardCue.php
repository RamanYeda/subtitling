<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Cue;

/**
 * Standard subtitle data object realization.
 *
 * @package Yeda\Subtitling\Cue
 */
class StandardCue implements CuePoint
{
    /** @var int Index. */
    private $index;
    
    /** @var int Start time. */
    private $startTime;
    
    /** @var int End time. */
    private $endTime;
    
    /** @var array Text block. */
    private $textLines;
    
    /**
     * @param int $index Index.
     * @param int $start Start time.
     * @param int $end End time.
     * @param array $text Text block.
     */
    public function __construct($index, $start, $end, array $text)
    {
        $this->index = $index;
        $this->startTime = $start;
        $this->endTime = $end;
        $this->textLines = $text;
    }
    
    public function getIndex()
    {
        return $this->index;
    }
    
    public function getStartTime()
    {
        return $this->startTime;
    }
    
    public function getEndTime()
    {
        return $this->endTime;
    }
    
    public function getTextLines()
    {
        return $this->textLines;
    }
}
