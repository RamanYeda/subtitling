<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Cue\Manager;

use Yeda\Subtitling\Cue\CuePoint;
use Yeda\Subtitling\Cue\StandardCue;
use Yeda\Subtitling\Parser\Srt\SrtParser;
use Yeda\Subtitling\Parser\Srt\TimeDuration;
use Yeda\Subtitling\Source\Output\OutputSource;

/**
 * Manager for SRT subtitle cue objects.
 *
 * @package Yeda\Subtitling\Cue\Manager
 */
class SrtCueManager implements CueManager
{
    public function createFromParsed(array $parsedCue)
    {
        $timeMarkers = preg_split(
            TimeDuration::REG_EXP_DELIMITER,
            $parsedCue[SrtParser::SRT_TIMELINE]
        );
        
        return new StandardCue(
            (int) $parsedCue[SrtParser::SRT_INDEX],
            $this->transformTimeToMilliseconds(trim($timeMarkers[0])),
            $this->transformTimeToMilliseconds(trim($timeMarkers[1])),
            $parsedCue[SrtParser::SRT_TEXT]
        );
    }
    
    public function writeToOutput(CuePoint $cue, OutputSource $output)
    {
        $indexLine = (string) $cue->getIndex();
        $startTimeLine = $this->transformMillisecondsToTime($cue->getStartTime());
        $endTimeLine = $this->transformMillisecondsToTime($cue->getEndTime());
        
        $output->writeLines(array_merge(
            [ $indexLine, $startTimeLine . ' --> ' . $endTimeLine ],
            $cue->getTextLines()
        ));
    }
    
    /**
     * Transforms input SRT time marker to time value in milliseconds.
     *
     * @param string $time SRT subtitle time marker string.
     * @return int Time in milliseconds.
     */
    private function transformTimeToMilliseconds($time)
    {
        $timeParts = explode(':', $time);
        $timeParts[2] = explode(',', $timeParts[2]);
        
        $hours = (int) $timeParts[0];
        $minutes = (int) $timeParts[1];
        $seconds = (int) $timeParts[2][0];
        $milliseconds = (int) $timeParts[2][1];
        
        return ($hours * 3600 + $minutes * 60 + $seconds) * 1000 + $milliseconds;
    }
    
    /**
     * Transforms input time in milliseconds to SRT time marker string.
     *
     * @param int $milliseconds Time in milliseconds.
     * @return string SRT time marker.
     */
    private function transformMillisecondsToTime($milliseconds)
    {
        $totalHours = (int) ($milliseconds / 1000 / 60 / 60);
        $totalMinutes = (int) ($milliseconds / 1000 / 60);
        $totalSeconds = (int) ($milliseconds / 1000);
        
        $hours = $this->zerosPrepend((string) $totalHours, 2);
        $minutes = $this->zerosPrepend((string) ($totalMinutes - $totalHours * 60), 2);
        $seconds = $this->zerosPrepend((string) ($totalSeconds - $totalMinutes * 60), 2);
        $milliseconds = $this->zerosPrepend((string) ($milliseconds - $totalSeconds * 1000), 3);
        
        return $hours . ':' . $minutes . ':' . $seconds . ',' . $milliseconds;
    }
    
    /**
     * Prepending input numeric string by zero characters to the specified order.
     *
     * @param string $numberString A numeric string.
     * @param int $order Result numbers count in value.
     * @return string Result numeric string.
     */
    private function zerosPrepend($numberString, $order)
    {
        if (strlen($numberString) < $order) {
            $numberString = $this->zerosPrepend('0' . $numberString, $order);
        }
        
        return $numberString;
    }
}
