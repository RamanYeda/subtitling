<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Source\Input;

/**
 * Concrete input source realization.
 * This realization represents file input and works with files in the filesystem
 * through \SplFileObject.
 *
 * @package Yeda\Subtitling\Source\Input
 */
class InputFileSource implements InputSource
{
    /** @var \SplFileObject Input file object. */
    private $file;
    
    /**
     * @param string $filename Path to subtitles file.
     */
    public function __construct($filename)
    {
        $this->file = new \SplFileObject($filename);
    }

    public function readLine()
    {
        return $this->file->current();
    }
    
    public function readNextLine()
    {
        return $this->file->fgets();
    }
    
    public function hasNextLine()
    {
        return !$this->file->eof();
    }
    
    public function getLineKey()
    {
        return $this->file->key();
    }
    
    public function setLineKey($lineKey)
    {
        if (!is_int($lineKey) || $lineKey < 0) {
            throw new \LogicException();
        }
        
        $this->file->seek($lineKey);
    }
}
