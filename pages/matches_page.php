<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Match Listings</title>

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
        <div class="absolute -top-44 left-1/2 h-[40rem] w-[40rem] -translate-x-1/2 rounded-full bg-brand-500/18 blur-3xl"></div>
        <div class="absolute top-40 -left-32 h-[28rem] w-[28rem] rounded-full bg-emerald-400/10 blur-3xl"></div>
        <div class="absolute top-16 -right-32 h-[28rem] w-[28rem] rounded-full bg-indigo-400/10 blur-3xl"></div>
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
                <path d="M12 11v3m-4 6h8" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                <path d="M10 20v-3h4v3" stroke="currentColor" stroke-width="2" class="text-brand-500" />
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
                <a
                    class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    href="#register"
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

    <!-- Page -->
    <main id="matches" class="grain relative">
        <section class="mx-auto max-w-6xl px-4 pt-10 pb-16 md:pt-14 md:pb-20">
            <!-- Title -->
            <div>
                <h1 class="font-display text-3xl sm:text-4xl md:text-5xl tracking-tight">
                    <span class="text-white">Match </span><span class="text-brand-500">Listings</span>
                </h1>
                <p class="mt-2 text-sm sm:text-base text-zinc-400">
                    Find and book tickets for upcoming sports events.
                </p>
            </div>

            <!-- Filters (static UI only) -->
            <div class="mt-8 rounded-2xl border border-white/10 bg-white/5 p-4 md:p-5">
                <div class="grid gap-3 md:grid-cols-12">
                    <div class="md:col-span-6">
                        <label class="relative block">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path
                          d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                      />
                    </svg>
                  </span>
                            <input
                                class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500 outline-none transition focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                                placeholder="Search teams, stadiums..."
                                autocomplete="off"
                            />
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="relative block">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path
                          d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z"
                          stroke="currentColor"
                          stroke-width="2"
                      />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <select
                                class="w-full appearance-none rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-10 text-sm text-white outline-none transition focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                            >
                                <option>All Cities</option>
                                <option>Madrid</option>
                                <option>Manchester</option>
                                <option>Paris</option>
                                <option>Milan</option>
                                <option>Turin</option>
                                <option>London</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                  </span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="relative block">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path
                          d="M4 5h16l-6 7v6l-4 1v-7L4 5Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linejoin="round"
                      />
                    </svg>
                  </span>
                            <select
                                class="w-full appearance-none rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-10 text-sm text-white outline-none transition focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                            >
                                <option>All Categories</option>
                                <option>Football</option>
                                <option>Basketball</option>
                                <option>Tennis</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                  </span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="relative block">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path
                          d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z"
                          stroke="currentColor"
                          stroke-width="2"
                      />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <select
                                class="w-full appearance-none rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-10 text-sm text-white outline-none transition focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                            >
                                <option>Any Date</option>
                                <option>January 2025</option>
                                <option>February 2025</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                  </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Count (static) -->
            <div class="mt-8 text-sm text-zinc-400">Showing <span class="text-white font-semibold">6</span> matches</div>

            <!-- Cards (STATIC HTML) -->
            <div class="mt-5 grid gap-4 md:gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Card 1 -->
                <article
                    class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     transition duration-200
                     hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]
                     focus-within:border-brand-500/30"
                >
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <!-- Left team -->
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200
                           hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Real Madrid logo"
                                title="Real Madrid"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">RM</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Real Madrid</div>
                        </div>

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                        </div>

                        <!-- Right team -->
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200
                           hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Barcelona logo"
                                title="Barcelona"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">FCB</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Barcelona</div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>January 15, 2025</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                            <span>20:00</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>Santiago Bernabéu Stadium</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5">
                        <a
                            href="#"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
                         text-sm font-semibold text-brand-500
                         transition duration-200
                         hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
                         focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                            See Details
                        </a>
                    </div>
                </article>

                <!-- Card 2 (LIVE) -->
                <article
                    class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     transition duration-200
                     hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]"
                >
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <div
                        class="absolute top-4 right-4 inline-flex items-center gap-2 rounded-full border border-red-500/25 bg-red-500/10 px-3 py-1 text-[11px] font-semibold text-red-300"
                    >
                        <span class="h-2 w-2 rounded-full bg-red-500 animate-pulse"></span> LIVE
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200
                           hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Man United logo"
                                title="Man United"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">MU</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Man United</div>
                        </div>

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200
                           hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Liverpool logo"
                                title="Liverpool"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">LIV</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Liverpool</div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 space-y-2">
                        <!-- date -->
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>January 18, 2025</span>
                        </div>
                        <!-- time -->
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                            <span>17:30</span>
                        </div>
                        <!-- stadium -->
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>Old Trafford</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5">
                        <a
                            href="#"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
                         text-sm font-semibold text-brand-500
                         transition duration-200
                         hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
                         focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                            See Details
                        </a>
                    </div>
                </article>

                <!-- Card 3 -->
                <!-- Copy/paste this structure for the remaining 4 cards and just change names/details.
                     I kept the file size reasonable, but the pattern is identical. -->

                <!-- Card 3 (PSG vs Bayern) -->
                <article
                    class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     transition duration-200
                     hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]"
                >
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="PSG logo"
                                title="PSG"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">PSG</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">PSG</div>
                        </div>

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Bayern Munich logo"
                                title="Bayern Munich"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">FCB</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Bayern Munich</div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>January 22, 2025</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                            <span>21:00</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>Parc des Princes</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5">
                        <a
                            href="#"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
                         text-sm font-semibold text-brand-500 transition duration-200
                         hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
                         focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                            See Details
                        </a>
                    </div>
                </article>

                <!-- Card 4 (AC Milan vs Inter) -->
                <article
                    class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     transition duration-200
                     hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]"
                >
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="AC Milan logo"
                                title="AC Milan"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">ACM</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">AC Milan</div>
                        </div>

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Inter Milan logo"
                                title="Inter Milan"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">INT</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Inter Milan</div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>January 25, 2025</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                            <span>18:00</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>San Siro</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5">
                        <a
                            href="#"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
                         text-sm font-semibold text-brand-500 transition duration-200
                         hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
                         focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                            See Details
                        </a>
                    </div>
                </article>

                <!-- Card 5 (Juventus vs Napoli) -->
                <article
                    class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     transition duration-200
                     hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]"
                >
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Juventus logo"
                                title="Juventus"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">JUV</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Juventus</div>
                        </div>

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Napoli logo"
                                title="Napoli"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">NAP</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Napoli</div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>January 28, 2025</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                            <span>20:45</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>Allianz Stadium</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5">
                        <a
                            href="#"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
                         text-sm font-semibold text-brand-500 transition duration-200
                         hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
                         focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                            See Details
                        </a>
                    </div>
                </article>

                <!-- Card 6 (Chelsea vs Arsenal) -->
                <article
                    class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     transition duration-200
                     hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]"
                >
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Chelsea logo"
                                title="Chelsea"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">CFC</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Chelsea</div>
                        </div>

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <button
                                type="button"
                                class="group/logo relative grid h-16 w-16 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Arsenal logo"
                                title="Arsenal"
                            >
                                <span class="font-display text-xs tracking-wide text-zinc-200">AFC</span>
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                    </span>
                            </button>
                            <div class="text-xs font-semibold text-white">Arsenal</div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>February 1, 2025</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                            <span>16:00</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            <span>Stamford Bridge</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5">
                        <a
                            href="#"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
                         text-sm font-semibold text-brand-500 transition duration-200
                         hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
                         focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                            See Details
                        </a>
                    </div>
                </article>
            </div>
        </section>

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

<!-- Native JS (only for menu + badge; cards are static) -->
<script>
    const menuBtn = document.getElementById("menuBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    menuBtn?.addEventListener("click", () => {
        const isOpen = menuBtn.getAttribute("aria-expanded") === "true";
        menuBtn.setAttribute("aria-expanded", String(!isOpen));
        mobileMenu.classList.toggle("hidden");
    });

    document.getElementById("builtWith")?.addEventListener("click", (e) => e.currentTarget.remove());
</script>
</body>
</html>
