                    
                    <div class="fxt-content">
						<div class="fxt-header">
							<a href="" class="fxt-logo"><img src="/auth-assets/img/logo-7.png" alt="Logo"></a>
							<p>Create A New Password And Confirm</p>
						</div>
						<div class="fxt-form">
							<form method="POST" action="/auth/reset_password" class="" data-remote>
								<?= csrf_field() ?>
                                
                                <input type="hidden" name="forgotten_password_code" value="<?= $forgotten_password_code ?>">

								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-2">
										<input id="new_password" type="password" class="form-control" name="new_password" placeholder="New Password" required="required">
										<i toggle="#new_password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-2">
										<input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" required="required">
										<i toggle="#confirm_password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" class="fxt-btn-fill">Update My Password</button>
									</div>
								</div>
							</form>
						</div>
											
						<div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-9">
								<p>Don't have an account?<a href="/auth/signup" class="switcher-text2 inline-text">Register</a></p>
							</div>
						</div>
					</div>

					