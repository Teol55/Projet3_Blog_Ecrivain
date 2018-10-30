<div class="container">
    <div class="cont_1 row">

        <div class="col-lg-6" id="presentation">
            <h1> <a data-toggle="tooltip" href="#" title='Ecrivain'>Jean ForterRoche</a></h1>




            <ul class="list-unstyled">
                <li><i class="fa fa-portrait fa-2x">Je suis Ecrivain depuis 20 ans </i>
                </li>
                <br>
                <li><i class="fa fa-portrait fa-2x">je souhaite vous présenter mon nouveau roman du maniére différente</i>
                </li>
                <br>
                <li><i class="fa fa-portrait fa-2x">Voici la publication des derniers chapitres</i>
                </li>
            </ul>



        </div>
        <section>
            <div id="carousel" class="carousel slide col-lg-6" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                    <li data-target="#carousel" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner thumbnail">
                    <div class="item active">
                        <img src="images/montagneAlaska.jpg" alt="Montagnes Alaska">
                    </div>
                    <div class="item">
                        <img src=" images/montagne2Alaska.jpg" alt="Montagnes Alaska">
                    </div>
                    <div class="item">
                        <img src="images/eauAlaska.jpg" alt="lac Alaska">
                    </div>
                    <div class="item">
                        <img src="images/baleineAlaska.jpg" alt="Baleine mer Alaska">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel" data-slide="prev">
                             <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                <a class="right carousel-control" href="#carousel" data-slide="next">
                             <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>

            </div>
        </section>



    </div>
</div>

<div class="container">

    <div class="jumbotron row">

        <h1 class="text-center">Billet Simple pour l'Alaska</h1>
        <img class="col-sm-12 col-md-5 col-md-push-7" img src=" images/montagne2Alaska.jpg" alt="Montagnes Alaska">
        <div id="monaccordeon" class="panel-group col-sm-12 col-md-7 col-md-pull-5">
            <h3>Les derniers chapitres Parus</h3>
            <?php
foreach ($listeNews as $news)
{
?>

                <div class="panel panel-info">
                    <div class="panel-heading">

                        <h3 class="panel-title"> <a href="#exp<?= $news['id'] ?>" data-parent="#monaccordeon" data-toggle="collapse"><strong><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></strong> <br> <em>Publié le :<?= $news['dateAjout']->format('d/m/Y à H\hi') ?> </em></a>
                        </h3>
                    </div>
                    <div id="exp1" class="panel-collapse collapse in ">
                        <div class="panel-body">
                            <p>
                                <?= nl2br($news['contenu']) ?>
                            </p>
                        </div>
                    </div>

                </div>
                <?php
}?>

        </div>
    </div>
</div>
