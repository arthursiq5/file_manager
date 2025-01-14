<?php

namespace App\Utils\FileParsers;

interface FileParserInterface
{
    public function __construct(string $filepath);
    public function getText(): array;
}
