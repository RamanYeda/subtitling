<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source\Output;

use Hoa\Ustring\Ustring;

/**
 * Output source with normalized data.
 * Uses Ustring to normalize raw data and writes it to output source.
 *
 * @link https://sourcemaking.com/design_patterns/decorator
 * @package Yeda\Subtitling\Source\Output
 */
class OutputNormalizedSource implements OutputSource
{
    /** @var OutputSource Standard output source. */
    private $rawSource;
    
    /**
     * @param OutputSource $rawSource Output source using to write normalized data.
     */
    public function __construct(OutputSource $rawSource)
    {
        $this->rawSource = $rawSource;
    }
    
    public function writeLine($rawLine)
    {
        $treatedLine = new Ustring($rawLine);
        
        $this->rawSource->writeLine((string) $treatedLine);
    }
    
    public function writeLines(array $lines)
    {
        $rawBlockLine = '';
        
        foreach ($lines as $line) {
            $rawBlockLine .= $line . PHP_EOL;
        }
        
        $this->writeLine($rawBlockLine . PHP_EOL);
    }
}
