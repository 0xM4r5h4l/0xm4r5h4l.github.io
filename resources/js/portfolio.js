import Alpine from 'alpinejs';

// Hero terminal — types out real architecture log lines on a loop.
Alpine.data('terminal', () => ({
    lines: [
        { p: '$', t: 'php artisan tenant:resolve --domain=acme.app', c: '' },
        { p: '✓', t: 'Tenant context bound · middleware validated', c: 'text-trace' },
        { p: '✓', t: 'Cache warmed · stampede jitter applied (12s)', c: 'text-trace' },
        { p: '✓', t: 'OAuth token verified · AES-256 decrypt', c: 'text-signal' },
        { p: '✓', t: 'Eloquent: 0 N+1 queries · eager loaded', c: 'text-trace' },
        { p: '✓', t: 'DTO mapped → Service Layer → Response (118ms)', c: 'text-signal' },
    ],
    visible: [],
    init() {
        this.run();
    },
    run() {
        this.visible = [];
        let i = 0;
        const step = () => {
            if (i < this.lines.length) {
                this.visible.push(this.lines[i]);
                i++;
                setTimeout(step, 480);
            } else {
                setTimeout(() => this.run(), 2600);
            }
        };
        step();
    },
}));

// Projects section tabs (Overview / Architecture / Security / Performance)
Alpine.data('projectTabs', () => ({
    tab: 'overview',
}));

// Simple hero entrance flag
Alpine.data('heroReveal', () => ({
    shown: false,
    init() {
        setTimeout(() => (this.shown = true), 80);
    },
}));

window.Alpine = Alpine;
Alpine.start();

// Scroll-reveal for .reveal sections (respects prefers-reduced-motion via CSS)
document.addEventListener('DOMContentLoaded', () => {
    const obs = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) e.target.classList.add('in');
            });
        },
        { threshold: 0.15 }
    );
    document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
});