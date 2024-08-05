{{-- <div class="container-fluid h-full">
    <div class="row justify-content-center h-full">
        <div class="d-flex flex-column col-md-8 h-full overflow-y-auto">
            <div class="h-full chat-container flex-grow-1">
                @foreach($history as $chat)
                    @if($chat['role'] === 'user')
                    <div class="d-flex align-items-end flex-column mb-2">
                        <p class="m-0">
                            <strong>You </strong>
                        </p>
                        <p class="card-text m-0 fst-italic fw-light"><small class="text-body-secondary">{{ $chat['timestamp'] }}</small></p>
                        <p class="m-0">
                            <span>{{ $chat['content'] }}</span>
                        </p>
                    </div>
                    @else
                    <div class="d-flex align-items-start flex-column mb-2">
                        <p class="m-0">
                            <strong>Google Gemini AI </strong>
                        </p>
                        <p class="card-text m-0 fst-italic fw-light"><small class="text-body-secondary">{{ $chat['timestamp'] }}</small></p>
                        <p class="m-0">
                            @if(strpos($chat['content'], '```') !== false)
                                    <pre><code>{{ str_replace('```', '', $chat['content']) }}</code></pre>
                            @else
                                <span id="typingEffectGemini{{ $loop->index }}"> {{ $chat['content'] }}</span>
                            @endif
                        </p>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="row justify-content-center h-full overflow-hidden">
                <div class="input-group-container col-12">
                    <div class="container d-flex justify-content-center">
                        <form wire:submit.prevent="addMessageToHistory" class="input-group-custom @error('message') is-invalid @enderror" id="messageForm">
                            <label for="file-input"><i class="bi bi-paperclip"></i>
                            </label>
                            <input type="file" id="file-input" class="file-input">
                            <textarea id="chatMessageInput" oninput='this.style.height = ""; this.style.height = this.scrollHeight + "px"' wire:keydown.enter.prevent="addMessageToHistory" class="form-control" rows="1" wire:model="message"    placeholder="{{ $errors->has('message') ? $errors->first('message') : 'Tulis Sesuatu...' }}" required></textarea>
                            <!-- <input id="chatMessageInput" class="form-control h-auto overflow-auto" type="text" wire:model="message" placeholder="" aria-label=""   aria-describedby="button-addon" required autofocus /> -->
                            <button type="submit" wire:loading.attr="disabled" id="button-addon">
                                <span wire:loading.remove class="text-secondary"><i class="bi bi-arrow-up-circle-fill"></i></span>
                                <span class="spinner-border spinner-border-sm text-secondary" role="status" wire:loading></span>
                            </button>
                        </form>
                    </div>
                    <div class="container d-flex justify-content-center p-1">
                        <p class="small text-center font-monospace text-muted lh-1 col-md-8 m-0" style="font-size: 0.75rem">
                            Halo ini adalah chat dengan Gemini AI yang di kembangkan oleh Google, kau bisa menanyakan apa saja kepadanya. atau kau bisa mengunjungi blog ku untuk membaca artikel yang ada disana. Silahkan klik<a class="text-decoration-none" href="/home"> Disini </a>untuk menuju halaman utamaku.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="parent">
    <div class="header-parent">
        <div class="header-child">
            <a href="{{ URL::to('/') }}/home">
                <img class="gemini-logo" src="{{ secure_asset('/img/gemini.svg') }}" alt="Gemini Logo">
            </a>
            <p class="text-center font-monospace text-muted lh-1 m-1 fw-semibold">Gemini AI</p>
        </div>
    </div>
    <div class="content">
        <div class="chat-container">
            <div class="chat-content">
                @foreach($history as $chat)
                        @if($chat['role'] === 'user')
                        <div class="chat-message d-flex align-items-end flex-column mb-2">
                            <p class="m-0">
                                <strong>You </strong>
                            </p>
                            <p class="card-text m-0 fst-italic fw-light"><small class="text-body-secondary">{{ $chat['timestamp'] }}</small></p>
                            <p class="m-0">
                                <span>{{ $chat['content'] }}</span>
                            </p>
                        </div>
                        @else
                        <div class="chat-message d-flex align-items-start flex-column mb-2">
                            <p class="m-0">
                                <strong>Google Gemini AI </strong>
                            </p>
                            <p class="card-text m-0 fst-italic fw-light"><small class="text-body-secondary">{{ $chat['timestamp'] }}</small></p>
                            <p class="m-0">
                                @if($chat['type'] === 'code')
                                    <pre><code>{{ $chat['content'] }}</code></pre>
                                @else
                                    <span id="typingEffectGemini{{ $loop->index }}">{{ $chat['content'] }}</span>
                                @endif
                                {{-- @if(strpos($chat['content'], '```') !== false)
                                        <pre><code>{{ str_replace('```', '', $chat['content']) }}</code></pre>
                                @else
                                    <span id="typingEffectGemini{{ $loop->index }}"> {{ $chat['content'] }}</span>
                                @endif --}}
                            </p>
                        </div>
                        @endif
                        {{-- @dump($history) --}}
                    @endforeach
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="input-group-container">
            <div class="container d-flex justify-content-center">
                <form wire:submit.prevent="addMessageToHistory" class="input-group-custom @error('message') is-invalid @enderror" id="messageForm">
                    <label for="file-input"><i class="bi bi-paperclip"></i>
                    </label>
                    <input type="file" id="file-input" class="file-input">
                    <textarea id="chatMessageInput" oninput='this.style.height = ""; this.style.height = this.scrollHeight + "px"' wire:keydown.enter.prevent="addMessageToHistory" class="form-control" rows="1" wire:model="message"    placeholder="{{ $errors->has('message') ? $errors->first('message') : 'Tulis Sesuatu...' }}" required></textarea>
                    <button type="submit" wire:loading.attr="disabled" id="button-addon">
                        <span wire:loading.remove class="text-secondary"><i class="bi bi-arrow-up-circle-fill"></i></span>
                        <span class="spinner-border spinner-border-sm text-secondary" role="status" wire:loading></span>
                    </button>
                </form>
            </div>
            <div class="container d-flex justify-content-center col-md-8 p-1">
                <div class="running-container">
                    <div>
                        <span class="running-text small text-center font-monospace text-muted lh-1 m-0" style="font-size: 0.75rem;">
                            <a class="text-decoration-none" href="{{ URL::to('/') }}/home">Mulai chat dengan gemini, tapi ingat dia bisa membuat kesalahan. Atau kunjungi Halaman Utama.
                            </a>
                        </span>
                        <span class="running-text small text-uppercase text-danger font-monospace lh-1 m-0" style="font-size: 0.75rem;"> Perhatin jangan register memggunakan e-mail aslimu, gunakanlah e-mail dummy!!!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
<link rel="stylesheet" type="text/css" href="/css/gemini.css">
@endassets

@push('scripts')
<script src="/js/gemini.js"></script>
@endpush
