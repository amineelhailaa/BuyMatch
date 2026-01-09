<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
require_once "../classes/Comment.php";
require_once "../config/database.php";
require_once "../classes/MatchSummary.php";
require_once "../classes/Category.php";
require_once "../classes/GuardAuth.php";
require_once "../classes/CommentRule.php";
require_once "../classes/CommentMaker.php";
require_once "../repo/MatchRepository.php";
require_once "../repo/CategoryRepository.php";
require_once "../repo/userRepository.php";
require_once "../repo/CommentRepository.php";
require_once "../classes/GuardAuth.php";

GuardAuth::isLoggedIn();
$userid = GuardAuth::getUserId();



$pdo = Database::getConnection();
$userRepo = new userRepository($pdo);
$user = $userRepo->getUserById($userid);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user->setName($_POST["nom"]);
        $user->setEmail($_POST["email"]);
        if($_POST['password']!="********"){
            $user->setPasswordHash(password_hash($_POST['password'],PASSWORD_DEFAULT));
        }

        $user->setPhone($_POST["phone"]);
        $userRepo->updateUser($user);
    }







?>






<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — My Profile</title>

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
                <a class="hover:text-white transition" href="/buymatch/pages/matches_page.php">Home</a>

            </nav>

            <button
                id="menuBtn"
                class="md:hidden inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 hover:bg-white/10 transition"
                aria-label="Open menu"
                aria-expanded="false"
                type="button"
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
                    class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    href="/buymatch/pages/signUp.php"
                >Register</a
                >
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-10 md:py-14">
            <div class="mx-auto max-w-xl text-center">
                <h1 class="font-display text-3xl md:text-4xl text-white">
                    My <span class="text-brand-500">Profile</span>
                </h1>
                <p class="mt-2 text-sm text-zinc-400">Manage your account settings and preferences.</p>
            </div>

            <div class="mx-auto mt-8 max-w-xl">
                <div
                    class="rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6 shadow-[0_22px_55px_rgba(0,0,0,.55)]"
                >
                    <!-- Header row -->
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="grid h-12 w-12 place-items-center rounded-full bg-zinc-900/40 ring-1 ring-brand-500/30 overflow-hidden">
                               <img src="../uploads/<?= $user->getPic() ?>" class="h-12 w-12  cover">
                            </div>

                            <div class="text-left">
                                <div class="font-display text-lg text-white"><?= $user->getName() ?> </div>
                                <div class="mt-1 text-xs text-zinc-400">Account details</div>
                            </div>
                        </div>

                        <!-- Edit / Save button (starts NOT orange) -->
