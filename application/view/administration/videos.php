				<div class="row">
	                <div class="col-lg-12">
	                    <h1 class="page-header">Toutes les vidéos</h1>
	                </div>
	                <!-- /.col-lg-12 -->
	            </div>
	            <div class="row">

	            	<?php if(!empty($videos)) { ?>
						<table class="table table-bordered table-hover table-responsive">
							<thead>
								<tr>
									<?php foreach($videos[0] as $key => $value) { ?>
										<th><?php echo $key; ?></th>
									<?php } ?>
									<th>picture_show</th>
									<th>Modifier</th>
									<th>Supprimer</th>
								</tr>
							</thead>
							<tbody style="text-align: center;">
								<?php foreach($videos as $video) { ?>
									<tr>
										<?php foreach($video as $key => $value) { ?>
											<td><?php echo $value; ?></td>
										<?php } ?>
										<td><img style="height: 100px;" src="<?php echo $video->get('picture', 'medium'); ?>" /></td>
										<td><a href="<?php echo URL; ?>administration/video/edit/<?php echo $video->id; ?>/"><i class="fa fa-cog"></i></a></td>
										<td><a href="<?php echo URL; ?>administration/video/delete/<?php echo $video->id; ?>/"><i class="fa fa-trash-o"></i></a></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php } else { ?>
						<div class="alert alert-warning" role="alert">
							<p>Il n'y a aucune vidéo à afficher</p>
						</div>
					<?php } ?>

					<div style="text-align: center;">
						<a href="<?php echo URL; ?>administration/video/new/" class="btn btn-primary btn-lg" role="button">Nouvelle vidéo</a>
					</div>
				</div>