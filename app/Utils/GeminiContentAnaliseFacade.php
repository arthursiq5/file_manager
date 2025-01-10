<?php

namespace App\Utils;

use App\Models\File;
use Gemini\Data\Content;
use Gemini\Laravel\Facades\Gemini;

class GeminiContentAnaliseFacade
{
    /**
     * @param \App\Models\File $file
     * @param array $content
     * @return string[]
     */
    public function summarizePDF(File $file, array $content): array
    {
        $chatHistory = [
            Content::parse(part: 'Você é um modelo de linguagem que analisa textos longos. Sua tarefa é ler o texto abaixo, que foi extraído de um documento, e criar um resumo ou sinopse com aproximadamente três parágrafos, em texto corrido. O resumo deve condensar as informações mais importantes, sem transformar o conteúdo em listas, tabelas ou qualquer outro formato além de texto corrido. Evite repetições desnecessárias e mantenha o texto claro e objetivo.'),
            Content::parse(part:'Informações do documento:'),
            Content::parse(part:'- Nome do documento: ' . $file->name),
        ];

        if (!empty($file->description)) {
            $chatHistory[] = Content::parse(part:'- descrição do documento: ' . $file->description);
        }

        $chatHistory[] = Content::parse(part:'Texto a ser analisado:');

        foreach ($content as $line) {
            if (gettype($line) == 'string') {
                $chatHistory[] = Content::parse($line);
            }
        }

        $chat = Gemini::chat()
            ->startChat(history: $chatHistory);

        $response = $chat->sendMessage('Por favor, retorne o resumo em três parágrafos de texto corrido.');


        return explode("\n", $response->text());
    }
}
