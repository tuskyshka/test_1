<div class="row" style="margin-bottom: 18px;">

    <?php

        $link = '';

        if ( $data->status == Subscribers::STATUS_SUBSCRIBED ) {
            $status = 'подписан';

            $link = '/subscribers/unsubscribe/';
            $linkText = 'Отписать';
        } else {
            $status = 'не подписан';

            $link = '/subscribers/subscribe/';
            $linkText = 'Подписать';
        }

    ?>

    #<?php echo CHtml::encode($data->id); ?> &mdash; <b><?php echo CHtml::encode($data->email); ?></b><br/>
    Статус: <span class="status"><?= $data->status == Subscribers::STATUS_SUBSCRIBED ? 'подписан' : 'не подписан'; ?></span><br/>

    <a class="subscribeAction" href="<?=$link; ?><?= $data->id; ?>/"><?= $linkText; ?></a>

</div>