<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Dashboard <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Articles Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="article" data-toggle="collapse" data-target="#collapseArticles"
           aria-expanded="true" aria-controls="collapseArticles">
            <span>Articles</span>
        </a>
    </li>
    <script>
        let articleButton = document.querySelector("#article");
        articleButton.addEventListener('click',function(){
            window.location.href="article.php";
        })
    </script>

    <!-- Nav Item - Clients Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="client" data-toggle="collapse" data-target="#collapseClients"
           aria-expanded="true" aria-controls="collapseClients">
            <span>Clients</span>
        </a>
    </li>
    <script>
        let clientButton = document.querySelector("#client");
        clientButton.addEventListener('click',function(){
            window.location.href="tableClient.php";
        })
    </script>

    <!-- Nav Item - Admins Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="admin" data-toggle="collapse" data-target="#collapseAdmins"
           aria-expanded="true" aria-controls="collapseAdmins">
            <span>Admins</span>
        </a>
    </li>
    <script>
        let adminButton = document.querySelector("#admin");
        adminButton.addEventListener('click',function(){
            window.location.href="tableAdmin.php";
        })
    </script>
        <!-- Nav Item - Commands Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" id="commands" data-toggle="collapse" data-target="#collapseCommands"
           aria-expanded="true" aria-controls="collapseCommands">
            <span>Commands</span>
        </a>
    </li>
    <script>
        let commandsButton = document.querySelector("#commands");
        commandsButton.addEventListener('click',function(){
            window.location.href="tableCommande.php";
        })
    </script>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
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
                <a class="btn btn-primary" href="login.html">Logout</a><!--lina nhot mtaa eya-->
            </div>
        </div>
    </div>
</div>
