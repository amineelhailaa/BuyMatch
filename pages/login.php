<?php
session_start();
require_once "../auth/authentication.php";

if(isset($_SESSION['id'])){
    header("location: ../index.php"); //to fix after
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $error= null;
    if(authentication::login($_POST["email"], $_POST["password"])){
        header("location: ");//still need header
        exit();
    }

    else{
        $error = "Wrong email or password"; //need to show it after
    }
}
?>








<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Login</title>

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
                <a class="inline-flex items-center gap-2 text-white" href="#login">
                    <span aria-hidden="true">↗</span> Login
                </a>
                <a
                    class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    href="signUp.php"
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
        <section class="mx-auto max-w-6xl px-4 py-12 md:py-16">
            <div class="mx-auto max-w-md text-center">
                <!-- Icon -->
                <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-brand-500/10 ring-1 ring-brand-500/25">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M8 4h8v3a4 4 0 0 1-8 0V4Z" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                        <path d="M6 7H4a2 2 0 0 0 2 5h1" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                        <path d="M18 7h2a2 2 0 0 1-2 5h-1" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                        <path d="M12 11v3m-4 6h8" stroke="currentColor" stroke-width="2" class="text-brand-500" />
                    </svg>
                </div>

                <h1 class="mt-6 font-display text-3xl md:text-4xl tracking-tight text-white">Welcome Back</h1>
                <p class="mt-2 text-sm text-zinc-400">Sign in to access your account.</p>
            </div>

            <!-- Card -->
            <div class="mt-8 mx-auto max-w-md">
                <form
                    action="#"
                    method="post"
                    class="rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6 shadow-[0_30px_90px_rgba(0,0,0,.55)]"
                >
                    <!-- Email -->
                    <div class="text-left">
                        <label for="email" class="text-xs font-semibold text-white">Email Address</label>
                        <div class="mt-2 relative">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path
                          d="M4 6h16v12H4V6Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linejoin="round"
                      />
                      <path
                          d="M4 7l8 6 8-6"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                      />
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
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mt-5 text-left">
                        <label for="password" class="text-xs font-semibold text-white">Password</label>
                        <div class="mt-2 relative">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path
                          d="M7 11V8a5 5 0 0 1 10 0v3"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                      />
                      <path
                          d="M6 11h12v10H6V11Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linejoin="round"
                      />
                    </svg>
                  </span>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                required
                                class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-11 text-sm text-white placeholder:text-zinc-500
                           outline-none transition
                           focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                            />

                            <button
                                id="togglePassword"
                                type="button"
                                class="absolute inset-y-0 right-3 inline-flex items-center justify-center rounded-lg px-2 text-zinc-400
                           transition hover:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                aria-label="Toggle password visibility"
                                aria-pressed="false"
                            >
                                <!-- eye -->
                                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path
                                        d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    />
                                </svg>
                                <!-- eye-off (hidden by default) -->
                                <svg
                                    id="eyeOffIcon"
                                    class="hidden"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M3 3l18 18"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        d="M10.6 10.6a2.8 2.8 0 0 0 3.8 3.8"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        d="M7.1 7.1C4.1 9 2 12 2 12s3.5 7 10 7c2 0 3.7-.5 5.1-1.2"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        d="M9.9 5.2A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a18 18 0 0 1-2.9 4.1"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="mt-5 flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-xs text-zinc-400 select-none">
                            <input
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded border-white/20 bg-white/5 text-brand-500
                           focus:ring-2 focus:ring-brand-500/25 focus:ring-offset-0"
                            />
                            Remember me
                        </label>

                        <a
                            href="#"
                            class="text-xs text-brand-500 transition hover:text-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/25 rounded"
                        >Forgot password?</a
                        >
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-brand-500 px-5 py-4
                       text-sm font-semibold text-zinc-950 shadow-glow
                       transition duration-200
                       hover:bg-brand-600 hover:-translate-y-[1px]
                       focus:outline-none focus:ring-2 focus:ring-brand-500/25 active:translate-y-0"
                    >
                        Sign In
                    </button>

                    <!-- Bottom link -->
                    <p class="mt-5 text-center text-xs text-zinc-400">
                        Don&apos;t have an account?
                        <a
                            href="#"
                            class="font-semibold text-brand-500 transition hover:text-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/25 rounded"
                        >Create one</a
                        >
                    </p>
                </form>
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
                            The ultimate platform for sports events. Buy tickets, organize matches, and experience the thrill of live
                            sports.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="font-display text-lg text-white">Quick Links</h3>
                        <ul class="mt-4 space-y-2 text-sm text-zinc-400">
                            <li><a class="hover:text-white transition" href="#">Browse Matches</a></li>
                            <li><a class="hover:text-white transition" href="#">Become an Organizer</a></li>
                            <li><a class="hover:text-white transition" href="#">My Tickets</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h3 class="font-display text-lg text-white">Support</h3>
                        <ul class="mt-4 space-y-2 text-sm text-zinc-400">
                            <li><a class="hover:text-white transition" href="#">Help Center</a></li>
                            <li><a class="hover:text-white transition" href="#">Terms of Service</a></li>
                            <li><a class="hover:text-white transition" href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
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
                            d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.7.6 2.5a2 2 0 0 1-.5 2.1L8.1 9.4a16 16 0 0 0 6 6l1.1-1.1a2 2 0 0 1 2.1-.5c.8.3 1.6.5
