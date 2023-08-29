<!doctype html>
<html lang="es">
  <head>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.bootstrap4.min.css">
      
      <!--BOOTSTRAP 5.3-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.css">
        <link rel='shortcut icon' href='{{asset('img/favicon.ico')}}' type='image/x-icon'>

      <!--DATATABLE-->   
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
      <!--FIN DATATABLE-->
    <!--INICIO DE SWEETALERTS-->
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>     
    <!--FIN DE SWEETALERTS-->
    <link rel="stylesheet" href="{{url('css/footer.css')}}">
    <link rel="stylesheet" href="{{url('css/blanco.css')}}">

<style>
body {
  background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto;
}

</style>
<script>
  // Graph
var ctx = document.getElementById("myChart");

var myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ],
    datasets: [
      {
        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
        lineTension: 0,
        backgroundColor: "transparent",
        borderColor: "#007bff",
        borderWidth: 4,
        pointBackgroundColor: "#007bff",
      },
    ],
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: false,
          },
        },
      ],
    },
    legend: {
      display: false,
    },
  },
});
</script>
</head>
<!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <br>
        <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple active"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-chart-area fa-fw me-3"></i><span>Webiste traffic</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-lock fa-fw me-3"></i><span>Password</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-globe fa-fw me-3"></i><span>International</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-building fa-fw me-3"></i><span>Partners</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-calendar fa-fw me-3"></i><span>Calendar</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a
        >
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a
        >
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#main-navbar"
        aria-controls="main-navbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
    <img class="img-fluid" src="{{url('img/logo.png')}}" width="170" height="50" alt="GAD DE PORTOVELO logo">
      </a>

      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <li class="nav-item dropdown">
                  <li>
              <a href="#" class="nav-link text-white disabled">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle mx-1" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>  Bienvenido, Cristhian Ortiz.
              </a>
            </li>
        <li class="nav-item">
          <a class="nav-link me-3 me-lg-0" href="#">
            <i class="fa-solid fa-house fa-lg"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 me-lg-0" href="#">
            <i class="fa-solid fa-right-from-bracket fa-lg"></i>
          </a>
        </li>

      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->
   <!-- Contenido principal -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>
        
        <!-- Aquí puedes agregar tus widgets, tablas, gráficos, etc. -->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Widget 1</h5>
                <p class="card-text">Contenido del widget.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Widget 2</h5>
                <p class="card-text">Contenido del widget.</p>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <footer class="footer fixed-bottom my-5 pt-5 text-body-secondary text-center text-small">
    <div class="container_footer">
    <!--INICIO DE ICONOS DE REDES SOCIALES-->
          <ul class="list-inline">
            <li class="list-inline-item mx-2">
                  <!-- Facebook -->
                <a title="Facebook" href="https://www.facebook.com/PortoveloGADM"><i class=" list-inline-item mx-2 fab fa-facebook-f fa-1x" style="color: #3b5998;"></i></a>

                <!-- Twitter -->
                <a title="Twitter" href="https://twitter.com/GadPortovelo"><i class=" list-inline-item mx-2 fab fa-twitter fa-1x" style="color: #55acee;"></i></a>

                <!-- Instagram -->
                <a title="Instagram" href="https://www.instagram.com/gadportovelo/"><i class="list-inline-item mx-2 fab fa-instagram fa-1x" style="color: #ac2bac;"></i></a>

                <!-- YouTube -->
                <a title="YouTube" href="https://www.youtube.com/channel/UCLomKkKiMVOrg8CCgkYr1kA?view_as=subscriber"><i class="list-inline-item mx-2 fab fa-youtube fa-1x" style="color: #ed302f;"></i></a>

                <!-- TikTok -->
                <a title="TikTok" href="https://www.tiktok.com/@gadportovelo"><i class="list-inline-item mx-2 fab fa-tiktok fa-1x" style="color: #000;"></i></a>
            </li>
        </ul>
  <!--FIN DE ICONOS DE REDES SOCIALES-->
    <p class="mb-0">Gobierno Autónomo Descentralizado Municipal de Portovelo | Copyright © {{date('Y')}} </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a class="text-decoration-none" href="/">Inicio</a></li>
      <li class="list-inline-item"><a class="text-decoration-none" href="http://portovelo.gob.ec">Municipio</a></li>
      <li class="list-inline-item"><a class="text-decoration-none" href="http://www.portovelo.gob.ec/canton-portovelo/">Ciudad</a></li>
    </ul>
  </div>
  </footer>
    <!--JAVASCRIPT BOOTSTRAP 5.3-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--JAVASCRIPT BOOTSTRAP 5.3-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4"></div>
</main>
<!--Main layout-->