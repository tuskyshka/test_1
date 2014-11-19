<div class="container">

    <h1>Подписки</h1>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'template'=>"{items}",
    )); ?>

</div>