$(document).ready(function(){


		var AllPosts = document.getElementsByClassName("news_post");
		var NumPages= Math.ceil(AllPosts.length/3);

		for(var i=2;i<=NumPages;i++){

			$(".news_page_nav ul").append("<li class='text-center trans_200' onclick='paging(this)' >"+ i +"</li>");

		}
		for(var i=3;i<AllPosts.length;i++){

					AllPosts[i].style.display="none";
				}
		
	});
		function paging(numOfPage){

			var x=$(".news_page_nav ul li");
			x.removeClass("active");
			$(numOfPage).addClass("active");


			var AllPosts = document.getElementsByClassName("news_post");
			for(var i=0;i<AllPosts.length;i++){

				AllPosts[i].style.display="none";
			}
			var start=3*(numOfPage.innerHTML-1);
			for(var i=start;i<start+3 && i<=AllPosts.length-1;i++){

				AllPosts[i].style.display="block";
			}
				window.scrollTo(0, 85);



		}