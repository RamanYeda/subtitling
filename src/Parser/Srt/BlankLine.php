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
 * SRT parser subtitle delimiter state.
 * When SRT parser swithces to this state, subtitle delimiter was already parsed.
 * This state knows how to parse next subtitle index.
 *
 * @link https://sourcemaking.com/design_patterns/state
 * @package Yeda\Subtitling\Parser\Srt
 */
class BlankLine extends AbstractSrtParserState
{
    /** This marker equited to SRT subtitles delimiter. */
    const EMPTY_MARKER = '';
    
    /**
     * Parsing subtitle index from input source.
     * If parsing was failed the ParserException will be thrown.
     *
     * @param InputSource $source
     * @throws ParserException Thrown when parsing was failed.
     * @return void
     */
    public function parseSequenceNumber(InputSource $source)
    {
        if ($source->hasNextLine()) {
            $line = $source->readNextLine();
            
            if (is_numeric($line)) {
                self::$parsedStateValue = $line;
                
                return new SequenceNumber();
            }
        }
        
        throw new ParserException();
    }
}
