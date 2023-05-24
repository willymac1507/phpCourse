<!doctype html>
<?php require 'partials/head.php' ?>
<?php require 'partials/nav.php' ?>
<?php require 'partials/banner.php' ?>
<?php $email = $_SESSION['user']['email'] ?? "guest"; ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <p>Hello, <?= $email ?>, welcome to the home page!</p>
  </div>
</main>

<?php require 'partials/foot.php' ?>