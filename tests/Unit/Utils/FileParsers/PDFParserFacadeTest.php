<?php

namespace Tests\Unit\Utils\FileParsers;

use App\Utils\FileParsers\PDFParserFacade;
use PHPUnit\Framework\TestCase;

class PDFParserFacadeTest extends TestCase
{
    public function test_get_from_a_file(): void
    {
        $expected = [
            'test 1 test',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed dapibus mauris. Aliquam erat volutpat. Integer urna augue, elementum sit amet commodo in, volutpat in ligula. Suspendisse mauris orci, malesuada id arcu ut, feugiat aliquet ipsum. Etiam aliquam nisl volutpat mi aliquet malesuada. Sed varius consequat diam in maximus. Integer eros erat, egestas id neque a, scelerisque laoreet risus. Sed nec rhoncus augue.',
            'Integer elementum in tortor vel tincidunt. Ut ut mauris at purus ullamcorper interdum vitae consequat velit. Ut ante magna, dignissim et scelerisque vel, bibendum nec mauris. Proin vel varius eros. Aliquam ut elit id ex commodo viverra. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget ex gravida, molestie purus et, porta diam. Nullam molestie tincidunt risus a tincidunt.',
            'Vivamus neque nibh, porta vel arcu sed, vulputate bibendum elit. Sed velit ligula, lobortis non enim vel, porttitor laoreet purus. Aliquam dolor urna, scelerisque ut lacus nec, dapibus faucibus metus. Cras id lorem nulla. Nam urna leo, dapibus ut euismod tempor, pharetra id dui. Morbi vel eros at magna maximus sollicitudin a ut tortor. Sed nulla tortor, tincidunt imperdiet pulvinar vel, commodo in neque. Suspendisse potenti. Sed commodo lorem nulla, eu bibendum nulla ullamcorper at. Fusce rhoncus ut elit at eleifend. Sed sit amet mauris et justo viverra fermentum id sodales risus. Aliquam ac rutrum arcu. Praesent venenatis consequat vehicula. Nulla facilisi. Nullam sollicitudin tristique sem, sed hendrerit tellus facilisis non. Mauris varius ultrices elit in porta.',
            'Integer lobortis vel arcu nec ultrices. Pellentesque a lectus at ante molestie viverra. Sed est nisi, laoreet eu porta vel, accumsan et diam. Curabitur ex nisi, ultrices sed tortor quis, tincidunt cursus risus. Nulla vitae orci at tellus gravida congue. Duis sit amet scelerisque quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce in porttitor mi, at euismod leo. Praesent in gravida enim, nec tristique elit. Aenean egestas, mauris eget tincidunt pellentesque, mauris enim congue ipsum, eu pellentesque lacus tortor at nisl. Phasellus sollicitudin eros vel turpis sodales feugiat. Donec vel posuere sapien, congue lobortis felis.',
            'test 2 Vestibulum ullamcorper magna vehicula nulla posuere, auctor egestas neque dapibus. Mauris mattis tempor nulla, in finibus dui. Nulla varius sagittis venenatis. Pellentesque a tristique magna, eu imperdiet ligula. Quisque laoreet mauris lorem, ultricies fermentum arcu gravida eu. Pellentesque pretium lectus ac odio tristique semper. Nullam augue augue, sodales sit amet vulputate nec, sodales non tortor. Suspendisse potenti. Donec tincidunt consectetur suscipit. Nam molestie placerat imperdiet. Mauris suscipit fringilla quam ac sodales. Nam dignissim facilisis felis, vel mollis quam ultrices nec. Donec id felis luctus, tristique sapien non, venenatis tortor. Sed at nunc nec enim sodales imperdiet a quis turpis.',
        ];
        $filepath = base_path() . '/tests/Resources/FileParser/PDFFile.pdf';
        $parser = new PDFParserFacade($filepath);
        $this->assertEquals($expected, $parser->getText());
    }

    public function test_fund_paragraphs(): void
    {
        $entry = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed dapibus ',
            'mauris. Aliquam erat volutpat. Integer urna augue, elementum sit amet commodo ',
            'in, volutpat in ligula. Suspendisse mauris orci, malesuada id arcu ut, feugiat aliquet ',
            'ipsum. Etiam aliquam nisl volutpat mi aliquet malesuada. Sed varius consequat ',
            'diam in maximus. Integer eros erat, egestas id neque a, scelerisque laoreet risus. ',
            'Sed nec rhoncus augue.',
        ];
        $expected = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed dapibus mauris. Aliquam erat volutpat. Integer urna augue, elementum sit amet commodo in, volutpat in ligula. Suspendisse mauris orci, malesuada id arcu ut, feugiat aliquet ipsum. Etiam aliquam nisl volutpat mi aliquet malesuada. Sed varius consequat diam in maximus. Integer eros erat, egestas id neque a, scelerisque laoreet risus. Sed nec rhoncus augue.',
        ];

        $filepath = base_path() . '/tests/Resources/FileParser/PDFFile.pdf';
        $parser = new PDFParserFacade($filepath);
        $this->assertEquals($expected, $parser->fundParagraphs($entry));
    }
}
