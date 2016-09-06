<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\WebVtt;

use Yeda\Subtitling\Parser\Parser;
use Yeda\Subtitling\Parser\AbstractParserSubject;
use Yeda\Subtitling\Source\Input\InputSource;

class WebVttParser extends AbstractParserSubject implements Parser
{
    private $webVttState;
    
    public function __construct()
    {
        parent::__construct();
        $this->initParser();
    }
    
    public function parse(InputSource $source)
    {
        $this->webVttState->parseSignature($source);
        // Uncomplete.
        
        $this->initParser();
    }
    
    private function initParser()
    {
        $this->webVttState = new StartEnd();
    }
}
