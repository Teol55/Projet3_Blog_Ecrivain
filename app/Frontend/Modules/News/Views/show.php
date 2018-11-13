<div class="container">

    <div class="cont_1 row">

        <div class="col-lg-6" id="presentation">
            <img src="images/image-<?= $news->id() ?>.jpg" alt="Billet simple pour l'Alaska">
        </div>
        <div class="col-lg-6" id="presentation2">
            <?php
    foreach ($listAll as $listAlls) { ?>

                <?=  $listAlls->chapitre();?> :
                    <a href="news-<?= $listAlls->id() ?>.html">
                        <?= $listAlls->titre() ?>
                    </a><br><br>
                    <?php } ?>
        </div>
    </div>





    <div class="jumbotron row" id="Roman">

        <p><em><?= $news->chapitre() ?>
            </em>, le
            <?= $news->dateAjout()->format('d/m/Y à H\hi')  ?>
        </p>
        <h2>
            <?= $news->titre() ?>
        </h2>
        <p>
            <?= nl2br($news->contenu()) ?>
        </p>

        <?php if ($news->dateAjout() != $news->dateModif()) { ?>
        <p style="text-align: right;"><small><em>Modifiée le <?= $news->dateModif()->format('d/m/Y à H\hi') ?></em></small></p>
        <?php } ?>

        <p><a href="commenter-<?= $news->id() ?>.html">Ajouter un commentaire</a></p>

        <?php
if (empty($comments))
{
?>
            <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
            <?php
} ?>
                <ul class="media-list col-lg-7">
                    <?php
foreach ($comments as $comment)
{
?>
                        <li class="media thumbnail">
                            <legend>
                                Posté par <strong><?= htmlspecialchars($comment->auteur()) ?></strong> le
                                <?= $comment->date()->format('d/m/Y à H\hi') ?>
                                    <br>
                                    <a href="comment-signal-<?= $comment->id() ?>.html">Signaler</a>

                                    <?php if ($user->isAuthenticated()) { ?> -
                                    <a href="admin/comment-update-<?= $comment->id() ?>.html">Modifier</a>
                                    <a href="admin/comment-delete-<?= $comment->id() ?>.html">Supprimer</a>
                                    <?php } ?>
                            </legend>
                            <p>
                                <?= nl2br(htmlspecialchars($comment->contenu())) ?>
                            </p>
                        </li>
                        <?php
}
?>

                </ul><br>
                <p><a href="commenter-<?= $news->id() ?>.html">Ajouter un commentaire</a></p>
    </div>
</div>
