<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $error
 * @var string $message
 * @var string $url
 */

$this->layout = 'error';
?>
<h2>Forbidden</h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'No access for the requested address {0}.', "<strong>'{$url}'</strong>") ?>
</p>
