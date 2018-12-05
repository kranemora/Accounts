<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $usersGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Group'), ['action' => 'edit', $usersGroup->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Group'), ['action' => 'delete', $usersGroup->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersGroup->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersGroups view large-9 medium-8 columns content">
    <h3><?= h($usersGroup->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersGroup->has('user') ? $this->Html->link($usersGroup->user->id, ['controller' => 'Users', 'action' => 'view', $usersGroup->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $usersGroup->has('group') ? $this->Html->link($usersGroup->group->name, ['controller' => 'Groups', 'action' => 'view', $usersGroup->group->id]) : '' ?></td>
        </tr>
    </table>
</div>
