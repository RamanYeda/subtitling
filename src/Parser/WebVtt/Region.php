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

class Region extends AbstractWebVttParserState
{
    use StateTrait\Region;
    use StateTrait\BlankLine { 
        StateTrait\BlankLine::parseLineTerminator as parseLineTerminatorStandard; 
    }
    
    const REGION_LABEL = 'REGION';
    const REGION_LABEL_LENGTH = 6;
    
    const REGION_KEY_ID = 'id';
    const REGION_KEY_WIDTH = 'width';
    const REGION_KEY_LINES = 'lines';
    const REGION_KEY_ANCHOR_POINT = 'regionanchor';
    const REGION_KEY_VIEWPORT_ANCOR_POINT = 'viewportanchor';
    const REGION_KEY_SCROLL_VALUE = 'scroll';
    
    const REGION_KEYS = [
        self::REGION_KEY_ID,
        self::REGION_KEY_WIDTH,
        self::REGION_KEY_LINES,
        self::REGION_KEY_ANCHOR_POINT,
        self::REGION_KEY_VIEWPORT_ANCOR_POINT,
        self::REGION_KEY_SCROLL_VALUE,
    ];
    
    
    public function parseLineTerminator(InputSource $source)
    {
        if($source->hasNextLine()) {
            $lineKey = $source->getLineKey();
            $source->setLineKey($lineKey + 1);
            
            $line = $source->readLine();
            $source->setLineKey($lineKey);
            
            $stringRegionLabel = self::REGION_LABEL . ':';
            $stringRegionLabelLength = self::REGION_LABEL_LENGTH + 1;
            $isStringForm = 
                strlen($line) > $stringRegionLabelLength &&
                strncmp($line, $stringRegionLabel, $stringRegionLabelLength) === 0;
            
            return $isStringForm ? 
                new namespace\BlankLine() :
                $this->parseLineTerminatorStandard($source);
        }
        
        throw new ParserException();
    }
}
