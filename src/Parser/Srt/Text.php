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
 * SRT parser text state.
 * When SRT parser swithces to this state, text block of current subtitle
 * was already parsed. This state knows how to parse subtitle delimiter.
 *
 * @link https://sourcemaking.com/design_patterns/state
 * @package Yeda\Subtitling\Parser\Srt
 */
class Text extends AbstractSrtParserState
{
    /**
     * Parsing subtitle delimiter from input source.
     * If parsing was failed the ParserException will be thrown.
     *
     * @param InputSource $source
     * @throws ParserException Thrown when parsing was failed.
     * @return void
     */
    public function parseBlankLine(InputSource $source)
    {
        if ($source->hasNextLine()) {
            $line = $source->readNextLine();
            
            if ($line === BlankLine::EMPTY_MARKER) {
                self::$parsedStateValue = $line;
                
                while ($source->hasNextLine()) {
                    $lineKey = $source->getLineKey();
                    $source->setLineKey($lineKey + 1);
                    
                    $line = $source->readLine();
                    
                    if ($line !== BlankLine::EMPTY_MARKER) {
                        $source->setLineKey($lineKey);
                        break;
                    }
                }
                
                return new BlankLine();
            }
        }

        throw new ParserException();
    }
}
