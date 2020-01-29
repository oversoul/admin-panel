<div class="<?= $card->class ?>">
    <div class="card card-stats mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0"><?= $card->title ?></h5>
                    <span class="h2 font-weight-bold mb-0">
                        <?= $card->content ?>
                    </span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>