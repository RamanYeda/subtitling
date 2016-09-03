<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling;

use Yeda\Subtitling\Format\Format;
use Yeda\Subtitling\Format\SrtFormat;

/**
 * The client touchpoint.
 * This class provides main application functionality to the client.
 *
 * @package Yeda\Subtitling
 */
class Subtitling
{
    /** @var CueStorage Cue objects storage. */
    private $storage;
    
    /** @var SubtitleManager Manager that incapsulates main components logic. */
    private $manager;
    
    /**
     * Constructor.
     *
     * @todo Implement other resources support.
     *
     * @param string $formatName Subtitles format.
     * @param string $filename Path to subtitles file.
     */
    public function __construct($formatName, $filename)
    {
        $format = self::createFormat($formatName);
        $this->storage = $format->createStorage();
        
        $this->manager = new SubtitleManager($format, $filename);
        $this->manager->load($this->storage);
    }
    
    /**
     * Save current subtitles to the file.
     *
     * @todo Implement other resources support.
     *
     * @param string $filename Full path to output file.
     */
    public function save($filename)
    {
        $this->manager->save($filename);
    }
    
    /**
     * Creates Format object depends on specified format name.
     *
     * @param string $formatName Specified format name.
     * @throws \InvalidArgumentException Thrown when format name is incorrect.
     * @return Format Format object.
     */
    private static function createFormat($formatName)
    {
        switch ($formatName) {
            case Format::NAME_SRT:
                return new SrtFormat();
            default:
                throw \InvalidArgumentException();
        }
    }
}
