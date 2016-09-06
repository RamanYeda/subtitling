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

interface WebVttParserState
{
    public function parseSignature(InputSource $source);
    
    public function parseLineTerminator(InputSource $source);
    
    public function parseRegion(InputSource $source);
    
    public function parseStyle(InputSource $source);
    
    public function parseNote(InputSource $source);
    
    public function parseCue(InputSource $source);
}
