import './bootstrap';

// 印刷ボタンのクリックイベント
document.getElementById('printing-button')?.addEventListener('click', function (event) {
    event.preventDefault();
    this.innerHTML = `
        <span class="block text-center flex-1">印刷中...</span>
        <svg class="animate-spin h-5 w-5 ml-2 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    `;
    this.classList.add('opacity-50', 'pointer-events-none');
    window.location.href = this.href;
});

// FAB印刷ボタンにもローディング
document.getElementById('fab-printing-button')?.addEventListener('click', function (event) {
    event.preventDefault();
    this.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        印刷中...
    `;
    this.classList.add('opacity-50', 'pointer-events-none');
    window.location.href = this.href;
});

// クイックリプライ風ナビのアクティブ色切替
document.querySelectorAll('.fixed nav a').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.fixed nav a').forEach(a => a.classList.remove('bg-indigo-600', 'text-white'));
        this.classList.add('bg-indigo-600', 'text-white');
    });
});

// クイックナビ表示制御（上スクロール時のみ表示）
(function() {
    const quickNav = document.getElementById('quick-nav-bar');
    if (!quickNav) return;
    let lastScroll = window.scrollY;
    window.addEventListener('scroll', function() {
        const current = window.scrollY;
        if (current < lastScroll && current > 30) {
            quickNav.classList.remove('-translate-y-full');
        } else {
            quickNav.classList.add('-translate-y-full');
        }
        lastScroll = current;
    });
})();

// クイックナビ現在地色変更＋自動スクロール＋色変化時は常に一定時間表示＋ホバー中は消さない
document.addEventListener('DOMContentLoaded', function () {
    let lastActive = null;
    let scrollTimeout = null;
    const quickNavBar = document.getElementById('quick-nav-bar');

    function showQuickNavBar() {
        if (quickNavBar) {
            quickNavBar.classList.remove('-translate-y-full');
        }
    }
    function hideQuickNavBar() {
        if (quickNavBar) {
            quickNavBar.classList.add('-translate-y-full');
        }
    }

    function setQuickNavCurrent(scrollToActive = false) {
        const links = document.querySelectorAll('.quicknav-link');
        let found = false;
        let activeLink = null;
        links.forEach(link => link.classList.remove('quicknav-current'));
        // ページ内アンカーの現在地判定
        for (const link of links) {
            const href = link.getAttribute('href');
            if (!href) continue;
            const hash = href.split('#')[1];
            if (hash) {
                const section = document.getElementById(hash);
                if (section) {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= 80 && rect.bottom > 80 && !found) {
                        link.classList.add('quicknav-current');
                        activeLink = link;
                        found = true;
                    }
                }
            }
        }
        // 色が変わったらクイックナビを一定時間表示し、該当リンクまで横スクロール
        if (activeLink && lastActive !== activeLink) {
            lastActive = activeLink;
            const nav = activeLink.closest('nav');
            if (nav) {
                // 横スクロール
                const scrollLeft = activeLink.offsetLeft - nav.offsetLeft - nav.clientWidth / 2 + activeLink.clientWidth / 2;
                nav.scrollTo({ left: scrollLeft, behavior: 'smooth' });
            }
            showQuickNavBar();
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                if (!quickNavBar.matches(':hover')) hideQuickNavBar();
            }, 1800);
        }
        // 色が変わらなくても（下スクロール時も）現在地が同じなら表示だけはする
        if (activeLink && lastActive === activeLink) {
            showQuickNavBar();
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                if (!quickNavBar.matches(':hover')) hideQuickNavBar();
            }, 1800);
        }
    }

    if (quickNavBar) {
        quickNavBar.addEventListener('mouseenter', () => {
            if (scrollTimeout) clearTimeout(scrollTimeout);
            showQuickNavBar();
        });
        quickNavBar.addEventListener('mouseleave', () => {
            scrollTimeout = setTimeout(() => {
                hideQuickNavBar();
            }, 600);
        });
    }

    window.addEventListener('scroll', () => setQuickNavCurrent(false), { passive: true });
    setQuickNavCurrent(true);
});
