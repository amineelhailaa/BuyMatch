<?php
require_once "../auth/authentication.php";
require_once "../classes/UploadPic.php";

session_start();


try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//        var_dump($_POST['role'] ?? null);
        $data = $_POST;
        $data['pic'] = UploadPic::uploadPicture($_FILES['pic']);
                if (authentication::signUp($data)) {
                    header("location: login.php");
                    exit();
                }

            echo "error sign up";
        }
} catch (Throwable $exception) {
    echo $exception->getMessage();
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SPORTARENA — Create Account</title>

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
                        brand: {500: "#FF7A00", 600: "#F36A00"}, // user/buyer orange
                        org: {500: "#7C3AED", 600: "#6D28D9"}, // organizer purple
                    },
                    boxShadow: {
                        glow: "0 0 0 1px rgba(255,122,0,.25), 0 18px 50px rgba(255,122,0,.14)",
                        glowOrg: "0 0 0 1px rgba(124,58,237,.28), 0 18px 50px rgba(124,58,237,.16)",
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

<body id="page" class="min-h-screen bg-zinc-950 text-zinc-100 font-sans">
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
                <a class="hover:text-white transition" href="#matches">Matches</a>
                <a class="inline-flex items-center gap-2 hover:text-white transition" href="#login">
                    <span aria-hidden="true">↗</span> Login
                </a>
                <a
                        class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="#register"
                        aria-current="page"
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
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
        </div>

        <div id="mobileMenu" class="md:hidden hidden border-t border-white/5 bg-zinc-950/80 backdrop-blur">
            <div class="mx-auto max-w-6xl px-4 py-4 flex flex-col gap-3 text-sm text-zinc-300">
                <a class="hover:text-white transition" href="#home">Home</a>
                <a class="hover:text-white transition" href="#matches">Matches</a>
                <a class="hover:text-white transition" href="#login">Login</a>
                <a
                        id="navRegisterMobile"
                        class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                        href="#register"
                >Register</a
                >
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-12 md:py-16">
            <div class="mx-auto max-w-md text-center">
                <h1 class="font-display text-3xl md:text-4xl tracking-tight text-white">Create Account</h1>
                <p class="mt-2 text-sm text-zinc-400">Join SportArena and start your journey.</p>
            </div>

            <!-- Card -->
            <div class="mt-8 mx-auto max-w-md">
                <form
                        enctype="multipart/form-data"
                        action="#"
                        method="post"
                        class="rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6 shadow-[0_30px_90px_rgba(0,0,0,.55)]"
                >
                    <!-- Role toggle -->
                    <div class="text-left">
                        <div class="text-xs font-semibold text-white">I want to</div>

                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <!-- Buyer -->
                            <label
                                    class="role-card group relative flex cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border px-4 py-4 outline-none
                           border-brand-500/45 bg-brand-500/10 shadow-[0_0_0_1px_rgba(255,122,0,.12)]
                           transition duration-200
                           hover:-translate-y-[1px] hover:border-brand-500/70 hover:shadow-glow
                           focus:ring-2 focus:ring-brand-500/25"
                                    tabindex="0"
                                    data-role="buyer"
                                    aria-label="Buy tickets"
                            >
                                <input type="radio" name="role" class="sr-only" value="acheteur" checked/>
                                <div class="text-brand-500">
                                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path
                                                d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z"
                                                stroke="currentColor"
                                                stroke-width="2"
                                        />
                                        <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor"
                                              stroke-width="2"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold text-brand-500">Buy Tickets</div>
                                <div class="text-[11px] text-brand-500/80">Browse & purchase</div>

                                <span class="pointer-events-none absolute inset-0 rounded-xl ring-0 ring-brand-500/25 group-has-[:focus-visible]:ring-2"></span>
                            </label>

                            <!-- Organizer -->
                            <label
                                    class="role-card group relative flex cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border px-4 py-4 outline-none
                           border-white/10 bg-white/5
                           transition duration-200
                           hover:-translate-y-[1px] hover:border-org-500/25 hover:bg-white/8 hover:shadow-[0_0_0_1px_rgba(124,58,237,.12),0_22px_55px_rgba(0,0,0,.55)]
                           focus:ring-2 focus:ring-org-500/25"
                                    tabindex="0"
                                    data-role="organizer"
                                    aria-label="Organize events"
                            >
                                <input type="radio" name="role" class="sr-only" value="organisateur"/>
                                <div class="text-zinc-300 group-[.is-selected]:text-org-500 transition">
                                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path
                                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                        />
                                        <path
                                                d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"
                                                stroke="currentColor"
                                                stroke-width="2"
                                        />
                                        <path
                                                d="M22 21v-2a4 4 0 0 0-3-3.87"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                        />
                                        <path
                                                d="M16 3.13a4 4 0 0 1 0 7.75"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                        />
                                    </svg>
                                </div>
                                <div class="text-sm font-semibold text-white transition role-title">Organize Events
                                </div>
                                <div class="text-[11px] text-zinc-400 transition role-sub">Create & manage</div>

                                <span class="pointer-events-none absolute inset-0 rounded-xl ring-0 ring-org-500/25 group-has-[:focus-visible]:ring-2"></span>
                            </label>
                        </div>
                    </div>

                    <!-- Inputs -->
                    <div class="mt-5 space-y-4 text-left">
                        <!-- Full name -->
                        <div>
                            <label for="fullName" class="text-xs font-semibold text-white">Full Name</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12 13a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2"/>
                      </svg>
                    </span>
                                <input
                                        id="fullName"
                                        name="nom"
                                        type="text"
                                        placeholder="Enter your full name"
                                        required
                                        class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500
                             outline-none transition
                             focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                                        data-focus-accent="brand"
                                />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="text-xs font-semibold text-white">Email Address</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                      </svg>
                    </span>
                                <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        placeholder="Enter your email"
                                        required
                                        class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500
                             outline-none transition
                             focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                                        data-focus-accent="brand"
                                />
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="text-xs font-semibold text-white">Password</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round"/>
                        <path d="M6 11h12v10H6V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                      </svg>
                    </span>

                                <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="new-password"
                                        placeholder="Create a strong password"
                                        required
                                        class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-11 text-sm text-white placeholder:text-zinc-500
                             outline-none transition
                             focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                                        data-focus-accent="brand"
                                />

                                <button
                                        id="togglePassword"
                                        type="button"
                                        class="absolute inset-y-0 right-3 inline-flex items-center justify-center rounded-lg px-2 text-zinc-400
                             transition hover:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                        aria-label="Toggle password visibility"
                                        aria-pressed="false"
                                        data-focus-accent="brand"
                                >
                                    <!-- eye -->
                                    <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         aria-hidden="true">
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" stroke="currentColor"
                                              stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor"
                                              stroke-width="2"/>
                                    </svg>
                                    <!-- eye-off -->
                                    <svg id="eyeOffIcon" class="hidden" width="18" height="18" viewBox="0 0 24 24"
                                         fill="none" aria-hidden="true">
                                        <path d="M3 3l18 18" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round"/>
                                        <path d="M10.6 10.6a2.8 2.8 0 0 0 3.8 3.8" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round"/>
                                        <path d="M7.1 7.1C4.1 9 2 12 2 12s3.5 7 10 7c2 0 3.7-.5 5.1-1.2"
                                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M9.9 5.2A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a18 18 0 0 1-2.9 4.1"
                                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Address (USER ONLY) -->
                        <!--                        <div id="addressWrap">-->
                        <!--                            <label for="address" class="text-xs font-semibold text-white">Address</label>-->
                        <!--                            <div class="mt-2 relative">-->
                        <!--                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">-->
                        <!--                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">-->
                        <!--                        <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />-->
                        <!--                        <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />-->
                        <!--                      </svg>-->
                        <!--                    </span>-->
                        <!--                                <input-->
                        <!--                                    id="address"-->
                        <!--                                    name="address"-->
                        <!--                                    type="text"-->
                        <!--                                    placeholder="Enter your address"-->
                        <!--                                    class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500-->
                        <!--                             outline-none transition-->
                        <!--                             focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"-->
                        <!--                                    data-focus-accent="brand"-->
                        <!--                                />-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="text-xs font-semibold text-white">Phone</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                                d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.7.6 2.5a2 2 0 0 1-.5 2.1L8.1 9.4a16 16 0 0 0 6 6l1.1-1.1a2 2 0 0 1 2.1-.5c.8.3 1.6.5 2.5.6A2 2 0 0 1 22 16.9Z"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                                <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        placeholder="Enter your phone"
                                        class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500
                             outline-none transition
                             focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                                        data-focus-accent="brand"
                                />
                            </div>
                        </div>

                        <!-- Profile pic -->
                        <div>
                            <label class="text-xs font-semibold text-white">Profile Picture</label>
                            <div class="mt-2 flex items-center gap-3">
                                <div class="grid h-12 w-12 place-items-center rounded-xl border border-white/10 bg-white/5 text-zinc-400">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M12 13a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor"
                                              stroke-width="2"/>
                                        <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <label
                                        class="flex-1 cursor-pointer rounded-xl border border-white/10 bg-zinc-900/40 px-4 py-3 text-sm text-zinc-300
                             transition hover:bg-zinc-900/55 hover:border-white/15
                             focus-within:ring-2 focus-within:ring-brand-500/15"
                                        id="profileUploadWrap"
                                >
                      <span class="inline-flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"
                             class="text-zinc-400">
                          <path d="M12 16V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                          <path d="M7 9l5-5 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"/>
                          <path d="M20 20H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span id="profileFileLabel" class="text-zinc-400">Upload picture</span>
                      </span>
                                    <input id="profilePic" name="pic" type="file" accept="image/*" class="sr-only"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Organizer-only section -->
                    <div id="organizerSection" class="hidden mt-6 border-t border-white/10 pt-5 text-left">
                        <div id="orgHeader" class="text-sm font-semibold text-org-500">Organization Details</div>

                        <div class="mt-4 space-y-4">
                            <!-- Organization name (required for organizer) -->
                            <div>
                                <label for="orgName" class="text-xs font-semibold text-white">Organization Name</label>
                                <div class="mt-2 relative">
                      <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                          <path d="M3 21h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                          <path d="M7 21V7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v14" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round"/>
                          <path d="M10 9h4M10 13h4M10 17h4" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round"/>
                        </svg>
                      </span>
                                    <input
                                            id="orgName"
                                            name="orgName"
                                            type="text"
                                            placeholder="Enter your organization name"
                                            class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500
                               outline-none transition
                               focus:border-org-500/40 focus:ring-2 focus:ring-org-500/15"
                                            data-focus-accent="org"
                                    />
                                </div>
                            </div>


                            <!-- OPTIONAL: Organization logo (matches your screenshot vibe; remove if you don't want it) -->
                            <div>
                                <label class="text-xs font-semibold text-white">Organization Logo</label>
                                <div class="mt-2 flex items-center gap-3">
                                    <div class="grid h-12 w-12 place-items-center rounded-xl border border-white/10 bg-white/5 text-zinc-400">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M3 21h18" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                            <path d="M7 21V7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v14" stroke="currentColor"
                                                  stroke-width="2" stroke-linejoin="round"/>
                                            <path d="M10 9h4M10 13h4M10 17h4" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </div>

                                    <label
                                            class="flex-1 cursor-pointer rounded-xl border border-white/10 bg-zinc-900/40 px-4 py-3 text-sm text-zinc-300
                               transition hover:bg-zinc-900/55 hover:border-white/15
                               focus-within:ring-2 focus-within:ring-org-500/15"
                                            id="orgUploadWrap"
                                    >
                        <span class="inline-flex items-center gap-2">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"
                               class="text-zinc-400">
                            <path d="M12 16V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M7 9l5-5 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M20 20H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                          </svg>
                          <span id="orgFileLabel" class="text-zinc-400">Upload logo</span>
                        </span>
                                        <input id="orgLogo" name="orgLogo" type="file" accept="image/*"
                                               class="sr-only"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <button
                            id="createBtn"
                            type="submit"
                            class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-brand-500 px-5 py-4
                       text-sm font-semibold text-zinc-950 shadow-glow
                       transition duration-200
                       hover:bg-brand-600 hover:-translate-y-[1px]
                       focus:outline-none focus:ring-2 focus:ring-brand-500/25 active:translate-y-0"
                    >
                        Create Account
                    </button>

                    <p class="mt-5 text-center text-xs text-zinc-400">
                        Already have an account?
                        <a
                                id="signinLink"
                                href="#"
                                class="font-semibold text-brand-500 transition hover:text-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/25 rounded"
                        >Sign in</a
                        >
                    </p>
                </form>
            </div>
        </section>

        <!-- Footer (same style as your login page) -->
        <footer class="border-t border-white/5 bg-zinc-950/50">
            <div class="mx-auto max-w-6xl px-4 py-10">
                <div class="grid gap-8 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-3">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-brand-500/15 ring-1 ring-brand-500/30">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M8 4h8v3a4 4 0 0 1-8 0V4Z" stroke="currentColor" stroke-width="2"
                            class="text-brand-500"/>
                      <path d="M6 7H4a2 2 0 0 0 2 5h1" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
                      <path d="M18 7h2a2 2 0 0 1-2 5h-1" stroke="currentColor" stroke-width="2" class="text-brand-500"/>
                    </svg>
                  </span>
                            <span class="flex items-baseline gap-1 font-display tracking-wide">
                    <span class="text-white">SPORT</span>
                    <span class="text-brand-500">ARENA</span>
                  </span>
                        </div>
                        <p class="mt-4 text-sm text-zinc-400 leading-relaxed">
                            The ultimate platform for sports events. Buy tickets, organize matches, and experience the
                            thrill of live sports.
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
                        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
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
                        <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor"
                              stroke-width="2"/>
                        <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2"/>
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

<!-- Native JS: menu + badge + password toggle + role toggle (no JS rendering) -->
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

    // Password toggle
    const toggleBtn = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const eye = document.getElementById("eyeIcon");
    const eyeOff = document.getElementById("eyeOffIcon");
    toggleBtn?.addEventListener("click", () => {
        const isHidden = password.type === "password";
        password.type = isHidden ? "text" : "password";
        toggleBtn.setAttribute("aria-pressed", String(isHidden));
        eye.classList.toggle("hidden", isHidden);
        eyeOff.classList.toggle("hidden", !isHidden);
        password.focus();
    });

    // File label updates (nice-to-have)
    const profilePic = document.getElementById("profilePic");
    const profileFileLabel = document.getElementById("profileFileLabel");
    profilePic?.addEventListener("change", () => {
        profileFileLabel.textContent = profilePic.files?.[0]?.name || "Upload picture";
    });

    const orgLogo = document.getElementById("orgLogo");
    const orgFileLabel = document.getElementById("orgFileLabel");
    orgLogo?.addEventListener("change", () => {
        orgFileLabel.textContent = orgLogo.files?.[0]?.name || "Upload logo";
    });

    // Role toggle: show/hide + change accent color like screenshots
    const page = document.getElementById("page");
    const roleCards = Array.from(document.querySelectorAll(".role-card"));
    const organizerSection = document.getElementById("organizerSection");
    const addressWrap = document.getElementById("addressWrap");
    const createBtn = document.getElementById("createBtn");
    const signinLink = document.getElementById("signinLink");
    const navRegisterMobile = document.getElementById("navRegisterMobile");
    const profileUploadWrap = document.getElementById("profileUploadWrap");
    const orgUploadWrap = document.getElementById("orgUploadWrap");

    function applyAccent(mode) {
        const isOrg = mode === "organizer";

        // Show/hide fields
        organizerSection.classList.toggle("hidden", !isOrg);
        addressWrap.classList.toggle("hidden", isOrg);

        // Button color
        createBtn.classList.toggle("bg-brand-500", !isOrg);
        createBtn.classList.toggle("hover:bg-brand-600", !isOrg);
        createBtn.classList.toggle("shadow-glow", !isOrg);
        createBtn.classList.toggle("focus:ring-brand-500/25", !isOrg);

        createBtn.classList.toggle("bg-org-500", isOrg);
        createBtn.classList.toggle("hover:bg-org-600", isOrg);
        createBtn.classList.toggle("shadow-glowOrg", isOrg);
        createBtn.classList.toggle("focus:ring-org-500/25", isOrg);

        // Sign-in link accent
        signinLink.classList.toggle("text-brand-500", !isOrg);
        signinLink.classList.toggle("hover:text-brand-600", !isOrg);
        signinLink.classList.toggle("focus:ring-brand-500/25", !isOrg);

        signinLink.classList.toggle("text-org-500", isOrg);
        signinLink.classList.toggle("hover:text-org-600", isOrg);
        signinLink.classList.toggle("focus:ring-org-500/25", isOrg);

        // Mobile register button (optional)
        navRegisterMobile?.classList.toggle("bg-brand-500", !isOrg);
        navRegisterMobile?.classList.toggle("hover:bg-brand-600", !isOrg);
        navRegisterMobile?.classList.toggle("shadow-glow", !isOrg);

        navRegisterMobile?.classList.toggle("bg-org-500", isOrg);
        navRegisterMobile?.classList.toggle("hover:bg-org-600", isOrg);
        navRegisterMobile?.classList.toggle("shadow-glowOrg", isOrg);

        // File upload focus rings
        profileUploadWrap?.classList.toggle("focus-within:ring-brand-500/15", !isOrg);
        profileUploadWrap?.classList.toggle("focus-within:ring-org-500/15", isOrg);

        orgUploadWrap?.classList.toggle("focus-within:ring-org-500/15", isOrg);

        // Inputs focus accent (swap brand <-> org)
        document.querySelectorAll("[data-focus-accent]").forEach((el) => {
            // We only swap class tokens we used in HTML (so it stays simple)
            if (!(el instanceof HTMLElement)) return;

            // For organizer mode, turn brand focus into org focus
            if (isOrg) {
                el.classList.remove("focus:border-brand-500/40", "focus:ring-brand-500/15");
                el.classList.add("focus:border-org-500/40", "focus:ring-org-500/15");
            } else {
                // Back to user mode
                el.classList.remove("focus:border-org-500/40", "focus:ring-org-500/15");
                el.classList.add("focus:border-brand-500/40", "focus:ring-brand-500/15");
            }
        });

        // TogglePassword ring accent
        if (toggleBtn) {
            toggleBtn.classList.toggle("focus:ring-brand-500/25", !isOrg);
            toggleBtn.classList.toggle("focus:ring-org-500/25", isOrg);
        }
    }

    function setSelectedRole(role) {
        roleCards.forEach((card) => {
            const isSelected = card.dataset.role === role;
            const radio = card.querySelector('input[type="radio"]');
            if (radio) radio.checked = isSelected;

            // Selected styling:
            // - buyer: orange highlight
            // - organizer: purple highlight
            const buyerSelected = isSelected && role === "buyer";
            const orgSelected = isSelected && role === "organizer";

            // Reset
            card.classList.remove(
                "border-brand-500/45",
                "bg-brand-500/10",
                "shadow-[0_0_0_1px_rgba(255,122,0,.12)]",
                "border-org-500/45",
                "bg-org-500/10",
                "shadow-[0_0_0_1px_rgba(124,58,237,.14)]"
            );

            // Apply selected
            if (buyerSelected) {
                card.classList.add(
                    "border-brand-500/45",
                    "bg-brand-500/10",
                    "shadow-[0_0_0_1px_rgba(255,122,0,.12)]"
                );
            }
            if (orgSelected) {
                card.classList.add(
                    "border-org-500/45",
                    "bg-org-500/10",
                    "shadow-[0_0_0_1px_rgba(124,58,237,.14)]"
                );
            }

            // Text inside organizer card: make it purple when selected (to match screenshot)
            if (card.dataset.role === "organizer") {
                const title = card.querySelector(".role-title");
                const sub = card.querySelector(".role-sub");
                if (title) {
                    title.classList.toggle("text-org-500", orgSelected);
                    title.classList.toggle("text-white", !orgSelected);
                }
                if (sub) {
                    sub.classList.toggle("text-org-500/80", orgSelected);
                    sub.classList.toggle("text-zinc-400", !orgSelected);
                }
            }
        });

        applyAccent(role === "organizer" ? "organizer" : "buyer");
    }

    // Click + keyboard support
    roleCards.forEach((card) => {
        card.addEventListener("click", () => {
            const role = card.dataset.role || "buyer";
            setSelectedRole(role);
            card.focus();
        });
        card.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                const role = card.dataset.role || "buyer";
                setSelectedRole(role);
                card.focus();
            }
        });
    });

    // Init (buyer default)
    setSelectedRole("buyer");
</script>
</body>
</html>
