	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<style type="text/css" media="screen">
	#red-content-left {
	    height: 500px;
	}
	#like-facebookapi {
	    display: block;
	    float: left;
	    margin: 2px 0 0 10px;
	}
	#follow-twitterapi{
	    display: block;
	    float: left;
	}
	#red-content.background{    background: none repeat scroll 0 0 transparent !important;}
	#closed-registration {
	    background: none repeat scroll 0 0 #FFFFFF;
	    border: 1px solid #CCCCCC;
	    margin: 150px auto 0;
	    padding: 5px;
	    width: 600px;
	}
	</style>
	
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
	<div class="c bs" id="closed-registration">		
			<div id="helloworld">
				Pendaftaran invitasi #1 telah berakhir.
			</div>
			<p style=" padding: 5px 5px 0;">Saat ini team akan melanjutkan perkembangan, team akan segera membuka invitasi #2. Anda dapat mengikuti perkembangan dengan memfollow twitter atau "like" facebook kami.</p>
			<p class="clearfix" style=" padding: 5px 5px 0;">
				<span id="follow-twitterapi"></span>
				<span id="like-facebookapi"><fb:like href="www.facebook.com/netcoid" layout="button_count" show_faces="true" width="200" font=""></fb:like></span>
			</p>
	</div>
	</div>
	<!-- CONTENT END -->


	<script src="https://platform.twitter.com/anywhere.js?id=VgMhY8zm9QF6SgpYskmptA&v=1" type="text/javascript"></script> 
	  <script type="text/javascript">
		  twttr.anywhere(function (T) {
		    T('#follow-twitterapi').followButton("netcoid");
		  });
	  </script>
	  <script src="https://connect.facebook.net/en_US/all.js#xfbml=1"></script>