<html>
	<head>

		<title>Contact - Commercial</title>

		<meta name="description" content="" />

		<meta http-equiv="content-type" content="text/html; charset=utf8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="style/css/contact-commercial.css">

		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

	</head>
	
	<body>

		<?php 
			$styleHeader = "style-dark";
			include('common-header.php'); 
		?> 

		<main>


			<section id="section-contact">

				<img class="shape" src="img/home/sectionCover/shape.svg" alt="">

				<div class="wrapper">
					<div class="container-text">
						<h1>
							Contacter le Service Commercial
						</h1>
						<p class="paragraph">
							Remplissez ce formulaire afin que nous vous contactions ou appelez-nous.
						</p>
						<a class="btn" href="tel:0325753085">
							<img src="img/contact-commercial/icn-phone.svg" alt="">
							<div class="btn-text">
								03 25 75 30 85
							</div>
						</a>
						<p class="hr">
							Du Lundi au Vendredi de 9h à 17h
						</p>
						<p class="link">
							Déjà client ? 
							<a href="">Contactez l’Assistance.</a>
						</p>
					</div>
					<form action="">
						<div class="container-input">
							<div class="input">
								<div class="title">NOM COMPLET</div>
								<input type="text">
							</div>
							<div class="input">
								<div class="title">E-MAIL PROFESSIONNEL</div>
								<input type="text">
							</div>
							<div class="input">
								<div class="title">NUMÉRO DE TÉLÉPHONE</div>
								<input type="text">
							</div>
							<div class="textarea">
								<div class="title">POSEZ VOTRE QUESTION</div>
								<textarea></textarea>
							</div>
						</div>
						<div class="container-rcl">
							<div class="title">Vous souhaitez être recontacté par :</div>
							<div class="container-radio">
								<input id="input-radio" type="hidden">
								<div class="radio" data-radio="E-mail">	
									<div class="content">
										<div class="btn-radio">
											<div class="rd"></div>
										</div>
										<div class="text">E-mail</div>
									</div>
								</div>
								<div class="radio" data-radio="Téléphone">
									<div class="content">
										<div class="btn-radio">
											<div class="rd"></div>
										</div>
										<div class="text">Téléphone</div>
									</div>
									<div class="container-checkbox">
										<input id="input-checkbox" type="hidden">
										<div class="checkbox" data-checkbox="Matin">
											<div class="checkbox-btn">
												<img src="img/contact-commercial/check.svg" alt="">
											</div>
											<div class="text">Matin</div>
										</div>
										<div class="checkbox" data-checkbox="Après midi">
											<div class="checkbox-btn">
												<img src="img/contact-commercial/check.svg" alt="">
											</div>
											<div class="text">Après-midi</div>
										</div>
									</div>
								</div>
							</div>
							<button>
								<span class="btn-text">ENVOYER</span>
								<img class="btn-check" src="img/common/check.svg" alt="">
							</button>
						</div>

					</form>
					
				</div>
			</section>

		</main>

		<?php include('common-footer.php') ?> 

		<script type="text/javascript" src="js/contact-commercial.js"></script>
		<script type="text/javascript" src="js/header.js"></script>
	</body>
</html>