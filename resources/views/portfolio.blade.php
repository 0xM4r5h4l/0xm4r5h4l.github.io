{{--
    resources/views/portfolio.blade.php

    Setup (one-time):
    1. Copy resources/css/portfolio.css content into your existing app.css
       (or keep as a second file and add a second @vite entry below).
    2. Copy resources/js/portfolio.js into resources/js/, then in app.js add:
           import './portfolio';
       (or replace the @vite entry below with your own app.js path).
    3. npm install alpinejs
    4. Route: Route::view('/', 'portfolio'); — or return view('portfolio') from a controller.
    5. Replace every "Your Name" / placeholder link / email with your real info.
--}}
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mostafa Abdelrazek — Laravel Backend Developer</title>
    <meta name="description"
        content="Laravel backend developer specializing in multi-tenant SaaS architecture, service-layer design, and security-first systems." />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-[var(--void)] text-[var(--ink)]" x-data>

    <!-- NAV -->
    <header class="fixed top-0 inset-x-0 z-50">
        <div class="max-w-[1140px] mx-auto px-6">
            <div class="glass rounded-2xl mt-4 px-5 py-3 flex items-center justify-between">
                <a href="#" class="font-display font-semibold text-[15px] tracking-tight">0xM4r5h4l<span
                        class="text-trace">.</span>dev</a>
                <nav
                    class="hidden md:flex items-center gap-8 font-mono text-[12px] uppercase tracking-widest text-mist">
                    <a href="#approach" class="hover:text-[var(--ink)] transition">Approach</a>
                    <a href="#projects" class="hover:text-[var(--ink)] transition">Projects</a>
                    <a href="#stack" class="hover:text-[var(--ink)] transition">Stack</a>
                    <a href="#contact" class="hover:text-[var(--ink)] transition">Contact</a>
                </nav>
                <div class="flex items-center gap-2 font-mono text-[11px] text-mist">
                    <span class="dot-ping inline-block w-1.5 h-1.5 rounded-full bg-[var(--trace)]"></span>
                    OPEN_TO_REMOTE
                </div>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="relative pt-40 pb-24 md:pt-48 md:pb-32 px-6 overflow-hidden">
        <div class="max-w-[1140px] mx-auto grid md:grid-cols-[1.1fr_0.9fr] gap-14 items-center">

            <div x-data="heroReveal" :class="shown && 'in'" class="reveal">
                <p class="font-mono text-[12px] uppercase tracking-widest text-signal mb-5">[ STATUS: BACKEND_FOCUSED ]
                </p>
                <h1
                    class="font-display font-semibold text-[40px] leading-[1.08] md:text-[58px] md:leading-[1.05] tracking-tight">
                    Laravel Backend<br />Developer, built for<br />
                    <span class="text-trace">multi-tenant</span> scale.
                </h1>
                <p class="mt-6 text-mist text-[16px] md:text-[17px] leading-relaxed max-w-[480px]">
                    I design and ship backend systems — tenant isolation, service-layer architecture, and security
                    primitives — for SaaS products that can't afford to get this wrong.
                </p>
                <div class="mt-9 flex flex-wrap items-center gap-4">
                    <a href="#projects"
                        class="font-mono text-[13px] uppercase tracking-wide bg-[var(--trace)] text-[#06231f] font-medium px-6 py-3 rounded-xl hover:brightness-110 transition">View
                        Architecture</a>
                    {{-- Point this at a real file in storage/app/public or an asset() path --}}
                    {{-- <a href="{{ asset('cv.pdf') }}" --}}
                    <a href="#"
                        class="font-mono text-[13px] uppercase tracking-wide hairline border px-6 py-3 rounded-xl text-[var(--ink)] hover:bg-white/5 transition">Download
                        CV</a>
                </div>
                <div class="mt-12 flex items-center gap-8 font-mono text-[12px] text-mist">
                    <span>PHP 8.2+</span>
                    <span class="w-1 h-1 rounded-full bg-mist/40"></span>
                    <span>Laravel 12</span>
                    <span class="w-1 h-1 rounded-full bg-mist/40"></span>
                    {{-- <span>Redis</span> --}}
                </div>
            </div>

            <!-- TERMINAL SIGNATURE ELEMENT -->
            <div x-data="terminal" class="glass rounded-2xl overflow-hidden shadow-2xl shadow-black/40">
                <div class="flex items-center gap-2 px-4 py-3 border-b hairline border">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#ff5f57]"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#febc2e]"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#28c840]"></span>
                    <span class="font-mono text-[11px] text-mist ml-3">tenant-resolver — zsh</span>
                </div>
                <div class="p-5 font-mono text-[13px] leading-[1.9] min-h-[260px]">
                    <template x-for="(line, idx) in visible" :key="idx">
                        <div>
                            <span :class="line.p === '$' ? 'text-mist' : line.c">[<span
                                    x-text="line.p"></span>]</span>
                            <span :class="line.c || 'text-ink/90'" x-text="' ' + line.t"></span>
                        </div>
                    </template>
                    <span class="cursor"></span>
                </div>
            </div>

        </div>
    </section>

    <!-- APPROACH -->
    <section id="approach" class="px-6 py-24 border-t hairline border">
        <div class="max-w-[1140px] mx-auto">
            <p class="font-mono text-[12px] uppercase tracking-widest text-trace mb-3">[ 01 ] Approach</p>
            <h2 class="font-display font-semibold text-[28px] md:text-[34px] max-w-[620px]">Architecture decisions, not
                just working code.</h2>

            <div class="mt-12 grid md:grid-cols-3 gap-6">
                <div class="glass glow-signal rounded-2xl p-7">
                    <span class="font-mono text-[11px] text-signal">[ TYPE_SAFETY ]</span>
                    <h3 class="font-display font-medium text-[18px] mt-4">DTOs over arrays</h3>
                    <p class="text-mist text-[14px] mt-3 leading-relaxed">Data crossing a layer boundary is typed and
                        validated at the edge — not a loosely-shaped array that breaks silently three calls later.</p>
                </div>
                <div class="glass glow-trace rounded-2xl p-7">
                    <span class="font-mono text-[11px] text-trace">[ SEPARATION ]</span>
                    <h3 class="font-display font-medium text-[18px] mt-4">Service Layer</h3>
                    <p class="text-mist text-[14px] mt-3 leading-relaxed">Controllers stay thin. Business logic lives in
                        services that are testable in isolation from HTTP and Eloquent.</p>
                </div>
                <div class="glass glow-signal rounded-2xl p-7">
                    <span class="font-mono text-[11px] text-signal">[ SECURITY_FIRST ]</span>
                    <h3 class="font-display font-medium text-[18px] mt-4">Assume hostile tenants</h3>
                    <p class="text-mist text-[14px] mt-3 leading-relaxed">Multi-tenant systems fail at the boundary
                        between tenants. I design isolation as the default, not a patch.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS -->
    <section id="projects" class="px-6 py-24 border-t hairline border">
        <div class="max-w-[1140px] mx-auto">
            <p class="font-mono text-[12px] uppercase tracking-widest text-signal mb-3">[ 02 ] Projects</p>
            <h2 class="font-display font-semibold text-[28px] md:text-[34px] max-w-[620px]">The system this whole site
                is talking about.</h2>

            <div x-data="projectTabs" class="mt-12 glass rounded-2xl overflow-hidden">
                <div class="flex items-center justify-between flex-wrap gap-4 px-7 pt-7">
                    <div>
                        <h3 class="font-display font-medium text-[20px]">Multi-Tenant SaaS Platform</h3>
                        <p class="text-mist text-[13px] mt-1">Enterprise engagement · NDA — architecture described,
                            implementation private</p>
                    </div>
                    <span
                        class="font-mono text-[11px] uppercase tracking-wide px-3 py-1.5 rounded-full hairline border text-mist">Confidential
                        / Production</span>
                </div>

                <div class="flex gap-1 px-7 mt-7 font-mono text-[12px] uppercase tracking-wide overflow-x-auto">
                    <button @click="tab='overview'"
                        :class="tab === 'overview' ? 'text-ink border-trace' : 'text-mist border-transparent'"
                        class="px-4 py-3 border-b-2 transition whitespace-nowrap">Overview</button>
                    <button @click="tab='architecture'"
                        :class="tab === 'architecture' ? 'text-ink border-trace' : 'text-mist border-transparent'"
                        class="px-4 py-3 border-b-2 transition whitespace-nowrap">Architecture</button>
                    <button @click="tab='security'"
                        :class="tab === 'security' ? 'text-ink border-trace' : 'text-mist border-transparent'"
                        class="px-4 py-3 border-b-2 transition whitespace-nowrap">Security</button>
                    <button @click="tab='performance'"
                        :class="tab === 'performance' ? 'text-ink border-trace' : 'text-mist border-transparent'"
                        class="px-4 py-3 border-b-2 transition whitespace-nowrap">Performance</button>
                </div>

                <div class="px-7 py-8 border-t hairline border mt-1">
                    <div x-show="tab==='overview'" x-cloak>
                        <p class="text-mist text-[15px] leading-relaxed max-w-[680px]">A multi-tenant SaaS platform
                            supporting three distinct roles — System Owner, Merchant, and Client — each operating within
                            strictly scoped permissions, data, and workflows. Built to handle onboarding, inventory, and
                            order logic at a structure similar to Shopify's tenancy model.</p>
                    </div>
                    <div x-show="tab==='architecture'" x-cloak class="grid md:grid-cols-2 gap-4">
                        <div class="font-mono text-[13px] text-mist">→ MVC + Service Layer + DTOs</div>
                        <div class="font-mono text-[13px] text-mist">→ Eloquent polymorphic relationships</div>
                        <div class="font-mono text-[13px] text-mist">→ Tenant middleware on every request</div>
                        <div class="font-mono text-[13px] text-mist">→ Dynamic filesystem / cache isolation per tenant
                        </div>
                    </div>
                    <div x-show="tab==='security'" x-cloak class="grid md:grid-cols-2 gap-4">
                        <div class="font-mono text-[13px] text-mist">→ Custom multi-tenant OAuth flow</div>
                        <div class="font-mono text-[13px] text-mist">→ AES-256 token encryption at rest</div>
                        <div class="font-mono text-[13px] text-mist">→ Anti-hijacking session telemetry</div>
                        <div class="font-mono text-[13px] text-mist">→ Tenant-scoped authorization on every query</div>
                    </div>
                    <div x-show="tab==='performance'" x-cloak class="grid md:grid-cols-2 gap-4">
                        <div class="font-mono text-[13px] text-mist">→ Eager loading — zero N+1 by default</div>
                        <div class="font-mono text-[13px] text-mist">→ Cache stampede prevention via jitter</div>
                        <div class="font-mono text-[13px] text-mist">→ Deferrable service providers on cold boot</div>
                        <div class="font-mono text-[13px] text-mist">→ Redis-backed tenant cache partitioning</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STACK -->
    <section id="stack" class="px-6 py-24 border-t hairline border">
        <div class="max-w-[1140px] mx-auto">
            <p class="font-mono text-[12px] uppercase tracking-widest text-trace mb-3">[ 03 ] Stack</p>
            <h2 class="font-display font-semibold text-[28px] md:text-[34px] max-w-[620px]">Tools I reach for, and why.
            </h2>

            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $stack = [
                        ['Laravel 12', 'core framework', 'trace'],
                        ['PHP 8.2+', 'language', 'trace'],
                        ['Redis', 'cache / queues', 'signal'],
                        ['MySQL', 'primary store', 'signal'],
                        ['Tailwind v4', 'styling', 'trace'],
                        ['Alpine.js', 'interactivity', 'trace'],
                        ['Blade', 'templating', 'signal'],
                        ['Filament', 'admin panels', 'signal'],
                    ];
                @endphp
                @foreach ($stack as [$name, $desc, $accent])
                    <div class="glass glow-{{ $accent }} rounded-xl p-5">
                        <p class="font-display font-medium text-[15px]">{{ $name }}</p>
                        <p class="font-mono text-[11px] text-mist mt-1">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="px-6 py-24 border-t hairline border">
        <div class="max-w-[1140px] mx-auto grid md:grid-cols-2 gap-14 items-start">
            <div>
                <p class="font-mono text-[12px] uppercase tracking-widest text-signal mb-3">[ 04 ] Contact</p>
                <h2 class="font-display font-semibold text-[28px] md:text-[34px] max-w-[440px]">Open to remote backend
                    roles and contract work.</h2>
                <p class="text-mist text-[15px] mt-5 leading-relaxed max-w-[440px]">Based in Cairo (UTC+2) —
                    comfortable working hours overlap with European teams. Reply within a day, usually faster.</p>
                <div class="mt-8 flex flex-col gap-3 font-mono text-[13px]">
                    <a href="mailto:0xm4r5h4l@duck.com" class="hover:text-trace transition">0xm4r5h4l@duck.com</a>
                    <a href="https://github.com/0xM4r5h4l"
                        class="hover:text-trace transition">github.com/0xM4r5h4l</a>
                    <a href="https://linkedin.com/in/mustafa-abdelrazek"
                        class="hover:text-trace transition">linkedin.com/in/mustafa-abdelrazek</a>
                </div>
            </div>

            {{--
            Wire this to a real route + Mailable when ready:
            Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        --}}
            {{-- <form method="POST" action="{{ route('contact.store') ?? '#' }}" class="glass rounded-2xl p-7 space-y-5">
            @csrf
            <div>
                <label class="font-mono text-[11px] uppercase tracking-wide text-mist">Name</label>
                <input type="text" name="name" class="mt-2 w-full bg-white/5 hairline border rounded-xl px-4 py-3 text-[14px] focus:outline-none focus:ring-2 focus:ring-trace/40" placeholder="Jane Doe" />
            </div>
            <div>
                <label class="font-mono text-[11px] uppercase tracking-wide text-mist">Email</label>
                <input type="email" name="email" class="mt-2 w-full bg-white/5 hairline border rounded-xl px-4 py-3 text-[14px] focus:outline-none focus:ring-2 focus:ring-trace/40" placeholder="jane@company.com" />
            </div>
            <div>
                <label class="font-mono text-[11px] uppercase tracking-wide text-mist">Message</label>
                <textarea name="message" rows="4" class="mt-2 w-full bg-white/5 hairline border rounded-xl px-4 py-3 text-[14px] focus:outline-none focus:ring-2 focus:ring-trace/40" placeholder="Tell me about the role..."></textarea>
            </div>
            <button type="submit" class="w-full font-mono text-[13px] uppercase tracking-wide bg-[var(--trace)] text-[#06231f] font-medium px-6 py-3 rounded-xl hover:brightness-110 transition">Send message</button>
        </form> --}}
        </div>
    </section>

    <footer class="px-6 py-10 border-t hairline border">
        <div
            class="max-w-[1140px] mx-auto flex flex-col md:flex-row justify-between gap-3 font-mono text-[11px] text-mist">
            <span>© {{ now()->year }} Mostafa Abdelrazek — built with Laravel, Tailwind &amp; Alpine</span>
            <span>Cairo, EG · UTC+2</span>
        </div>
    </footer>

</body>

</html>
