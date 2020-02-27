<?php
use yii\helpers\Url;
use yii\i18n\Formatter;

$formatter = new Formatter();
$formatter->language = 'ru-RU, ru';
$elapsedTime = $formatter->asRelativeTime($task->created_at);
?>
<div class="new-task__card">
    <div class="new-task__title">
        <a href="#" class="link-regular"><h2><?= $task->name; ?></h2></a>
        <a class="new-task__type link-regular" href="<?= Url::toRoute(['category/index', 'id' => $task->category->id]); ?>"><p><?= $task->category->name; ?></p></a>
    </div>
    <div class="new-task__icon new-task__icon--translation"></div>

    <p class="new-task_description"><?= $task->description; ?></p>

    <b class="new-task__price new-task__price--translation"><?= $task->cost; ?><b> ₽</b></b>
    <p class="new-task__place">Санкт-Петербург, Центральный район</p>
    <span class="new-task__time"><?= $elapsedTime; ?></span>
</div>