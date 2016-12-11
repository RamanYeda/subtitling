<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Tests\Source\Input\MockTrait;

use Yeda\Subtitling\Source\Input\InputFakeSource;

trait InputFakeSourceMock
{
    private $inputSourceMock;
    
    private function setUp()
    {
        $this->inputSourceMock = $this
            ->getMockBuilder(InputFakeSource::class)
            ->setMethods([ 'readLine', 'readNextLine' ])
            ->getMock();
    }
    
    private function expectReadNextLine($expectedLine)
    {
        $this->inputSourceMock
            ->expects($this->once())
            ->method('readNextLine')
            ->willReturn($expectedLine);
    }
    
    private function expectReadLineByPointer($expectedLine)
    {
        $this->inputSourceMock
            ->expects($this->once())
            ->method('readLine')
            ->willReturn($expectedLine);
    }
    
    private function expectReadLinesByPointer(array $expectedLines)
    {
        reset($expectedLines);
        $returningValueCallback = function() use (&$expectedLines) {
            $returnedValue = current($expectedLines);
            next($expectedLines);
            return $returnedValue;
        };
        $this->inputSourceMock
            ->expects($this->exactly(count($expectedLines)))
            ->method('readLine')
            ->willReturnCallback($returningValueCallback);
    }
}
