<?php
session_start();

require 'utils.inc.php';

start_page('Inscription');
?>

<div class="container">
    <h2>
        Inscription
    </h2>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="msg-error">

        </div>
</div>