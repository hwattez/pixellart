		<header class="row minHeightScreen">
			<div class="col-xs-12">
				<h1>Pixell'Art</h1>
			</div>
			<div class="col-xs-12">
				<h2 class="pull-right"><small>by</small> Loïc Wattez</h2>
			</div>
			<div class="col-xs-12">
				<hr>
			</div>
			<div class="col-xs-12">
				<h3>Memories for Eternity</h3>
			</div>
		</header>
		
		<div id="videos" class="row minHeightScreen">
			<nav class="col-xs-12">
				<div class="btn-group" role="group" aria-label="...">
					<button type="button" class="btn filter" data-sort="myorder:asc" data-filter=".mix">Toutes</button>
					<?php $i=0; while(isset($tags[0]) && $i<5) { $tag=array_shift($tags); $i++; ?>
						<button type="button" class="btn filter" data-sort="myorder:asc" data-filter=".<?php echo $tag->get('tag'); ?>"><?php echo ucfirst($tag->get('tag')); ?></button>
					<?php } ?>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<?php foreach($tags as $tag) { ?>
								<li><a class="btn filter" data-sort="myorder:asc" data-filter=".<?php echo $tag->get('tag'); ?>"><?php echo ucfirst($tag->get('tag')); ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>

			<?php if(isset($videos[0])) { ?>
				<div class="col-md-8 col-xs-12 mix <?php echo $videos[0]->get('tags'); ?>" data-myorder="1" style="background-image: url('<?php echo $videos[0]->get('picture', 'large'); ?>');">
					<div class="col-xs-12 infoVideo" data-toggle="modal" data-target="#myModal" data-youtube="<?php echo $videos[0]->get('youtube'); ?>" data-description="<?php echo $videos[0]->get('description'); ?>">
						<a title="Ouvrir la vidéo dans une nouvelle fenêtre" href="<?php echo URL . $videos[0]->get('permalink'); ?>" class="physicalLink"><i class="fa fa-external-link"></i></a>
						<i class="fa fa-video-camera"></i>
						<h2 class="videoTitle"><?php echo $videos[0]->get('title'); ?></h2>
					</div>
				</div>
				<?php unset($videos[0]); ?>
			<?php } ?>

			<?php foreach($videos as $video) { ?>
				<div class="col-md-4 col-xs-6 mix <?php echo $video->get('tags'); ?>" data-myorder="2" style="background-image: url('<?php echo $video->get('picture', 'medium'); ?>');">
					<div class="col-xs-12 infoVideo" data-toggle="modal" data-target="#myModal" data-youtube="<?php echo $video->get('youtube'); ?>" data-description="<?php echo $video->get('description'); ?>">
						<a title="Ouvrir la vidéo dans une nouvelle fenêtre" href="<?php echo URL . $video->get('permalink'); ?>" class="physicalLink"><i class="fa fa-external-link"></i></a>
						<i class="fa fa-video-camera"></i>
						<h4 class="videoTitle"><?php echo $video->get('title'); ?></h4>
					</div>
				</div>
			<?php } ?>


		</div>
		
		<div id="contact" class="row minHeightScreen">
			<div id="contact_title" class="col-xs-12">
				<h2>Contactez-moi</h2>
				<h3>Prestation, information, question...</h3>
			</div>
			<div id="map" class="col-xs-12">
				<div class="embed-responsive embed-responsive-16by9">
				
				</div>
			</div>
			<div class="col-sm-6 formulaire">
				<input type="text" class="form-control" id="nom" placeholder="Votre nom *">
				<input type="email" class="form-control" id="email" placeholder="Votre email *">
				<input type="text" class="form-control" id="website" placeholder="Votre site internet">
			</div>
			<div class="col-sm-6 formulaire">
				<textarea class="form-control" id="message" placeholder="Votre message *"></textarea>
			</div>
			<div class="col-sm-12">
				<button id="msgButton" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i></button>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"></h4>
					</div>
					<div class="modal-body embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="" allowfullscreen></iframe>
					</div>
					<div class="modal-footer">
						<div class="col-xs-12 divDescription">
							<dl class="dl-horizontal">
								<dt><h5>Description</h5></dt>
								<dd class="description"></dd>
							</dl>
						</div>
						<div class="col-xs-4">
							<a class="facebook" href="#" title="Partager sur Facebook" target="_new" rel="nofollow" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;">
								<i class="fa fa-facebook fa-fw"></i>
								Facebook
							</a>
						</div>
						<div class="col-xs-4">
							<a href="#" title="Partager sur Twitter" class="twitter" target="_new" rel="nofollow" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;">
								<i class="fa fa-twitter fa-fw"></i>
								Twitter
							</a>
						</div>
						<div class="col-xs-4">
							<a href="#" title="Partager sur Google+" target="_blank" class="googleP" rel="nofollow" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;">
								<i class="fa fa-google-plus fa-fw"></i>
								Google+
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>