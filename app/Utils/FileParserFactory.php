<?php

namespace App\Utils;

use \App\Models\File;
use App\Utils\FileParsers\FileParserInterface;
use App\Utils\FileParsers\PDFParserFacade;
use App\Utils\FileParsers\TXTParserFacade;

class FileParserFactory
{
    public static function getParser(File $file): FileParserInterface
    {
        if ($file->getType() === 'pdf') {
            return new PDFParserFacade($file->getPath());
        }
        return new TXTParserFacade($file->getPath());
    }
}
