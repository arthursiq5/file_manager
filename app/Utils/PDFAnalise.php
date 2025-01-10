<?php

namespace App\Utils;

use App\Models\File;

class PDFAnalise
{
    private File $file;
    private PDFParserFacade $pdf;
    private GeminiContentAnaliseFacade $gemini;

    public function __construct(File $file)
    {
        $this->file = $file;
        $this->pdf = new PDFParserFacade($file->getPath());
        $this->gemini = new GeminiContentAnaliseFacade();
    }

    /**
     * @return string[]
     */
    public function analiseFirstPages(): array
    {
        $content = $this->pdf->getFirstPages();
        return $this->gemini->summarizePDF(
            $this->file,
            $content
        );
    }
}
