<?php

namespace App\Http\Services\Todo;

use App\Http\Services\Service;
use App\Models\Todo;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TodoService extends Service
{
    public function index()
    {
        return Todo::where("user_id", auth()->user()->id)->get();
    }

    public function store($request): Todo
    {
        return Todo::create($request);
    }

    public function update(array $request): Todo
    {
        $todo = Todo::where('id', $request['todo_id'])
                    ->where('user_id', $request['user_id'])
                    ->firstOrFail();

        $todo->fill(array_filter($request, fn($value, $key) => in_array($key, ['title', 'description', 'status']), ARRAY_FILTER_USE_BOTH));

        $todo->save();

        return $todo;
    }

    public function get(int $id) : Todo
    {
        return Todo::findOrFail($id);
    }

    public function delete(int $id)
    {
        return Todo::destroy($id);
    }

    public function automate(array $request){

        $this->automateTodoCreation($request['prompt'], $request["user_id"]);

    }

    private function automateTodoCreation(string $prompt, $user_id){

        $todoListJson = $this->fetchTodoJsonListFromLLM($prompt);

        $this->bulkStore($todoListJson, $user_id);
    }

    private function fetchTodoJsonListFromLLM(string $prompt) {
        $apiKey = env('API_KEY'); // Certifique-se de que a chave está definida no .env

        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $apiKey, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "Gere um JSON com uma lista de TODOS que devem quebrar em microatividades a seguinte macroatividade: $prompt. Máximo de 10. Os TODOs devem conter um title e uma description. Gere APENAS o JSON."
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true); // Decodifica a resposta JSON

        // Extrai apenas a parte desejada
        $parts = $responseBody['candidates'][0]['content']['parts'] ?? [];

        // Pega o texto do primeiro item e decodifica o JSON
        $jsonText = $parts[0]['text'] ?? '';

        // Remove a formatação de código e decodifica o JSON
        $jsonText = preg_replace('/^```json\n|\n```$/', '', $jsonText); // Remove as marcações de código
        $todoList = json_decode(trim($jsonText), true); // Decodifica o JSON para um array

        return $todoList; // Retorna o array de objetos
    }

    private function bulkStore(array $todoListJson,$user_id){

        foreach($todoListJson as $todo){
            $todo["user_id"]=$user_id;
            $this->store($todo);
        }

    }

}