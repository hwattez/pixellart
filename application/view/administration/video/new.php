				<div class="row">
	                <div class="col-lg-12">
	                    <h1 class="page-header">Nouvelle vidéo</h1>
	                </div>
	                <!-- /.col-lg-12 -->
	            </div>
	            <?php if(isset($error)) { ?>
		            <div class="row">
						<div class="alert alert-danger" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							Erreur(s) dans le formulaire
						</div>
		            </div>
		        <?php } ?>
	            <div class="row">
					<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
						<?php foreach($forms as $key => $val) { ?>
							<?php
								switch($key){
									case 'id':
										echo Forms::$val($key, $video->$key, 'disabled');
										break;
									case 'picture':
										echo Forms::$val($key, $video->get($key, 'medium'));
										break;
									default:
										echo Forms::$val($key, $video->$key);
								}
							?>
						<?php } ?>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Envoyer</button>
							</div>
						</div>
					</form>
				</div>