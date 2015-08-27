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
					<?php foreach($tags as $tag) { ?>
						<button type="button" class="btn filter" data-sort="myorder:asc" data-filter=".<?php echo $tag->get('tag'); ?>"><?php echo ucfirst($tag->get('tag')); ?></button>
					<?php } ?>
				</div>
			</nav>

			<?php if(isset($videos[0])) { ?>
				<div class="col-md-8 col-xs-12 mix <?php echo $videos[0]->get('tags'); ?>" data-myorder="1" style="background-image: url('<?php echo $videos[0]->get('picture', 'large'); ?>');">
					<div class="col-xs-12 infoVideo" data-toggle="modal" data-target="#myModal" data-youtube="<?php echo $videos[0]->get('youtube'); ?>">
						<i class="fa fa-video-camera"></i>
						<h2 class="videoTitle"><?php echo $videos[0]->get('title'); ?></h2>
					</div>
				</div>
				<?php unset($videos[0]); ?>
			<?php } ?>

			<?php foreach($videos as $video) { ?>
				<div class="col-md-4 col-xs-6 mix <?php echo $video->get('tags'); ?>" data-myorder="2" style="background-image: url('<?php echo $video->get('picture', 'medium'); ?>');">
					<div class="col-xs-12 infoVideo" data-toggle="modal" data-target="#myModal" data-youtube="<?php echo $video->get('youtube'); ?>">
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
						<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>