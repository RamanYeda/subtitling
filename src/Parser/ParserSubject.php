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
 * Any subtitles parser should implement this interface.
 *
 * @link https://sourcemaking.com/design_patterns/observer
 * @package Yeda\Subtitling\Parser
 */
interface ParserSubject
{
    /**
     * Register new observer for current parser.
     *
     * @param ParserObserver $observer
     * @return void
     */
    public function registerObserver(ParserObserver $observer);
    
    /**
     * Remove specified observer for current parser.
     *
     * @param ParserObserver $observer
     * @return void
     */
    public function removeObserver(ParserObserver $observer);
}
