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
        <?= $form->field($filterTasksForm, 'taskCategories', [
            'options' => [
                'tag' => false
            ]
        ])->checkboxList(
            [
                '1'=>'Курьерские услуги',
                '2'=>'Грузоперевозки',
                '3'=>'Переводы',
                '4'=>'Строительство и ремонт',
                '5'=>'Выгул животных'
            ],
            [
                'item' => function($index, $label, $name, $checked, $value)
                {
                    return '
                        <input id="'. $index .'" name="'. $name .'" type="checkbox" class="visually-hidden checkbox__input" value="' . $index . '">
                        <label for="'. $index .'">'. $label .'</label>
                        ';
                }
            ]); ?>
    </fieldset>

    <fieldset class="search-task__categories">
        <legend>Дополнительно</legend>
        <?= $form->field($filterTasksForm, 'additionalParamRemoteJob', [
            'template' => "{input}\n{label}\n{hint}\n{error}",
            'labelOptions' => [ 'class' => '' ]
        ])->checkbox(['class' => 'visually-hidden checkbox__input'], false)->label('Удаленная работа'); ?>
    </fieldset>

    <label class="search-task__name" for="8">Период</label>
    <?= $form->field($filterTasksForm, 'period', [
        'options' => [
            'tag' => false,
        ]
    ])->dropDownList(
        $filterTasksForm->getPeriods(),
        [
            'class' => 'multiple-select input',
            'options' => [ 'week' => ['Selected'=>'selected']]
        ]
    ); ?>

    <?= $form->field($filterTasksForm, 'searchByName', [
        'template' => "{label}\n{input}\n{hint}\n{error}",
        'labelOptions' => [ 'class' => 'search-task__name' ]
    ])->textInput(['class' => 'input-middle input'])->label('Поиск по названию'); ?>

    <?= Html::submitButton('Искать', ['class' => 'button']) ?>

<?php ActiveForm::end(); ?>
