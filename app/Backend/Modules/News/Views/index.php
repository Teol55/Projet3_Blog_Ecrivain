<div class="container">
    <div class="panel panel-primary">

        <table class="table table-striped table-condensed">
            <div class="panel-heading">
                <h3 class="panel-title">Il y a actuellement
                    <?= $nombreNews ?> Chapitre. En voici la liste :</h3>
            </div>
            <thead>
                <tr>
                    <th>Chapitre</th>
                    <th>Titre</th>
                    <th>Date d'ajout</th>
                    <th>Dernière modification</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
foreach ($listeNews as $news)
{
  echo '<tr><td>', $news->chapitre(), '</td><td>', $news->titre(), '</td><td>le ', $news->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($news->dateAjout() == $news->dateModif() ? '-' : 'le '.$news->dateModif()->format('d/m/Y à H\hi')), '</td><td><a href="news-update-', $news->id(), '.html"><i class="fa fa-pencil"></i></a><a href="news-delete-', $news->id(), '.html"><i class="fa fa-trash"></i></a></td></tr>', "\n";
}
?>

            </tbody>
        </table>
    </div>
</div>
