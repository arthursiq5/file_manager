<?php

namespace App\Utils\FileParsers;

class TXTParserFacade implements FileParserInterface
{
    private string $path;

    public function __construct(string $filepath)
    {
        $this->path = $filepath;
    }

    public function getFileText(string $filePath) : array
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Arquivo não encontrado: $filePath");
        }

        // Abre o arquivo em modo de leitura
        $fileHandle = fopen($filePath, "r");
        if (!$fileHandle) {
            throw new \Exception("Erro ao abrir o arquivo: $filePath");
        }
        $lines = [];

        while (($line = fgets($fileHandle)) !== false) {
            $line = trim($line);
            if ($line !== "") {
                $lines[] = $line;
            }
        }

        fclose($fileHandle);

        return $lines;
    }

    public function getText(): array
    {
        try {
            return $this->getFileText($this->path);
        } catch (\Exception $e) {
            return [];
        }
    }
}
