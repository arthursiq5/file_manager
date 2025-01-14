<?php

namespace App\Utils;

use App\Models\File;
use App\Utils\FileParsers\FileParserInterface;

class PDFAnalise
{
    private File $file;
    private FileParserInterface $fileParser;
    private GeminiContentAnaliseFacade $gemini;

    public function __construct(File $file)
    {
        $this->file = $file;
        $this->fileParser = FileParserFactory::getParser($file);
        $this->gemini = new GeminiContentAnaliseFacade();
    }

    /**
     * @return string[]
     */
    public function analiseFirstPages(): array
    {
        $content = $this->fileParser->getText();
        return $this->gemini->summarizePDF(
            $this->file,
            $content
        );
    }
}
