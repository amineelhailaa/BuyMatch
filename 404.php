<?php


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SPORTARENA — 404</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
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
                        brand: {500: "#FF7A00", 600: "#F36A00"},
                        org: {500: "#7C3AED", 600: "#6D28D9"},
                    },
                    boxShadow: {
                        glow: "0 0 0 1px rgba(255,122,0,.25), 0 18px 50px rgba(255,122,0,.14)",
                    },
                },
            },
        };
    </script>

    <style>
        .grain::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 3px 3px;
            opacity: 0.11;
            mix-blend-mode: overlay;
        }
    </style>
</head>

<body class="min-h-screen bg-zinc-950 text-zinc-100 font-sans">
<div class="relative isolate overflow-hidden min-h-screen">
    <!-- Background -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute -top-44 left-1/2 h-[40rem] w-[40rem] -translate-x-1/2 rounded-full bg-brand-500/18 blur-3xl"></div>
        <div class="absolute top-40 -left-32 h-[28rem] w-[28rem] rounded-full bg-emerald-400/10 blur-3xl"></div>
        <div class="absolute top-16 -right-32 h-[28rem] w-[28rem] rounded-full bg-indigo-400/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/30 via-zinc-950 to-zinc-950"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-white/5 bg-zinc-950/70 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="index.html" class="flex items-center gap-3">
          <span class="grid h-9 w-9 place-items-center rounded-lg bg-brand-500/15 ring-1 ring-brand-500/30">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M8 4h8v3a4 4 0 0 1-8 0V4Z" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
              <path d="M6 7H4a2 2 0 0 0 2 5h1" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
              <path d="M18 7h2a2 2 0 0 1-2 5h-1" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
              <path d="M12 11v3m-4 6h8" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
              <path d="M10 20v-3h4v3" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
            </svg>
          </span>
                <span class="flex items-baseline gap-1 font-display tracking-wide">
            <span class="text-white">SPORT</span>
            <span class="text-brand-500">ARENA</span>
          </span>
            </a>


            <button
                    id="menuBtn"
                    class="md:hidden inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 hover:bg-white/10 transition"
                    aria-label="Open menu"
                    aria-expanded="false"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
        </div>

        <div id="mobileMenu" class="md:hidden hidden border-t border-white/5 bg-zinc-950/80 backdrop-blur">
            <div class="mx-auto max-w-6xl px-4 py-4 flex flex-col gap-3 text-sm text-zinc-300">
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Home</a>
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Matches</a>
                <a
                        class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="register.html"
                >Register</a>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-12 md:py-16">
            <div class="mx-auto max-w-2xl">
                <div class="rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-7 md:p-10 shadow-[0_30px_90px_rgba(0,0,0,.55)]">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 rounded-full border border-brand-500/30 bg-brand-500/10 px-3 py-1 text-xs font-semibold text-brand-500">
              <span class="grid h-5 w-5 place-items-center rounded-full bg-brand-500/15 ring-1 ring-brand-500/25">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M12 9v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M12 17h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M10.3 3.6 2.3 17.4A2 2 0 0 0 4 20h16a2 2 0 0 0 1.7-2.6L13.7 3.6a2 2 0 0 0-3.4 0Z"
                        stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
              </span>
                        Page Not Found
                    </div>

                    <div class="mt-6 grid gap-8 md:grid-cols-[1.2fr_.8fr] md:items-center">
                        <!-- Text -->
                        <div>
                            <h1 class="font-display text-4xl md:text-5xl tracking-tight">
                                <span class="text-white">Error</span>
                                <span class="text-brand-500"> 404</span>
                            </h1>

                            <p class="mt-3 text-sm md:text-base text-zinc-400 leading-relaxed">
                                The page you’re looking for doesn’t exist (or got tackled by the void).
                                Check the URL, or jump back to somewhere safer.
                            </p>

                            <!-- Actions -->
                            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
                                <a
                                        href="/buymatch/pages/matches_page.php"
                                        class="inline-flex items-center justify-center rounded-xl bg-brand-500 px-5 py-3 text-sm font-semibold text-zinc-950 shadow-glow
                           transition hover:bg-brand-600 hover:-translate-y-[1px] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                >
                                    <span class="mr-2">←</span> Back to Home
                                </a>

                                <a
                                        href="/buymatch/pages/matches_page.php"
                                        class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white
                           transition hover:bg-white/10 hover:border-white/15 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                >
                                    Browse Matches
                                </a>


                            </div>

                            <div class="mt-5 text-xs text-zinc-500">
                                Tip: use the navigation above to keep exploring.
                            </div>
                        </div>

                        <!-- Visual -->
                        <div class="relative">
                            <div class="absolute -inset-6 rounded-3xl bg-brand-500/10 blur-2xl"></div>
                            <div class="relative rounded-2xl border border-white/10 bg-zinc-950/40 p-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-xs font-semibold text-zinc-300">SPORTARENA</div>
                                    <div class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-[11px] text-zinc-400">
                                        System
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center gap-4">
                                    <div class="grid h-12 w-12 place-items-center rounded-xl bg-brand-500/15 ring-1 ring-brand-500/25">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"
                                             class="text-brand-500">
                                            <path d="M12 2l1.8 5.4L19 9l-5.2 1.6L12 16l-1.8-5.4L5 9l5.2-1.6L12 2Z"
                                                  stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                            <path d="M5 22h14" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-display text-xl text-white">Lost in the Arena</div>
                                        <div class="mt-1 text-xs text-zinc-400">No route to this endpoint.</div>
                                    </div>
                                </div>

                                <div class="mt-6 space-y-3">
                                    <div class="h-2 w-full rounded-full bg-white/5 overflow-hidden">
                                        <div class="h-full w-[62%] bg-brand-500/70"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2 text-[11px] text-zinc-500">
                                        <div class="rounded-lg border border-white/10 bg-white/5 px-2 py-2 text-center">
                                            Home
                                        </div>
                                        <div class="rounded-lg border border-white/10 bg-white/5 px-2 py-2 text-center">
                                            Matches
                                        </div>
                                        <div class="rounded-lg border border-white/10 bg-white/5 px-2 py-2 text-center">
                                            Account
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-zinc-400">
                                    <span class="text-brand-500 font-semibold">Hint:</span>
                                    The URL may be wrong, or the page was removed.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini footer line -->
                <div class="mt-10 text-center text-xs text-zinc-500">
                    © 2025 SportArena. All rights reserved.
                </div>
            </div>
        </section>

        <!-- Built with badge -->

    </main>
</div>

<!-- Native JS -->
<script>
    // Mobile menu
    const menuBtn = document.getElementById("menuBtn");
    const mobileMenu = document.getElementById("mobileMenu");
    menuBtn?.addEventListener("click", () => {
        const isOpen = menuBtn.getAttribute("aria-expanded") === "true";
        menuBtn.setAttribute("aria-expanded", String(!isOpen));
        mobileMenu.classList.toggle("hidden");
    });

    // Dismiss badge
    document.getElementById("builtWith")?.addEventListener("click", (e) => e.currentTarget.remove());

    // Go back (history)
    document.getElementById("goBackBtn")?.addEventListener("click", () => {
        if (history.length > 1) history.back();
        else window.location.href = "index.html";
    });
</script>
</body>
</html>
