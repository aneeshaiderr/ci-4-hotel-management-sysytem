<!DOCTYPE html>
<html lang="en">

<head>

    <?= view('dashPartial/head') ?>
</head>

<body>

    <?= view('dashPartial/nav') ?>

    <?= view('dashPartial/sidebar') ?>

    <main class="d-flex flex-column min-vh-100">
        <?php if (isset($content)) : ?>
            <?= view($content) ?>
        <?php endif; ?>
    </main>

    <?= view('dashPartial/footer') ?>

</body>
</html>
