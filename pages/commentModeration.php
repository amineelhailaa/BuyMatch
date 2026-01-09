<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
session_start();
require_once "../classes/GuardAuth.php";
require_once "../repo/CommentRepository.php";
require_once "../config/database.php";
GuardAuth::isLoggedIn();
$pdo = Database::getConnection();
$user_id = GuardAuth::getUserId();
$commentRepository = new CommentRepository($pdo);
try {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['action'] === "delete"){
            $commentID = $_POST["id_comment"];
            echo $commentID;
            $commentRepository->deleteComment($commentID);
        }
    }
}catch (Throwable $e){
    echo $e->getMessage();
}
if ($_SESSION['role'] === "administrateur") {
    $comments = $commentRepository->getAllComment();
}
elseif ($_SESSION['role'] === "organisateur"){
    $comments=$commentRepository->getCommentByOrganizer($user_id);
}
else{
    header("Location:/buymatch/404.php");
}





?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Comments Moderation</title>

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
                <a class="hover:text-white transition" href="#">Home</a>
                <a class="hover:text-white transition" href="#">Matches</a>
                <a class="inline-flex items-center gap-2 hover:text-white transition" href="#">
                    <span aria-hidden="true">↗</span> Login
                </a>
                <a
                    class="rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    href="<?=GuardAuth::getUserPath()?>"
                >Dashboard</a>
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
                <a class="hover:text-white transition" href="#">Home</a>
                <a class="hover:text-white transition" href="#">Matches</a>
                <a class="hover:text-white transition" href="#">Login</a>
                <a
                    class="mt-1 inline-flex justify-center rounded-lg bg-brand-500 px-4 py-2 font-semibold text-zinc-950 shadow-glow hover:bg-brand-600 transition"
                    href="#"
                >Register</a>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-10 md:py-14">
            <!-- Title -->
            <div class="max-w-4xl">
                <h1 class="font-display text-4xl md:text-5xl tracking-tight">
                    <span class="text-white">Comments</span>
                    <span class="text-brand-500"> Moderation</span>
                </h1>
                <p class="mt-2 text-sm text-zinc-400">Review and manage user comments.</p>

                <!-- Search -->
                <div class="mt-6 rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-4 shadow-[0_30px_90px_rgba(0,0,0,.45)]">
                    <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-zinc-400">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16Z" stroke="currentColor" stroke-width="2" />
                  <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
              </span>
                        <input
                            id="searchInput"
                            type="text"
                            placeholder="Search comments by user or content..."
                            class="w-full rounded-xl border border-white/10 bg-zinc-900/40 py-3 pl-11 pr-4 text-sm text-white placeholder:text-zinc-500
                       outline-none transition
                       focus:border-brand-500/40 focus:ring-2 focus:ring-brand-500/15"
                        />
                    </div>
                </div>

                <!-- Count -->
                <div class="mt-5 flex items-center gap-2 text-sm text-zinc-400">
            <span class="text-brand-500">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              </svg>
            </span>
                    <span><span id="countLabel" class="font-semibold text-white">4</span> comments</span>
                </div>
            </div>

            <!-- List -->
            <form method="post">
            <div id="commentsList" class="mt-6 space-y-4 max-w-6xl">
                <!-- Card -->
                <?php
                foreach ($comments as $comment):
                ?>
                <article class="comment-card rounded-2xl border border-white/10 bg-white/5 p-5 shadow-[0_18px_55px_rgba(0,0,0,.45)]
                          transition hover:-translate-y-[1px] hover:border-white/15 hover:bg-white/7">
                    <input type="hidden" name="id_comment" value="<?= $comment->getId() ?>">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 min-w-0">
                            <div class="grid h-11 w-11 place-items-center rounded-full border border-white/10 bg-zinc-950/40 text-zinc-400">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M12 13a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-white truncate"><?=$comment->getCommentOwner()?></h3>
                                </div>

                                <!-- NO match name here (as requested) -->

                                <p class="mt-2 text-sm text-zinc-200 leading-relaxed">
                                    <?=$comment->getComment()?>
                                </p>

                                <div class="mt-3 flex items-center gap-2 text-xs text-zinc-500">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M4 8h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M6 21h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    <?=$comment->getDate()?>
                                </div>
                            </div>
                        </div>

                        <button
                            type="submit"
                            name="action" value="delete"
                            class="shrink-0 inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 p-2 text-zinc-300
                       transition hover:border-red-500/35 hover:bg-red-500/10 hover:text-red-200
                       focus:outline-none focus:ring-2 focus:ring-red-500/25"
                            aria-label="Delete comment from John Doe"
                        >
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M3 6h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M8 6V4h8v2" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M6 6l1 16h10l1-16" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </div>
                </article>
                <?php
                endforeach;
                ?>

                 </div>
            </form>
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

<!-- Native JS: menu + badge + simple filtering (no JS rendering) -->
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

    // Filter comments (UX only)
    const searchInput = document.getElementById("searchInput");
    const list = document.getElementById("commentsList");
    const countLabel = document.getElementById("countLabel");

    function normalize(s) {
        return (s || "").toLowerCase().trim();
    }

    searchInput?.addEventListener("input", () => {
        const q = normalize(searchInput.value);
        const cards = Array.from(list.querySelectorAll(".comment-card"));

        let visible = 0;
        cards.forEach((card) => {
            const text = normalize(card.innerText);
            const show = !q || text.includes(q);
            card.classList.toggle("hidden", !show);
            if (show) visible++;
        });

        countLabel.textContent = String(visible);
    });
</script>
</body>
</html>


