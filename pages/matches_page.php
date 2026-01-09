<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once "../config/database.php";
require_once "../repo/userRepository.php";
require_once "../repo/MatchRepository.php";
require_once "../classes/MatchSummary.php";
require_once "../classes/GuardAuth.php";


$repo = new MatchRepository(Database::getConnection());
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SPORTARENA — Match Listings</title>

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

            <nav class="hidden items-center gap-8 text-sm text-zinc-300 md:flex">
                <a class="hover:text-white transition" href="#home">Home</a>
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Matches</a>

                <a class="inline-flex items-center gap-2 hover:text-white transition"
                <?php if(isset($_SESSION['id'])) {
                    echo 'href="/buymatch/pages/editProfile.php"><span aria-hidden="true">↗</span> Edit Profile </a>
<a
                        class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="/buymatch/pages/tickets.php"
                >MyTickets</a
                >';
                }
                else {
                    echo 'href="/buymatch/pages/login.php"><span aria-hidden="true">↗</span> Login </a>
<a
                        class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="/buymatch/pages/signUp.php"
                >Register</a
                >';
                }
                ?>


            </nav>

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
                      <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2"/>
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
                      <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
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
                      <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                  </span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="relative block">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                      <path
                              d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z"
                              stroke="currentColor"
                              stroke-width="2"
                      />
                      <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2"/>
                    </svg>
                  </span>
                            <form method="get">
                            <select name="filter" id="filterDate" onchange="this.form.submit()"
                                    class="w-full appearance-none rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-10 text-sm text-white outline-none transition focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                            >
                                <option value="" >Any Month</option>
                                <?php
                                    $months = $repo->getMonths();
                                    foreach ($months as $month) {
                                        $dateObj = DateTime::createFromFormat('!m', $month);
                                        echo '<option value="' . $month . '">' . $dateObj->format('F') . '</option>';
                                    }
                                ?>
                            </select>
                                <script> document.getElementById('filterDate').value = "<?= $_GET['filter'] ?>"; </script>
                            </form>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                  </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Count (static) -->
            <div class="mt-8 text-sm text-zinc-400">Showing <span class="text-white font-semibold">6</span> matches
            </div>

            <!-- Cards (STATIC HTML) -->
            <div class="mt-5 grid gap-4 md:gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <?php

                $matches = $repo->getMatchesByStatus('validated');
                if(!empty($_GET['filter']))
                {
                    $matches = $repo->getMatchofMonth($_GET['filter']);
                }
                    foreach ($matches as $match):

                ?>
                <article
                        class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-5
         transition duration-200
         hover:-translate-y-1 hover:border-brand-500/25 hover:shadow-[0_0_0_1px_rgba(255,122,0,.18),0_26px_70px_rgba(0,0,0,.55)]
         focus-within:border-brand-500/30"
                >
                    <!-- Banner -->
                    <div class="absolute inset-x-0 top-0 h-28 overflow-hidden">
                        <img
                                src="../uploads/<?= $match->getBanner() ?>"
                                alt=""
                                class="h-full w-full object-cover opacity-70"
                                loading="lazy"
                        />
                        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/40 to-zinc-950"></div>
                    </div>

                    <!-- Hover glow -->
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                        <div class="absolute -top-10 left-1/2 h-32 w-64 -translate-x-1/2 rounded-full bg-brand-500/12 blur-3xl"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 pt-16">
                        <div class="flex items-center justify-between gap-4">
                            <!-- Left team -->
                            <div class="flex flex-col items-center gap-2">
                                <button
                                        type="button"
                                        class="group/logo relative grid h-16 w-16 place-items-center overflow-hidden rounded-full bg-zinc-900/55 ring-1 ring-white/15
                 transition duration-200
                 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                 hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                        aria-label="Team 1 logo"
                                        title="Team 1"
                                >
                                    <img
                                            src="../uploads/<?= $match->getTeam1logo() ?>"
                                            alt=""
                                            class="h-full w-full object-cover"
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.parentElement.querySelector('.fallback1').style.display='grid';"
                                    />
                                    <span class="fallback1 hidden h-full w-full place-items-center font-display text-xs tracking-wide text-zinc-200">
            T1
          </span>

                                    <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
            <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
          </span>
                                </button>

                                <div class="text-xs font-semibold text-white"><?= $match->getTeam1Name() ?></div>
                            </div>

                            <div class="flex flex-col items-center justify-center gap-2">
                                <div class="font-display text-brand-500 text-xl tracking-widest">VS</div>
                            </div>

                            <!-- Right team -->
                            <div class="flex flex-col items-center gap-2">
                                <button
                                        type="button"
                                        class="group/logo relative grid h-16 w-16 place-items-center overflow-hidden rounded-full bg-zinc-900/55 ring-1 ring-white/15
                 transition duration-200
                 hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                 hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                        aria-label="Team 2 logo"
                                        title="Team 2"
                                >
                                    <img
                                            src="../uploads/<?= $match->getTeam2Logo() ?>"
                                            alt=""
                                            class="h-full w-full object-cover"
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.parentElement.querySelector('.fallback2').style.display='grid';"
                                    />
                                    <span class="fallback2 hidden h-full w-full place-items-center font-display text-xs tracking-wide text-zinc-200">
            T2
          </span>

                                    <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
            <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
          </span>
                                </button>

                                <div class="text-xs font-semibold text-white"><?= $match->getTeam2Name() ?></div>
                            </div>
                        </div>

                        <div class="mt-5 space-y-2">
                            <div class="flex items-center gap-2 text-sm text-zinc-400">
        <span class="text-brand-500">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2"/>
            <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2"/>
          </svg>
        </span>
                                <span><?= $match->getDate() ?></span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-zinc-400">
        <span class="text-brand-500">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2"/>
            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"/>
          </svg>
        </span>
                                <span><?= $match->getTime() ?></span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-zinc-400">
        <span class="text-brand-500">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2"/>
            <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2"/>
          </svg>
        </span>
                                <span><?= $match->getLocation() ?></span>
                            </div>
                        </div>
                        <form action="" method="post">
                        <div class="mt-5">

                            <a
                                    href="matchDetail.php?match_id=<?= $match->getMatchId() ?>"
                                    class=" cursor-pointer inline-flex w-full items-center justify-center rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3
               text-sm font-semibold text-brand-500
               transition duration-200
               hover:bg-brand-500 hover:text-zinc-950 hover:shadow-glow hover:-translate-y-[1px]
               focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                            >
                                See Details
                            </a>
                        </div>
                        </form>
                    </div>
                </article>

                <?php
                endforeach;
                ?>
            </div>
        </section>

        <!-- Built with badge -->

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
