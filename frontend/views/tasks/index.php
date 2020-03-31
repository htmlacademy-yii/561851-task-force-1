<?php

/* @var $this yii\web\View */

$this->title = 'Новые задания';
?>

<section class="new-task">
    <div class="new-task__wrapper">
        <h1><?= $this->title; ?></h1>

        <?php
        if (!empty($tasks)) :
            foreach ($tasks as $task) :
                echo $this->render('_task', ['task' => $task]);
            endforeach;
        endif;
        ?>

    </div>
    <div class="new-task__pagination">
        <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
                <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
        </ul>
    </div>
</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php echo $this->render('_filterForm', ['filterTasksForm' => $filterTasksForm]); ?>
    </div>
</section>

