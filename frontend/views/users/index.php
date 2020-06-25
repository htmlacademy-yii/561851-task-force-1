<?php

/* @var $this yii\web\View */

$this->title = 'Пользователи';
?>

<section class="user__search">
    <div class="user__search-link">
        <p>Сортировать по:</p>
        <ul class="user__search-list">
            <li class="user__search-item user__search-item--current">
                <a href="#" class="link-regular">Рейтингу</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Числу заказов</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Популярности</a>
            </li>
        </ul>
    </div>

    <?php
    if (!empty($users)) :
        foreach ($users as $user) :
            echo $this->render('_user', ['user' => $user]);
        endforeach;
    endif;
    ?>
</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php echo $this->render('_filterForm', ['filterUsersForm' => $filterUsersForm]); ?>
    </div>
</section>

