<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\Srt;

use Yeda\Subtitling\Parser\Exception\ParserException;
use Yeda\Subtitling\Source\Input\InputSource;

/**
 * SRT parser subtitle index state.
 * When SRT parser swithces to this state, subtitle index was already parsed.
 * This state knows how to parse subtitle duration.
 *
 * @link https://sourcemaking.com/design_patterns/state
 * @package Yeda\Subtitling\Parser\Srt
 */
class SequenceNumber extends AbstractSrtParserState
{
    /**
     * Parsing subtitle duration from input source.
     * If parsing was failed the ParserException will be thrown.
     *
     * @param InputSource $source
     * @throws ParserException Thrown when parsing was failed.
     * @return void
     */
    public function parseTimeDuration(InputSource $source)
    {
        if ($source->hasNextLine()) {
            $line = $source->readNextLine();
            
            if (preg_match(TimeDuration::REG_EXP_DURATION, $line)) {
                self::$parsedStateValue = $line;
                return new TimeDuration();
            }
        }
        
        throw new ParserException();
    }
}
