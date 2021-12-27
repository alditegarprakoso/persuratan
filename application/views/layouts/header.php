<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <link href="<?= base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/sbadmin/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/datatables.css') ?>">
    <style>
        table {
            font-size: 13px !important;
            width: 100% !important;
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-file" aria-hidden="true"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Persuratan</div>
            </a>

            <hr class="sidebar-divider my-0">

            <?php
            $active = '';
            if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) != NULL) {
                $active = '';
            } else if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') {
                $active = 'active';
            } ?>
            <li class="nav-item <?= $active; ?>">
                <a class="nav-link" href="<?= base_url('home'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Menu
            </div>

            <?php
            $active = '';
            if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'suratMasuk') {
                $active = 'active';
            } else {
                $active = '';
            } ?>
            <li class="nav-item <?= $active; ?>">
                <a class="nav-link" href="<?= base_url('home/suratMasuk'); ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Surat Masuk</span></a>
            </li>

            <?php
            $active = '';
            if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'disPosisi') {
                $active = 'active';
            } else {
                $active = '';
            } ?>
            <li class="nav-item <?= $active; ?>">
                <a class="nav-link" href="<?= base_url('home/disPosisi'); ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Disposisi</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>

                <div class="container-fluid">