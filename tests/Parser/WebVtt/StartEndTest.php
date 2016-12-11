<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Tests\Parser\WebVtt;

use Yeda\Subtitling\Parser\WebVtt\StartEnd;
use Yeda\Subtitling\Parser\WebVtt\Signature;
use Yeda\Subtitling\Parser\Exception\ParserException;
use Yeda\Subtitling\Tests\Source\Input\MockTrait\InputFakeSourceMock;

class StartEndTest extends \PHPUnit_Framework_TestCase
{
    use InputFakeSourceMock {
        InputFakeSourceMock::setUp as setUpInputSourceMock;
    }
    
    private $startEndParserState;
    
    protected function setUp()
    {
        parent::setUp();
        $this->setUpInputSourceMock();
        $this->startEndParserState = new StartEnd();
    }
    
    public function testParsingSignatureCorrect()
    {
        $this->expectReadNextLine(Signature::SIGNATURE_LABEL);
        $expectedParserState = new Signature();
        $actualParserState = $this->startEndParserState->parseSignature($this->inputSourceMock);
        
        $this->assertEquals($expectedParserState, $actualParserState);
    }
    
    public function testParsingSignatureNotCorrect()
    {
        $this->setExpectedException(ParserException::class);
        
        $invaidSignature = 'ololo';
        $this->expectReadNextLine($invaidSignature);
        
        $this->startEndParserState->parseSignature($this->inputSourceMock);
    }
}
