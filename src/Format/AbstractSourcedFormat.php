<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Format;

use Yeda\Subtitling\Source\NormalizedFileSource;

/**
 * Abstract source that sets the default create method for source component.
 * All it's subclasses can't override it's source creating method.
 *
 * @package Yeda\Subtitling\Format
 */
abstract class AbstractSourcedFormat implements Format
{
    /**
     * Create normalized file source.
     *
     * @return NormalizedFileSource
     */
    final public function createSource()
    {
        return new NormalizedFileSource();
    }
}
