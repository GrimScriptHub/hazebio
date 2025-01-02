<?php
include("inc/config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Sanitize the input to avoid security issues
$username = isset($_GET['username']) ? mysqli_real_escape_string($conn, $_GET['username']) : '';

// If the username is empty, redirect to the homepage
if (empty($username)) {
    header("Location: https://localhost");
    exit;
}

// Get the user's IP address
$ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

// Prepare the statement
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

// Bind the parameter
mysqli_stmt_bind_param($stmt, "s", $username);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result set
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Store values from the database in variables
    $uid = $row['id'];
    $name = $row['username'];
    $color = $row['collor'];
    $sparkles = $row['sparkles'];
    $avatar = $row['avatar'];
    $customimg = $row['customimg'];
    $owner = $row['owner'];
    $dev = $row['dev'];
    $bhunt = $row['bhunt'];
    $support = $row['support'];
    $staff = $row['hasperms'];
    $premium = $row['premium'];
    $bio = $row['bio'];
    $discord = $row['discord'];
    $github = $row['github'];
    $telegram = $row['telegram'];
    $tiktok = $row['tiktok'];
    $roblox = $row['roblox'];
    $imgredirect = $row['imgredirect'];
    $background = $row['background'];
    $music = $row['music'];
    $pmoji = $row['pmoji'];
    $paidemoji = $row['paidemoji'];
    $paidtool = $row['etext'];
    $feather = $row['feather'];
    $views = $row['views'];

    // Check if the IP has viewed the profile in the last hour
    $lastViewTime = strtotime($row['last_view']); // Get the timestamp of the last view
    $currentTime = time(); // Get the current timestamp

    if ($lastViewTime < ($currentTime - 3600)) {
        // IP hasn't viewed the profile in the last hour, update the view count

        // Increment views count
        $views += 1;

        // Update the views count and last view time
        $updateViewsSql = "UPDATE users SET views = ?, last_view = NOW(), last_ip = ? WHERE username = ?";
        $updateStmt = mysqli_prepare($conn, $updateViewsSql);
        mysqli_stmt_bind_param($updateStmt, "iss", $views, $ip, $username);

        if (mysqli_stmt_execute($updateStmt)) {
            // Successfully updated views
        } else {
            // Error updating views
            echo "Error updating view count.";
        }

        // Close the update statement
        mysqli_stmt_close($updateStmt);
    }

    // Close the initial statement
    mysqli_stmt_close($stmt);
} else {
    // Redirect to homepage if no user is found
    header("Location: https://localhost");
    exit;
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gethaze - <?php echo $name ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $avatar ?>">
    <meta name="description" content="<?php echo $name ?>">
    <meta property="og:title" content="Private Biolink">
    <meta property="og:description" content="@<?php echo $name ?>">
    <meta property="og:url" content="index.html">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#fff">
    <meta property="og:image" content="../i1.sndcdn.com/artworks-TUASAIQOYOz8L3mt-97CFQQ-t500x500.jpg">
    <meta property="og:video" content="../i1.sndcdn.com/artworks-TUASAIQOYOz8L3mt-97CFQQ-t500x500.jpg">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="icon" type="image/x-icon" href="#">

    <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey && (e.key === 'u' || e.key === 'U' || e.key === 's' || e.key === 'S')) {
                e.preventDefault();
            }
        });
    </script>


<style>

@font-face {
    font-family: custom-font;
    src: url(fonts/Poppins-Regular.ttf);
}
* {
    font-family: custom-font;
}

body {
    background-size: cover;
    background-position: center center;
    display: flex;
    color: #fff;
    background-color: #1F2128;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}


.customglow-username {
    font-size: 30px;
    margin-right: 10px;
    color: #ffffff;
    font-weight: bold;
    line-height: 2rem;
    text-align: center;
    filter: drop-shadow(0 0 0.2rem #ffffff);
}


.username-container {
  display: flex;
  align-items: center;
  justify-content: center;
}


@keyframes glow {
    0% {
        box-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 15px #ffffff, 0 0 20px #ffffff;
    }
    50% {
        box-shadow: 0 0 20px #ffffff, 0 0 30px #ffffff, 0 0 40px #ffffff, 0 0 50px #ffffff;
    }
    100% {
        box-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 15px #ffffff, 0 0 20px #ffffff;
    }
}

.avatar_effect {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    -o-object-fit: cover;
    object-fit: ;
    margin: 0 auto;
    animation: glow 2s infinite;
    margin-bottom: 10px;
}


.avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    -o-object-fit: cover;
    object-fit: cover;
    margin: 0 auto;
    margin-bottom: 10px;
}
#particles-js {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: -1;
    top: 0;
    left: 0;
}


.rainbow-username {
  font-size: 30px;
  font-weight: bold;
  
  margin-right: 10px;
  color: #ff0000;
  animation: animate 3s linear infinite;
  text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000, 0 0 15px #ff0000, 0 0 20px #ff0000;
}

@keyframes animate {
  from {
    filter: hue-rotate(0deg);
  }
  to {
    filter: hue-rotate(360deg);
  }
}


  /* border */
  .border {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      padding: 39px 27px;
      width: 100%;
      max-width: 35.9rem;
      border-radius: 35px;
      backdrop-filter: blur(7px);
      background-color: rgb(255, 255, 255, 0.13) !important;
      box-shadow: 0 0 2.5px #ffffff;
  }
      
  @media (max-width : 480px) {
      .border {
          left: 50%;
          padding: 0px, 0px;
          width: 80%;
          max-width: 100%;
          border-radius: 21px;
      }
  }
  
