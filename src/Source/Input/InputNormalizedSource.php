<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source\Input;

use Hoa\Ustring\Ustring;

/**
 * Input source with normalized data.
 * Uses Ustring to normalize raw data retrieveng from input source.
 *
 * @link https://sourcemaking.com/design_patterns/decorator
 * @package Yeda\Subtitling\Source\Input
 */
class InputNormalizedSource implements InputSource
{
    /** @var InputSource Input source with raw data. */
    private $rawSource;
    
    /**
     * @param InputSource $rawSource Input source using to retrieve raw data.
     */
    public function __construct(InputSource $rawSource)
    {
        $this->rawSource = $rawSource;
    }
    
    public function readLine()
    {
        return $this->treateRawLine($this->rawSource->readLine());
    }
    
    public function readNextLine()
    {
        return $this->treateRawLine($this->rawSource->readNextLine());
    }
    
    public function hasNextLine()
    {
        return $this->rawSource->hasNextLine();
    }
    
    public function getLineKey()
    {
        return $this->rawSource->getLineKey();
    }
    
    public function setLineKey($lineKey)
    {
        return $this->rawSource->setLineKey($lineKey);
    }
    
    /**
     * Addition raw data handling.
     * This method actually normalizes the input raw string to UTF-8 and makes
     * trimming.
     *
     * @param string $rawLine Raw string that have been readed from input.
     * @return string Normalized string.
     */
    private function treateRawLine($rawLine)
    {
        $treatedLine = new Ustring($rawLine);
        
        return (string) $treatedLine->trim();
    }
}
