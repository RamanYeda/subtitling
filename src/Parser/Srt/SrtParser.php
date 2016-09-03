<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser\Srt;

use Yeda\Subtitling\Parser\AbstractParserSubject;
use Yeda\Subtitling\Parser\Parser;
use Yeda\Subtitling\Source\Input\InputSource;

/**
 * SRT subtitles parser.
 *
 * @package Yeda\Subtitling\Parser\Srt
 */
class SrtParser extends AbstractParserSubject implements Parser
{
    /** The index of srt subtitle order in array of parsed data. */
    const SRT_INDEX = 0;
    /** The index of srt subtitle time interval string in array of parsed data. */
    const SRT_TIMELINE = 1;
    /** The index of srt subtitle text in array of parsed data. */
    const SRT_TEXT = 2;
    
    /** @var SrtParserState Current parser state. */
    private $srtState;
    
    public function __construct()
    {
        parent::__construct();
        $this->initParser();
    }
    
    public function parse(InputSource $source)
    {
        while ($source->hasNextLine()) {
            $parsedItem = [];
            
            $this->setSrtState($this->srtState->parseSequenceNumber($source));
            $parsedItem[self::SRT_INDEX] = $this->srtState->getCurrentParsedStateValue();
            $this->setSrtState($this->srtState->parseTimeDuration($source));
            $parsedItem[self::SRT_TIMELINE] = $this->srtState->getCurrentParsedStateValue();
            $this->setSrtState($this->srtState->parseText($source));
            $parsedItem[self::SRT_TEXT] = $this->srtState->getCurrentParsedStateValue();
            $this->setSrtState($this->srtState->parseBlankLine($source));
            
            $this->notifyObservers($parsedItem);
        }
        
        $this->initParser();
    }
    
    /**
     * Trigger parser to it's initial state.
     *
     * @return void
     */
    private function initParser()
    {
        $this->srtState = new BlankLine();
    }
    
    /**
     * Set the state of current parser.
     *
     * @param SrtParserState $srtState
     * @return void
     */
    private function setSrtState(SrtParserState $srtState)
    {
        $this->srtState = $srtState;
    }
}