.role-icon-wrapper {
    padding: 7px 10px 1.5px;
    border-radius: 50px;
    max-width: -moz-fit-content;
    max-width: fit-content;
    display: inline-flex;
    place-items: center;
    margin: 2px auto 20px;
    background-color: rgba(255, 255, 255, 0.09);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.icon:active {
  transform: scale(1.2);
}

.icon {
  transition: all 0.2s ease-in-out;
}

.icon:hover {
  transform: scale(1.2);
}

.pixelated {
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 1;
    background: transparent url(images/EyzV6w4.png) repeat 0 0;
}



  /* icons */
  social-icons {
      text-align: center;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
  }
  
  .icon {
     margin: 3px;
     width: 35px;
     height: 35px;
  }
  
  .icon-link {
      margin: 10px;
      text-decoration: none;
      text-align: center;
  }
  
  .icon-link:not(:nth-child(-n+8)) {
      display: none;
  }
  
  /* social media */
  
  .social-media {
      text-align: center;
      position: relative;
  }
  
  .description {
    font-size: 17px;
        margin: 14px 0;
      color: #fff;
  }
  
  .username {
  color: <?php echo $color; ?>;
  font-size: 30px;
  margin-right: 10px;
  font-weight: bold;
  <?php if ($sparkles == 1): ?>
    background-image: url(images/sparkle.gif);
    background-size: auto 400%; /* Adjust the width as needed */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    background-position: center; /* Center the background image */
  <?php endif; ?>
}

  
  .normal-username {
    color: #fff;
    font-size: 30px;
    margin-right: 10px;
    
    font-weight: bold;
}

.role-icon {
    display: inline-block;
    position: relative;
    cursor: pointer;
    outline: none;
    border: none;
    box-shadow: none;
}

.role-icon img {
    width: 31px;
    height: 31px;
}

  .glowblue-username {
    font-size: 30px;
    margin-right: 10px;
    
    font-weight: bold;
    line-height: 2rem;
    text-align: center;
    text-shadow: 0 0 10px #0000ff, 0 0 20px #0000ff, 0 0 30px #0000ff, 0 0 40px #0000ff, 0 0 50px #0000ff, 0 0 60px #0000ff, 0 0 70px #0000ff, 0 0 80px #0000ff;
}

@keyframes popin {
    0% { transform: scale(0.5) translateX(-50%); }
    100% { transform: scale(1) translateX(-50%); }
}

.etext {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.5);
    color: #f0f0f0;
    font-weight: 580!important;
    user-select: none;
    padding: 5px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    white-space: nowrap;
    display: block;
    z-index: 1;
    transform: scale(0) translateX(-50%);
    left: 50%;
    bottom: 110%;
    letter-spacing: .01cm!important;
    font-size: 14.3px;
    transition: transform 0.1s ease-out;
}

.role-icon:hover .etext,
.role-icon:focus-within .etext {
    animation: popin 0.1s ease-out forwards;
}


  /* glow animation */
  
  @keyframes username {
      0% {
          text-shadow: 0px 0px 9px #5539cc;
          opacity: 1;
      }
      14% {
          text-shadow: 0px 0px 9px #5539cc;
          opacity: 0.50;
      }
      20% {
          text-shadow: 0px 0px 5px #feda75,
          0px 0px 5px #fa7e1e,
          0px 0px 5px #d62976,
          0px 0px 5px #962fbf,
          0px 0px 5px #4f5bd5;
          opacity: 1;
      }
      30% {
          text-shadow: 0px 0px 5px #229ED9;
          opacity: 0.25;
      }
      40% {
          text-shadow: 0px 0px 10px #A00003;
          opacity: 1;
      }
      50% {
          text-shadow: 0px 0px 10px #FFFC00;
          opacity: 0.25;
      }
      60% {
          text-shadow: 0px 0px 5px #0079C1;
          opacity: 1;
      }
      70% {
          text-shadow: 0px 0px 5px gray;
          opacity: 0.25;
      }
      80% {
          text-shadow: 0px 0px 5px blue;
          opacity: 1;
      }
      90% {
          text-shadow: 0px 0px 5px #E60023;
          opacity: 0.25;
      }
  }

.videobg {
    width: 100%;
    height: 100%;
    z-index: -3;
    position: absolute
}

#vidx {
    width: 100vw;
    height: 100vh;
    -o-object-fit: cover;
    object-fit: cover;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: -1
}

