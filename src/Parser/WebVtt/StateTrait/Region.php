<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\WebVtt\StateTrait;

use Yeda\Subtitling\Parser\WebVtt\Region as RegionState;
use Yeda\Subtitling\Source\Input\InputSource;
use Yeda\Subtitling\Parser\Exception\ParserException;

trait Region
{
    public function parseRegion(InputSource $source)
    {
        $stringRegionLabel = RegionState::REGION_LABEL . ':';
        $stringRegionLabelLength = RegionState::REGION_LABEL_LENGTH + 1;
        
        $line = $source->readNextLine();
        $region = [];
        
        $isStringForm = 
            strlen($line) > $stringRegionLabelLength &&
            strncmp($line, $stringRegionLabel, $stringRegionLabelLength) === 0;
        
        if ($line === RegionState::REGION_LABEL) {
            
            // parse region in block form.
            
        } else if ($isStringForm) {
            $line = trim(substr($line, $stringRegionLabelLength));
            var_dump($line);
            
            $regionToken = strtok($line, ' ');
            
            while ($regionToken) {
                list($key, $value) = explode('=', $regionToken, 2);
                $region[$key] = $value;
                $regionToken = strtok(' ');
            }
        }
        
        if (empty(array_diff(RegionState::REGION_KEYS, array_keys($region)))) {
            return new RegionState();
        }
        
        throw new ParserException();
    }
}
