<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Cue\Storage;

use Yeda\Subtitling\Cue\CuePoint;

/**
 * This is the standard cue objects storage realization.
 *
 * @package Yeda\Subtitling\Cue\Storage
 */
class StandardCueStorage implements CueStorage
{
    /** @var array Storage data structure. */
    private $cueCollection = [];
    
    public function add(CuePoint $cue)
    {
        $index = $cue->getIndex();
        
        if (isset($this->cueCollection[$index])) {
            throw new \LogicException();
        }
        
        $this->cueCollection[$index] = $cue;
    }
    
    public function replace(CuePoint $cue, $index)
    {
        if (!is_int($index)) {
            throw new \InvalidArgumentException();
        }
        
        $this->cueCollection[$index] = $cue;
    }
    
    public function get($index)
    {
        return
            $this->cueCollection[$index] instanceof CuePoint ?
            $this->cueCollection[$index] :
            null;
    }
    
    /**
     * Count all cue objects into the storage.
     *
     * @return int Cue objects count.
     */
    public function count()
    {
        return count($this->cueCollection);
    }
    
    /**
     * Get storage iterator.
     *
     * @return \Iterator Storage iterator.
     */
    public function getIterator()
    {
        return new StandardCueStorageIterator($this->cueCollection);
    }
}
