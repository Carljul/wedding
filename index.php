<?php
include 'env.php';
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
        $connected = false;
        try {
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
                
                $guestOne = $invitee['guest_one'];
                $guestTwo = $invitee['guest_two'];
                $guestThree = $invitee['guest_three'];
                $withKids = $invitee['kids_count'];
                $willattend = $invitee['willattend'];
                $guestCount = $invitee['guest_count'];
                $responded = $invitee['responded'];
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
    <title><?=($guestOne ?? '')?> you are invited to Yasmin & Julcarl's Wedding</title>
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
            <div class="subcontent">
            <?php if ($invitee): ?>
                <?php if ($responded && $willattend): ?>
                    <p>
                        SEE YOU THERE
                        <br>
                        <b><?=$guestOne;?>!</b><br>
                        <?php if ($guestTwo != ''): ?>
                            <b><?=$guestTwo;?>!</b><br>
                        <?php endif; ?>
                        <?php if ($guestThree != ''): ?>
                            <b><?=$guestThree;?>!</b>
                        <?php endif; ?>
                    </p>
                    <p>
                        Don't forget:
                        <br>
                        <b>May 6, 2024, at exactly 10 AM.</b>
                    </p>
                    <p>
                        <b>@ Archdiocesan Shrine of St. Francis of Assisi</b>
                        <br>
                        <a href="https://maps.app.goo.gl/VAiCaWkF5tsvwgCk8" target="_blank"><small style="text-transform: capitalize;">6Q55+G7, Natalio B. Bacalso S. National Highway, City of Naga Cebu</small></a>
                    </p>
                <?php elseif ($responded && !$willattend): ?>
                    <p>THANK YOU FOR RESPONDING <b><?=$guestOne;?></b></p>
                <?php else: ?>
                    <p>INVITE YOU TO CELEBRATE <br> THEIR MARRIAGE</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <?php if ($invitee): ?>
            <?php if (!$responded): ?>
                <span>Open the invitation by tapping the stamp seal</span>
            <?php endif; ?>
        <?php endif; ?>
        </div>
        <?php if ($invitee): ?>
            <?php if (!$responded): ?>
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
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <?php if ($invitee): ?>
    <div class="container">
        <?php
            if ($guestOne != '' && $guestTwo != '' && $guestThree != '') {
                $images = $imagesRSVP3;
            } else if ($guestOne != '' && $guestTwo != '' && $guestThree == '') {
                $images = $imagesRSVP2;
            } else if ($guestOne != '' && $guestTwo == '' && $guestThree == '') {
                $images = $imagesRSVP1;
            } else {
                $images = $imagesRSVP1;
            }
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
                        <label class="emerald-button" for="modal-2">Accept Invitation</label>
                        <label class="gold-button" for="modal-1">Decline Invitation</label>
                        <label class="refresh-button">Done! This device is already used to accept invitation, please use another device</label>
                    </label>
                </div>
                <div class="play-icon next-icon">
                    <img src="images/next-icon.png" alt="">
                </div>
            </div>
        </div>
    </div>
 
    <!-- Decline -->
    <input class="modal-state" id="modal-1" type="checkbox" hidden/>
    <div class="modal">
        <label class="modal__bg" for="modal-1"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-1"></label>
            <div class="decline-message">
                <div class="message">
                    <p class="name">Hi <b><?=$invitee ? $invitee['guest_one'] : ''?></b></p>
                    <p class="confirmation">Are you sure you want to decline this invitation?</p>
                    <span>&nbsp;</span>
                </div>
                <button id="decline-invitation" class="gold-button" data-guest-count="<?=$guestCount;?>" data-id="<?=$_GET['id'];?>">Decline Invitation</button>
            </div>
        </div>
    </div>

    <!-- Accepting -->
    <input class="modal-state" id="modal-2" type="checkbox" hidden/>
    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>
            <div class="accept-message">
                <div id="message-invitation" class="message">
                    <p class="name">Hi <b><?=$invitee ? $invitee['guest_one'] : ''?></b></p>
                    
                    <?php
                        if ($guestCount == 3) {
                            echo "<p class='confirmation'>We're thrilled to have you, <b>".$invitee['guest_two']."</b>, and, <b>".$invitee['guest_three']."</b> with us on our wedding day.";
                        } else if ($guestCount == 2) {
                            echo '<p class="confirmation">It brings us great joy to know that you and <b>'.$invitee['guest_two'].'</b> will be present at our wedding.';
                        } else {
                            echo "<p class='confirmation'>We're ecstatic about your presence at our wedding celebration.</p>";
                        }
                    ?>
                </div>
                <div class="downloads">
                    <div class="message">
                        <h2>Thank you for accepting! Please download the following images!</h2>
                    </div>
                    <a href="images/invitations/Cover.png" download="Cover">Download Cover</a>
                    <a href="images/invitations/Entourage.png" download="Entourage">Download Entourage</a>
                    <a href="images/invitations/Guide.png" download="Guide">Download Guide</a>
                    <a href="images/invitations/RSVP<?=$guestCount;?>.png" download="RSVP">Download RSVP</a>
                </div>
                <button id="accept-invitation" data-guest-count="<?=$guestCount;?>" data-id="<?=$_GET['id'];?>" class="emerald-button">Accept Invitation</button>
            </div>
        </div>
    </div>
    
    <?php endif; ?>
</body>
</html>