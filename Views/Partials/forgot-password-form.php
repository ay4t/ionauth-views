                    
                    <div class="fxt-content">
						<div class="fxt-header">
							<a href="" class="fxt-logo"><img src="/auth-assets/img/logo-7.png" alt="Logo"></a>
							<p>Forgot your password ?</p>
						</div>
						<div class="fxt-form">
							<form method="POST" action="/auth/forgot_password" data-remote>
								<?= csrf_field() ?>
								<div class="form-group" >
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="text" id="identity" class="form-control" name="identity" placeholder="Username / UserID" required="required" autocomplete="off" autofocus>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-2">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email match User" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" class="fxt-btn-fill">Request New Password !</button>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-3">
										<div class="fxt-checkbox-area">
											<a href="/auth/login" class="switcher-text">Remember password? Login Now</a>
										</div>
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

					