<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Cue\Storage;

/**
 * Standard cue storage iterator.
 *
 * @link https://sourcemaking.com/design_patterns/iterator
 * @package Yeda\Subtitling\Cue\Storage
 */
class StandardCueStorageIterator implements \Iterator
{
    /** @var int Internal index. */
    private $index = 0;
    
    /** @var array Iterating data structure. */
    private $collection;
    
    /**
     * @param array $collection Reference to iterating data structure.
     */
    public function __construct(array &$collection)
    {
        $this->collection = array_values($collection);
    }
    
    /**
     * Return current cue element.
     *
     * @return CuePoint Cue object.
     */
    public function current()
    {
        return $this->collection[$this->index];
    }
    
    /**
     * Return iterator position.
     *
     * @return int Iterator position.
     */
    public function key()
    {
        return $this->index;
    }
    
    /**
     * Go to the next position (to the next cue in the storage).
     *
     * @return void
     */
    public function next()
    {
        ++$this->index;
    }
    
    /**
     * Reset the current iterator position (start from beginnig).
     *
     * @return void
     */
    public function rewind()
    {
        $this->index = 0;
    }
    
    /**
     * Check if there is an element in current iterator position.
     *
     * @return bool Element presence flag.
     */
    public function valid()
    {
        return isset($this->collection[$this->index]);
    }
}
