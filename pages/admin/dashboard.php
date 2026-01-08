<?php
session_start();

require_once "../../classes/GuardAuth.php";
require_once "../../config/database.php";
require_once "../../repo/userRepository.php";
require_once "../../repo/TicketRepository.php";
require_once "../../repo/MatchRepository.php";
require_once "../../repo/ReservationRepository.php";

$pdo = Database::getConnection();
$userRepo = new UserRepository($pdo);
$matchRepo = new MatchRepository($pdo);
$ticketRepo = new TicketRepository($pdo);
$reservationRepo = new ReservationRepository($pdo);

GuardAuth::requireRole('administrateur');




?>









<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Admin Dashboard</title>

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
                        purple: { 500: "#7C3AED" },
                        emerald: { 500: "#10B981" },
                        red: { 500: "#EF4444" },
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
        <div class="absolute top-40 -left-32 h-[28rem] w-[28rem] rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="absolute top-16 -right-32 h-[28rem] w-[28rem] rounded-full bg-purple-500/10 blur-3xl"></div>
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
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Matches</a>
                <a class="inline-flex items-center gap-2 hover:text-white transition" href="/buymatch/pages/login.php">
                    <span aria-hidden="true">↗</span> Login
                </a>
                <a
                    class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 hover:bg-brand-600 transition"
                    href="/buymatch/pages/signUp.php"
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
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Matches</a>
                <a class="hover:text-white transition" href="/buymatch/pages/login.php">Login</a>
                <a
                    class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 hover:bg-brand-600 transition"
                    href="/buymatch/pages/signUp.php"
                >Register</a
                >
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-10 md:py-14">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 rounded-full border border-red-500/25 bg-red-500/10 px-3 py-1 text-xs text-red-200">
                <span class="h-2 w-2 rounded-full bg-red-500"></span>
                Admin Panel
            </div>

            <!-- Heading -->
            <h1 class="mt-4 font-display text-4xl md:text-5xl tracking-tight">
                <span class="text-white">Admin </span><span class="text-brand-500">Dashboard</span>
            </h1>
            <p class="mt-2 text-sm text-zinc-400">Platform overview and key metrics.</p>

            <!-- Metrics -->
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <!-- Total Users -->
                <article
                    class="rounded-2xl border border-brand-500/20 bg-gradient-to-b from-brand-500/12 to-white/3 p-5
                     shadow-[0_0_0_1px_rgba(255,122,0,.08),0_22px_55px_rgba(0,0,0,.55)]
                     transition hover:-translate-y-[1px] hover:border-brand-500/30"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-xs text-zinc-300">Total Users</div>
                            <div class="mt-1 font-display text-3xl text-white">
                                <?=
                                $userRepo->countUsers('acheteur')

                                ?>

                            </div>
                            <div class="mt-2 text-xs text-emerald-400">+12% from last month</div>
                        </div>
                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-brand-500/15 ring-1 ring-brand-500/25">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-brand-500">
                                <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2" />
                                <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Organizers -->
                <article
                    class="rounded-2xl border border-purple-500/20 bg-gradient-to-b from-purple-500/14 to-white/3 p-5
                     shadow-[0_0_0_1px_rgba(124,58,237,.08),0_22px_55px_rgba(0,0,0,.55)]
                     transition hover:-translate-y-[1px] hover:border-purple-500/30"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-xs text-zinc-300">Organizers</div>
                            <div class="mt-1 font-display text-3xl text-white"><?=
                                $userRepo->countUsers('organisateur')

                                ?></div>
                            <div class="mt-2 text-xs text-emerald-400">+8% from last month</div>
                        </div>
                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-purple-500/15 ring-1 ring-purple-500/25">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-purple-500">
                                <path d="M16 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2" />
                                <path d="M20 21a7 7 0 0 0-14 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Total Matches -->
                <article
                    class="rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
                     shadow-[0_22px_55px_rgba(0,0,0,.55)]
                     transition hover:-translate-y-[1px] hover:border-white/15"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-xs text-zinc-300">Total Matches</div>
                            <div class="mt-1 font-display text-3xl text-white"><?=
                                $matchRepo->countMatches()
                                ?></div>
                            <div class="mt-2 text-xs text-emerald-400">+15% from last month</div>
                        </div>
                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-brand-500/10 ring-1 ring-white/10">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-brand-500">
                                <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Tickets Sold -->
                <article
                    class="rounded-2xl border border-brand-500/20 bg-gradient-to-b from-brand-500/12 to-white/3 p-5
                     shadow-[0_0_0_1px_rgba(255,122,0,.08),0_22px_55px_rgba(0,0,0,.55)]
                     transition hover:-translate-y-[1px] hover:border-brand-500/30 md:col-span-1"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-xs text-zinc-300">Tickets Sold</div>
                            <div class="mt-1 font-display text-3xl text-white"><?=
                                $ticketRepo->countTickets()
                                ?></div>
                            <div class="mt-2 text-xs text-emerald-400">+23% from last month</div>
                        </div>
                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-brand-500/15 ring-1 ring-brand-500/25">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-brand-500">
                                <path
                                    d="M4 8h16v4a2 2 0 0 1 0 4v4H4v-4a2 2 0 0 0 0-4V8Z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                />
                                <path d="M9 8v12" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Revenue -->
                <article
                    class="rounded-2xl border border-emerald-500/20 bg-gradient-to-b from-emerald-500/14 to-white/3 p-5
                     shadow-[0_0_0_1px_rgba(16,185,129,.08),0_22px_55px_rgba(0,0,0,.55)]
                     transition hover:-translate-y-[1px] hover:border-emerald-500/30 md:col-span-1"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-xs text-zinc-300">Total Revenue</div>
                            <div class="mt-1 font-display text-3xl text-white"><?=
                                $reservationRepo->countTotalEarning()
                                ?></div>
                            <div class="mt-2 text-xs text-emerald-400">+18% from last month</div>
                        </div>
                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-500/15 ring-1 ring-emerald-500/25">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-emerald-500">
                                <path d="M12 1v22" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14.5a3.5 3.5 0 0 1 0 7H7"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Pending Requests -->
                <article
                    class="rounded-2xl border border-red-500/20 bg-gradient-to-b from-red-500/12 to-white/3 p-5
                     shadow-[0_0_0_1px_rgba(239,68,68,.08),0_22px_55px_rgba(0,0,0,.55)]
                     transition hover:-translate-y-[1px] hover:border-red-500/30 md:col-span-1"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-xs text-zinc-300">Pending Requests</div>
                            <div class="mt-1 font-display text-3xl text-white"><?= $matchRepo->countPendingMatches() ?></div>
                            <a href="#" class="mt-2 inline-flex items-center gap-2 text-xs text-red-300 hover:text-red-200 transition">
                                Review Now <span aria-hidden="true">→</span>
                            </a>
                        </div>
                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-red-500/15 ring-1 ring-red-500/25">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-red-500">
                                <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Action panels -->
            <div class="mt-10 grid gap-4 md:grid-cols-2">
                <a
                    href="#"
                    class="group rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6
                     transition hover:-translate-y-[1px] hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.12),0_22px_55px_rgba(0,0,0,.55)]
                     focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                >
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <div class="font-display text-xl text-white">Match Requests</div>
                            <p class="mt-2 text-sm text-zinc-400">
                                Review and approve pending match submissions from organizers.
                            </p>
                        </div>
                        <div class="mt-1 text-brand-500 text-xl transition group-hover:translate-x-1">→</div>
                    </div>
                </a>

                <a
                    href="#"
                    class="group rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6
                     transition hover:-translate-y-[1px] hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.12),0_22px_55px_rgba(0,0,0,.55)]
                     focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                >
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <div class="font-display text-xl text-white">User Management</div>
                            <p class="mt-2 text-sm text-zinc-400">
                                Manage buyers and organizers, enable or disable accounts.
                            </p>
                        </div>
                        <div class="mt-1 text-brand-500 text-xl transition group-hover:translate-x-1">→</div>
                    </div>
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-white/5 bg-zinc-950/50">
            <div class="mx-auto max-w-6xl px-4 py-10">
                <div class="grid gap-8 md:grid-cols-4">
                    <!-- Brand -->
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

<!-- Native JS: menu + badge only -->
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
