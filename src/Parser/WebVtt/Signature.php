<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\WebVtt;

class Signature extends AbstractWebVttParserState
{
    use StateTrait\BlankLine;
    
    const SIGNATURE_LABEL = 'WEBVTT';
}
