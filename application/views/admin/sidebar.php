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
                <a href="<?php echo base_url().'admin/dashboard'; ?>"><i class="icon icon-home"></i> Dashboard</a>
            </li>
            <li class="<?php echo __menu_active('lembaga', $__menu ); ?>">
                <a href="<?php echo base_url().'admin/lembaga'; ?>"><i class="icon icon-user-following"></i> Lembaga</a>
            </li>
            <li class="<?php echo __menu_active('member', $__menu ); ?>">
                <a href="<?php echo base_url().'admin/member'; ?>"><i class="icon icon-user-follow"></i> Pekurban</a>
            </li>
            <li class="<?php echo __menu_active('hewan', $__menu ); ?>">
                <a href="<?php echo base_url().'admin/hewan'; ?>"><i class="icon icon-tag"></i> Harga Hewan</a>
            </li>
            <li class="<?php echo __menu_active('pengaturan', $__menu ); ?>">
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="icon icon-settings"></i> Pengaturan</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="<?php echo base_url().'admin/rekening'; ?>"><i class="icon icon-credit-card"></i> Rekening</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>admin/slider"><i class="icon icon-layers"></i> Slider</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>admin/info"><i class="icon icon-info"></i> Info</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="<?php echo base_url() ?>admin/backupRestore" class="article"><i class="icon icon-layers"></i> Backup</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>admin/export" class="article"><i class="icon icon-tag"></i> Export</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>admin/admin__keluar" class="article logout"><i class="icon icon-logout"></i> Keluar</a>
            </li>
        </ul>
    </nav>