@keyframes fadeinout{
    0%{
        background-position:-500%
    }
    100%{
        background-position:500%
    }
}
.fadeinoutname{
    margin-right: 10px;
    position:relative;
    overflow:hidden;
    background: linear-gradient(90deg,#000,#ffffff,#ffffff,#000);
    background-repeat:no-repeat;
    background-size:80%;
    animation:fadeinout 2s linear infinite;
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent
}
</style>

<style>
.status {
    color: #f23f43;
    position: absolute;
    font-size: 19.5px;
    bottom: 3.5px;
    left: 55.5px;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none
}

.statuscontainer_dnd {
    color: #f23f43;
    position: absolute;
    font-size: 19.5px;
    bottom: 3.5px;
    left: 55.5px;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none
}

.statuscontainer_idle {
    color: #eff23f;
    position: absolute;
    font-size: 19.5px;
    bottom: 3.5px;
    left: 55.5px;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none
}

.statuscontainer_online {
    color: #08d334;
    position: absolute;
    font-size: 19.5px;
    bottom: 3.5px;
    left: 55.5px;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none
}

.statuscontainer_offline {
    color: #858585;
    position: absolute;
    font-size: 19.5px;
    bottom: 3.5px;
    left: 55.5px;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none
}

.container, .discordcontainer {
    padding: 10px;
    border-radius: 15px;
    position: relative;
    display: inline-flex;
    place-items: center;
}

.profile-pic, .avatarcontainer {
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    border-radius: 50%;
    -o-object-fit: cover;
    object-fit: cover;
}

.info h1, .infocontainer h1 {
    text-align: left;
    padding: 0;
    margin: 0 0 0 11px;
    font-size: 19.7px;
    max-width: 240px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    font-weight: 630;
}

.status, .statuscontainer_dnd, .statuscontainer_idle, .statuscontainer_online {
    position: absolute;
    font-size: 19.5px;
    bottom: 3.5px;
    left: 55.5px;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
}

.status {
    color: #f23f43;
}

.statuscontainer_dnd {
    color: #f23f43;
}

.statuscontainer_idle {
    color: #eff23f;
}

.statuscontainer_online {
    color: #08d334;
}

.infocontainer h3 {
    text-align: left;
    padding: 0;
    font-size: 13.2px;
    font-weight: 520;
    max-width: 270px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    margin: 3.5px 6px 0 11px;
}

@media (max-width: 767px) {
    .info h1, .infocontainer h1 {
        max-width: 115px;
    }

    .infocontainer h3 {
        max-width: 115px;
    }
}

@media (min-width: 768px) {
    .info h1, .infocontainer h1 {
        max-width: 170px;
    }

    .infocontainer h3 {
        max-width: 170px;
    }
}

@media (min-width: 992px) {
    .info h1, .infocontainer h1 {
        max-width: 210px;
    }

    .infocontainer h3 {
        max-width: 210px;
    }
}

@media (min-width: 1200px) {
    .info h1, .infocontainer h1 {
        max-width: 240px;
    }

    .infocontainer h3 {
        max-width: 270px;
    }
}

@media (max-width: 359px) {
    .info h1, .infocontainer h1 {
        max-width: 100px;
    }

    .infocontainer h3 {
        max-width: 100px;
    }
}
</style>

<script>
  var i = 0;
  var txt = 'Made by Grim, gethaze.lol and skidded';  // Text to type
  var speed = 1000;  // Faster typing speed (100ms per character)
  var isDeleting = false;

  function typeWriter() {
    if (isDeleting && i > 0) {
      document.title = "@" + txt.substring(0, i-1);
      i--;
      setTimeout(typeWriter, speed);
    } else if (!isDeleting && i < txt.length) {
      document.title = "@" + txt.substring(0, i+1);
      i++;
      setTimeout(typeWriter, speed);
    }

    if (i == txt.length) {
      isDeleting = true;
    } else if (i == 0) {
      isDeleting = false;
    }
  }

  typeWriter();
</script>




<link rel="stylesheet" href="css/all.min.css">
</head>

  
<body>      

 <div id="enter">
        <p>click</p>
</div>

<div style="background-image: url('<?php echo $background; ?>'); position: absolute; height: 100%; width: 100%; background-size: cover; background-position: 50%; z-index: -1;"></div>

<div class="videobg">
  <?php
  // Check if $background is a valid URL
  if (filter_var($background, FILTER_VALIDATE_URL)) {
    echo '<img src="' . $background . '" alt="Background Image">';
  } else {
    // Check if $background is a valid video path
    $videoExtension = strtolower(pathinfo($background, PATHINFO_EXTENSION));
    if ($videoExtension === 'mp4') {
      echo '<video id="vidx" loop="" playsinline="" draggable="false" autoplay="" muted="">
              <source src="' . $background . '" type="video/mp4" id="video-source">
            </video>';
    } else {
      // If the URL is invalid or the video format is unsupported, display an error message
      echo '<p>Error: Unsupported video format or invalid path</p>';
    }
  }
  ?>
</div>






<div class="pixelated"></div>


    <div class="landing" id="landing">
      
<div id="particles-js"></div>

<div class="border">
  <div class="avatar">
      <div class="avatar-container" style="display: flex; justify-content: center; align-items: center;">

      
          <?php
    echo '<img src="' . $avatar . '" alt="Avatar" class="inline-effect avatar">';
?>
      </div>
  </div>


        <div class="social-media">
            <!-- username -->

            <h1 <?php
if ($premium == 0) {
    $class = "normal-username";
} else {
    $class = "username";
}
?>
    <span class="username"><?php echo $name; ?></span>


<?php
if ($owner == 1) {
    echo '<div class="role-icon verified">
              <svg style="color: #95c5f5;
                          filter: drop-shadow(0 0 2.5px #95c5f5);
                          vertical-align: -1px;
                          top:5px;
                          position: relative;" viewbox="0 0 24 24" width="32" height="32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                      <path d="M8.5 12.5L10.0089 14.0089C10.3526 14.3526 10.5245 14.5245 10.7198 14.5822C10.8914 14.6328 11.0749 14.6245 11.2412 14.5585C11.4305 14.4834 11.5861 14.2967 11.8973 13.9232L16 9M16.3287 4.75855C17.0676 4.77963 17.8001 5.07212 18.364 5.636C18.9278 6.19989 19.2203 6.9324 19.2414 7.67121C19.2623 8.40232 19.2727 8.76787 19.2942 8.85296C19.3401 9.0351 19.2867 8.90625 19.383 9.06752C19.428 9.14286 19.6792 9.40876 20.1814 9.94045C20.6889 10.4778 21 11.2026 21 12C21 12.7974 20.6889 13.5222 20.1814 14.0595C19.6792 14.5912 19.428 14.8571 19.383 14.9325C19.2867 15.0937 19.3401 14.9649 19.2942 15.147C19.2727 15.2321 19.2623 15.5977 19.2414 16.3288C19.2203 17.0676 18.9278 17.8001 18.364 18.364C17.8001 18.9279 17.0676 19.2204 16.3287 19.2414C15.5976 19.2623 15.2321 19.2727 15.147 19.2942C14.9649 19.3401 15.0937 19.2868 14.9325 19.3831C14.8571 19.4281 14.5912 19.6792 14.0595 20.1814C13.5222 20.6889 12.7974 21 12 21C11.2026 21 10.4778 20.6889 9.94047 20.1814C9.40874 19.6792 9.14287 19.4281 9.06753 19.3831C8.90626 19.2868 9.0351 19.3401 8.85296 19.2942C8.76788 19.2727 8.40225 19.2623 7.67121 19.2414C6.93238 19.2204 6.19986 18.9279 5.63597 18.364C5.07207 17.8001 4.77959 17.0676 4.75852 16.3287C4.73766 15.5976 4.72724 15.2321 4.70578 15.147C4.65985 14.9649 4.71322 15.0937 4.61691 14.9324C4.57192 14.8571 4.32082 14.5912 3.81862 14.0595C3.31113 13.5222 3 12.7974 3 12C3 11.2026 3.31113 10.4778 3.81862 9.94048C4.32082 9.40876 4.57192 9.14289 4.61691 9.06755C4.71322 8.90628 4.65985 9.03512 4.70578 8.85299C4.72724 8.7679 4.73766 8.40235 4.75852 7.67126C4.77959 6.93243 5.07207 6.1999 5.63597 5.636C6.19986 5.07211 6.93238 4.77963 7.67121 4.75855C8.40232 4.73769 8.76788 4.72727 8.85296 4.70581C9.0351 4.65988 8.90626 4.71325 9.06753 4.61694C9.14287 4.57195 9.40876 4.32082 9.94047 3.81863C10.4778 3.31113 11.2026 3 12 3C12.7974 3 13.5222 3.31114 14.0595 3.81864C14.5913 4.32084 14.8571 4.57194 14.9325 4.61693C15.0937 4.71324 14.9649 4.65988 15.147 4.70581C15.2321 4.72726 15.5976 4.73769 16.3287 4.75855Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                  </g>
              </svg>
              <span class="etext">Owner</span>
            </div>
            <br>'; 
        } else {
            echo '<br>';
        }
        ?>

</h1>

              
            









<!-- roles -->

<?php if ($dev == 1) {
       echo '<div class="role-icon dev">
            <svg xmlns="http://www.w3.org/2000/svg" style="

                color: #ffffff;
                filter: drop-shadow(0 0 2.5px #0e0b0e);
                vertical-align: -1px;
                margin-right: 3px;
                margin-left: 3px;
                
            " width="27" height="27" fill="currentColor" class="bi bi-braces-asterisk" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C2.25 2 1.49 2.759 1.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6ZM14.886 7.9v.164c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456v-1.3c-1.114 0-1.49-.362-1.49-1.456V4.352C14.51 2.759 13.75 2 12.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6ZM7.5 11.5V9.207l-1.621 1.621-.707-.707L6.792 8.5H4.5v-1h2.293L5.172 5.879l.707-.707L7.5 6.792V4.5h1v2.293l1.621-1.621.707.707L9.208 7.5H11.5v1H9.207l1.621 1.621-.707.707L8.5 9.208V11.5h-1Z"/>
            </svg>
            <span class="etext">Developer</span>
            </div>';
        } else {
            echo '';
        }
        ?>

<?php if ($bhunt == 1) {    
       echo'     <div class="role-icon bughunter">
                <svg xmlns="http://www.w3.org/2000/svg" style="   
                    color: #ffffff;
                    filter: drop-shadow(0 0 2.5px #0e0b0e);
                    vertical-align: -1px;
                    margin-right: 3px;
                    margin-left: 3px;" width="27" height="27" fill="currentColor" class="bi bi-bug" viewBox="0 0 16 16">
                    <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A4.979 4.979 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A4.985 4.985 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623zM4 7v4a4 4 0 0 0 3.5 3.97V7H4zm4.5 0v7.97A4 4 0 0 0 12 11V7H8.5zM12 6a3.989 3.989 0 0 0-1.334-2.982A3.983 3.983 0 0 0 8 2a3.983 3.983 0 0 0-2.667 1.018A3.989 3.989 0 0 0 4 6h8z"/>
                </svg>
                <span class="etext">Bug Hunter</span>
                </div>';
            } else {
                echo '';
            }
            ?>

<?php if ($staff == 1) {  
         echo'     <div class="role-icon staff">
            <svg xmlns="http://www.w3.org/2000/svg" style="

                color: #ffffff;
                filter: drop-shadow(0 0 2.5px #0e0b0e);
                vertical-align: -1px;
                margin-right: 3px;
                margin-left: 3px;
                
            " width="27" height="27" fill="currentColor" class="bi bi-person-fill-gear" viewbox="0 0 16 16">
              <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"></path>
          </svg>
            <span class="etext">Staff<span>
            </span></span></div>'
            ;
            } else {
                echo '';
            }
            ?>
            


               <div class="role-icon boost">
                    <svg xmlns="http://www.w3.org/2000/svg" style="
                        color: #ffffff;
                        filter: drop-shadow(0 0 2.5px #0e0b0e);
                        vertical-align: -1px;
                        margin-right: 3px;
                        margin-left: 3px;
                    " width="27" height="27" fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566ZM9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
                    </svg>
                    <span class="etext">Member</span>
                    </div>
                


<?php if ($premium == 1) { 
           echo '<div class="role-icon og">
             <svg xmlns="http://www.w3.org/2000/svg" style="
               color: #ffffff;
               filter: drop-shadow(0 0 2.5px #0e0b0e);
               vertical-align: -1px;
               margin-right: 3px;
               margin-left: 3px;
               " width="27" height="27" viewbox="23 32 465 448"><path fill="currentColor" d="M396.31 32H264l84.19 112.26L396.31 32zm-280.62 0l48.12 112.26L248 32H115.69zM256 74.67L192 160h128l-64-85.33zm166.95-23.61L376.26 160H488L422.95 51.06zm-333.9 0L23 160h112.74L89.05 51.06zM146.68 192H24l222.8 288h.53L146.68 192zm218.64 0L264.67 480h.53L488 192H365.32zm-35.93 0H182.61L256 400l73.39-208z"></path></svg>
             <span class="etext">Premium</span>
        </div>
	';
} else {
    echo '';
}
?>
<?php
if ($pmoji == 1) {
    echo '<div class="role-icon dev">
            <img src="emojis/' . $paidemoji . '" alt="Emoji" class="emoji-img">
            <span class="etext">' . $paidtool . '</span>
        </div>';
} else {
    echo '';
}
?>





</div>

            <div id="discordrpc"></div>


            <!-- description  -->
            <?php echo '<p class="description typewrite" data-period="1000" data-type=\'["made by grim", "gethaze.lol", "invite only"]\'>'; ?>

                <span class="wrap"></span>
              </p>          

        <div id="spotify"></div>
          <!-- socials  -->
          <div style="
              margin: 0 .5rem;
              color: #fff;
              font-size: 2rem;
              transition: all .2s ease-in-out;
              margin-top: 10px;
          ">
          <?php
if (!empty($discord)) {
    echo '<a href="https://discord.gg/' . $discord . '" target="_blank" rel="noopener noreferrer">';
    echo '<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="#ffffff" height="36" width="36">';
    echo '<path d="M524.531 69.836a1.5 1.5 0 0 0-.764-.7A485.065 485.065 0 0 0 404.081 32.03a1.816 1.816 0 0 0-1.923.91 337.461 337.461 0 0 0-14.9 30.6 447.848 447.848 0 0 0-134.426 0 309.541 309.541 0 0 0-15.135-30.6 1.89 1.89 0 0 0-1.924-.91 483.689 483.689 0 0 0-119.688 37.107 1.712 1.712 0 0 0-.788.676C39.068 183.651 18.186 294.69 28.43 404.354a2.016 2.016 0 0 0 .765 1.375 487.666 487.666 0 0 0 146.825 74.189 1.9 1.9 0 0 0 2.063-.676A348.2 348.2 0 0 0 208.12 430.4a1.86 1.86 0 0 0-1.019-2.588 321.173 321.173 0 0 1-45.868-21.853 1.885 1.885 0 0 1-.185-3.126 251.047 251.047 0 0 0 9.109-7.137 1.819 1.819 0 0 1 1.9-.256c96.229 43.917 200.41 43.917 295.5 0a1.812 1.812 0 0 1 1.924.233 234.533 234.533 0 0 0 9.132 7.16 1.884 1.884 0 0 1-.162 3.126 301.407 301.407 0 0 1-45.89 21.83 1.875 1.875 0 0 0-1 2.611 391.055 391.055 0 0 0 30.014 48.815 1.864 1.864 0 0 0 2.063.7A486.048 486.048 0 0 0 610.7 405.729a1.882 1.882 0 0 0 .765-1.352c12.264-126.783-20.532-236.912-86.934-334.541ZM222.491 337.58c-28.972 0-52.844-26.587-52.844-59.239s23.409-59.241 52.844-59.241c29.665 0 53.306 26.82 52.843 59.239 0 32.654-23.41 59.241-52.843 59.241Zm195.38 0c-28.971 0-52.843-26.587-52.843-59.239s23.409-59.241 52.843-59.241c29.667 0 53.307 26.82 52.844 59.239 0 32.654-23.177 59.241-52.844 59.241Z"></path>';
    echo '</svg>';
    echo '</a>';
}
?>
    
<?php
            if (!empty($github)) {
    echo '<a href="https://github.com/' . $github . '" target="_blank" rel="noopener noreferrer">';
    echo '<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" fill="#ffffff" height="36" width="36" style="filter: drop-shadow(0 0 0.2rem #ffffff);">';
    echo '<path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path>';
    echo '</svg>';
    echo '</a>';
}

?>

<?php

if (!empty($telegram)) {
    echo '<a href="https://instagram.com/' . $telegram . '" target="_blank" rel="noopener noreferrer">';
    echo '<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff" height="36" width="36" style="filter: drop-shadow(0 0 0.2rem #ffffff);"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9962 0.0078125C8.73824 0.0078125 8.32971 0.021622 7.05019 0.080003C5.77333 0.138241 4.90129 0.341051 4.13824 0.637622C3.34938 0.944146 2.68038 1.35434 2.01343 2.02124C1.34652 2.68819 0.936333 3.35719 0.629809 4.14605C0.333238 4.9091 0.130429 5.78115 0.0721905 7.058C0.0138095 8.33753 0 8.74605 0 12.0041C0 15.262 0.0138095 15.6705 0.0721905 16.9501C0.130429 18.2269 0.333238 19.099 0.629809 19.862C0.936333 20.6509 1.34652 21.3199 2.01343 21.9868C2.68038 22.6537 3.34938 23.0639 4.13824 23.3705C4.90129 23.667 5.77333 23.8698 7.05019 23.9281C8.32971 23.9864 8.73824 24.0002 11.9962 24.0002C15.2542 24.0002 15.6627 23.9864 16.9422 23.9281C18.2191 23.8698 19.0911 23.667 19.8542 23.3705C20.643 23.0639 21.312 22.6537 21.979 21.9868C22.6459 21.3199 23.0561 20.6509 23.3627 19.862C23.6592 19.099 23.862 18.2269 23.9202 16.9501C23.9786 15.6705 23.9924 15.262 23.9924 12.0041C23.9924 8.74605 23.9786 8.33753 23.9202 7.058C23.862 5.78115 23.6592 4.9091 23.3627 4.14605C23.0561 3.35719 22.6459 2.68819 21.979 2.02124C21.312 1.35434 20.643 0.944146 19.8542 0.637622C19.0911 0.341051 18.2191 0.138241 16.9422 0.080003C15.6627 0.021622 15.2542 0.0078125 11.9962 0.0078125ZM11.9962 2.16929C15.1993 2.16929 15.5788 2.18153 16.8437 2.23924C18.0133 2.29257 18.6485 2.488 19.0712 2.65229C19.6312 2.86991 20.0308 3.12986 20.4506 3.54967C20.8704 3.96943 21.1303 4.36905 21.348 4.929C21.5122 5.35172 21.7077 5.98691 21.761 7.15653C21.8187 8.42148 21.831 8.80091 21.831 12.0041C21.831 15.2071 21.8187 15.5866 21.761 16.8515C21.7077 18.0211 21.5122 18.6563 21.348 19.0791C21.1303 19.639 20.8704 20.0386 20.4506 20.4584C20.0308 20.8782 19.6312 21.1381 19.0712 21.3558C18.6485 21.5201 18.0133 21.7155 16.8437 21.7688C15.579 21.8265 15.1996 21.8388 11.9962 21.8388C8.79286 21.8388 8.41352 21.8265 7.14871 21.7688C5.97909 21.7155 5.3439 21.5201 4.92119 21.3558C4.36124 21.1381 3.96162 20.8782 3.54186 20.4584C3.1221 20.0386 2.8621 19.639 2.64448 19.0791C2.48019 18.6563 2.28476 18.0211 2.23143 16.8515C2.17371 15.5866 2.16148 15.2071 2.16148 12.0041C2.16148 8.80091 2.17371 8.42148 2.23143 7.15653C2.28476 5.98691 2.48019 5.35172 2.64448 4.929C2.8621 4.36905 3.12205 3.96943 3.54186 3.54967C3.96162 3.12986 4.36124 2.86991 4.92119 2.65229C5.3439 2.488 5.97909 2.29257 7.14871 2.23924C8.41367 2.18153 8.7931 2.16929 11.9962 2.16929ZM11.9962 16.0028C9.78776 16.0028 7.99748 14.2125 7.99748 12.0041C7.99748 9.79558 9.78776 8.00529 11.9962 8.00529C14.2047 8.00529 15.995 9.79558 15.995 12.0041C15.995 14.2125 14.2047 16.0028 11.9962 16.0028ZM11.9962 5.84381C8.594 5.84381 5.836 8.60181 5.836 12.0041C5.836 15.4062 8.594 18.1642 11.9962 18.1642C15.3984 18.1642 18.1564 15.4062 18.1564 12.0041C18.1564 8.60181 15.3984 5.84381 11.9962 5.84381ZM18.3998 7.03996C19.1949 7.03996 19.8394 6.39548 19.8394 5.60043C19.8394 4.80538 19.1949 4.16086 18.3998 4.16086C17.6048 4.16086 16.9603 4.80538 16.9603 5.60043C16.9603 6.39548 17.6048 7.03996 18.3998 7.03996Z" fill="#ffffff"/></svg>';
    echo '</a>';
}
?>


<?php
if (!empty($roblox)) {
    echo '<a href="https://roblox.com/users/' . $roblox . '/profile" target="_blank" rel="noopener noreferrer">';
    echo '<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="30.36 84.71 135.82 135.82" fill="#ffffff" height="36" width="36" style="filter: drop-shadow(0 0 0.2rem #ffffff);">';
    echo '<path d="m59.06 84.709-28.7 107.116 107.115 28.701 28.702-107.116Zm32.445 55.499 18.825 5.044-5.299 19.775-18.825-5.044z"></path>';
    echo '</svg>';
    echo '</a>';
}
?>

              
<?php

if (!empty($tiktok)) {
    echo '<a href="https://tiktok.com/@' . $tiktok . '" target="_blank" rel="noopener noreferrer">';
    echo '<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#ffffff" height="36" width="36" style="filter: drop-shadow(0 0 0.2rem #ffffff);">';
    echo '<path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25v178.72A162.55 162.55 0 1 1 185 188.31v89.89a74.62 74.62 0 1 0 52.23 71.18V0h88a121.18 121.18 0 0 0 1.86 22.17A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"></path>';
    echo '</svg>';
    echo '</a>';
}
?>




        </div>

        <div style="display: center;">
        <svg style="filter: drop-shadow(0 0 0.2rem #ffffff); margin-right: 4px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </g>
        </svg>
        <span style="font-size: 0.9em;">
    <?php
        if ($views < 1000) {
            echo $views;
        } else {
            echo number_format($views / 1000, 1) . 'K';
        }
    ?>
</span>
        <span style="color: #ffffff; margin: 0 4px;"></span>
        <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 395.71 395.71" xml:space="preserve" style="filter: drop-shadow(0 0 0.2rem #ffffff); margin-right: 4px;">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <g>
              <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"></path>
            </g>
          </g>
        </svg>
        <span style="font-size: 0.9em;"><?php echo "UID: " . $uid; ?></span>


      </div>
     </div>

     </div>
  </div>
<audio loop="true" id="audio">
        <source src="<?php echo $music ?>" type="audio/mpeg">
    </audio>



<script src="js/script.js"></script>
<script src="js/enter.js"></script>
<script src="js/particles.min.js"></script>

<script>
    var roleIconWrapper = document.querySelector('.role-icon-wrapper');
    if (roleIconWrapper.innerHTML.trim() === '') {
        roleIconWrapper.style.display = 'none';
    }
</script>

<script src="js/browser.js"></script>
  <script>
window.addEventListener("load", (event) => {
        new cursoreffects.fairyDustCursor({colors: ["#fffafa"]});
});
  </script>
  

</script>
  

<script>
function getElapsedTime(startTimestamp) {
    let currentTime = new Date();
    let elapsedTime = currentTime - new Date(startTimestamp);
    let seconds = Math.floor((elapsedTime / 1000) % 60);
    let minutes = Math.floor((elapsedTime / (1000 * 60)) % 60);
    let hours = Math.floor((elapsedTime / (1000 * 60 * 60)) % 24);
    return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

    document.addEventListener("DOMContentLoaded", function () {
        const discordApi = '';
        fetch(discordApi)
            .then(response => response.json())
            .then(data => {
                if (data.success !== true) {
                    console.error('I can\'t find user');
                    return;
                }
    
                const discordrpc = document.getElementById('discordrpc');
    
                const discordContainer = document.createElement('div');
                discordContainer.className = 'discordcontainer';
                discordContainer.style = 'margin-bottom: 10px;background-color: rgb(0, 0, 0, 0.09);border: 1px solid rgb(0, 0, 0, 0.02);border-radius: 15px';
    
                const avatar = document.createElement('img');
avatar.src = data.data.discord_user.avatar;
avatar.height = '65';
avatar.draggable = 'true';
avatar.width = '65';
avatar.className = 'avatarcontainer'; 
discordContainer.appendChild(avatar);

    
                const infoDiv = document.createElement('div');
                infoDiv.className = 'infocontainer';
    
                const username = document.createElement('h1');
                username.id = 'username22';
                username.style = 'color: rgb(255 255 255);margin-right: 3px;width: 100%';
                username.textContent = `${data.data.discord_user.username}`;
                infoDiv.appendChild(username);
    
                const activities = document.createElement('h3');
                activities.id = 'activities22';
                activities.style = 'color: rgb(255 255 255);display: block;justify-content: left;margin-top: 4.5px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap; width: auto;';
                if (data.data.activities && data.data.activities.length > 0) {
                    let playingActivity = data.data.activities.find(activity => activity.type === 'PLAYING');
                    let customActivity = data.data.activities.find(activity => activity.type === 'CUSTOM');
                    let activityText = '';
                    if (playingActivity) {
                        let details = playingActivity.details || '';
                        if (playingActivity.timestamps) {
                            setInterval(function() {
                                let elapsedTime = getElapsedTime(playingActivity.timestamps.start);
                                activityText = `Playing ${playingActivity.name}${details ? '<br>' + details : ''}<br>Elapsed: ${elapsedTime}`;
                                activities.innerHTML = activityText; 

                                if (details.length > elapsedTime.length) {
                                    activities.style.width = 'auto';
                                } else {
                                    activities.style.width = '170px';
                                }
                            }, 100);
                        } else {
                            activityText = `Playing ${playingActivity.name}${details ? '<br>' + details : ''}`;
                            activities.innerHTML = activityText; 
                        }
                    } else if (customActivity) {
                        activityText = customActivity.state;
                        activities.textContent = activityText;                    
                    }
                    activities.textContent = activityText;
                } else {
                    activities.textContent = 'No activity';
                }

                infoDiv.appendChild(activities);
    
                const statusDiv = document.createElement('div');
                statusDiv.id = 'status22';
                if (data.data.discord_status === 'dnd') {
                    statusDiv.className = 'statuscontainer_dnd';
                } else if (data.data.discord_status === 'idle') {
                    statusDiv.className = 'statuscontainer_idle';
                } else if (data.data.discord_status === 'online') {
                    statusDiv.className = 'statuscontainer_online';
                } else if (data.data.discord_status === 'offline') {
                    statusDiv.className = 'statuscontainer_offline';
                }
                statusDiv.style = 'left: 55.5px; font-size: 19.5px; margin-bottom: 3px;';
                statusDiv.innerHTML = getStatus(data.data.discord_status);
                infoDiv.appendChild(statusDiv);
                let largeImageUrl;
                let smallImageUrl;

                if (data.data.activities && data.data.activities.length > 0) {
                    let playingActivity = data.data.activities.find(activity => activity.type === 'PLAYING');
                    if (playingActivity) {
                        if (playingActivity.assets && playingActivity.assets.largeImage) {
                            if (playingActivity.assets.largeImage.startsWith('mp:external/')) {
                                largeImageUrl = playingActivity.assets.largeImage.replace('mp:external/', 'https://media.discordapp.net/external/');
                            } else {
                                largeImageUrl = 'https://cdn.discordapp.com/app-assets/' + playingActivity.application_id + '/' + playingActivity.assets.largeImage + '.png';
                            }
                        }

                        if (playingActivity.assets && playingActivity.assets.smallImage) {
                            if (playingActivity.assets.smallImage.startsWith('mp:external/')) {
                                smallImageUrl = playingActivity.assets.smallImage.replace('mp:external/', 'https://media.discordapp.net/external/');
                            } else {
                                smallImageUrl = 'https://cdn.discordapp.com/app-assets/' + playingActivity.application_id + '/' + playingActivity.assets.smallImage + '.png';
                            }
                        }
                    }
                }

                discordContainer.appendChild(infoDiv);

                if (largeImageUrl) {
                    const largeImage = document.createElement('img');
                    largeImage.src = largeImageUrl;
                    largeImage.style = 'height: 63px;width: 63px;border-radius: 10px; margin-left:10px;';
                    discordContainer.appendChild(largeImage);
                }

                if (smallImageUrl) {
                    const smallImage = document.createElement('img');
                    smallImage.src = smallImageUrl;
                    smallImage.style = 'height: 25px;width: 25px;border-radius: 150px;position: absolute;bottom: 11px;right: 2px; margin-left:10px;';
                    discordContainer.appendChild(smallImage);
                }


                discordrpc.appendChild(discordContainer);
            }).catch(error => console.error('Error fetching data from Discord API:', error));
    
      function getStatus(status) {
          switch (status) {
                case 'dnd':
                    return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10s10-4.486 10-10S17.514 2 12 2zm5 11H7v-2h10v2z" fill="currentColor"></path></svg>';
                case 'idle':
                    return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M235.54 150.21a104.84 104.84 0 0 1-37 52.91A104 104 0 0 1 32 120a103.09 103.09 0 0 1 20.88-62.52a104.84 104.84 0 0 1 52.91-37a8 8 0 0 1 10 10a88.08 88.08 0 0 0 109.8 109.8a8 8 0 0 1 10 10Z"></path></svg>';
                case 'online':
                    return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m0 2a8 8 0 0 1 8 8a8 8 0 0 1-8 8a8 8 0 0 1-8-8a8 8 0 0 1 8-8m0 2a6 6 0 0 0-6 6a6 6 0 0 0 6 6a6 6 0 0 0 6-6a6 6 0 0 0-6-6m0 2a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4Z"></path></svg></div>';
                case 'offline':
                    return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M16.06 7.94a1.5 1.5 0 0 1 0 2.12L14.122 12l1.94 1.94a1.5 1.5 0 0 1-2.122 2.12L12 14.122l-1.94 1.94a1.5 1.5 0 0 1-2.12-2.122L9.878 12l-1.94-1.94a1.5 1.5 0 1 1 2.122-2.12L12 9.878l1.94-1.94a1.5 1.5 0 0 1 2.12 0ZM0 12C0 5.373 5.373 0 12 0s12 5.373 12 12s-5.373 12-12 12S0 18.627 0 12Zm12-9a9 9 0 1 0 0 18a9 9 0 0 0 0-18Z"></path></svg></div>'
                default:
                    return '';
          }
      }
  });
  </script>

<script>
    var roleIconWrapper = document.querySelector('.role-icon-wrapper');
    if (roleIconWrapper.innerHTML.trim() === '') {
        roleIconWrapper.style.display = 'none';
    }
</script>


  

<script>
let text = `harmfulskid`;
let formattedText = text.replace(/(\r\n|\n|\r)/g, '<br>');
console.log(formattedText)

</script>


<script>
   var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 1000;
    this.txt = '';
    this.isDeleting = false;
    this.messages = this.toRotate[this.loopNum].split('|').map(message => message.replace(/!br!/g, '<br/>'));
    this.messageIndex = 0;
    this.tick();
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        toRotate = toRotate.replace(/\n|\r\n/g, '\\n');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
            var parsed = JSON.parse(toRotate); 
            for (var j=0; j<parsed.length; j++) {
                parsed[j] = parsed[j].replace(/\\n/g, '\n').replace(/\n/g, '!br!');
            }
            new TxtType(elements[i], parsed, period);
        }
    }
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};

TxtType.prototype.tick = function() {
    var fullTxt = this.messages[this.messageIndex];

    if (this.isDeleting) {
        if (this.txt.endsWith('<br/>')) {
            this.txt = this.txt.substring(0, this.txt.lastIndexOf('<'));
        } else {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        }
    } else {
        if (fullTxt.substring(this.txt.length, this.txt.length + 5) === '<br/>') {
            this.txt += '<br/>';
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { 
        delta /= 4;
        if (this.txt === '') {
            this.isDeleting = false;
            if (++this.messageIndex >= this.messages.length) {
                this.messageIndex = 0;
                this.loopNum++;
                if (this.loopNum >= this.toRotate.length) {
                    this.loopNum = 0;
                }
                this.messages = this.toRotate[this.loopNum].split('|').map(message => message.replace(/!br!/g, '<br/>'));
            }
            delta = 500;
        }
    }

    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
    }

    setTimeout(function() {
        that.tick();
    }, delta);
};
</script>



    <script>
particlesJS("particles-js", {
      particles: {
        number: {
          value: 100,
          density: {
            enable: true,
            value_area: 800,
          },
        },
        color: {
          value: "#ffffff", 
        },
        shape: {
          type: "circle", 
        },
        opacity: {
          value: 0.8,
          random: true,
          anim: {
            enable: true,
            speed: 1,
            opacity_min: 0.1,
            sync: false,
          },
        },
        size: {
          value: 5,
          random: true,
          anim: {
            enable: true,
            speed: 2,
            size_min: 1,
            sync: false,
          },
        },
        line_linked: {
          enable: false,
        },
        move: {
          enable: true,
          speed: 1, 
          direction: "bottom",
          random: true,
          straight: false,
          out_mode: "out",
          bounce: false,
        },
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: {
            enable: false,
          },
          onclick: {
            enable: false,
          },
          resize: true,
        },
        modes: {
          grab: {
            distance: 400,
            line_linked: {
              opacity: 1,
            },
          },
          bubble: {
            distance: 250,
            size: 0,
            duration: 2,
            opacity: 0,
          },
          repulse: {
            distance: 400,
            duration: 0.4,
          },
          push: {
            particles_nb: 4,
          },
          remove: {
            particles_nb: 2,
          },
        },
      },
      retina_detect: true,
    });

    </script>


<style type="text/css">.typewrite > .wrap { border-right: 0.08em solid #fff}</style></body>
</html>