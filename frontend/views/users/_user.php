<div class="content-view__feedback-card user__search-wrapper">
    <div class="feedback-card__top">
        <div class="user__search-icon">
            <a href="#"><img src="./img/man-glasses.jpg" width="65" height="65"></a>
            <span>17 заданий</span>
            <span>6 отзывов</span>
        </div>
        <div class="feedback-card__top--name user__search-card">
            <p class="link-name"><a href="#" class="link-regular"><?= $user->name; ?></a></p>
            <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
            <b>4.25</b>

            <p class="user__search-content"><?= $user->description; ?></p>
        </div>
        <span class="new-task__time">Был на сайте 25 минут назад</span>
    </div>
    <div class="link-specialization user__search-link--bottom">
        <a href="#" class="link-regular">Ремонт</a>
        <a href="#" class="link-regular">Курьер</a>
        <a href="#" class="link-regular">Оператор ПК</a>
    </div>
</div>
