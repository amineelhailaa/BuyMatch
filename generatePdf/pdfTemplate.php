<?php


require_once __DIR__."/../repo/MatchRepository.php";
require_once __DIR__."/../classes/MatchSummary.php";
require_once __DIR__."/../config/database.php";
$path=__DIR__."/../uploads/";
$ticketId=$ticket_id ?? 2;
$pdo = Database::getConnection();
$matchRepo = new MatchRepository($pdo);
$match=$matchRepo->getMatchByTicketId($ticketId);



$seat = $seat ?? "A-15";
$category = $match->getCategory() ?? "VIP";


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Ticket PDF</title>

    <style>

    @page { margin: 0; }

    * { box-sizing: border-box; }

    html, body { height: 100%; }

    body {
    margin: 0;
    font-family: DejaVu Sans, Arial, sans-serif;
    background: #07080d;
    color: #fff;
    }

    .page {
    width: 100%;
    height: 100%;
    display: table;
    }

    .page-center {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    padding: 12mm 0; /* slight breathing room */
    }

    /* Centered layout wrapper */
    .wrap {
    display: inline-block;     /* so text-align center centers it */
    width: 100%;
    max-width: 560px;
    padding: 0 12px;           /* side padding only */
    text-align: left;          /* reset inner text alignment */
    }

    /* Ticket card */
    .ticket {
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, .10);
    background: #141621;
    overflow: hidden;
    box-shadow: 0 22px 55px rgba(0, 0, 0, .55);
    }

    /* Accent bar */
    .accent-1 { height: 4px; background: #ff7a00; }
    .accent-2 { height: 2px; background: #a855f7; }
    .accent-3 { height: 2px; background: #ff7a00; }

    .pad { padding: 18px; }
    .center { text-align: center; }

    /* Badge */
    .badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    border: 1px solid rgba(255, 122, 0, .25);
    background: rgba(255, 122, 0, .10);
    color: #ff7a00;
    font-size: 11px;
    font-weight: 700;
    }

    /* Title */
    .title {
    margin-top: 12px;
    font-size: 18px;
    font-weight: 800;
    letter-spacing: .2px;
    }

    .subtitle {
    margin-top: 4px;
    font-size: 11px;
    color: rgba(255, 255, 255, .55);
    }

    /* Teams row */
    .teams {
    margin-top: 16px;
    text-align: center;
    white-space: nowrap;
    }

    .team {
    display: inline-block;
    width: 42%;
    vertical-align: top;
    white-space: normal;
    }

    .vs {
    display: inline-block;
    width: 14%;
    vertical-align: top;
    margin-top: 12px;
    font-weight: 900;
    color: #ff7a00;
    font-size: 16px;
    }

    .logoWrap {
    width: 46px;
    height: 46px;
    border-radius: 999px;
    border: 1px solid rgba(255, 255, 255, .10);
    background: rgba(0, 0, 0, .25);
    margin: 0 auto 6px auto;
    overflow: hidden;
    }

    .logoWrap img {
    width: 46px;
    height: 46px;
    object-fit: cover;
    display: block;
    }

    .teamName {
    font-size: 11px;
    font-weight: 700;
    color: rgba(255, 255, 255, .85);
    }

    /* Perforation line */
    .perf {
    margin-top: 16px;
    border-top: 1px solid rgba(255, 255, 255, .12);
    }

    /* Info grid (2 columns) */
    .grid {
    margin-top: 14px;
    width: 100%;
    font-size: 0;
    }

    .cell {
    font-size: 12px;
    width: 48%;
    display: inline-block;
    margin: 0 1% 10px 1%;
    vertical-align: top;

    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, .10);
    background: rgba(255, 255, 255, .05);
    padding: 10px;
    text-align: center;
    }

    .label {
    font-size: 10px;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, .55);
    margin-top: 6px;
    }

    .value {
    margin-top: 4px;
    font-size: 12px;
    font-weight: 800;
    color: rgba(255, 255, 255, .88);
    word-wrap: break-word;
    }

    /* Category chip */
    .chip {
    display: inline-block;
    margin-top: 8px;
    padding: 6px 10px;
    border-radius: 999px;
    background: rgba(168, 85, 247, .18);
    border: 1px solid rgba(168, 85, 247, .28);
    color: rgba(216, 180, 254, .95);
    font-size: 11px;
    font-weight: 800;
    }
<</STYLE>
</head>

<body>
<div class="page">
    <div class="page-center">
<div class="wrap">
    <div class="ticket">
        <div class="accent-1"></div>
        <div class="accent-2"></div>
        <div class="accent-3"></div>

        <div class="pad">
            <div class="center">
                <span class="badge">E-Ticket</span>
            </div>

            <div class="center">
                <div class="title">
                    <?= htmlspecialchars($match->getTeam1Name() . " vs " . $match->getTeam2Name()) ?>
                </div>
                <div class="subtitle">Ticket ID: <?= htmlspecialchars($ticketId) ?></div>
            </div>

            <div class="teams">
                <div class="team">
                    <div class="logoWrap">
                        <img src="<?= $path.$match->getTeam1Logo() ?>" alt="">
                    </div>
                    <div class="teamName"><?= htmlspecialchars($match->getTeam1Name()) ?></div>
                </div>

                <div class="vs">VS</div>

                <div class="team">
                    <div class="logoWrap">
                        <img src="<?= $path.$match->getTeam2Logo() ?>" alt="">
                    </div>
                    <div class="teamName"><?= htmlspecialchars($match->getTeam2Name()) ?></div>
                </div>
            </div>

            <div class="perf"></div>

            <div class="grid">
                <div class="cell">
                    <div class="label">Date</div>
                    <div class="value"><?= htmlspecialchars($match->getDate()) ?></div>
                </div>

                <div class="cell">
                    <div class="label">Time</div>
                    <div class="value"><?= htmlspecialchars($match->getTime()) ?></div>
                </div>

                <div class="cell">
                    <div class="label">Stadium</div>
                    <div class="value"><?= htmlspecialchars($match->getLocation()) ?></div>
                </div>

                <div class="cell">
                    <div class="label">Seat</div>
                    <div class="value"><?= htmlspecialchars($seat) ?></div>
                </div>
            </div>

            <div class="center">
                <span class="chip"><?= htmlspecialchars($category) ?></span>
            </div>
        </div>
    </div>
</div>
    </div></div>
</body>
</html>
