<?php
$login = $_SESSION['login'];

if(isset($_SESSION['login'])) {

?>
<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                <div>
                    <h4>Olá, <?php echo $_SESSION['login']->getUserdata()["nome"]; ?></h4>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i> <?php echo $_SESSION['login']->getUserdata()["nome"]; ?></a>

                    <a class="nav-link" href="logout"><i class="fa fa-power-off"></i> Sair</a>
                </div>
            </div>

        </div>
    </div>

</header>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<?php
} else {
    header('Location: ../login');
}
?>