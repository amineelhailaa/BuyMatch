<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Landing</title>

    <!-- Fonts (optional, but helps match the screenshot vibe) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Orbitron:wght@500;600;700;800&display=swap"
            rel="stylesheet"
    />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "ui-sans-serif", "system-ui"],
                        display: ["Orbitron", "ui-sans-serif", "system-ui"],
                    },
                    colors: {
                        brand: {
                            500: "#FF7A00",
                            600: "#F36A00",
                        },
                    },
                    boxShadow: {
                        glow: "0 0 0 1px rgba(255,122,0,.25), 0 10px 30px rgba(255,122,0,.12)",
                    },
                },
            },
        };
    </script>

    <style>
        /* Subtle scanline/grain feel (optional) */
        .grain::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 3px 3px;
            opacity: 0.12;
            mix-blend-mode: overlay;
        }
    </style>
</head>

<body class="min-h-screen bg-zinc-950 text-zinc-100 font-sans">
<!-- Background blobs -->
<div class="relative isolate overflow-hidden">
    <div class="absolute inset-0 -z-10">
        <div class="absolute -top-40 left-1/2 h-[36rem] w-[36rem] -translate-x-1/2 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute top-24 -left-24 h-[28rem] w-[28rem] rounded-full bg-emerald-400/10 blur-3xl"></div>
        <div class="absolute top-8 -right-24 h-[28rem] w-[28rem] rounded-full bg-indigo-400/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/40 via-zinc-950 to-zinc-950"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-white/5 bg-zinc-950/70 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-brand-500/15 ring-1 ring-brand-500/30">
              <!-- trophy-ish icon -->
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path
                        d="M8 4h8v3a4 4 0 0 1-8 0V4Z"
                        stroke="currentColor"
                        stroke-width="2"
                        class="text-brand-500"
                />
                <path
                        d="M6 7H4a2 2 0 0 0 2 5h1"
                        stroke="currentColor"
                        stroke-width="2"
                        class="text-brand-500"
                />
                <path
                        d="M18 7h2a2 2 0 0 1-2 5h-1"
                        stroke="currentColor"
                        stroke-width="2"
                        class="text-brand-500"
                />
                <path
                        d="M12 11v3m-4 6h8"
                        stroke="currentColor"
                        stroke-width="2"
                        class="text-brand-500"
                />
                <path
                        d="M10 20v-3h4v3"
                        stroke="currentColor"
                        stroke-width="2"
                        class="text-brand-500"
                />
              </svg>
            </span>

                <span class="flex items-baseline gap-1 font-display tracking-wide">
              <span class="text-white">SPORT</span>
              <span class="text-brand-500">ARENA</span>
            </span>
            </a>

            <!-- Desktop nav -->
            <nav class="hidden items-center gap-8 text-sm text-zinc-300 md:flex">
                <a class="hover:text-white transition" href="#home">Home</a>
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Matches</a>
                <a class="inline-flex items-center gap-2 hover:text-white transition" href="/buymatch/pages/login.php">
                    <span aria-hidden="true">↗</span> Login
                </a>
                <a
                        class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="/buymatch/pages/signUp.php"
                >Register</a
                >
            </nav>

            <!-- Mobile button -->
            <button
                    id="menuBtn"
                    class="md:hidden inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 hover:bg-white/10 transition"
                    aria-label="Open menu"
                    aria-expanded="false"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="md:hidden hidden border-t border-white/5 bg-zinc-950/80 backdrop-blur">
            <div class="mx-auto max-w-6xl px-4 py-4 flex flex-col gap-3 text-sm text-zinc-300">
                <a class="hover:text-white transition" href="#home">Home</a>
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Matches</a>
                <a class="hover:text-white transition" href="/buymatch/pages/login.php">Login</a>
                <a
                        class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="/buymatch/pages/signUp.php"
                >Register</a
                >
            </div>
        </div>
    </header>

    <!-- Hero -->
    <main id="home" class="grain relative">
        <section class="mx-auto max-w-6xl px-4 pt-16 pb-10 md:pt-24 md:pb-14">
            <div class="flex flex-col items-center text-center">
                <!-- Pill -->
                <div
                        class="inline-flex items-center gap-2 rounded-full border border-brand-500/25 bg-brand-500/10 px-4 py-2 text-xs font-semibold text-brand-500"
                >
              <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-brand-500/15 ring-1 ring-brand-500/30">
                <!-- lightning -->
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path
                          d="M13 2 3 14h8l-1 8 11-14h-8l0-6Z"
                          stroke="currentColor"
                          stroke-width="2"
                          class="text-brand-500"
                  />
                </svg>
              </span>
                    The Future of Sports Ticketing
                </div>

                <!-- Headline -->
                <h1 class="mt-8 font-display leading-[0.95] tracking-tight">
              <span class="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white">
                Buy. Watch. Organize.
              </span>
                    <span class="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-brand-500">
                The Future of Sport
              </span>
                    <span class="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white">
                Starts Here.
              </span>
                </h1>

                <!-- Subtext -->
                <p class="mt-6 max-w-2xl text-sm sm:text-base text-zinc-400">
                    Experience the thrill of live sports like never before. Get tickets to the hottest matches, or
                    organize your own events with our powerful platform.
                </p>

                <!-- CTAs -->
                <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                    <a
                            href="/buymatch/pages/matches_page.php"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-brand-500 px-6 py-3 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    >
                        Browse Matches
                        <span class="transition group-hover:translate-x-0.5" aria-hidden="true">›</span>
                    </a>

                    <a
                            href="/buymatch/pages/signUp.php"
                            class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3 font-semibold text-white hover:bg-white/10 transition"
                    >
                        Sign Up Now
                    </a>
                </div>

                <!-- Stats -->
                <div class="mt-12 grid w-full max-w-2xl grid-cols-3 gap-4 sm:gap-8">
                    <div class="text-center">
                        <div class="text-xl sm:text-2xl font-display font-bold text-brand-500 tabular-nums">
                            <span class="counter" data-target="500">0</span><span>+</span>
                        </div>
                        <div class="mt-1 text-xs sm:text-sm text-zinc-400">Events</div>
                    </div>

                    <div class="text-center">
                        <div class="text-xl sm:text-2xl font-display font-bold text-brand-500 tabular-nums">
                            <span class="counter" data-target="1000000">0</span><span>+</span>
                        </div>
                        <div class="mt-1 text-xs sm:text-sm text-zinc-400">Tickets Sold</div>
                    </div>

                    <div class="text-center">
                        <div class="text-xl sm:text-2xl font-display font-bold text-brand-500 tabular-nums">
                            <span class="counter" data-target="50000">0</span><span>+</span>
                        </div>
                        <div class="mt-1 text-xs sm:text-sm text-zinc-400">Happy Fans</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section divider -->
        <div class="mx-auto max-w-6xl px-4">
            <div class="h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        </div>

        <!-- Next section (visible in screenshot) -->
        <section id="matches" class="mx-auto max-w-6xl px-4 py-16 md:py-20">
            <div class="text-center">
                <h2 class="font-display text-3xl md:text-4xl text-white">Everything You Need</h2>
                <p class="mt-4 text-zinc-400 max-w-2xl mx-auto">
                    From buying tickets to organizing events, we’ve got you covered with powerful tools.
                </p>
            </div>

            <!-- Placeholder cards (optional) -->
            <div class="mt-10 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:bg-white/10 transition">
                    <div class="font-semibold text-white">Smart Ticketing</div>
                    <p class="mt-2 text-sm text-zinc-400">Fast checkout, secure orders, and simple refunds.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:bg-white/10 transition">
                    <div class="font-semibold text-white">Live Match Hub</div>
                    <p class="mt-2 text-sm text-zinc-400">Follow fixtures, results, and your favorites in one place.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:bg-white/10 transition">
                    <div class="font-semibold text-white">Event Organizer</div>
                    <p class="mt-2 text-sm text-zinc-400">Create events, manage seating, and track sales.</p>
                </div>
            </div>
        </section>

        <!-- Tiny “Built with ♥” badge -->
        <button
                id="builtWith"
                class="fixed bottom-6 right-6 z-50 rounded-xl border border-white/10 bg-zinc-950/70 px-4 py-2 text-xs text-zinc-200 shadow-lg backdrop-blur hover:bg-zinc-900/70 transition"
                type="button"
        >
            Built with <span aria-hidden="true">♥</span>
            <span class="ml-1 text-brand-500 font-semibold">Tailwind</span>
            <span class="ml-2 text-zinc-400">×</span>
        </button>
    </main>
