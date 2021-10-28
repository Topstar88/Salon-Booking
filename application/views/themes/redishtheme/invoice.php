<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection" id="home">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<?php 
						if($invMsg = $this->session->flashdata('invMsg')){
							$inv_class = $this->session->flashdata('inv_class');
					?>
							<div class="alert <?php echo esc($inv_class, true);?>"><?php echo esc($invMsg, true);?></div>
					<?php
						}
					?>
					<div class="selectionBoxMain signupSec">
						<h1 class="loginSignupTitle">Paid Successfully</h1>
						<p class="loginSignupSubTitle">Thank you for your service.<p>
						
						<div class="row">
							<div class="col-md-5">
								<img class="img-fluid img-thumbnail" alt="Invoce Template" src="<?php uploads("img/".$service['image']);?>" />
							</div>
							<div class="col-md-7 text-xs-right">
								<h4><?php echo esc($service['title'], true) ?></h4>
								<p class="mb-2"><i class="icon-mobile2"></i> <?php echo esc($user['phone'], true) ?><br><i class="icon-envelop"></i>  <?php echo esc($user['email'], true) ?></p>
								<h4>Transection Id</h4>
								<p class="mb-0"><?php echo esc($order['transectionId'], true) ?></p>
							</div>
						</div>
						<br />
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th><h5>Description</h5></th>
										<th><h5>Amount</h5></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="col-md-8">Your appointment of <strong>"<?php echo esc($service['title'], true) ?>"</strong> have been booked for <strong>"<?php echo esc($booking['date'], true) ?>"</strong> & <strong>"<?php echo esc($booking['timing'], true) ?>"</strong>.</td>
										<td class="col-md-4"><?php echo esc($order['paid_amount'], true) ?> <?php echo esc($order['paid_currency'], true) ?></td>
									</tr>
									
									<tr>
										<td class="align-middle text-right"><strong>Total Amount: </strong></td>
										<td class="align-middle"><strong><?php echo esc($order['paid_amount'], true) ?> <?php echo esc($order['paid_currency'], true) ?></strong></td>
									</tr>
									<tr>
										<td class="align-middle text-right"><strong>Check your Stripe Invoice: </strong></td>
										<td class="align-middle"><a href="<?php echo esc($order['receipt_url'], true) ?>" target="_blank" class="btn btn-primary btn-sm">Stripe Invoice</a></td>
									</tr>
									<tr>
										<td class="text-right align-middle"><h5 class="mb-0"><strong>Total:</strong></h5></td>
										<td class="text-left align-middle"><h5 class="mb-0"><strong><?php echo esc($order['paid_amount'], true) ?> <?php echo esc($order['paid_currency'], true) ?></strong></h5></td>
									</tr>
									<tr>
										<td class="text-right align-middle"><h5 class="mb-0"><strong>Date:</strong></h5></td>
										<td class="text-left align-middle"><p class="mb-0"><?php echo esc($order['created'], true) ?></p></td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php if(!$this->session->userdata('id')){ ?>
							<div class="signUpWithSocial">
								<h3>Login / Signup for keep tracking your booking</h3>
							</div>
							<div class="loginGoSignup pt-0"><a class="bg-default" href="<?php echo base_url('login') ?>">Login</a> / <a href="<?php echo base_url('login/signUp') ?>">Sign Up</a></div>
						<?php } else{ ?>
							<div class="text-center"><a class="btn btn-outline-danger" href="<?php echo base_url('userbooking') ?>">Go to All Bookings</a></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /mainSection -->
	
<?php $theme_view('includes/footer'); ?>
<?php $theme_view('includes/foot'); ?>
<?php $theme_view('includes/footEnd'); ?>