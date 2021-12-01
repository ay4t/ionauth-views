                    
                    <div class="fxt-content">
						<div class="fxt-header">
							<a href="" class="fxt-logo"><img src="/auth-assets/img/logo-7.png" alt="Logo"></a>
							<p>Login into your pages account </p>
						</div>
						<div class="fxt-form">
							<form method="POST" action="/auth/login" class="" data-remote>
								<?= csrf_field() ?>
								<div class="form-group" >
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="text" id="identity" class="form-control" name="identity" placeholder="Username / UserID" required="required" autocomplete="off" autofocus>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-2">
										<input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
										<i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-3">
										<div class="fxt-checkbox-area">
											<div class="checkbox">
												<input id="checkbox1" type="checkbox" name="remember">
												<label for="checkbox1">Keep me logged in</label>
											</div>
											<a href="/auth/forgot_password" class="switcher-text">Forgot Password</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" class="fxt-btn-fill">Log in</button>
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

					