<!--                        <button-->
<!--                            type="button"-->
<!--                            id="editBtn"-->
<!--                            class="inline-flex items-center gap-2 rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-zinc-200-->
<!--                         transition hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-brand-500/20"-->
<!--                            aria-pressed="false"-->
<!--                        >-->
<!--                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">-->
<!--                                <path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />-->
<!--                                <path-->
<!--                                    d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4 11.5-11.5Z"-->
<!--                                    stroke="currentColor"-->
<!--                                    stroke-width="2"-->
<!--                                    stroke-linejoin="round"-->
<!--                                />-->
<!--                            </svg>-->
<!--                            <span id="editBtnLabel">Edit</span>-->
<!--                        </button>-->
                    </div>

                    <!-- Inputs (LOCKED until Edit clicked) -->
                    <form id="profileForm" class="mt-6 space-y-4" autocomplete="on" method="post">


                        <button
                                type="button"
                                id="editBtn"
                                class="inline-flex items-center gap-2 rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-zinc-200
                         transition hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-brand-500/20"
                                aria-pressed="false"
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path
                                        d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4 11.5-11.5Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                />
                            </svg>
                            <span id="editBtnLabel">Edit</span>
                        </button>
                        <!-- Full Name -->
                        <div>
                            <label for="fullName" class="block text-xs font-semibold text-zinc-200">Full Name</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <input
                                    id="fullName"
                                    name="nom"
                                    type="text"
                                    value="<?= $user->getName() ?>"
                                    readonly
                                    class="profile-input w-full rounded-xl border border-white/10 bg-white/5 px-10 py-3 text-sm text-white
                             outline-none transition focus:ring-4 focus:ring-brand-500/15 focus:border-brand-500/30
                             read-only:cursor-not-allowed read-only:opacity-80"
                                />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-zinc-200">Email Address</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2" />
                        <path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      </svg>
                    </span>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="<?= $user->getEmail() ?>"
                                    readonly
                                    class="profile-input w-full rounded-xl border border-white/10 bg-white/5 px-10 py-3 text-sm text-white
                             outline-none transition focus:ring-4 focus:ring-brand-500/15 focus:border-brand-500/30
                             read-only:cursor-not-allowed read-only:opacity-80"
                                />
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-zinc-200">Password</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M6 11h12v10H6V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                      </svg>
                    </span>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    value="********"
                                    readonly
                                    class="profile-input w-full rounded-xl border border-white/10 bg-white/5 px-10 py-3 text-sm text-white
                             outline-none transition focus:ring-4 focus:ring-brand-500/15 focus:border-brand-500/30
                             read-only:cursor-not-allowed read-only:opacity-80"
                                />
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-xs font-semibold text-zinc-200">Address</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                        <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <input
                                    id="address"
                                    name="address"
                                    type="text"
                                    value="123 Stadium Way, Sports City"
                                    readonly
                                    class="profile-input w-full rounded-xl border border-white/10 bg-white/5 px-10 py-3 text-sm text-white
                             outline-none transition focus:ring-4 focus:ring-brand-500/15 focus:border-brand-500/30
                             read-only:cursor-not-allowed read-only:opacity-80"
                                />
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-zinc-200">Phone</label>
                            <div class="mt-2 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-500">
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
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    value="<?= $user->getPhone() ?>"
                                    readonly
                                    class="profile-input w-full rounded-xl border border-white/10 bg-white/5 px-10 py-3 text-sm text-white
                             outline-none transition focus:ring-4 focus:ring-brand-500/15 focus:border-brand-500/30
                             read-only:cursor-not-allowed read-only:opacity-80"
                                />
                            </div>
                        </div>

                        <!-- UX helper text -->
                        <p id="hintText" class="pt-1 text-xs text-zinc-500">
                            Click <span class="text-zinc-300">Edit</span> to unlock fields.
                        </p>
                    </form>

                </div>
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

    // Profile Edit UX
    const editBtn = document.getElementById("editBtn");
    const editBtnLabel = document.getElementById("editBtnLabel");
    const hintText = document.getElementById("hintText");
    const inputs = Array.from(document.querySelectorAll(".profile-input"));

    let isEditing = false;

    function setEditing(state) {
        isEditing = state;
        editBtn.setAttribute("aria-pressed", String(isEditing));

        // Toggle readonly
        inputs.forEach((el) => {
            if (isEditing) {
                el.removeAttribute("readonly");
            } else {
                el.setAttribute("readonly", "readonly");
            }
        });

        // Button style + label
        if (isEditing) {
            editBtn.classList.remove("border-white/10", "bg-white/5", "text-zinc-200", "hover:bg-white/10");
            editBtn.classList.add("bg-brand-500", "text-zinc-950", "shadow-glow", "hover:bg-brand-600");
            editBtnLabel.textContent = "Save";
            hintText.textContent = "Make changes, then click Save.";
            editBtn.setAttribute('type', 'button');
            // Focus first input for better UX
            setTimeout(() => inputs[0]?.focus(), 0);
        } else {
            editBtn.setAttribute('type', 'submit');
            editBtn.classList.add("border-white/10", "bg-white/5", "text-zinc-200", "hover:bg-white/10");
            editBtn.classList.remove("bg-brand-500", "text-zinc-950", "shadow-glow", "hover:bg-brand-600");
            editBtnLabel.textContent = "Edit";
            hintText.textContent = "Click Edit to unlock fields.";
        }
    }

    editBtn?.addEventListener("click", () => {
        if (!isEditing) {
            setEditing(true);
            return;
        }

        // "Save" state (UX only)
        // Here you would normally send data to backend.
        setEditing(false);
    });

    // Start locked
    setEditing(false);
</script>
</body>
</html>
