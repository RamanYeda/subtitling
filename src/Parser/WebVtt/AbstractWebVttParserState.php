<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\WebVtt;

use Yeda\Subtitling\Source\Input\InputSource;
use Yeda\Subtitling\Parser\Exception\IllegalParserStateTransitionException;

abstract class AbstractWebVttParserState implements WebVttParserState
{
    protected static $parsedStateValue;
    
    public function parseSignature(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function parseLineTerminator(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function parseRegion(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function parseStyle(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function parseNote(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function parseCue(InputSource $source)
    {
        throw new IllegalParserStateTransitionException();
    }
    
    public function getCurrentParsedStateValue()
    {
        return self::$parsedStateValue;
    }
}
