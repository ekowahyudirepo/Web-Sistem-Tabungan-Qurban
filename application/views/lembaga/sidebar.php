<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="origin-when-cross-origin">
        
        <title><?php echo $__title; ?></title>

        <meta name="description" content="Tabungan Qurban | Qurbanapp">
        <meta property="og:locale" content="id">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Berkurban sekarang lebih mudah | Qurbanapp">
        <meta property="og:description" content="Tabungan Qurban | Qurbanapp">
        <meta name="mobile-web-app-capable" content="yes">

        <meta property="og:site_name" content="Qurbanapp">

        <?php for($i=0;$i<count($__css);$i++){ echo __css($__css[$i]); } ?>

        <?php for($i=0;$i<count($__js);$i++){ echo __js($__js[$i]); } ?>

    </head>

    <body style="background-color: lightgrey">
    <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3 class="text-center text-primary"><b>QURBANAPP</b></h3>
        </div>

        <ul class="list-unstyled components">
            <li class="<?php echo __menu_active('dashboard', $__menu ); ?>">
                <a href="<?php echo base_url().'lembaga/dashboard'; ?>"><i class="icon icon-home"></i> Dashboard</a>
            </li>
            <li class="<?php echo __menu_active('penerimaan', $__menu ); ?>">
                <a href="<?php echo base_url().'lembaga/penerimaan'; ?>"><i class="icon icon-bag"></i> Penerimaan</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="<?php echo base_url() ?>lembaga/lembaga__keluar" class="article logout"><i class="icon icon-logout"></i> Keluar</a>
            </li>
        </ul>
    </nav>