<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source\Output;

/**
 * Defines a set of methods for writing data to the specific ouput.
 *
 * @package Yeda\Subtitling\Source\Output
 */
interface OutputSource
{
    /**
     * Write string line to the output.
     *
     * @param string $line
     * @return void
     */
    public function writeLine($line);
    
    /**
     * Write array of lines to the output.
     *
     * @param array $lines
     * @return void
     */
    public function writeLines(array $lines);
}
