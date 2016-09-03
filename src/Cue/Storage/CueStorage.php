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
 * Interface defines methods for managing cues and represents a storage itself.
 * It extends some standard PHP interfaces for working with collections.
 *
 * @package Yeda\Subtitling\Cue\Storage
 */
interface CueStorage extends \Countable, \IteratorAggregate
{
    /**
     * Add the specified cue object to the storage.
     *
     * @param CuePoint $cue Input cue object that need to be stored.
     * @return void
     */
    public function add(CuePoint $cue);
    
    /**
     * Replace existing cue object in storage by new specified cue object.
     *
     * @param CuePoint $cue New cue object that need to ovirride the exists cue.
     * @param int $index Index of existing cue object in storage.
     * @return void
     */
    public function replace(CuePoint $cue, $index);
    
    /**
     * Get cue object by it's index into the storage.
     *
     * @param int $index Cue index in storage.
     * @return CuePoint|null Requested cue object or null if it not exists.
     */
    public function get($index);
}
