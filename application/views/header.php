<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html <?php $this->ifAdminBar(); ?>>
<head>
    <title>MVC</title>
    <link href="/css/style.css" rel="stylesheet">
    <meta charset="UTF-8">
</head>

<body>

<?php $this->displayAdminBar(); ?>

<div class="wrapper">

    <div class="header">
        <?php $this->displayblock('header'); ?>
    </div>

    <div class="nav">

        <a href="/">Home</a>
        <a href="/posts">Posts</a>

        <?php if (isset($_SESSION['username'])) { ?>
            <a href="/admin/logout" class="login">Log Out</a>
            <a href="/admin" class="login">Admin Panel</a>

        <?php } else { ?>
            <a href="/admin" class="login">Log In</a>
        <?php } ?>

    </div>
    <div class="nav-shadow">
        <img src="/images/nav-shadow.png" alt="" />
    </div>

    <div class="site-content">


