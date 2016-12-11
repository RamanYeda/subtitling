<?php
/**
 * Subtitling.
 *
 * @author Raman Yeda <grayfox010389@gmail.com>
 * @copyright 2016 Raman Yeda
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Yeda\Subtitling\Tests\Parser\WebVtt;

use Yeda\Subtitling\Parser\WebVtt\Signature;
use Yeda\Subtitling\Parser\WebVtt\BlankLine;
use Yeda\Subtitling\Parser\Exception\ParserException;
use Yeda\Subtitling\Tests\Source\Input\MockTrait\InputFakeSourceMock;

class SignatureTest extends \PHPUnit_Framework_TestCase
{
    use InputFakeSourceMock {
        InputFakeSourceMock::setUp as setUpInputSourceMock;
    }
    
    private $signatureParserState;
    
    protected function setUp()
    {
        parent::setUp();
        $this->setUpInputSourceMock();
        $this->signatureParserState = new Signature();
    }
    
    public function testParsingOneBlankLine()
    {
        $this->expectReadNextLine(BlankLine::EMPTY_MARKER);
        
        $expectedParserState = new BlankLine();
        $actualParserState = $this->signatureParserState->parseLineTerminator($this->inputSourceMock);
        
        $this->assertEquals($expectedParserState, $actualParserState);
    }
    
    public function testParsingThreeBlankLines()
    {
        $blankLine = BlankLine::EMPTY_MARKER;
        $threeBlankLinesAndEnd = [ $blankLine, $blankLine, $blankLine, null];
        $this->expectReadNextLine($blankLine);
        $this->expectReadLinesByPointer($threeBlankLinesAndEnd);
        
        $expectedParserState = new BlankLine();
        $actualParserState = $this->signatureParserState->parseLineTerminator($this->inputSourceMock);
        
        $this->assertEquals($expectedParserState, $actualParserState);
    }
    
    public function testParsingBlankLineNotCorrect()
    {
        $this->setExpectedException(ParserException::class);
        
        $invalidLineTerminator = 'ololo';
        $this->expectReadNextLine($invalidLineTerminator);
        
        $this->signatureParserState->parseLineTerminator($this->inputSourceMock);
    }
}
