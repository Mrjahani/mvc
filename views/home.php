<?php $this->layout('master_page', ['title' => 'show users']) ?>

    <ul>
        <?php foreach($users as $user): ?>
        <li><?= $user->id?></li>
        <li><?= $user->username?></li>
        <li><?= $user->email?></li>
        <?php endforeach; ?>
    </ul>

