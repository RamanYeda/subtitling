<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source;

use Yeda\Subtitling\Source\Input\InputSource;
use Yeda\Subtitling\Source\Output\OutputSource;

/**
 * Common interface for representing the subtitles source factory.
 * This interface allows it's client code to get sources for reading and writing
 * data. Commonly, there are tools working with files behind this interface.
 *
 * @link https://sourcemaking.com/design_patterns/abstract_factory
 * @package Yeda\Subtitling\Source
 */
interface Source
{
    /**
     * Returns subtitles input source representor.
     * Return object must be used for any reading operations.
     *
     * @param string $name Source name (commonly, subtitles input filename).
     * @return InputSource Input data representor.
     */
    public function createInputSource($name);
    
    /**
     * Returns subtitles output source representor.
     * Return object must be used for any writing operations.
     *
     * @param string $name Source name (commonly, subtitles output filename).
     * @return OutputSource Output data representor.
     */
    public function createOutputSource($name);
}
