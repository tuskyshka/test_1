<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>

    <!-- Bootstrap -->
    <link href="<?= Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php echo $content; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?= Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

        var form = $('form[name=\'subscribe\']');
        var email = $('input[name=\'email\']', form);

        var alert = $('div.alert');

        email.on('keyup', function(){
            $(this).parent('div').removeClass('has-error');
        });

        form.on('submit', function(){

            if (email.val() == '' || email.length < 1) {

                email.parent('div').addClass('has-error');
                showTooltip(email, { title: 'Введите Email'})

                email.focus();

            }

            $.ajax({
                type: 'POST',
                data: form.serialize(),
                url: '/test_1/index.php?r=subscribers/create',
                error: function() {},
                success: function(reply) {

                    if (reply.state == false) {

                        email.parent('div').addClass('has-error');
                        showTooltip(email, { title: reply.data.email[0]});

                    } else if (reply.state == true) {

                        form.hide();
                        form.parent('div').append('<h1>Вы подписаны на рассылку</h1>');
                    }

                }

            });

            return false;

        });

        var showTooltip = function(el, options) {

            var defaultOptions = {
                container: 'body',
                html: true,
                placement: 'right',
                trigger: 'manual',
                delay: { 'show': 100, 'hide': 1400}
            };

            $.extend(defaultOptions, options);

            el.tooltip(
                defaultOptions
            ).tooltip('fixTitle').tooltip('show');

            setTimeout(function(){ el.tooltip('destroy'); }, 1500);
        };




    });

</script>

</body>
</html>
