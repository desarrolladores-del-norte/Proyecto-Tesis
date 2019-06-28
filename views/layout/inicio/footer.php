	
		<!--======================================== Pie de pagina ========================================-->
	<footer class="full-reset footer" id="footer"  >
		<div class="full-reset" style="padding: 15px 0;">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles text-center">Visitenos en</h4>
						<p class="text-center">www.unanleon.edu.ni</p>
					</div>
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles text-center">Contactenos</h4>
						<p class="text-center">Tele-Fax: +(000)0000-0000 <br>Correo Electrónico: correo@hotmail.com</p>
					</div>
					<div class="col-xs-12 col-sm-4">
						<h4 class="titles subtitles-footer">Siguenos en</h4>
						<ul class="list-unstyled links-footer">
							<li><a href="#!" class="open-link-newTab"><i class="fa fa-facebook"></i> &nbsp; Facebook</a></li>
							<li><a href="#!" class="open-link-newTab"><i class="fa fa-twitter"></i> &nbsp; Twitter</a></li>
							<li><a href="#!" class="open-link-newTab"><i class="fa fa-google-plus"></i> &nbsp; Google+</a></li>
						</ul>
					</div>
					<div class="text-center">
                    <p>  &copy; Copyrights <strong>UNAN-LEON</strong>. Derecho Reservados </p>
					</div>
				   </div>
			</div>
		</div>
	</footer>
		
		<a href="javascript:void(0);" id="back-top"><i class="fa fa-angle-up fa-3x"></i></a>

		<!-- Essential jQuery Plugins
		================================================== -->
		<!-- Main jQuery -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery-1.11.1.min"></script>
		<!-- Single Page Nav -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.singlePageNav.min.js"></script>
		<!-- Twitter Bootstrap -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>bootstrap.min.js"></script>
		<!-- jquery.fancybox.pack -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.fancybox.pack.js"></script>
		<!-- jquery.mixitup.min -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.mixitup.min.js"></script>
		<!-- jquery.parallax -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.parallax-1.1.3.js"></script>
		<!-- jquery.countTo -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery-countTo.js"></script>
		<!-- jquery.appear -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.appear.js"></script>
		<script src="<?php echo $_layoutParams2['ruta_js'];?>main.js"></script>
		<script src="<?php echo $_layoutParams2['ruta_js'];?>zabuto_calen"></script>
		<!-- jquery easing -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.easing.min.js"></script>
		<!-- jquery easing -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>wow.min.js"></script>
		<script>
			var wow = new WOW ({
				boxClass:     'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset:       120,          // distance to the element when triggering the animation (default is 0)
				mobile:       false,       // trigger animations on mobile devices (default is true)
				live:         true        // act on asynchronously loaded content (default is true)
			  }
			);
			wow.init();
		</script> 
		<!-- Custom Functions -->
        <script src="<?php echo $_layoutParams2['ruta_js'];?>custom.js"></script>
		
		<script type="text/javascript">
			$(function(){
				/* ========================================================================= */
				/*	Contact Form
				/* ========================================================================= */
				
				$('#contact-form').validate({
					rules: {
						name: {
							required: true,
							minlength: 2
						},
						email: {
							required: true,
							email: true
						},
						message: {
							required: true
						}
					},
					messages: {
						name: {
							required: "come on, you have a name don't you?",
							minlength: "your name must consist of at least 2 characters"
						},
						email: {
							required: "no email, no message"
						},
						message: {
							required: "um...yea, you have to write something to send this form.",
							minlength: "thats all? really?"
						}
					},
					submitHandler: function(form) {
						$(form).ajaxSubmit({
							type:"POST",
							data: $(form).serialize(),
							url:"process.php",
							success: function() {
								$('#contact-form :input').attr('disabled', 'disabled');
								$('#contact-form').fadeTo( "slow", 0.15, function() {
									$(this).find(':input').attr('disabled', 'disabled');
									$(this).find('label').css('cursor','default');
									$('#success').fadeIn();
								});
							},
							error: function() {
								$('#contact-form').fadeTo( "slow", 0.15, function() {
									$('#error').fadeIn();
								});
							}
						});
					}
				});
			});
		</script>
		<script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>

  

    </body>
</html>