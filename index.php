<?php
    $imagesRSVP1 = [
        'Cover' => 'images/invitations/Cover.png',
        'Guide' => 'images/invitations/Guide.png',
        'Entourage' => 'images/invitations/Entourage.png',
        'RSVP' => 'images/invitations/RSVP1.png',
    ];
    $imagesRSVP2 = [
        'Cover' => 'images/invitations/Cover.png',
        'Guide' => 'images/invitations/Guide.png',
        'Entourage' => 'images/invitations/Entourage.png',
        'RSVP' => 'images/invitations/RSVP2.png',
    ];
    $imagesRSVP3 = [
        'Cover' => 'images/invitations/Cover.png',
        'Guide' => 'images/invitations/Guide.png',
        'Entourage' => 'images/invitations/Entourage.png',
        'RSVP' => 'images/invitations/RSVP3.png',
    ];
    $invitee = null;

    if (isset($_GET['id'])) {
        $dev = false;
        $connected = false;
        try {
            $servername = "localhost";
            $username = $dev ? "u585112692_wedding" : "root";
            $password = $dev ? "Yassel23!" : "";
            $dbname = $dev ? "u585112692_wedding" : "wedding";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
        
            // Check connection
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }

            $connected = true;
            $sqlData = "SELECT * FROM attendees WHERE id = ".$_GET['id'];
            $data = [];
            $result = mysqli_query($conn, $sqlData);
            
            if (mysqli_num_rows($result) > 0) {
                $invitee = mysqli_fetch_assoc($result);
            }
        } catch (Exception $e) {
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You are Invited - Yasmin & Julcarl's Wedding</title>
    <link rel="stylesheet" href="styles.css">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="behavior.js"></script>
    <link rel="shortcut icon" href="images/favico/favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="flower-border">
            <div class="circle-image">
                <img src="images/backgrounds/1.png" alt="">
            </div>
        </div>
        <div class="message">
            <h1>Yas & Jul</h1>
            <p>INVITE YOU TO CELEBRATE <br> THEIR MARRAIAGE</p>
            <span>Open the invitation by tapping the stamp seal</span>
        </div>
        <div class="letter-image">
            <img src="images/sealwax.webp" alt="" id="button-click">
            <div class="animated-mail">
                <div class="back-fold"></div>
                <div class="letter">
                    <div class="letter-context-body">
                        <img src="images/invitations/Cover.png" alt="">
                        <img src="images/invitations/Guide.png" alt="">
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
                <div class="play-icon back-icon">
                    <img src="images/back-icon.png" alt="">
                </div>
                <div class="info-area" id="test">
                    <label class="wedding-info" data-info="1" id="wedding-info-1">
                        <div class="title">You are Invited</div>
                        <div class="sub-line">
                            <div class="subtitle">Witness the most important day of our lives</div>
                        </div>
                    </label>
                    <label class="wedding-info" data-info="2" id="wedding-info-2">
                        <div class="title">What you should know</div>
                        <div class="sub-line">
                            <div class="subtitle">Attire, Venue, Gifts, all there.</div>
                        </div>
                    </label>
                    <label class="wedding-info" data-info="3" id="wedding-info-3">
                        <div class="title">Entourage</div>
                        <div class="sub-line">
                            <div class="subtitle">Cherished Members of Our Journey</div>
                        </div>
                    </label>
                    <label class="wedding-info" data-info="4" id="wedding-info-4">
                        <!-- <button id="accept" class="emerald-button">Accept Invitation</button> -->
                        <label class="emerald-button" for="modal-2">Accept Invitation</label>
                        <label class="gold-button" for="modal-1">Decline Invitation</label>
                    </label>
                </div>
                <div class="play-icon next-icon">
                    <img src="images/next-icon.png" alt="">
                </div>
            </div>
        </div>
    </div>

    
    <input class="modal-state" id="modal-1" type="checkbox" />
    <div class="modal">
        <label class="modal__bg" for="modal-1"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-1"></label>
            <p><?=$invitee ? $invitee['guest_one'] : ''?></p>
        </div>
    </div>

    <input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>
            <p><?=$invitee ? $invitee['guest_one'] : ''?></p>
        </div>
    </div>
</body>
</html>