				<div class="row">
	                <div class="col-lg-12">
	                    <h1 class="page-header">Toutes les tâches</h1>
	                </div>
	                <!-- /.col-lg-12 -->
	            </div>
	            <div class="row">

	            	<?php if(!empty($tasks)) { ?>
						<table class="table table-bordered table-hover table-responsive">
							<thead>
								<tr>
									<?php foreach($tasks[0] as $key => $value) { ?>
										<th><?php echo $key; ?></th>
									<?php } ?>
									<th>Modifier</th>
									<th>Complété</th>
								</tr>
							</thead>
							<tbody style="text-align: center;">
								<?php foreach($tasks as $task) { ?>
									<tr>
										<?php foreach($task as $key => $value) { ?>
											<td><?php echo $value; ?></td>
										<?php } ?>
										<td><a href="<?php echo URL; ?>administration/task/edit/<?php echo $task->id; ?>/"><i class="fa fa-cog"></i></a></td>
										<td><a href="<?php echo URL; ?>administration/task/delete/<?php echo $task->id; ?>/"><i class="fa fa<?php echo $task->get('completed') ? '-check' : ''; ?>-square-o"></i></a></td>
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
						<a href="<?php echo URL; ?>administration/task/new/" class="btn btn-primary btn-lg" role="button">Nouvelle tâche</a>
					</div>
				</div>