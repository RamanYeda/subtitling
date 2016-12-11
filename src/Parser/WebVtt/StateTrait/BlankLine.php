<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\WebVtt\StateTrait;

use Yeda\Subtitling\Parser\WebVtt\BlankLine as BlankLineState;
use Yeda\Subtitling\Source\Input\InputSource;
use Yeda\Subtitling\Parser\Exception\ParserException;

trait BlankLine
{
    public function parseLineTerminator(InputSource $source)
    {
        $line = $source->readNextLine();

        if ($line === BlankLineState::EMPTY_MARKER) {
            self::$parsedStateValue = BlankLineState::EMPTY_MARKER;

            while ($source->hasNextLine()) {
                $lineKey = $source->getLineKey();
                $source->setLineKey($lineKey + 1);

                $line = $source->readLine();

                if ($line !== BlankLineState::EMPTY_MARKER) {
                    $source->setLineKey($lineKey);
                    break;
                }
            }

            return new BlankLineState();
        }
        
        throw new ParserException();
    }
}
