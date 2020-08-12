<script type="text/javascript">
		$(document).ready(function (){
			
			var heightWindow= $(window).height();
			$("#topCarousel .carousel-inner .carousel-item img").css({"height":heightWindow});
		

		});			




		$(document).ready(function (){
			$(window).resize(function(){
				var heightWindow= $(window).height();
				$("#topCarousel .carousel-inner .carousel-item img").css({"height":heightWindow});
			});

		});
</script>