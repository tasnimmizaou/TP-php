<!DOCTYPE><HTML>
<style>
  .nav-link, .d-flex, .form-control , .navbar-brand{
    height: 100% ; 
    width: auto; 
    max-height: 80px;}
  
  
</style>

<ul class="nav nav-tabs " id="myTab" role="tablist">  
<li class="nav-item" role="presentation">
        <a  href="#"><img class="navbar-brand" src="src/girl2.png" alt="Logo"></a>
    </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home" type="button"><a href= "home\home.php" target="conteneur" >Home 🌐</a></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="filtre"  type="button"><a href= "filtre\filtre.html" target="conteneur"> Filtre 📋</a></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="login"  type="button"><a href= "login.php" target="conteneur">login 🔒</a> </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact" type="button" ><a href= "contact/index.php" target="conteneur">contact us📧 </a> </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="basket" type="button"  ><a href= "C:\xampp2\htdocs\ecommerceTp\work\cart\back_end\index_cart.php" target="conteneur">my cart 🛒 </a> </button>
  </li>
  <li class="nav-item ms-auto" role="presentation">
    <form class="d-flex" action="recherche.php" method="POST">
      <div class="input-group rounded">
        <input class="form-control rounded-start" type="search" placeholder="search" aria-label="Recherche" name="search">
        <button class="btn btn-outline-primary rounded-end" type="submit"> search</button>
      </div>
    </form>
  </li>
  <li class="nav-item ml-auto " role="presentation">
    <button class="nav-link" id="admin" type="button"  ><a href= "admin/indexAdmin.php" target="conteneur">👨‍💼 </a> </button>
  </li>
 
</ul>
</HTML>