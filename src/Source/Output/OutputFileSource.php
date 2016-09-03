<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source\Output;

/**
 * Concrete output source realization.
 * This realization represents file output and works with files in the filesystem
 * through \SplFileObject.
 *
 * @package Yeda\Subtitling\Source\Output
 */
class OutputFileSource implements OutputSource
{
    /** @var \SplFileObject Output file object. */
    private $file;
    
    /**
     * Constructor.
     *
     * @param string $filename Path to output file.
     */
    public function __construct($filename)
    {
        $this->file = new \SplFileObject($filename, 'w');
    }
    
    
    public function writeLine($line)
    {
        $this->file->fwrite($line);
    }
    
    public function writeLines(array $lines)
    {
        $blockLine = '';
        
        foreach ($lines as $line) {
            $blockLine .= $line . PHP_EOL;
        }
        
        $this->writeLine($blockLine . PHP_EOL);
    }
}
