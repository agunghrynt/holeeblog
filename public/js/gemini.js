document.addEventListener('livewire:initialized', function () {
    Livewire.on('messageReceived', (response) => {
        let index = response[0].index; // Mengambil index dari response
        let text = response[0].text; // Mengambil teks dari response
        // Scroll ke bawah setelah pesan baru dari user ditambahkan
        let typingElementId = `typingEffectGemini${index}`;
        setTimeout(() => {
                let typingElement = document.getElementById(typingElementId);
                if (typingElement) {
                    typingElement.textContent = ' '; // Mengosongkan konten sebelum mengetik ulang
                    typeWriter(text, typingElement);
                } else {
                }
            }, 0);
    });

    Livewire.on('processUserInput', (userinput) => {
    let chatContainer = document.querySelector('.chat-container');
    setTimeout(() => {
            if (chatContainer) {
                // Scroll ke bawah setelah pesan baru dari user ditambahkan
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }, 0);  
    });

    function typeWriter(text, element) {
        let i = 0;
        let speed = 2; // Kecepatan ketik (ms per karakter)
        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);

                // Scroll chat container ke bawah saat typewriter berjalan
                let chatContainer = document.querySelector('.chat-container');
                if (chatContainer) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            }
        }
        type(); // Mulai efek ketik
    }
});


// Scroll otomatis ke bawah ketika pesan baru diproses
document.addEventListener('livewire:initialized', function () {
    Livewire.on('messageReceived', function () {
        setTimeout(() => {
            let chatContainer = document.querySelector('.chat-container');
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }, 0);
    });
});