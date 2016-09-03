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
use Yeda\Subtitling\Parser\Exception\IllegalParserStateTransitionException;

/**
 * Common SRT parser state realization.
 * Represents the structure sceleton for any SRT parser state concrete subclasses.
 * Any concrete state realization doesn't need to support all interface methods
 * because it usually has a limited number of transitions. In case when wrong
 * transition was called the exception will be thrown.
 *
 * @link https://sourcemaking.com/design_patterns/state
 * @package Yeda\Subtitling\Parser\Srt
 */
abstract class AbstractSrtParserState implements SrtParserState
{
    /** @var mixed Current parsed value should be placed here. */
    protected static $parsedStateValue;
        
    /**
     * Parsing subtitle index from input source.
     *
     * @param InputSource $source
     * @throws IllegalParserStateTransitionException Illegal state exception.
     * @return void
     */
    public function parseSequenceNumber(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }

    /**
     * Parsing time interval from input source.
     *
     * @param InputSource $source
     * @throws IllegalParserStateTransitionException Illegal state exception.
     * @return void
     */
    public function parseTimeDuration(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }

    /**
     * Parsing subtitle text block from input source.
     *
     * @param InputSource $source
     * @throws IllegalParserStateTransitionException Illegal state exception.
     * @return void
     */
    public function parseText(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }

    /**
     * Parsing subtitle delimiter from input source.
     *
     * @param InputSource $source
     * @throws IllegalParserStateTransitionException Illegal state exception.
     * @return void
     */
    public function parseBlankLine(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function getCurrentParsedStateValue()
    {
        return self::$parsedStateValue;
    }
}
