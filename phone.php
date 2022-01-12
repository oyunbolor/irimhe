<?php
require("config/inc.functions.php");
require("config/inc.session.php");
require("config/inc.language.php");
require("config/inc.cfg.php");
require("config/inc.db.php");
require("notification/inc.alerts.php");
require("templates/inc.main_head.php");
?>
<!-- 
THEME: Medic | Medical HTML Template
VERSION: 1.0.0
AUTHOR: Themefisher

HOMEPAGE: https://themefisher.com/products/medic-medical-template/
DEMO: https://demo.themefisher.com/themefisher/medic/
GITHUB: https://github.com/themefisher/Medic-Bootstrap-Medical-Template

WEBSITE: https://themefisher.com
TWITTER: https://twitter.com/themefisher
FACEBOOK: https://www.facebook.com/themefisher
-->
<section class="appoinment-section section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="accordion-section">
		  <div class="accordion-holder">
			<div class="accordion" id="accordionGroup" role="tablist" aria-multiselectable="true">
			  <div class="card">
				<div class="card-header" role="tab" id="headingOne">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseOne"
					  aria-expanded="false" aria-controls="collapseOne">
					  <?php echo _p("Dep1"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordionGroup">
				  <div class="card-body">
				    <a href="images/employees/Climate Change and Resources Research Division.png" target="_blank">
					  <img src="images/employees/Climate Change and Resources Research Division.png" alt="Fjords" style="width:100%">
					</a>
					</div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingTwo">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo"
					  aria-expanded="false" aria-controls="collapseTwo">
					  <?php echo _p("Dep2"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordionGroup">
				  <div class="card-body">
				    <a href="images/employees/Environmental Database Division.png" target="_blank">
					  <img src="images/employees/Environmental Database Division.png" alt="Fjords" style="width:100%">
					</a> 
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingThree">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree"
					  aria-expanded="false" aria-controls="collapseThree">
					  <?php echo _p("Dep3"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordionGroup">
				  <div class="card-body">
					<a href="images/employees/Hydrological Research Division.png" target="_blank">
					  <img src="images/employees/Hydrological Research Division.png" alt="Fjords" style="width:100%">
					</a> 	 
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingFour">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseFour"
					  aria-expanded="false" aria-controls="collapseFour">
					  <?php echo _p("Dep4"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordionGroup">
				  <div class="card-body">
					<a href="images/employees/Research Division of Weather and Environmental Numerical Modelling.png" target="_blank">
					  <img src="images/employees/Research Division of Weather and Environmental Numerical Modelling.png" alt="Fjords" style="width:100%">
					</a> 
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingFive">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseFive"
					  aria-expanded="false" aria-controls="collapseFive">
					  <?php echo _p("Dep5"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordionGroup">
				  <div class="card-body">
				    <a href="images/employees/Agrometeorological Research Division.png" target="_blank">
					  <img src="images/employees/Agrometeorological Research Division.png" alt="Fjords" style="width:100%">
					</a> 	 
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
      </div>
    <div class="col-lg-6">
      <div class="contact-area pl-0 pl-lg-5">
		<div class="accordion-section">
		  <div class="accordion-holder">
			<div class="accordion" id="accordionGroup" role="tab">
			  <div class="card">
				<div class="card-header" role="tab" id="headingSix">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseSix"
					  aria-expanded="false" aria-controls="collapseSix">
					  <?php echo _p("Dep6"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordionGroup">
				  <div class="card-body">
				    <a href="images/employees/Remote Sensing Division.png" target="_blank">
					  <img src="images/employees/Remote Sensing Division.png" alt="Fjords" style="width:100%">
					</a>	 
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingSeven">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseSeven"
					  aria-expanded="false" aria-controls="collapseSeven">
					  <?php echo _p("Dep7"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingSeven" data-parent="#accordionGroup">
				  <div class="card-body">
					<a href="images/employees/Meteorological Telecommunication Information Division.png" target="_blank">
					  <img src="images/employees/Meteorological Telecommunication Information Division.png" alt="Fjords" style="width:100%">
					</a>
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingEigth">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseEigth"
					  aria-expanded="false" aria-controls="collapseThree">
					  <?php echo _p("Dep8"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseEigth" class="collapse" role="tabpanel" aria-labelledby="headingEigth" data-parent="#accordionGroup">
				  <div class="card-body">
					<a href="images/employees/Administration and Finance Division.png" target="_blank">
					  <img src="images/employees/Administration and Finance Division.png" alt="Fjords" style="width:100%">
					</a>	 
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" role="tab" id="headingNine">
				  <h4 class="card-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseNine"
					  aria-expanded="false" aria-controls="collapseNine">
					  <?php echo _p("Dep9"); ?>
					</a>
				  </h4>
				</div>
				<div id="collapseNine" class="collapse" role="tabpanel" aria-labelledby="headingNine" data-parent="#accordionGroup">
				  <div class="card-body">
					<a href="images/employees/Head Circulation and long-range forecasting.png" target="_blank">
					  <img src="images/employees/Head Circulation and long-range forecasting.png" alt="Fjords" style="width:100%">
					</a>	 
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	   </div>
      </div>
    </div>                    
  </div>
</section>
<?php require("templates/inc.main_footer.php"); ?> 