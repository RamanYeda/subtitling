<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser;

/**
 * All observers subject logic placed here separated from concrete parsers.
 *
 * @package Yeda\Subtitling\Parser
 */
abstract class AbstractParserSubject implements ParserSubject
{
    /** @var \SplObjectStorage Parser observers. */
    private $parserObservers;
    
    public function __construct()
    {
        $this->parserObservers = new \SplObjectStorage();
    }
    
    public function registerObserver(ParserObserver $observer)
    {
        $this->parserObservers->attach($observer);
    }
    
    public function removeObserver(ParserObserver $observer)
    {
        if ($this->parserObservers->contains($observer)) {
            $this->parserObservers->detach($observer);
        }
    }
    
    /**
     * Update all parser observers by parsed data.
     *
     * @param array $parsedItem
     * @return void
     */
    protected function notifyObservers(array $parsedItem)
    {
        $this->parserObservers->rewind();
        
        while ($this->parserObservers->valid()) {
            $observer = $this->parserObservers->current();
            $observer->update($parsedItem);
            
            $this->parserObservers->next();
        }
    }
}
