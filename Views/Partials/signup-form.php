                    
                    <div class="fxt-content">
						<div class="fxt-header">
							<a href="" class="fxt-logo"><img src="/auth-assets/img/logo-7.png" alt="Logo"></a>
							<p>Create New Account Just Few Second</p>
						</div>
						<div class="fxt-form">
							<form method="POST" action="/auth/signup" class="" data-remote>
								<?= csrf_field() ?>
								
                                <?php foreach ($signup_field as $field):?>
                                <div class="form-group" >
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="<?= $field['type'] ?>" id="<?= $field['name'] ?>" class="form-control" name="<?= $field['name'] ?>" placeholder="<?= $field['placeholder'] ?>" required="required" autocomplete="off">
									</div>
								</div>
                                <?php endforeach; ?>

								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" class="fxt-btn-fill">Join Now !</button>
									</div>
								</div>
							</form>
						</div>
						
						<?= $this->include('IonauthView\Partials\_social-login-button') ?>
						
						<div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-9">
								<p>Don't have an account?<a href="/auth/signup" class="switcher-text2 inline-text">Register</a></p>
							</div>
						</div>
					</div>

					