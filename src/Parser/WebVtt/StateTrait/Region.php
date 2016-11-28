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
            var_dump($line);
            $region = $this->parseRegionBlock($source);
            
        } else if ($isStringForm) {
            var_dump($line);
            $region = $this->parseRegionString($line);
        }
        
        if (empty(array_diff(RegionState::REGION_KEYS, array_keys($region)))) {
            return new RegionState();
        }
        
        throw new ParserException();
    }
    
    private function parseRegionBlock(InputSource $source)
    {
        $region = [];
        for ($i = 0; $i < count(RegionState::REGION_KEYS); $i++) {
            $regionToken = $source->readNextLine();
            var_dump($regionToken);
            list($key, $value) = explode(':', $regionToken, 2);
            $region[$key] = trim($value);
        }
        
        return $region;            
    }
    
    private function parseRegionString($regionString)
    {
        $line = trim(substr($regionString, RegionState::REGION_LABEL_LENGTH + 1));
        $region = [];

        $regionToken = strtok($line, ' ');
        
        while ($regionToken) {
            list($key, $value) = explode('=', $regionToken, 2);
            $region[$key] = $value;
            $regionToken = strtok(' ');
        }
        
        return $region;
    }
}
