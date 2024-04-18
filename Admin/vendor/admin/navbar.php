<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Dashboard </div>
    </a>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">

    </div>

    <li class="nav-item">
        <a class="nav-link " href="tableArticle.php">
            <span>Articles</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="tableClient.php">
            <span>Clients</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"  href="tableAdmin.php">
            <span>Admins</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="tableCommande.php">
            <span>Commands</span>
        </a>
    </li>


    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="indexAdmin.php">Logout</a>
            </div>
        </div>
    </div>
</div>