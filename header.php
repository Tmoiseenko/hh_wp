<!DOCTYPE>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <title>HoneyHunters</title>
</head>
<body>

<header>
    <div class="container">
        <nav class="navbar">
            <a href="#" class="navbar-brand">
                <img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="logo">
            </a>
        </nav>
        <div class="row">
            <div class="col-md-12 text-center">
                <img class="mail" src="<?php bloginfo('template_url'); ?>/img/mail.png" alt="mail">
            </div>
            <div class="col-md-12">
                <form id="js_form" action="/" method="post" class="form-row pb-5">
                    <div class="col-md-6 pr-5 d-flex flex-column justify-content-between">
                        <div>
                            <label for="inputName">Имя <span class="req">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="name" required>
                        </div>
                        <div>
                            <label for="inputEmail">E-mail <span class="req">*</span></label>
                            <input type="email" id="inputEmail" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputComment">Комментарий <span class="req">*</span></label>
                        <textarea id="inputComment" class="form-control" required></textarea>
                    </div>
                    <div class="text-right w-100 mt-5">
                        <button type="submit" class="btn btn-red">Записать</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</header>