<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Create New Event</title>

    <!-- Fonts -->
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
                        brand: { 500: "#FF7A00", 600: "#F36A00" },
                        purple: { 500: "#7C3AED", 600: "#6D28D9" },
                        ok: { 500: "#22C55E" },
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
<div class="relative isolate overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute -top-44 left-1/2 h-[40rem] w-[40rem] -translate-x-1/2 rounded-full bg-brand-500/16 blur-3xl"></div>
        <div class="absolute top-40 -left-32 h-[28rem] w-[28rem] rounded-full bg-emerald-400/10 blur-3xl"></div>
        <div class="absolute top-16 -right-32 h-[28rem] w-[28rem] rounded-full bg-purple-500/12 blur-3xl"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/30 via-zinc-950 to-zinc-950"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-white/5 bg-zinc-950/70 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="#" class="flex items-center gap-3">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-brand-500/15 ring-1 ring-brand-500/30">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M8 4h8v3a4 4 0 0 1-8 0V4Z" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                <path d="M6 7H4a2 2 0 0 0 2 5h1" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                <path d="M18 7h2a2 2 0 0 1-2 5h-1" stroke="currentColor" stroke-width="2" class="text-brand-500" />
              </svg>
            </span>
                <span class="flex items-baseline gap-1 font-display tracking-wide">
              <span class="text-white">SPORT</span>
              <span class="text-brand-500">ARENA</span>
            </span>
            </a>

            <nav class="hidden items-center gap-8 text-sm text-zinc-300 md:flex">
                <a class="hover:text-white transition" href="#home">Home</a>
                <a class="hover:text-white transition" href="#matches">Matches</a>
                <a class="inline-flex items-center gap-2 hover:text-white transition" href="#login">
                    <span aria-hidden="true">↗</span> Login
                </a>
                <a class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition" href="#register"
                >Register</a
                >
            </nav>

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

        <div id="mobileMenu" class="md:hidden hidden border-t border-white/5 bg-zinc-950/80 backdrop-blur">
            <div class="mx-auto max-w-6xl px-4 py-4 flex flex-col gap-3 text-sm text-zinc-300">
                <a class="hover:text-white transition" href="#home">Home</a>
                <a class="hover:text-white transition" href="#matches">Matches</a>
                <a class="hover:text-white transition" href="#login">Login</a>
                <a
                    class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    href="#register"
                >Register</a
                >
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-10 md:py-14">
            <a
                href="#"
                class="inline-flex items-center gap-2 text-sm text-zinc-300 transition hover:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/25 rounded-lg px-2 py-1"
            >
                <span class="text-zinc-400" aria-hidden="true">←</span>
                Back to Dashboard
            </a>

            <div class="mt-6 text-center">
                <h1 class="font-display text-4xl md:text-5xl tracking-tight">
                    <span class="text-white">Create </span><span class="text-brand-500">New Event</span>
                </h1>
                <p class="mt-2 text-sm text-zinc-400">Set up your match details and start selling tickets.</p>
            </div>

            <div class="mt-8 flex justify-center">
                <form
                    class="w-full max-w-xl rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3
                     shadow-[0_22px_55px_rgba(0,0,0,.55)]"
                >
                    <div class="p-6">
                        <!-- TEAMS -->
                        <div class="flex items-center gap-2">
                  <span class="text-brand-500" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <h2 class="font-display text-lg">Teams</h2>
                        </div>
                        <div class="mt-3 h-px w-full bg-white/10"></div>

                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            <!-- Team A -->
                            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                <div class="text-xs font-semibold text-zinc-200">Team A</div>

                                <label class="mt-3 block text-[11px] font-semibold text-zinc-300">Team Name</label>
                                <input
                                    class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white placeholder:text-zinc-500
                             outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                    placeholder="Enter team name"
                                    type="text"
                                />

                                <label class="mt-4 block text-[11px] font-semibold text-zinc-300">Team Logo</label>
                                <div class="mt-2 flex items-center gap-3">
                                    <div class="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-zinc-900/35 text-zinc-400">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 21s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <label
                                        class="flex-1 cursor-pointer rounded-xl border border-white/10 bg-zinc-900/25 px-3 py-2 text-xs text-zinc-300 hover:bg-zinc-900/35 transition"
                                    >
                        <span class="inline-flex items-center gap-2">
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 16V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M8 8l4-4 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 20h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                          </svg>
                          Upload
                        </span>
                                        <input class="hidden" type="file" />
                                    </label>
                                </div>
                            </div>

                            <!-- Team B -->
                            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                <div class="text-xs font-semibold text-zinc-200">Team B</div>

                                <label class="mt-3 block text-[11px] font-semibold text-zinc-300">Team Name</label>
                                <input
                                    class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white placeholder:text-zinc-500
                             outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                    placeholder="Enter team name"
                                    type="text"
                                />

                                <label class="mt-4 block text-[11px] font-semibold text-zinc-300">Team Logo</label>
                                <div class="mt-2 flex items-center gap-3">
                                    <div class="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-zinc-900/35 text-zinc-400">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 21s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <label
                                        class="flex-1 cursor-pointer rounded-xl border border-white/10 bg-zinc-900/25 px-3 py-2 text-xs text-zinc-300 hover:bg-zinc-900/35 transition"
                                    >
                        <span class="inline-flex items-center gap-2">
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 16V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M8 8l4-4 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 20h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                          </svg>
                          Upload
                        </span>
                                        <input class="hidden" type="file" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- MATCH BANNER -->
                        <div class="mt-6">
                            <div class="flex items-center gap-2">
                    <span class="text-brand-500" aria-hidden="true">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14" stroke="currentColor" stroke-width="2" />
                        <path d="M3 16l5-5 4 4 3-3 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      </svg>
                    </span>
                                <h2 class="font-display text-lg">Match Banner</h2>
                            </div>
                            <div class="mt-3 h-px w-full bg-white/10"></div>

                            <div class="mt-4 rounded-xl border border-white/10 bg-zinc-900/25 p-6">
                                <div class="grid place-items-center rounded-xl border border-dashed border-white/15 bg-white/5 py-10 text-center">
                                    <div class="grid h-10 w-10 place-items-center rounded-xl bg-white/5 ring-1 ring-white/10 text-zinc-400">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14" stroke="currentColor" stroke-width="2" />
                                            <path d="M3 16l5-5 4 4 3-3 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <p class="mt-3 text-xs text-zinc-400">Upload match banner (1200×400)</p>
                                </div>

                                <label
                                    class="mt-4 inline-flex cursor-pointer items-center gap-2 rounded-xl border border-white/10 bg-zinc-900/25 px-4 py-2 text-xs text-zinc-300 hover:bg-zinc-900/35 transition"
                                >
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M12 16V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <path d="M8 8l4-4 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4 20h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    Choose File
                                    <input class="hidden" type="file" />
                                </label>
                            </div>
                        </div>

                        <!-- MATCH DETAILS (NO duration input) -->
                        <div class="mt-6">
                            <div class="flex items-center gap-2">
                    <span class="text-brand-500" aria-hidden="true">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <h2 class="font-display text-lg">Match Details</h2>
                            </div>
                            <div class="mt-3 h-px w-full bg-white/10"></div>

                            <div class="mt-4 grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-[11px] font-semibold text-zinc-300">Date</label>
                                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                          </svg>
                        </span>
                                        <input
                                            type="text"
                                            placeholder="mm/dd/yyyy"
                                            class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-10 pr-3 text-sm text-white placeholder:text-zinc-500
                                 outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-semibold text-zinc-300">Time</label>
                                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 7v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M12 22a10 10 0 1 0-10-10 10 10 0 0 0 10 10Z" stroke="currentColor" stroke-width="2" />
                          </svg>
                        </span>
                                        <input
                                            type="text"
                                            placeholder="--:--"
                                            class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-10 pr-3 text-sm text-white placeholder:text-zinc-500
                                 outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                        />
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-[11px] font-semibold text-zinc-300">Stadium / Location</label>
                                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                            <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                          </svg>
                        </span>
                                        <input
                                            type="text"
                                            placeholder="Enter venue name"
                                            class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-10 pr-3 text-sm text-white placeholder:text-zinc-500
                                 outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-semibold text-zinc-300">Max Seats (max 2000)</label>
                                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M16 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2" />
                            <path d="M20 21a7 7 0 0 0-14 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                          </svg>
                        </span>
                                        <input
                                            type="number"
                                            value="2000"
                                            class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-10 pr-3 text-sm text-white placeholder:text-zinc-500
                                 outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-semibold text-zinc-300">Organizer Note (optional)</label>
                                    <input
                                        type="text"
                                        placeholder="e.g. Doors open at 18:30"
                                        class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white placeholder:text-zinc-500
                               outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- TICKET CATEGORIES (add seats max per category) -->
                        <div class="mt-6">
                            <div class="flex items-center gap-2">
                    <span class="text-brand-500" aria-hidden="true">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M4 8h16v4a2 2 0 0 1 0 4v4H4v-4a2 2 0 0 0 0-4V8Z"
                            stroke="currentColor"
                            stroke-width="2"
                        />
                        <path d="M9 8v12" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <h2 class="font-display text-lg">Ticket Categories</h2>
                            </div>
                            <div class="mt-3 h-px w-full bg-white/10"></div>

                            <div class="mt-4 space-y-4">
                                <!-- Category 1 -->
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs font-semibold text-brand-500">Category 1</div>

                                    <div class="mt-3 grid gap-3 md:grid-cols-3">
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Name</label>
                                            <input
                                                type="text"
                                                placeholder="e.g., Normal"
                                                class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white placeholder:text-zinc-500
                                   outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                            />
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Price ($)</label>
                                            <div class="relative mt-2">
                                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">$</span>
                                                <input
                                                    type="number"
                                                    value="50"
                                                    class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-8 pr-3 text-sm text-white
                                     outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                                />
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Seats Max</label>
                                            <input
                                                type="number"
                                                value="500"
                                                class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white
                                   outline-none transition focus:border-brand-500/40 focus:ring-4 focus:ring-brand-500/10"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Category 2 -->
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs font-semibold text-purple-500">Category 2</div>

                                    <div class="mt-3 grid gap-3 md:grid-cols-3">
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Name</label>
                                            <input
                                                type="text"
                                                placeholder="e.g., Premium"
                                                class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white placeholder:text-zinc-500
                                   outline-none transition focus:border-purple-500/40 focus:ring-4 focus:ring-purple-500/10"
                                            />
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Price ($)</label>
                                            <div class="relative mt-2">
                                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">$</span>
                                                <input
                                                    type="number"
                                                    value="120"
                                                    class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-8 pr-3 text-sm text-white
                                     outline-none transition focus:border-purple-500/40 focus:ring-4 focus:ring-purple-500/10"
                                                />
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Seats Max</label>
                                            <input
                                                type="number"
                                                value="200"
                                                class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white
                                   outline-none transition focus:border-purple-500/40 focus:ring-4 focus:ring-purple-500/10"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Category 3 -->
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs font-semibold text-emerald-400">Category 3</div>

                                    <div class="mt-3 grid gap-3 md:grid-cols-3">
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Name</label>
                                            <input
                                                type="text"
                                                placeholder="e.g., VIP"
                                                class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white placeholder:text-zinc-500
                                   outline-none transition focus:border-emerald-400/40 focus:ring-4 focus:ring-emerald-400/10"
                                            />
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Price ($)</label>
                                            <div class="relative mt-2">
                                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">$</span>
                                                <input
                                                    type="number"
                                                    value="250"
                                                    class="w-full rounded-xl border border-white/10 bg-zinc-900/35 py-2 pl-8 pr-3 text-sm text-white
                                     outline-none transition focus:border-emerald-400/40 focus:ring-4 focus:ring-emerald-400/10"
                                                />
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-zinc-300">Seats Max</label>
                                            <input
                                                type="number"
                                                value="50"
                                                class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/35 px-3 py-2 text-sm text-white
                                   outline-none transition focus:border-emerald-400/40 focus:ring-4 focus:ring-emerald-400/10"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="p-6 pt-0">
                        <button
                            type="button"
                            class="w-full rounded-xl bg-purple-500 px-5 py-3 text-sm font-semibold text-white
                         shadow-[0_0_0_1px_rgba(124,58,237,.25),0_18px_50px_rgba(124,58,237,.14)]
                         transition hover:bg-purple-600 focus:outline-none focus:ring-4 focus:ring-purple-500/20"
                        >
                            Submit for Approval
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-white/5 bg-zinc-950/50">
            <div class="mx-auto max-w-6xl px-4 py-10">
                <div class="grid gap-8 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-3">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-brand-500/15 ring-1 ring-brand-500/30">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M8 4h8v3a4 4 0 0 1-8 0V4Z" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                      <path d="M6 7H4a2 2 0 0 0 2 5h1" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                      <path d="M18 7h2a2 2 0 0 1-2 5h-1" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                    </svg>
                  </span>
                            <span class="flex items-baseline gap-1 font-display tracking-wide">
                    <span class="text-white">SPORT</span>
                    <span class="text-brand-500">ARENA</span>
                  </span>
                        </div>
                        <p class="mt-4 text-sm text-zinc-400 leading-relaxed">
                            The ultimate platform for sports events. Buy tickets, organize matches, and experience the thrill of live sports.
                        </p>
                    </div>

                    <div>
                        <h3 class="font-display text-lg text-white">Quick Links</h3>
                        <ul class="mt-4 space-y-2 text-sm text-zinc-400">
                            <li><a class="hover:text-white transition" href="#">Browse Matches</a></li>
                            <li><a class="hover:text-white transition" href="#">Become an Organizer</a></li>
                            <li><a class="hover:text-white transition" href="#">My Tickets</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-display text-lg text-white">Support</h3>
                        <ul class="mt-4 space-y-2 text-sm text-zinc-400">
                            <li><a class="hover:text-white transition" href="#">Help Center</a></li>
                            <li><a class="hover:text-white transition" href="#">Terms of Service</a></li>
                            <li><a class="hover:text-white transition" href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-display text-lg text-white">Contact</h3>
                        <ul class="mt-4 space-y-3 text-sm text-zinc-400">
                            <li class="flex items-center gap-3">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2" />
                        <path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      </svg>
                    </span>
                                support@sportarena.com
                            </li>
                            <li class="flex items-center gap-3">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.7.6 2.5a2 2 0 0 1-.5 2.1L8.1 9.4a16 16 0 0 0 6 6l1.1-1.1a2 2 0 0 1 2.1-.5c.8.3 1.6.5 2.5.6A2 2 0 0 1 22 16.9Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                                +1 (555) 123-4567
                            </li>
                            <li class="flex items-center gap-3">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                        <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                123 Stadium Way, Sports City
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-10 border-t border-white/5 pt-6 text-center text-xs text-zinc-500">
                    © 2025 SportArena. All rights reserved.
                </div>
            </div>
        </footer>

        <!-- Built with badge -->
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
</script>
</body>
</html>
