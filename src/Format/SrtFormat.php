<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Format;

use Yeda\Subtitling\Parser\Srt\SrtParser;
use Yeda\Subtitling\Cue\Manager\SrtCueManager;
use Yeda\Subtitling\Cue\Validator\SrtCueValidator;
use Yeda\Subtitling\Cue\Storage\StandardCueStorage;

/**
 * Create components that workd with SRT subtitles format.
 *
 * @package Yeda\Subtitling\Format
 */
class SrtFormat extends AbstractSourcedFormat
{
    /**
     * Create SRT format parser.
     *
     * @return SrtParser
     */
    public function createParser()
    {
        return new SrtParser();
    }
    
    /**
     * Create SRT format validator.
     *
     * @return SrtCueValidator
     */
    public function createValidator()
    {
        return new SrtCueValidator();
    }
    
    /**
     * Create cue storage supports SRT format.
     *
     * @return StandardCueStorage
     */
    public function createStorage()
    {
        return new StandardCueStorage();
    }
    
    /**
     * Create SRT format cue manager.
     *
     * @return SrtCueManager
     */
    public function createCueManager()
    {
        return new SrtCueManager();
    }
    
    /**
     * Get current subtitles format name.
     *
     * @return string Format name.
     */
    public function getFormatName()
    {
        return self::NAME_SRT;
    }
}
