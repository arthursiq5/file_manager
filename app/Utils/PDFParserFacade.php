<?php

namespace App\Utils;

use Smalot\PdfParser\Document as PDFDocument;
use Smalot\PdfParser\Parser as PDFParser;

class PDFParserFacade
{
    private PDFDocument $pdf;
    private int $amountPages;

    public function __construct(string $pdfPath, int $amountPages = 5)
    {
        $parser = new PDFParser();
        $this->pdf = $parser->parseFile($pdfPath);
        $this->amountPages = $amountPages;
    }

    public function setAmountPages(int $amount): void
    {
        $this->amountPages = $amount;
    }

    /**
     * @return string[]
     */
    public function getFirstPages(): array
    {
        return explode("\n", $this->pdf->getText($this->amountPages));
    }

    /**
     * @return string[]
     */
    public function getText(): array
    {
        return explode("\n", $this->pdf->getText());
    }


}
