				<div class="row">
	                <div class="col-lg-12">
	                    <h1 class="page-header">Tous les tags</h1>
	                </div>
	                <!-- /.col-lg-12 -->
	            </div>
	            <div class="row">
	            	<?php if(!empty($tags)) { ?>
						<table class="table table-bordered table-hover table-responsive">
							<thead>
								<tr>
									<?php foreach($tags[0] as $key => $value) { ?>
										<?php 
											switch($key){
												case 'count':
													echo '<th>Nombre de vidéos</th>';
													break;
												default:
													echo "<th>$key</th>";
											}
										?>
									<?php } ?>
									<th>Supprimer</th>
								</tr>
							</thead>
							<tbody style="text-align: center;">
								<?php foreach($tags as $tag) { ?>
									<tr>
										<?php foreach($tag as $key => $value) { ?>
											<td><?php echo $value; ?></td>
										<?php } ?>
										<td><a href="<?php echo URL; ?>administration/tag/delete/<?php echo $tag->id; ?>/"><i class="fa fa-trash-o"></i></a></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php } else { ?>
						<div class="alert alert-warning" role="alert">
							<p>Il n'y a aucun tag à afficher</p>
						</div>
					<?php } ?>

				</div>