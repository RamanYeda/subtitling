<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Parser;

use Yeda\Subtitling\Source\Input\InputSource;

/**
 * Common parser interface for parsing subtitles from source file.
 *
 * @package Yeda\Subtitling\Parser
 */
interface Parser extends ParserSubject
{
    /**
     * Parsing from InputSource that represents subtitles file.
     *
     * @param InputSource $source
     * @return void
     */
    public function parse(InputSource $source);
}
