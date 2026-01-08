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
require_once "../repo/CommentRepository.php";
require_once "../classes/GuardAuth.php";


GuardAuth::requireRole('acheteur');


$userId = GuardAuth::getUserId();


$pdo = Database::getConnection();
$matchId = $_GET['match_id'];
try {

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $comment = new Comment($userId,$matchId,$_POST['content']);

        $commentRepo = new CommentRepository($pdo);
        $commentRepo->addComment($comment);
    }

    $matchRepository = new MatchRepository($pdo);
    $match = $matchRepository->getMatcheById($matchId);
    $categoryRepo = new CategoryRepository($pdo);
    $categories = $categoryRepo->getCategoriesByMatchId($matchId);
    $canComment = true;
    if(!CommentRule::checkCanComment($userId,$matchId)) {
        $canComment = false;
    }
    if (!CommentRule::matchCommentable($matchId)){
        $canComment = false;
    }


}catch (Throwable $exception){
    echo $exception->getMessage();
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Match Details</title>

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

        /* Added only to size logo images nicely */
        .team-logo{
            width: 52px;
            height: 52px;
            object-fit: contain;
            filter: drop-shadow(0 6px 18px rgba(0,0,0,.35));
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

    <!-- Top stadium hero strip (like screenshot) -->
    <div class="relative h-44 w-full overflow-hidden border-b border-white/5">
        <img
                src="../uploads/<?= $match->getBanner() ?>"
                alt="Stadium"
                class="h-full w-full object-cover opacity-70"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/30 via-zinc-950/40 to-zinc-950"></div>
    </div>

    <!-- Page -->
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-10 md:py-12">
            <!-- Match details card -->
            <article
                    class="relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6 md:p-7"
            >
                <!-- subtle inner glow -->
                <div class="pointer-events-none absolute inset-0">
                    <div class="absolute -top-10 left-1/2 h-32 w-72 -translate-x-1/2 rounded-full bg-brand-500/10 blur-3xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-b from-brand-500/0 via-brand-500/0 to-brand-500/5"></div>
                </div>

                <!-- Teams row -->
                <div class="relative z-10 flex flex-col items-center gap-5">
                    <div class="flex w-full items-center justify-center gap-10 md:gap-16">
                        <!-- Team A -->
                        <div class="flex flex-col items-center gap-3">
                            <button
                                    type="button"
                                    class="group/logo relative grid h-20 w-20 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200
                           hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                    aria-label="Team 1 logo"
                                    title="<?= $match->getTeam1Name() ?>"
                            >
                                <img src="../uploads/<?= $match->getTeam1Logo() ?>" alt="<?= $match->getTeam1Name() ?>" class="team-logo" />
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-10px] rounded-full bg-brand-500/10 blur-2xl"></span>
                    </span>
                            </button>
                            <div class="text-sm font-semibold text-white"><?= $match->getTeam1Name() ?></div>
                        </div>

                        <!-- VS -->
                        <div class="flex flex-col items-center justify-center">
                            <div class="font-display text-3xl md:text-4xl text-brand-500 drop-shadow-[0_0_18px_rgba(255,122,0,.25)]">
                                VS
                            </div>
                        </div>

                        <!-- Team B -->
                        <div class="flex flex-col items-center gap-3">
                            <button
                                    type="button"
                                    class="group/logo relative grid h-20 w-20 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                           transition duration-200
                           hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                           hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                    aria-label="Team 2 logo"
                                    title="<?= $match->getTeam2Name() ?>"
                            >
                                <img src="../uploads/<?= $match->getTeam2Logo() ?>" alt="<?= $match->getTeam2Name() ?>" class="team-logo" />
                                <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                      <span class="absolute inset-[-10px] rounded-full bg-brand-500/10 blur-2xl"></span>
                    </span>
                            </button>
                            <div class="text-sm font-semibold text-white"><?= $match->getTeam2Name() ?></div>
                        </div>
                    </div>

                    <!-- Info blocks -->
                    <div class="grid w-full gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- Date -->
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                            <div class="flex items-center justify-center gap-2 text-xs text-zinc-400">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                        <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <span>Date</span>
                            </div>
                            <div class="mt-2 text-center text-sm font-semibold text-white"><?= $match->getDate() ?></div>
                        </div>

                        <!-- Time -->
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                            <div class="flex items-center justify-center gap-2 text-xs text-zinc-400">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                        <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </span>
                                <span>Time</span>
                            </div>
                            <div class="mt-2 text-center text-sm font-semibold text-white"><?= $match->getTime() ?></div>
                        </div>

                        <!-- Stadium -->
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                            <div class="flex items-center justify-center gap-2 text-xs text-zinc-400">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                        <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <span>Stadium</span>
                            </div>
                            <div class="mt-2 text-center text-sm font-semibold text-white"><?= $match->getLocation() ?></div>
                        </div>

                        <!-- Duration -->
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                            <div class="flex items-center justify-center gap-2 text-xs text-zinc-400">
                    <span class="text-brand-500">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                                d="M12 22a10 10 0 1 0-10-10 10 10 0 0 0 10 10Z"
                                stroke="currentColor"
                                stroke-width="2"
                        />
                        <path d="M12 6v6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M12 12l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                      </svg>
                    </span>
                                <span>Duration</span>
                            </div>
                            <div class="mt-2 text-center text-sm font-semibold text-white">90 minutes</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="max-w-3xl text-center text-sm text-zinc-400 leading-relaxed">
                        Experience the ultimate El Clásico showdown between two of the world’s greatest football clubs. This legendary
                        rivalry promises 90 minutes of pure adrenaline and world-class football.
                    </p>

                    <!-- Ticket categories (NOT clickable, NOT hoverable) -->
                    <div class="w-full">
                        <div class="flex items-center gap-2 text-sm font-semibold text-white">
                  <span class="text-brand-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M4 8h16v4a2 2 0 0 1 0 4v4H4v-4a2 2 0 0 0 0-4V8Z" stroke="currentColor" stroke-width="2" />
                      <path d="M9 8v12" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            Ticket Categories
                        </div>

                        <div class="mt-3 grid gap-3 md:grid-cols-3">

                            <!-- Normal -->
                            <?php
                            foreach($categories as $category):
                            ?>
                            <div class="rounded-xl border border-white/10 bg-zinc-900/30 px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <div class="text-xs text-zinc-400"><?= $category->getLabel() ?></div>
                                    <div class="text-sm font-semibold text-brand-500"><?= $category->getPrice() ?></div>
                                </div>
                                <div class="mt-2 h-px w-full bg-white/5"></div>
                                <div class="mt-2 text-xs text-zinc-500">Standard seating • Great view</div>
                            </div>

                            <?php
                            endforeach
                            ?>





                    <!-- Buy button (hover like before) -->
                    <div class="w-full flex justify-start">
                        <a
                                href="./buyTicket.php?id=<?= $match->getMatchId() ?>"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-500 px-5 py-3 text-sm font-semibold text-zinc-950 shadow-glow
                         transition duration-200 hover:bg-brand-600 hover:-translate-y-[1px] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                        >
                  <span class="text-zinc-950/90">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path
                              d="M4 8h16v4a2 2 0 0 1 0 4v4H4v-4a2 2 0 0 0 0-4V8Z"
                              stroke="currentColor"
                              stroke-width="2"
                      />
                      <path d="M9 8v12" stroke="currentColor" stroke-width="2" />
                    </svg>
                  </span>
                            Buy Ticket
                        </a>
                    </div>
                </div>
            </article>

            <!-- Comments section (KEEP; rating section REMOVED) -->
            <section class="mt-6 rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6">
                <div class="flex items-center gap-2 text-sm font-semibold text-white">
              <span class="text-brand-500">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path
                          d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linejoin="round"
                  />
                </svg>
              </span>

                </div>

                <div class="mt-4 rounded-xl border border-white/10 bg-zinc-900/30 px-4 py-4 text-center text-xs text-zinc-500">
                    Comments will be enabled after the match ends.
                </div>

                <div class="mt-4 space-y-3">
                    <!-- Comment form -->
                    <form action="" method="POST" class="mt-4">


                        <div class="rounded-xl border border-white/10 bg-zinc-900/30 p-4">
                            <label class="block text-xs text-zinc-400 mb-2">Your comment</label>

                            <textarea
                                    name="content"
                                    rows="3"
                                    maxlength="500"
                                    class="w-full rounded-xl border border-white/10 bg-zinc-950/50 px-4 py-3 text-sm text-zinc-100 placeholder:text-zinc-600 focus:outline-none focus:ring-2 focus:ring-brand-500/25
                   disabled:opacity-50 disabled:cursor-not-allowed"
                                    placeholder="<?= $canComment ? 'Write your comment here…' : 'Comments are disabled for this match.' ?>"
            <?= $canComment ? '' : 'disabled' ?>
            required
                            ></textarea>

                            <div class="mt-3 flex items-center justify-between gap-3">

                                <button
                                        type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-500 px-5 py-3 text-sm font-semibold text-zinc-950 shadow-glow
                       transition duration-200 hover:bg-brand-600 hover:-translate-y-[1px] focus:outline-none focus:ring-2 focus:ring-brand-500/25
                       disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0"
                                        <?= $canComment ? '' : 'disabled' ?>
                                >
                                    Post Comment
                                </button>
                            </div>
                        </div>
                    </form>



                    <?php
                    $commentRepo = new CommentRepository($pdo);
                    $comments = $commentRepo->getComments($matchId);
                    foreach($comments as $comment):
                    ?>

                    <article class="rounded-xl border border-white/10 bg-zinc-900/30 p-4">
                        <div class="flex items-start gap-3">
                            <div class="grid h-9 w-9 place-items-center rounded-full bg-white/5 ring-1 ring-white/10 text-zinc-300">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <path d="M12 13a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <div class="text-sm font-semibold text-white"><?= $comment->getCommentOwner() ?></div>
                                </div>
                                <p class="mt-2 text-sm text-zinc-300">
                                    <?= $comment->getComment() ?>                                </p>
                                <div class="mt-2 text-xs text-zinc-500"><?= $comment->getDate() ?></div>
                            </div>
                        </div>
                    </article>
                    <?php
                    endforeach;
                    ?>


                </div>
            </section>
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

<!-- Native JS (only for menu + badge; NO JS rendering) -->
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
