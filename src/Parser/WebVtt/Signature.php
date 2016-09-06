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
use PDepend\Source\Parser\ParserException;

class Signature extends AbstractWebVttParserState
{
    const SIGNATURE_LABEL = 'WEBVTT';
    
    public function parseLineTerminator(InputSource $source)
    {
        // To be implemented.
        
        throw new ParserException();
    }
}
