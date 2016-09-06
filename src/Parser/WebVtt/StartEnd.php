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

class StartEnd extends AbstractWebVttParserState
{
    public function parseSignature(InputSource $source)
    {
        $signature = $source->readNextLine();
        
        if (substr($signature, 0, 6) === Signature::SIGNATURE_LABEL) {
            self::$parsedStateValue = $signature;
            var_dump($signature);
            return new Signature();
        }
        
        throw new ParserException();
    }
}