</div>

<!-- Native JS -->
<script>
    // Mobile menu toggle
    const menuBtn = document.getElementById("menuBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    menuBtn?.addEventListener("click", () => {
        const isOpen = menuBtn.getAttribute("aria-expanded") === "true";
        menuBtn.setAttribute("aria-expanded", String(!isOpen));
        mobileMenu.classList.toggle("hidden");
    });

    // Smooth scroll for in-page anchors
    document.addEventListener("click", (e) => {
        const a = e.target.closest('a[href^="#"]');
        if (!a) return;

        const id = a.getAttribute("href");
        if (!id || id === "#") return;

        const el = document.querySelector(id);
        if (!el) return;

        e.preventDefault();
        el.scrollIntoView({ behavior: "smooth", block: "start" });

        // Close mobile menu after navigation
        if (!mobileMenu.classList.contains("hidden")) {
            mobileMenu.classList.add("hidden");
            menuBtn.setAttribute("aria-expanded", "false");
        }
    });

    // Counter animation (runs when hero enters view)
    function formatNumber(n) {
        // Make 1000000 -> 1,000,000
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function animateCounter(el, target, duration = 900) {
        const start = 0;
        const startTime = performance.now();

        function tick(now) {
            const t = Math.min(1, (now - startTime) / duration);
            // Ease out
            const eased = 1 - Math.pow(1 - t, 3);
            const value = Math.floor(start + (target - start) * eased);
            el.textContent = formatNumber(value);

            if (t < 1) requestAnimationFrame(tick);
            else el.textContent = formatNumber(target);
        }

        requestAnimationFrame(tick);
    }

    const counters = Array.from(document.querySelectorAll(".counter"));
    const counterObserver = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                counters.forEach((c) => {
                    const target = Number(c.dataset.target || "0");
                    animateCounter(c, target, 900);
                });
                obs.disconnect(); // run once
            });
        },
        { threshold: 0.35 }
    );

    const home = document.getElementById("home");
    if (home) counterObserver.observe(home);

    // Built with badge dismiss
    const builtWith = document.getElementById("builtWith");
    builtWith?.addEventListener("click", () => builtWith.remove());
</script>
</body>
</html>
