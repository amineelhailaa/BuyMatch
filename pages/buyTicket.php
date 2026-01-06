<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
require_once "../repo/MatchRepository.php";
require_once "../repo/CategoryRepository.php";
require_once "../classes/MatchSummary.php";
require_once "../classes/PurchaseRule.php";
require_once "../classes/Category.php";
require_once "../config/database.php";
require_once "../classes/Reservation.php";
require_once "../classes/Ticket.php";

$match_id = $_GET['id'];
$user_id = $_SESSION["user_id"];
try {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       $categoryChosen =  $_POST['ticket'];
       $quantity =  $_POST['qtyInput'];
       $pdo = Database::getConnection();
         //check constraints
         //insert reservation
         //insert ticket
        if(PurchaseRule::check($categoryChosen,$quantity)){
            $categoryRepository = new CategoryRepository($pdo);
            $category = $categoryRepository->getCategoryById($categoryChosen); //objet
            $pdo->beginTransaction();
            $reservation = new Reservation($user_id, $match_id,$quantity*$category->getPrice());
            $reservationRepo= new ReservationRepository($pdo);
            $reservation->setId($reservationRepo->createReservation($reservation));
            for ($i=0; $i < $quantity; $i++) {
                $ticket = new Ticket($reservation->getId(),$category->getId(),$category->getPrice());
            }
            $pdo->commit();
        }




    }





    $matchRepository = new MatchRepository(Database::getConnection());
    $match = $matchRepository->getMatcheById($match_id);
    $categoryRepo = new CategoryRepository(Database::getConnection());
    $categories = $categoryRepo->getCategoriesByMatchId($match_id);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTARENA — Buy Tickets</title>

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
                    colors: { brand: { 500: "#FF7A00", 600: "#F36A00" } },
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

        /* ADDED: logo sizing for the small round buttons */
        .team-logo{
            object-fit: cover;
            @apply h-full w-full rounded-full object-cover;

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
    <main class="grain relative">
        <section class="mx-auto max-w-6xl px-4 py-10 md:py-14">
            <!-- Back -->
            <a
                    href="#"
                    class="inline-flex items-center gap-2 text-sm text-zinc-300 transition hover:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/25 rounded-lg px-2 py-1"
            >
                <span class="text-zinc-400" aria-hidden="true">←</span>
                Back to Match Details
            </a>

            <!-- Title -->
            <div class="mt-5 text-center">
                <h1 class="font-display text-3xl sm:text-4xl md:text-5xl tracking-tight">
                    <span class="text-white">Buy </span><span class="text-brand-500">Tickets</span>
                </h1>
            </div>

            <div class="mt-8 flex flex-col items-center gap-5">
                <!-- Match summary card -->
                <article class="w-full max-w-2xl rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 px-6 py-5">
                    <div class="flex items-center justify-center gap-6">
                        <!-- left team -->
                        <button
                                type="button"
                                class="group/logo relative grid h-11 w-11 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                         transition duration-200
                         hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                         hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                title="Real Madrid"
                                aria-label="Real Madrid logo"
                        >
                            <!-- CHANGED: abbreviation -> img -->
                            <img src="../uploads/<?= $match->getTeam1Logo() ?>" alt="Team 1" class="team-logo  h-full w-full rounded-full object-cover" />

                            <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                                <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                            </span>
                        </button>

                        <div class="flex items-center gap-4">
                            <div class="text-sm font-semibold text-white"><?= $match->getTeam1Name() ?></div>
                            <div class="font-display text-brand-500 text-lg tracking-widest">VS</div>
                            <div class="text-sm font-semibold text-white"><?= $match->getTeam2Name() ?></div>
                        </div>

                        <!-- right team -->
                        <button
                                type="button"
                                class="group/logo relative grid h-11 w-11 place-items-center rounded-full bg-zinc-900/55 ring-1 ring-white/15
                         transition duration-200
                         hover:ring-brand-500/70 hover:shadow-[0_0_0_1px_rgba(255,122,0,.25),0_18px_45px_rgba(255,122,0,.14)]
                         hover:scale-[1.03] focus:outline-none focus:ring-2 focus:ring-brand-500/25"
                                title="Barcelona"
                                aria-label="Barcelona logo"
                        >
                            <!-- CHANGED: abbreviation -> img -->
                            <img src="../uploads/<?= $match->getTeam2Logo() ?>" alt="Team 2" class="team-logo h-full w-full rounded-full object-cover" />

                            <span class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition group-hover/logo:opacity-100">
                                <span class="absolute inset-[-8px] rounded-full bg-brand-500/10 blur-xl"></span>
                            </span>
                        </button>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-zinc-400">
                        <span class="inline-flex items-center gap-2">
                          <span class="text-brand-500">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                              <path d="M7 3v3M17 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                              <path d="M4 8h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" stroke="currentColor" stroke-width="2" />
                              <path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" />
                            </svg>
                          </span>
                          <?= $match->getDate() ?>
                        </span>

                        <span class="inline-flex items-center gap-2">
                          <span class="text-brand-500">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                              <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="2" />
                              <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                          </span>
                          <?= $match->getTime() ?>
                        </span>

                        <span class="inline-flex items-center gap-2">
                          <span class="text-brand-500">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                              <path d="M12 22s7-4.4 7-12a7 7 0 1 0-14 0c0 7.6 7 12 7 12Z" stroke="currentColor" stroke-width="2" />
                              <path d="M12 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" stroke="currentColor" stroke-width="2" />
                            </svg>
                          </span>
                          <?= $match->getLocation() ?>
                        </span>
                    </div>
                </article>

                <!-- Purchase card -->
                <section
                        class="w-full max-w-2xl rounded-2xl border border-white/10 bg-gradient-to-b from-white/6 to-white/3 p-6 md:p-7"
                        aria-label="Buy ticket form"
                >
                    <h2 class="text-sm font-semibold text-white">Select Category</h2>

                    <!-- Categories (click selects + focus transfers) -->
                   <form method="post" >

                       <div class="mt-4 space-y-3">
                        <!-- Normal -->
                        <?php
                        foreach ($categories as $category):

                        ?>
                        <label
                                class="ticket-card group relative flex cursor-pointer items-center justify-between gap-4 rounded-xl border px-4 py-4 outline-none
                         border-brand-500/45 bg-brand-500/10 shadow-[0_0_0_1px_rgba(255,122,0,.12)]
                         transition duration-200
                         hover:-translate-y-[1px] hover:border-brand-500/70 hover:shadow-glow
                         focus:ring-2 focus:ring-brand-500/25"
                                tabindex="0"
                        >
                            <input type="radio" name="ticket" class="sr-only" value="<?= $category->getId() ?>" data-price="<?= $category->getPrice() ?>" checked />
                            <div class="flex items-center gap-3">
                    <span class="ticket-icon text-brand-500">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 8h16v4a2 2 0 0 1 0 4v4H4v-4a2 2 0 0 0 0-4V8Z" stroke="currentColor" stroke-width="2" />
                        <path d="M9 8v12" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </span>
                                <div>
                                    <div class="ticket-title text-sm font-semibold text-brand-500"><?= $category->getLabel() ?></div>
                                    <div class="text-xs text-zinc-400"><?= $category->getMaxSeats() ?> seats available</div>
                                </div>
                            </div>
                            <div class="ticket-price text-lg font-bold text-brand-500">$<?= $category->getPrice() ?> </div>
                        </label>
                        <?php
                            endforeach;
                        }catch (Throwable $exception){
                            echo $exception->getMessage();
                        }
                        ?>
                    </div>

                    <!-- Quantity -->
                    <div class="mt-7">
                        <div class="text-sm font-semibold text-white">
                            Quantity <span class="text-zinc-500 font-medium">(Max 4)</span>
                        </div>

                        <div class="mt-3 flex items-center gap-4">
                            <button
                                    id="qtyMinus"
                                    type="button"
                                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-white
                           transition duration-200
                           hover:bg-white/10 hover:border-brand-500/25 hover:-translate-y-[1px]
                           focus:outline-none focus:ring-2 focus:ring-brand-500/25 disabled:opacity-40 disabled:cursor-not-allowed"
                                    aria-label="Decrease quantity"
                            >
                                <span class="text-lg leading-none">−</span>
                            </button>

                            <div id="qtyValue" class="w-16 text-center font-display text-2xl text-white">1</div>
                                <input type="hidden" id="qtyInput" name="qtyInput" value="" >
                            <button
                                    id="qtyPlus"
                                    type="button"
                                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-white
                           transition duration-200
                           hover:bg-white/10 hover:border-brand-500/25 hover:-translate-y-[1px]
                           focus:outline-none focus:ring-2 focus:ring-brand-500/25 disabled:opacity-40 disabled:cursor-not-allowed"
                                    aria-label="Increase quantity"
                            >
                                <span class="text-lg leading-none">+</span>
                            </button>
                        </div>
                    </div>

                    <div class="mt-7 h-px w-full bg-white/10"></div>

                    <!-- Total -->
                    <div class="mt-5 flex items-center justify-between">
                        <div class="text-sm text-zinc-400">Total Amount</div>
                        <div id="totalAmount" class="font-display text-3xl text-brand-500 drop-shadow-[0_0_18px_rgba(255,122,0,.2)]">

                        </div>
                    </div>

                    <!-- Confirm -->
                    <button
                            type="submit"

                            class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-500 px-5 py-4 text-sm font-semibold text-zinc-950 shadow-glow
                       transition duration-200
                       hover:bg-brand-600 hover:-translate-y-[1px]
                       focus:outline-none focus:ring-2 focus:ring-brand-500/25 active:translate-y-0"
                    >
                        <span class="text-zinc-950/90">

                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path
                                    d="M7 8h14v10a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                            />
                            <path d="M9 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                          </svg>
                        </span>
                        Confirm Purchase
                    </button>
                   </form>
                </section>
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
<script>
    // ===== Mobile menu (same as your other pages) =====
    const menuBtn = document.getElementById("menuBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    menuBtn?.addEventListener("click", () => {
        const isOpen = menuBtn.getAttribute("aria-expanded") === "true";
        menuBtn.setAttribute("aria-expanded", String(!isOpen));
        mobileMenu.classList.toggle("hidden");
    });

    // Dismiss badge
    document.getElementById("builtWith")?.addEventListener("click", (e) => e.currentTarget.remove());

    // ===== Ticket selection: click => checked + focus + style =====
    const ticketCards = document.querySelectorAll(".ticket-card");

    function setSelectedStyles() {
        ticketCards.forEach((card) => {
            const radio = card.querySelector('input[name="ticket"]');
            const title = card.querySelector(".ticket-title");
            const price = card.querySelector(".ticket-price");
            const icon = card.querySelector(".ticket-icon");
            const selected = !!radio?.checked;

            // Base reset
            card.classList.toggle("border-brand-500/45", selected);
            card.classList.toggle("bg-brand-500/10", selected);
            card.classList.toggle("shadow-[0_0_0_1px_rgba(255,122,0,.12)]", selected);

            // If selected, force brand colors (even without hover)
            if (title) {
                title.classList.toggle("text-brand-500", selected);
                title.classList.toggle("text-white", !selected);
            }
            if (price) {
                price.classList.toggle("text-brand-500", selected);
                price.classList.toggle("text-white", !selected);
            }
            if (icon) {
                icon.classList.toggle("text-brand-500", selected);
                icon.classList.toggle("text-zinc-300", !selected);
            }
        });
    }

    // ===== Quantity + Total dynamic =====
    const qtyMinus = document.getElementById("qtyMinus");
    const qtyPlus = document.getElementById("qtyPlus");
    const qtyValue = document.getElementById("qtyValue");
    const totalAmount = document.getElementById("totalAmount");

    let qty = 1;
    const MIN = 1;
    const MAX = 4;

    function selectedPrice() {
        const checked = document.querySelector('input[name="ticket"]:checked');
        return Number(checked?.dataset.price || 0);
    }
    const qtyInput = document.getElementById("qtyInput");
    function updateTotal() {
        qtyValue.textContent = String(qty);
        qtyInput.value = String(qty); // IMPORTANT
        totalAmount.textContent = `$${qty * selectedPrice()}`;
        qtyMinus.disabled = qty <= MIN;
        qtyPlus.disabled = qty >= MAX;
    }

    ticketCards.forEach((card) => {
        const radio = card.querySelector('input[name="ticket"]');
        card.addEventListener("click", () => {
            radio.checked = true;
            card.focus(); // focus transfers to the selected type
            setSelectedStyles();
            updateTotal();
        });

        // Keyboard: Enter/Space selects too
        card.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                radio.checked = true;
                card.focus();
                setSelectedStyles();
                updateTotal();
            }
        });
    });

    document.querySelectorAll('input[name="ticket"]').forEach((r) => {
        r.addEventListener("change", () => {
            setSelectedStyles();
            updateTotal();
        });
    });

    qtyMinus.addEventListener("click", () => {
        qty = Math.max(MIN, qty - 1);
        updateTotal();
    });

    qtyPlus.addEventListener("click", () => {
        qty = Math.min(MAX, qty + 1);
        updateTotal();
    });

    // init
    setSelectedStyles();
    updateTotal();
</script>
</body>
</html>
