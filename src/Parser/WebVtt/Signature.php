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
use Yeda\Subtitling\Parser\Exception\ParserException;

class Signature extends AbstractWebVttParserState
{
    const SIGNATURE_LABEL = 'WEBVTT';
    
    public function parseLineTerminator(InputSource $source)
    {
        if ($source->hasNextLine()) {
            $line = $source->readNextLine();
//            var_dump($line);
            
            if ($line === namespace\BlankLine::EMPTY_MARKER) {
                self::$parsedStateValue = namespace\BlankLine::EMPTY_MARKER;
                
                while ($source->hasNextLine()) {
                    $lineKey = $source->getLineKey();
                    $source->setLineKey($lineKey + 1);
                    
                    $line = $source->readLine();
//                    var_dump($line);
                    
                    if ($line !== namespace\BlankLine::EMPTY_MARKER) {
                        $source->setLineKey($lineKey);
                        break;
                    }
                }
                
                return new namespace\BlankLine();
            }
        }
        
        throw new ParserException();
    }
}
