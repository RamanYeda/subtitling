<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source\Input;

/**
 * Defines a set of methods for reading data from specific input.
 * This interface operates line pointer term. The line pointer is a string
 * position in current input source.
 *
 * @package Yeda\Subtitling\Source\Input
 */
interface InputSource
{
    /**
     * Read string line from current pointer position.
     *
     * @return string
     */
    public function readLine();
    
    /**
     * Read the next string line in relation to current pointer position.
     *
     * @return string
     */
    public function readNextLine();

    /**
     * Check if source at it's end.
     *
     * @return bool
     */
    public function hasNextLine();
    
    /**
     * Return current source pointer position.
     *
     * @return int
     */
    public function getLineKey();
    
    /**
     * Set source pointer on specified position.
     *
     * @param int $lineKey New pointer position.
     * @return void
     */
    public function setLineKey($lineKey);
}
