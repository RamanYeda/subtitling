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
 * Interface for parser observers.
 *
 * @link https://sourcemaking.com/design_patterns/observer
 * @package Yeda\Subtitling\Parser
 */
interface ParserObserver
{
    /**
     * Update parser observers.
     * Every time when parser have parsed next subtitle all it's observers will
     * be updated by parsed piece.
     *
     * @param array $parsedItem
     * @return void
     */
    public function update(array $parsedItem);
}
