<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$mySimpleCmsDescription = 'My Simple CMS: for learning and fun';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $mySimpleCmsDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>My Simple</span> CMS</a>
        </div>
        <div class="top-nav-links">
            <a href="<?= $this->Url->build('/articles') ?>">Articles</a>
            <a href="<?= $this->Url->build('/tags') ?>">Tags</a>
            <a href="<?= $this->Url->build('/users') ?>">Users</a>
        </div>
        <?php if ($this->Identity->isLoggedIn()) : ?>
            <div class="top-nav-identity">
                <a href="<?= $this->Url->build('/users/view/'.$this->Identity->get('id')) ?>">
                    <?= $this->Identity->get('email') ?> as <span class="top-nav-identity"><?= $this->Identity->get('group') ?></span>
                </a>
            </div>
        <?php else : ?>
            <div class="top-nav-no-identity">
                <a href="<?= $this->Url->build('/users/login') ?>">Login</a>
            </div>
        <?php endif; ?>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
