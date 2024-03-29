<?php

use app\components\ReturnUrl;
use cornernote\shortcuts\Y;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Job $model
 */

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Yii::t('app', 'Preserved Prices'); ?></h3>
    </div>
    <div class="panel-body">
        <?php
        $total = 0;
        $attributes = [];
        foreach ($model->products as $product) {
            $value = ($product->quote_factor_price - $product->quote_total_price_unlocked) * $model->quote_markup;
            $total += $value;
            if ($value != 0) {
                $attributes[] = [
                    'label' => $product->name,
                    'value' => number_format($value, 2) . ' <span class="label label-default">' . $product->quantity . '</span>',
                    'format' => 'raw',
                ];
            }
        }
        $attributes[] = [
            'label' => Yii::t('app', 'Total  Offset'),
            'value' => number_format($total, 2),
            'format' => 'raw',
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $attributes,
        ]);
        ?>
    </div>
</div>



