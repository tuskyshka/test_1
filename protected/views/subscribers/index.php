<div class="container">

    <form class="form-signin" name="subscribe" role="form" method="POST" action="/test_1/index.php?r=subscribers/create">
        <h2 class="form-signin-heading">Подписаться на рассылку</h2>
        <label for="inputEmail">Email</label>
        <div><input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email"></div>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Подписаться</button>
    </form>

    <?php

        if (Yii::app()->user->hasFlash('success')) {
            ?>

                <div class="alert alert-success"><?= Yii::app()->user->getFlash('success');?></div>

            <?php
        }

    if (Yii::app()->user->hasFlash('error')) {
        ?>

        <div class="alert alert-danger"><?= Yii::app()->user->getFlash('error');?></div>

    <?php
    }

    ?>
</div>