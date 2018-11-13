<div class="container">


    <?php 
                

                
                foreach ($listNews as $news)
                { ?>
    <div class="panel panel-primary">

        <table class="table table-condensed">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $news->chapitre() .': '. $news->titre() ?>
                </h3>
            </div>
            <thead>
                <tr>
                    <th>Id commentaire</th>
                    <th>Auteur</th>
                    <th>contenu</th>
                    <th>date</th>
                    <th>Action</th>

                </tr>
            </thead>
            <?php     {

            
                     foreach($listComments as  $comment)
                  



         if( $news->id()=== $comment->news())
                    { 
                        if( $comment->signalement()) 
                        
                        { echo '<tr class="bg-danger">'; } else echo '<tr>';
             
             
             
             echo '<td>', $comment->id(), '</td><td>', nl2br($comment->auteur()), '</td><td>', nl2br( $comment->contenu()), '</td><td>le ', $comment->date()->format('d/m/Y à H\hi'), '</td>
        <td><a href="comment-update-', $comment->id(), '.html"><i class="fa fa-pencil"></i></a><a href="comment-delete-', $comment->id(), '.html"><i class="fa fa-trash"></i></a></td>
        </tr>', "\n"; 
                                                     } 
                    }?>


        </table>
    </div>
    <?php    } ?>








</div>
