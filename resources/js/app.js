import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.transition = 'opacity 0.5s ease';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 500); // 完全に消えるまで待つ
        }, 3000); // 3秒後にフェードアウト
    }

    // プレビュー表示処理
    const previewInputs = document.querySelectorAll('.preview-input');

    previewInputs.forEach(input => {
        input.addEventListener('change', event => {
            const targetId = input.getAttribute('data-preview-target');
            const previewContainer = document.getElementById(targetId);

            if (previewContainer) {
                previewContainer.innerHTML = ''; // 既存のプレビューをクリア

                const files = event.target.files;
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-32 object-contain rounded-md';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
});

document.getElementById('scroll-to-bottom').addEventListener('click', () => {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
    });
});

window.addEventListener('scroll', () => {
    const scrollToBottomButton = document.getElementById('scroll-to-bottom');
    if (scrollToBottomButton) {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 20) {
            scrollToBottomButton.style.transition = 'opacity 0.5s ease';
            scrollToBottomButton.style.opacity = '0';
            setTimeout(() => {
            scrollToBottomButton.style.display = 'none';
            }, 500); // フェードアウト後に非表示
        } else {
            scrollToBottomButton.style.display = 'block';
            setTimeout(() => {
            scrollToBottomButton.style.transition = 'opacity 0.5s ease';
            scrollToBottomButton.style.opacity = '1';
            }, 0); // フェードイン
        }
    }
});
