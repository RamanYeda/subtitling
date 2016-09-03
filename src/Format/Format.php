<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Format;

use Yeda\Subtitling\Source\Source;
use Yeda\Subtitling\Parser\Parser;
use Yeda\Subtitling\Cue\Validator\CueValidator;
use Yeda\Subtitling\Cue\Storage\CueStorage;
use Yeda\Subtitling\Cue\Manager\CueManager;

/**
 * Common interface declaring methods for creating concrete subtitle format
 * specific components.
 *
 * @link https://sourcemaking.com/design_patterns/abstract_factory
 * @package Yeda\Subtitling\Format
 */
interface Format
{
    /** SRT subtitles format name. */
    const NAME_SRT = 'SRT';
    
    /**
     * Create format specific source.
     *
     * @return Source
     */
    public function createSource();
    
    /**
     * Create format specific parser.
     *
     * @return Parser
     */
    public function createParser();
    
    /**
     * Create format specific validator.
     *
     * @return CueValidator
     */
    public function createValidator();
    
    /**
     * Create format specific cue storage.
     *
     * @return CueStorage
     */
    public function createStorage();
    
    /**
     * Create format specific cue manager.
     *
     * @return CueManager
     */
    public function createCueManager();
    
    /**
     * Get current subtitles format name.
     *
     * @return string Format name.
     */
    public function getFormatName();
}
