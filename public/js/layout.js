const urlForm = document.getElementById('urlForm');
const urlInput = document.getElementById('urlInput');
const shortenBtn = document.getElementById('shortenBtn');
const loading = document.getElementById('loading');
const resultSection = document.getElementById('resultSection');
const shortUrl = document.getElementById('shortUrl');
const originalUrl = document.getElementById('originalUrl');
const clickCount = document.getElementById('clickCount');

urlForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    const url = urlInput.value.trim();
    if (!url) return;

    // Mostrar loading
    shortenBtn.disabled = true;
    loading.style.display = 'block';
    resultSection.classList.remove('show');

    try {
        // Simular chamada para o backend
        const response = await post(url);
        console.log(response.short_url);

        // Simular resposta do backend
        const mockResponse = {
            shortUrl: response.short_url,
            originalUrl: url,
            clicks: Math.floor(Math.random() * 100)
        };

        // Mostrar resultado
        showResult(mockResponse);

    } catch (error) {
        alert('Erro ao encurtar URL. Tente novamente.');
    } finally {
        // Resetar botão
        shortenBtn.disabled = false;
        shortenBtn.textContent = 'Shorten Url';
        loading.style.display = 'none';
    }
});

function generateShortCode() {
    return Math.random().toString(36).substring(2, 8);
}

async function post(url) {
    const response = await fetch('/shortner', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({url})
    });
    return await response.json();
}

function showResult(data) {
    shortUrl.textContent = data.shortUrl;
    originalUrl.textContent = data.originalUrl;
    clickCount.textContent = data.clicks;

    setTimeout(() => {
        resultSection.classList.add('show');
    }, 100);
}

function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    const text = element.textContent;

    navigator.clipboard.writeText(text).then(() => {
        const btn = element.nextElementSibling;
        const originalText = btn.textContent;
        btn.textContent = 'Copiado!';
        btn.style.background = '#10b981';

        setTimeout(() => {
            btn.textContent = originalText;
            btn.style.background = '#27384a';
        }, 2000);
    }).catch(() => {
        alert('Não foi possível copiar. Selecione o texto manualmente.');
    });
}

// Adicionar animação de foco no input
urlInput.addEventListener('focus', function() {
    this.parentElement.style.transform = 'scale(1.02)';
});

urlInput.addEventListener('blur', function() {
    this.parentElement.style.transform = 'scale(1)';
});
