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
use Yeda\Subtitling\Parser\Exception\ParserException;

/**
 * SRT parser subtitle duration state.
 * When SRT parser swithces to this state, the duration string of current subtitle
 * was already parsed. This state knows how to parse subtitle text block.
 *
 * @link https://sourcemaking.com/design_patterns/state
 * @package Yeda\Subtitling\Parser\Srt
 */
class TimeDuration extends AbstractSrtParserState
{
    /** Time delimiter regular expression pattern in duration line. */
    const REG_EXP_DELIMITER = '/\s-->\s/';
    /** Duration line regular expression pattern. */
    const REG_EXP_DURATION =
        '/
            ^                                            # Start anchor.
            [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2},[0-9]{1,3}  # Time start pattern.
            \s-->\s                                      # Duration delimiter mark.
            [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2},[0-9]{1,3}  # Time end pattern.
            $                                            # End anchor.
        /xu'
    ;
    
    /**
     * Parsing subtitle text block from input source.
     * If parsing was failed the ParserException will be thrown.
     *
     * @param InputSource $source
     * @throws ParserException Thrown when parsing was failed.
     * @return void
     */
    public function parseText(InputSource $source)
    {
        $lines = [];
        
        while ($source->hasNextLine()) {
            $lineKey = $source->getLineKey();
            $source->setLineKey($lineKey + 1);
            
            $line = $source->readLine();
            
            if ($line === BlankLine::EMPTY_MARKER) {
                $source->setLineKey($lineKey);
                self::$parsedStateValue = $lines;
                
                return new Text();
            }
            
            $lines[] = $line;
        }
        
        throw new ParserException();
    }
}
