<?php
    $imagesRSVP1 = [
        'Cover' => 'images/invitations/Cover.png',
        'Guide' => 'images/invitations/AttireGuide.png',
        'Entourage' => 'images/invitations/Entourage.png',
        'RSVP' => 'images/invitations/RSVP1.png',
    ];
    $imagesRSVP2 = [
        'Cover' => 'images/invitations/Cover.png',
        'Guide' => 'images/invitations/AttireGuide.png',
        'Entourage' => 'images/invitations/Entourage.png',
        'RSVP' => 'images/invitations/RSVP2.png',
    ];
    $imagesRSVP3 = [
        'Cover' => 'images/invitations/Cover.png',
        'Guide' => 'images/invitations/AttireGuide.png',
        'Entourage' => 'images/invitations/Entourage.png',
        'RSVP' => 'images/invitations/RSVP3.png',
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yas and Jul Wedding Invitation</title>
    <link rel="stylesheet" href="styles.css">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="behavior.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="letter-image">
            <img src="images/sealwax.webp" alt="" id="button-click">
            <div class="animated-mail">
                <div class="back-fold"></div>
                <div class="letter">
                    <div class="letter-context-body">
                        <img src="images/invitations/Cover.png" alt="">
                        <img src="images/invitations/AttireGuide.png" alt="">
                        <img src="images/invitations/Entourage.png" alt="">
                        <img src="images/invitations/RSVP1.png" alt="">
                    </div>
                </div>
                <div class="top-fold"></div>
                <div class="body"></div>
                <div class="left-fold"></div>
            </div>
            <div class="shadow"></div>
        </div>
    </div>
    
    <div class="container">
        <?php
            $images = $imagesRSVP1;
        ?>
        <input type="radio" name="slider" id="item-1" value="1" checked>
        <input type="radio" name="slider" id="item-2" value="2">
        <input type="radio" name="slider" id="item-3" value="3">
        <input type="radio" name="slider" id="item-4" value="4">
        <div class="cards">
            <label class="card" for="item-1" id="wedding-1">
                <img src="<?=$images['Cover'];?>" alt="Cover">
            </label>
            <label class="card" for="item-2" id="wedding-2">
                <img src="<?=$images['Guide'];?>" alt="Guide">
            </label>
            <label class="card" for="item-3" id="wedding-3">
                <img src="<?=$images['Entourage'];?>" alt="Entourage">
            </label>
            <label class="card" for="item-4" id="wedding-4">
                <img src="<?=$images['RSVP'];?>" alt="RSVP">
            </label>
        </div>
        <div class="player">
            <div class="upper-part">
                <div class="info-area" id="test">
                    <label class="wedding-info" id="wedding-info-1">
                        <div class="title">You are Invited</div>
                        <div class="sub-line">
                            <div class="subtitle">Witness the most important day of our lives</div>
                        </div>
                    </label>
                    <label class="wedding-info" id="wedding-info-2">
                        <div class="title">What you should know</div>
                        <div class="sub-line">
                            <div class="subtitle">Attire, Venue, Gifts, all there.</div>
                        </div>
                    </label>
                    <label class="wedding-info" id="wedding-info-3">
                        <div class="title">Entourage</div>
                        <div class="sub-line">
                            <div class="subtitle">Cherished Members of Our Journey</div>
                        </div>
                    </label>
                    <label class="wedding-info" id="wedding-info-4">
                        <button class="emerald-button">Accept Invitation</button>
                        <button class="gold-button">Decline Invitation</button>
                    </label>
                </div>
                <div class="play-icon">
                    <img src="images/next-icon.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>