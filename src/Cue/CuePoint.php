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
 * Common interface for subtitle information.
 *
 * @package Yeda\Subtitling\Cue
 */
interface CuePoint
{
    /**
     * Returns subtitle index number.
     *
     * @return int Index.
     */
    public function getIndex();

    /**
     * Returns subtitle start time.
     *
     * @return int Start time.
     */
    public function getStartTime();
    
    /**
     * Returns subtitle end time.
     *
     * @return int End time.
     */
    public function getEndTime();
    
    /**
     * Returns subtitle text block.
     *
     * @return array Text block.
     */
    public function getTextLines();
}
