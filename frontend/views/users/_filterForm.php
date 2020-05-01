<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin( [
    'options' => [
        'class' => 'search-task__form'
    ]
]); ?>

    <fieldset class="search-task__categories">
        <legend>Категории</legend>
        <?= $form->field($filterUsersForm, 'performerSpecializations', [
            'options' => [
                'tag' => false
            ]
        ])->checkboxList(
            $filterUsersForm->getCategories(),
            [
                'item' => function($index, $label, $name, $checked, $value)
                {
                    return '
                            <input id="categories'. $index .'" name="'. $name .'" type="checkbox" class="visually-hidden checkbox__input" value="' . $value . '">
                            <label for="categories'. $index .'">'. $label .'</label>
                            ';
                }
            ]); ?>
    </fieldset>

    <fieldset class="search-task__categories">
        <legend>Дополнительно</legend>
        <?= $form->field($filterUsersForm, 'performerCurrentlyAvailable', [
            'template' => "{input}\n{label}",
            'labelOptions' => [ 'class' => '' ]
        ])->checkbox(['class' => 'visually-hidden checkbox__input'], false)->label('Сейчас свободен'); ?>
        <?= $form->field($filterUsersForm, 'performerCurrentlyOnline', [
            'template' => "{input}\n{label}",
            'labelOptions' => [ 'class' => '' ]
        ])->checkbox(['class' => 'visually-hidden checkbox__input'], false)->label('Сейчас онлайн'); ?>
        <?= $form->field($filterUsersForm, 'performerHaveOpinions', [
            'template' => "{input}\n{label}",
            'labelOptions' => [ 'class' => '' ]
        ])->checkbox(['class' => 'visually-hidden checkbox__input'], false)->label('Есть отзывы'); ?>
    </fieldset>

    <?= $form->field($filterUsersForm, 'searchByName', [
        'template' => "{label}\n{input}\n{hint}\n{error}",
        'labelOptions' => [ 'class' => 'search-task__name' ]
    ])->textInput(['class' => 'input-middle input'])->label('Поиск по названию'); ?>

    <?= Html::submitButton('Искать', ['class' => 'button']) ?>

<?php ActiveForm::end(); ?>
