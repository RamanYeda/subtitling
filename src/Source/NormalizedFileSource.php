<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */


namespace Yeda\Subtitling\Source;

use Yeda\Subtitling\Source\Input\InputFileSource;
use Yeda\Subtitling\Source\Input\InputNormalizedSource;
use Yeda\Subtitling\Source\Output\OutputFileSource;
use Yeda\Subtitling\Source\Output\OutputNormalizedSource;

/**
 * Creates normalized file sources.
 * This concrete factory creates input and output source representors that
 * works with files. Any reading data from input will be normalized.
 *
 * @link https://sourcemaking.com/design_patterns/abstract_factory
 * @package Yeda\Subtitling\Source
 */
class NormalizedFileSource implements Source
{
    /**
     * Returns subtitles input file source representor.
     * {@inheritdoc}
     *
     * @param string $filename Input filename.
     * @return InputSource Input file data representor.
     */
    public function createInputSource($filename)
    {
        return new InputNormalizedSource(new InputFileSource($filename));
    }
    
    /**
     * Returns subtitles output file source representor.
     * {@inheritdoc}
     *
     * @param string $filename Output filename.
     * @return OutputSource Output file data representor.
     */
    public function createOutputSource($filename)
    {
        return new OutputNormalizedSource(new OutputFileSource($filename));
    }
}
