<?php
get_header();
?>
    <main>
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>Выводим комментарии</h3>
        </div>
    </div>
    <div class="js-card-box row justify-content-between">
<?php
$hh_posts = new WP_Query([
            'post_type' => 'hh_comments',
            'order' => 'ASC',
        ]);
if ( $hh_posts->have_posts() ) {
    $i = 1;
    // Load posts loop.
    while ( $hh_posts->have_posts() ) {
        $odd = $i % 2 == 0 ? 'odd' : '';
        $hh_posts->the_post();
        ?>
        <div class="card text-center mb-5 <?= $odd ?>">
            <h5 class="card-title"><?php the_title(); ?></h5>
            <div class="card-body">
                <h6 class="card-subtitle mb-5 mt-5">
                    <?= get_post_meta(get_the_ID(), 'email', true) ?>
                </h6>
                <?php the_content(); ?>
            </div>
        </div>
        <?php
        $i++;
    }
} else {
    ?>
    <p class="js-no-content w-100 text-center alert alert-danger"><strong>К сожалению коментариев нет</strong></p>
    <?php
}
?>
    </div>
    </main>

<?php
get_footer();
