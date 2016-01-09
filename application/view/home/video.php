
		<div id="video" class="row minHeightScreen">
			<div class="col-xs-12">
				<h2><?php echo $video->get('title'); ?></h2>
			</div>

			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="<?php echo $video->get('youtube'); ?>" allowfullscreen></iframe>
			</div>

			<div class="row">
				<div class="col-xs-4">
					<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URL . $video->get('permalink'); ?>" title="Partager sur Facebook" target="_new" rel="nofollow" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;">
						<i class="fa fa-facebook fa-fw"></i>
						Facebook
					</a>
				</div>
				<div class="col-xs-4">
					<a href="http://twitter.com/home?status=<?php echo $video->get('title'); ?> <?php echo URL . $video->get('permalink'); ?> @WattezL" title="Partager sur Twitter" class="twitter" target="_new" rel="nofollow" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;">
						<i class="fa fa-twitter fa-fw"></i>
						Twitter
					</a>
				</div>
				<div class="col-xs-4">
					<a class="googleP" href="#">
					<a href="https://plus.google.com/share?url=<?php echo URL . $video->get('permalink'); ?>" title="Partager sur Google+" target="_blank" class="googleP" rel="nofollow" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;">
						<i class="fa fa-google-plus fa-fw"></i>
						Google+
					</a>
				</div>
			</div>


		</div>