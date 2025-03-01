<!DOCTYPE html>
<html lang="fr">
<head>
    <title>TomTroc - <?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/build/styles/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/build/images/logo_min.png" />
</head>
<body>

<?php
    require_once dirname(__DIR__) . '/templates/partials/header.php';
    foreach (\App\Util\NoticeMessage::get() as $message) {
         echo "<div class='notice-message {$message['type']}'><div class='container'>";

        !empty(trim($message['title'])) && print "<span class='notice-title'>{$message['title']}</span>";
        !empty(trim($message['message'])) && print "{$message['message']}";

         echo "</div></div>";
    }

    require_once $file;
    require_once dirname(__DIR__) . '/templates/partials/footer.php';
?>

</body>
</html>
