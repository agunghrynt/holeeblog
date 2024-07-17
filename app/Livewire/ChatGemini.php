<?php

namespace App\Livewire;

use Gemini\Enums\Role;
use Livewire\Component;
use Gemini\Data\Content;
use Gemini\Data\SafetySetting;
use Gemini\Enums\HarmCategory;
use Gemini\Data\GenerationConfig;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Enums\HarmBlockThreshold;

class ChatGemini extends Component
{
    public $message;
    // public $chats = [];
    public $history = [];
    protected $isLoading = false;

    public function render()
    {
        // Urutkan history berdasarkan timestamp sebelum merender tampilan
        // $timestamps = array_column($this->history, 'timestamp');
        // array_multisort($timestamps, SORT_ASC, $this->history);

        return view('livewire.chat-gemini');
    }

    public function addMessageToHistory()
    {
        $this->validate([
            'message' => ['required', 'min:1'], // Validasi di dalam fungsi
        ]);
        
        // Set isLoading menjadi true saat proses pengiriman dimulai
        $this->isLoading = true;

        $this->history[] = [
            'role' => 'user',
            'content' => $this->message,
            'timestamp' => now()->format('H:i:s'),
        ];

        // Simpan pesan pengguna ke dalam history dan reset input message
        $userInput = $this->message;
        $this->message = '';

        // Emit event untuk memproses pesan pengguna ke Gemini
        $this->dispatch('processUserInput', $userInput);
        $this->dispatch('scrollToBottom');
    }

    public function parseResponse($text)
    {
        $lines = explode("\n", $text);
        $parsedContent = [];
        $isCodeBlock = false;
        $codeContent = '';

        foreach ($lines as $line) {
            if (strpos($line, '```') !== false) {
                $isCodeBlock = !$isCodeBlock;
                if (!$isCodeBlock) {
                    // Blok kode selesai
                    $parsedContent[] = [
                        'type' => 'code',
                        'content' => $codeContent
                    ];
                    $codeContent = '';
                }
            } elseif ($isCodeBlock) {
                // Tambahkan baris ke konten kode
                $codeContent .= $line . "\n";
            } else {
                // Tambahkan sebagai paragraf biasa
                if (trim($line) !== '') {
                    $parsedContent[] = [
                        'type' => 'paragraph',
                        'content' => $line
                    ];
                }
            }
        }

        return $parsedContent;
    }

    public function processUserInput($userInput)
    {
        // Siapkan history untuk dikirim ke Gemini
        $formattedHistory = array_map(function ($message) {
            return Content::parse(part: $message['content'], role: $message['role'] === 'user' ? Role::USER : Role::MODEL);
        }, $this->history);

        // Konfigurasi pengaturan keamanan dan generatif
        $safetySettingDangerousContent = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_DANGEROUS_CONTENT,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );

        $safetySettingHateSpeech = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_HATE_SPEECH,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );

        $safetySettingHarassement = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_HARASSMENT,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );
        
        $safetySettingSexual = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_SEXUALLY_EXPLICIT,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );


        $generationConfig = new GenerationConfig(
            stopSequences: [
            ],
            maxOutputTokens: 2000,
            temperature: 1,
            topP: 0.7,
            topK: 16
        );

        // Memulai sesi chat dengan history
        $generativeModel = Gemini::geminiPro()
            ->withSafetySetting($safetySettingDangerousContent)
            ->withSafetySetting($safetySettingHateSpeech)
            ->withSafetySetting($safetySettingHarassement)
            ->withSafetySetting($safetySettingSexual)
            ->withGenerationConfig($generationConfig);

            // Memulai sesi chat dengan history
            $chat = $generativeModel->startChat($formattedHistory);

        try {
            
            $response = $chat->sendMessage();

            // $response = $generativeModel->generateContent($formattedHistory);

            if (empty($response->candidates)) {
                throw new \Exception('No candidates were returned');
            }

            foreach ($response->candidates as $candidate) {
                if (empty($candidate->content->parts)) {
                    foreach ($candidate->safetyRatings as $rating) {
                        if ($rating->blocked) {
                            $this->history[] = [
                                'role' => 'model',
                                'content' => "Content blocked due to: " . $rating->category,
                                'timestamp' => now()->format('H:i:s'),
                            ];

                            $this->dispatch('messageReceived', [
                                'index' => count($this->history) - 1,
                                'text' => "Content blocked due to: " . $rating->category,
                            ]);
                        }
                    }
                } else {
                    $parsedResponse = $this->parseResponse($candidate->content->parts[0]->text);
                    foreach ($parsedResponse as $content) {
                        $this->history[] = [
                            'role' => 'model',
                            'content' => $content['content'],
                            'type' => $content['type'],
                            'timestamp' => now()->format('H:i:s'),
                        ];
                    }

                    // $this->history[] = [
                    //     'role' => 'model',
                    //     'content' => $candidate->content->parts[0]->text,
                    //     'timestamp' => now()->format('H:i:s'),
                    // ];

                    // dump($parsedResponse);
                    $this->dispatch('messageReceived', [
                        'index' => count($this->history) - 1,
                        'text' => $candidate->content->parts[0]->text,
                    ]);
                }
            }
        } catch (\Exception $e) {
            $this->history[] = [
                'role' => 'model',
                'content' => "Failed to generate content: " . $e->getMessage(),
                'timestamp' => now()->format('H:i:s'),
            ];
            $this->dispatch('messageReceived', [
                'index' => count($this->history) - 1,
                'text' => "Failed to generate content: " . $e->getMessage(),
            ]);
        }
       
        $this->isLoading = false;

        // SEBELUM PENAMBAHAN HANDLE ERROR
        // $response = $chat->sendMessage();

        // $this->history[] = [
        //     'role' => 'model',
        //     'content' => $response->text(),
        //     'timestamp' => now()->format('H:i:s'),
        // ];

        // $this->dispatch('messageReceived', [
        //     'index' => count($this->history) - 1, // Mengirimkan indeks pesan baru
        //     'text' => $response->text(), // Mengirimkan teks respons
        // ]);

        // // Set isLoading menjadi false setelah proses selesai
        // $this->isLoading = false;
    }

    protected $listeners = [
        'processUserInput' => 'processUserInput',
        'scrollToBottom' => 'scrollToBottom'
    ];

    public function updating($name, $value)
    {
        if ($name === 'history') {
            foreach ($value as &$message) {
                unset($message['content']); // Contoh penyembunyian data
            }
        }
    }
}