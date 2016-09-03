<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling;

use Yeda\Subtitling\Parser\ParserObserver;
use Yeda\Subtitling\Format\Format;
use Yeda\Subtitling\Cue\Storage\CueStorage;

/**
 * Manager class that incapsulates all internal application component logic.
 * This class also implements parser observer functionality.
 *
 * @package Yeda\Subtitling
 */
class SubtitleManager implements ParserObserver
{
    /** @var string Input file. */
    private $inputFilename;
    
    /** @var Source Source factory. */
    private $source;
    
    /** @var Parser Subtitles parser. */
    private $parser;
    
    /** @var Validator Subtitles validator. */
    private $validator;
    
    /** @var CueManager Cue objects manager. */
    private $cueManager;
    
    /** @var CueStorage Cue objects storage. */
    private $storage;
    
    /**
     * Constructor.
     *
     * @param Format $format Subtitles format.
     * @param string $inputFilename Input file.
     */
    public function __construct(Format $format, $inputFilename)
    {
        $this->source = $format->createSource();
        $this->setInputFilename($inputFilename);
        $this->setLoadFormat($format);
    }
    
    /**
     * Set current input filename.
     *
     * @param string $inputFilename Input file.
     * @throws \InvalidArgumentException Thrown when input filename is not correct.
     * @return void
     */
    public function setInputFilename($inputFilename)
    {
        if (!is_readable($inputFilename)) {
            throw new \InvalidArgumentException();
        }
        
        $this->inputFilename = $inputFilename;
    }
    
    /**
     * Set current format.
     *
     * @param Format $format Specifying subtitles format.
     * @return void
     */
    public function setLoadFormat(Format $format)
    {
        if (isset($this->parser)) {
            $this->parser->removeObserver($this);
        }
        
        $this->parser = $format->createParser();
        $this->parser->registerObserver($this);
        
        $this->validator = $format->createValidator();
        
        $this->cueManager = $format->createCueManager();
    }
    
    /**
     * Initiates parsing process.
     *
     * @param CueStorage Cue objects storage.
     * @return void
     */
    public function load(CueStorage $storage)
    {
        $this->storage = $storage;
        $this->parser->parse(
            $this->source->createInputSource($this->inputFilename)
        );
    }
    
    /**
     * Save current subtiltes to output file specified by filename.
     *
     * @param string Ouput file.
     * @return void
     */
    public function save($filename)
    {
        $output = $this->source->createOutputSource($filename);
        $cueIterator = $this->storage->getIterator();
        
        while ($cueIterator->valid()) {
            $this->cueManager->writeToOutput($cueIterator->current(), $output);
            $cueIterator->next();
        }
    }
    
    /**
     * Observer reaction after each subtitle was parsed.
     *
     * @param array $parsedItem Subtitle parsed data.
     * @return void
     */
    public function update(array $parsedItem)
    {
        $cue = $this->cueManager->createFromParsed($parsedItem);
        
        $this->validator->validate($cue);
        $this->storage->add($cue);
    }
}
