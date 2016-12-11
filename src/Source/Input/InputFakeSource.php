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
 * For testing needs only.
 */
abstract class InputFakeSource implements InputSource
{
    private $lineKey = 0;
    
    abstract public function readLine();

    abstract public function readNextLine();

    public function hasNextLine()
    {
        return true;
    }
    
    public function getLineKey()
    {
        return $this->lineKey;
    }
    
    public function setLineKey($lineKey)
    {
        if (!is_int($lineKey) || $lineKey < 0) {
            throw new \LogicException();
        }
        
        $this->lineKey = $lineKey;
    }
}
