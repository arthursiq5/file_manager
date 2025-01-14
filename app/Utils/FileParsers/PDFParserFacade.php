<?php

namespace App\Utils\FileParsers;

use Smalot\PdfParser\Document as PDFDocument;
use Smalot\PdfParser\Parser as PDFParser;

class PDFParserFacade implements FileParserInterface
{
    private PDFDocument $pdf;
    private int $amountPages = 5;

    public function __construct(string $pdfPath)
    {
        $parser = new PDFParser();
        $this->pdf = $parser->parseFile($pdfPath);
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

    public function fundParagraphs(array $content): array
    {
        $result = [];
        $mix = false;
        foreach ($content as $line) {
            if ($line === ' ' or $line === '') {
                continue;
            }
            if ($mix == true) {
                $result[array_key_last($result)] .= $line;
                $mix = false;
            } else {
                $result[] = $line;
            }
            if (substr($line, -1) === ' ') {
                $mix = true;
            }
        }
        return $result;
    }

    /**
     * @return string[]
     */
    public function getText(): array
    {
        $pdfContent = explode("\n", $this->pdf->getText());
        $pdfContent = $this->fundParagraphs($pdfContent);
        return $pdfContent;
    }


}
