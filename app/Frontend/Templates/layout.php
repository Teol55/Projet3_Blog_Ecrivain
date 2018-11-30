<!DOCTYPE html>
<html>

<head>
    <title>
        <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
    <meta name="description" content="Billet simple pour l'Alaska">

    <meta charset="utf-8" />

    <link rel="stylesheet" href="/css/style.css" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <header>

        <!-- Navigation
      ================================================== -->
        <nav id="navbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="/">Jean ForterRoche</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li><a href="/">Accueil</a>
                    </li>
                    <?php if (!$user->isAuthenticated()) {  ?>
                    <li><a href="news-1.html">Billet Simple pour l'Alaska</a>
                        <?php } ?>
                    </li>
                    <?php if ($user->isAuthenticated()) { ?>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <li><a href="/admin/">listes des Chapitres</a></li>
                                <li><a href="/admin/news-insert.html">Ajouter un Chapitre</a></li>
                                <li><a href="/admin/comment-list.html">Commentaires</a></li>

                        </ul>
                        </li>
                        <li><a href="/admin/deconnexion.html">Déconnexion</a>



                </ul>
                <?php } ?>

            </div>
        </nav>
    </header>







    <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
    <div class="container">

        <?= $content ?>

    </div>

    <footer></footer>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Javascript de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>


    <script>
        tinymce.init({
            selector: '.mytextarea',
            language_url: '/languages/fr_FR.js'
        });

    </script>

</body>

</html>
