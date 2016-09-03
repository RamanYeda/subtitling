<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Cue\Manager;

use Yeda\Subtitling\Cue\CuePoint;
use Yeda\Subtitling\Source\Output\OutputSource;

/**
 * Interface for managing cue objects.
 * All it's realization incapsulates operations with cues like creation or
 * writing to output.
 *
 * @package Yeda\Subtitling\Cue\Manager
 */
interface CueManager
{
    /**
     * Create cue subtitle object from array of parsed subtitle data.
     *
     * @param array $parsedCue Parsed subtitle data for cue creation.
     * @return CuePoint Cue object contains concrete subtitle data.
     */
    public function createFromParsed(array $parsedCue);
    
    /**
     * Write cue to the specified output.
     *
     * @param CuePoint $cue Cue object contains concrete subtitle data.
     * @param OutputSource $output Output source supports writing operations.
     */
    public function writeToOutput(CuePoint $cue, OutputSource $output);
}
