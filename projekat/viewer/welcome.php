<?php
 require("../model/konekcija.php");
 $poruka = '';

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Oktopod</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet"> 
<link href="css/flexslider.css" rel="stylesheet" /> 
<link href="css/style.css" rel="stylesheet" />
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper" class="home-page">
<div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 	  
        <p class="pull-left hidden-xs"><i class="fa fa-clock-o"></i><span>Ponedeljak - Subota 8.00 - 18.00.</span></p>
        <p class="pull-right"><i class="fa fa-phone"></i>011 2589 147</p>
      </div>
    </div>
  </div>
</div>
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Pocetna</a></li>
                        <li class="active"><a href="../viewer/logout.php">Izlogujte se</a></li>
                        <li class="active"><a href="cart.php">Vasa korpa</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
		
	
	
	<section id="content">
	
	<section id="services" class="section pad-bot5 bg-white">
    <div class="container">
        <div class="row mar-bot5">
          <div class=" col-md-12">
            <div class="section-header">
            <div class="wow bounceIn"data-animation-delay="7.8s">

              <h2 class="section-heading animated" > Putovanja u ponudi</h2>
              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretraga po kategoriji">
              

                    <?php
                      include("../controller/proizvod.php");
                      $proizvod = new Proizvod($mysqli);
                      $proizvod->vratiProizvode();
                      $proizvodiIzBaze = $proizvod->getResult();

                       if(count($proizvodiIzBaze) >0) {

                         ?>
                         <table id="tabela" class="table table-hover">
                           <thead>
                             <th>Proizvod id</th>
                             <th>Naziv</th>
                             <th>Opis</th>
                             <th>Cena</th>
                             <th>Kategorija</th>
                             <th>Korpa</th>
                           </thead>
                           <tbody>
                         <?php

                         foreach ($proizvodiIzBaze as $red ) {
                              ?>

                              <tr>
                                  <td><?php echo $red['id'] ?></td>
                                  <td><?php echo $red['naziv'] ?></td>
                                  <td><?php echo $red['opis'] ?></td>
                                  <td><?php echo $red['cena'] ?>$</td>
                                  <td><?php echo $red['nazivKategorije'] ?></td>
                                   <td><a class="btn btn-info btn-md" href="../controller/dodajUKorpu.php?id=<?php echo$red['id'] ?>">Dodaj</a></td>
                              </tr>

                              <?php

                       }
                  ?>
                </tbody>
              </table>

              <?php
                  }else{
                     ?>
                     <h1> Nema rezultata u tabeli </h1>
                    <?php
                  }

                  ?>
            </div>
            </div>
          </div>
        </div>


      </div>

    </div>
    </section>

	
	
	</section>
	
  <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="img/slides/7.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Oktopod Travel</h3> 
					<p>Letovanja, zimovanja i izleti</p> 
					 
                <!-- </div>
              </li>
              <li>
                <img src="img/slides/3.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Atraktivne destinacije</h3> 
					<p>Putujte sa nama</p> 
					 
                </div> -->
              </li>
            </ul>
        </div>  
	

					
					

	<footer id="footer">
	
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>
							<span>&copy; FON </span>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>  
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<!-- Vendor Scripts -->
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>wow = new WOW({}).init();</script> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script>
  $(document).ready(function(){
    $('#tabela').DataTable();
    });
  </script>
  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabela");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>