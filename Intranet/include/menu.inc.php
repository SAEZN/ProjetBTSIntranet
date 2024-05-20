<div class="px-3 py-2 text-bg-success">
    <div class="container">
        <?php $nomFichier=basename($_SERVER['SCRIPT_NAME']) ?>
        <div class="bi bi-fire d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="index.php" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                <h5>Intranet</h5>
            </a>
            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li>
                    <a href="index.php" class="nav-link <?php if ($nomFichier==="index.php") { echo 'text-dark'; } else {echo 'text-white';}?>">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="Actu.php" class="nav-link <?php if ($nomFichier==="Actu.php") { echo 'text-dark'; } else {echo 'text-white';}?>">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#fire"/></svg>
                        Actualité
                    </a>
                </li>
                
                <li>
                    <a href="Planning.php" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                        Planning
                    </a>
                </li>
                <li>
                    <a href="PartageDocument.php" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#vehicule"/></svg>
                        Partage
                    </a>
                </li>
                <!-- formulaire de recherche -->
         <form method="POST" class="form-inline mt-md-0">
            <?php
                if (!isset ($_SESSION['autoriser']))
                {
                    echo '
                    <ul class="navbar-nav mr-right">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="inscription.php">S\'inscrire</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark"  type="submit"  href="login.php">S\'identifier</a>
                    </li>
                    </ul>';
                }
                else
                {
                    echo '
                    <ul class="navbar-nav mr-right">
                    <li class="nav-item">
                        <a href="deconnexion.php" type="button" class="btn btn-secondary" >Fin de session</a>
                    </li>
                    </ul>';
                }
            ?>
        </form>
            </ul>
            
        </div>
    </div>
</div>
