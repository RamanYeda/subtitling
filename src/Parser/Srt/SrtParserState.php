<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\Srt;

use Yeda\Subtitling\Source\Input\InputSource;

/**
 * SRT parser state machine interface.
 * Any SRT parser state should implement this interface. The methods corresponds
 * of parsing each SRT subtitle structure element depending on the concrete state
 * at that moment. Any methods of this interface should cause triggering a
 * transition to the next state.
 *
 * @link https://sourcemaking.com/design_patterns/state
 * @package Yeda\Subtitling\Parser\Srt
 */
interface SrtParserState
{
    /**
     * Parsing subtitle index from input source.
     *
     * @param InputSource $source
     * @return void
     */
    public function parseSequenceNumber(InputSource $source);

    /**
     * Parsing time interval from input source.
     *
     * @param InputSource $source
     * @return void
     */
    public function parseTimeDuration(InputSource $source);

    /**
     * Parsing subtitle text block from input source.
     *
     * @param InputSource $source
     * @return void
     */
    public function parseText(InputSource $source);

    /**
     * Parsing subtitle delimiter from input source.
     *
     * @param InputSource $source
     * @return void
     */
    public function parseBlankLine(InputSource $source);

    /**
     * Retrieve current parsed value.
     *
     * @return mixed
     */
    public function getCurrentParsedStateValue();
}
