<?php

function getAlias(): string
{
    $host = $_SERVER['HTTP_HOST'];
    if ($host == "localhost") {
        return "patient-management-solution";
    } else {
        return "pms";
    }
}

function protocol(): string
{
    return (
        !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
        || $_SERVER['SERVER_PORT'] == 443
    )
        ? "https://" : "http://";
}

define("ROOT_URL", protocol() . $_SERVER['HTTP_HOST'] . "/" . getAlias() . "/");
//const CDN_LINK = "https://shakib04.github.io/nice-admin-bootstrap-template/";
const CDN_LINK = "http://localhost/NiceAdmin/";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php
        $pageTitle = '';
        echo $pageTitle; ?> Patient Management Solution</title>
    <!--    <link href="../static/css/styles.css" rel="stylesheet" />-->
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
<!--          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"-->
<!--            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"-->
<!--            crossorigin="anonymous"></script>-->

    <!-- Favicons -->
    <link href="<?php echo CDN_LINK ?>assets/img/favicon.png" rel="icon">
    <link href="<?php echo CDN_LINK ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
<!--    <link href="https://fonts.gstatic.com" rel="preconnect">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"-->
<!--          rel="stylesheet">-->

    <!-- Vendor CSS Files -->
    <link href="<?php echo CDN_LINK ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CDN_LINK ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo CDN_LINK ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo CDN_LINK ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo CDN_LINK ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo CDN_LINK ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo CDN_LINK ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo CDN_LINK ?>assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>