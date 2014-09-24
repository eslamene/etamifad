				<?php 
				if (isset($_POST['Company']))		{$Company	= $_POST['Company'];}	else {$Company	= "Mifad";}
				if (isset($_POST['Name']))			{$Name		= $_POST['Name'];}		else {$Name		= "";}
				if (isset($_POST['Title']))			{$Title		= $_POST['Title'];}		else {$Title	= "";}
				if (isset($_POST['Tel']))			{$Tel		= $_POST['Tel'];}		else {$Tel		= "+202 2310 8240";}
				if (isset($_POST['Mob']))			{$Mob		= $_POST['Mob'];}		else {$Mob		= "";}
				if (isset($_POST['Fax']))			{$Fax		= $_POST['Fax'];}		else {$Fax		= "+202 2310 8245";}
				if (isset($_POST['EMail']))			{$EMail		= $_POST['EMail'];}		else {$EMail	= "";}
				if (isset($_POST['Dep']))			{$Dep		= $_POST['Dep'];}		else {$Dep		= "";}
				?>
				<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'].'?Signature'; ?>" method="post" name="new" id="new">
					<table class="table table-bordered">									
						
						<h3>Create Your Company E-Mail Signature</h3>
						<hr>
						<?php 
							//<!-- Action Form ============================ -->
							
							if (isset($_POST['Submit']))
							{
								//Error Msg's if the following feilds empty
								if (empty($_POST['Name']) || empty($_POST['Title'])) 
								{
									echo 
									'<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Sorry! </b>Your Name & your Title</strong> both are mandatory fields.
                                    </div>';	
								}
							}						
							//<!-- End Action Form ======================== -->
							//<!-- ======================================== -->
						?>
						<tr>
							<td><b>Company Name</b></td>
							<td colspan="3">
								<label>
									<input class="flat-blue" type="radio" name="Company" value="Eta" />
									<p class="btn bg-blue margin"> Eta </p>
								</label>
								<label>
									<input class="flat-green" type="radio" name="Company" value="Mifad" />
									<p class="btn bg-green margin">Mifad</p>
								</label>
							</td>
							
						</tr>
						
						<tr>
							<td><b>Full Name</b></td>
							<td colspan="3">
								<input type="text" name="Name" value="<?php echo $Name; ?>" class="form-control">
							</td>
						</tr>

						<tr>
							<td><b>Title</b></td>
							<td colspan="3">
								<input type="text" autocomplete="off" name="Title" id="Title" value="<?php echo $Title; ?>" class="form-control">
							</td>
						</tr>

						<tr>
							<td><b>Tel</b></td>
							<td>
								<input type="text" autocomplete="off" name="Tel" id="Tel" value="<?php echo $Tel; ?>" class="form-control">
							</td>

							<td><b>Fax</b></td>
							<td>
								<input type="text" autocomplete="off" name="Fax" id="Fax" value="<?php echo $Fax; ?>" class="form-control">
							</td>
						</tr>


						<tr>
							<td><b>E-Mail</b></td>
							<td>
								<input type="text" autocomplete="off" name="EMail" id="EMail" value="<?php echo $EMail; ?>" class="form-control">
							</td>

							<td><b>Mobile</b></td>
							<td>
								<input type="text" autocomplete="off" name="Mob" id="Mob" value="<?php echo $Mob; ?>" class="form-control">
							</td>
						</tr>
					</table>
					<button type="submit" name="Submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Submit</button>
					<button type="button" class="btn btn-warning pull-right" onClick="parent.location='index.php?Signature'"><i class="icon-repeat icon-white"></i> Clean</button>
				</form>
			
				<hr>

				<div class="well">
					<table>
						<tr>
							<td>

								<p>
									<b>
										<span style='font-size:10.0pt;line-height:115%; font-family:"Arial","sans-serif";color:#2F2F2F'>
											Sincerely,
										</span>
									</b>
									<p style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px; color: #666;">
										<span style="font-weight: bold;" class="txt"><?php echo $Name; ?></span>
										<br>
										<span style="color: #666;" class="txt"><?php echo $Title; ?></span>
									</p>
									
									<p style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px;"><a href="http://www.etamifad.com/" class="clink"><img src="<?php echo 'signature/Logo/'.$Company.'.png'; ?>" alt="3sparks llc" border="0" id="sig-logo"></a></p>
									
									<span style="font-weight: bold; color: #666;" class="txt"><?php if ($Company == 'Mifad'){echo 'Misr Food Additives';} elseif ($Company == 'Eta'){echo 'Egyptian office for trading & agencies';} ?></span>
	
									<p style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px;">
										<span style="color: #666;" class="txt"><?php echo "Office: ".$Tel; ?></span> 
										<span style="color: #666;" class="txt"><?php echo " | Fax: ".$Fax; ?></span>
										<span style="color: #666;" class="txt"><?php if ($Mob != '') {echo "Mobile: ".$Mob;}?></span>
									</p>
									<p style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px;">
										<span style="color: #666;" class="txt">Plot 154, Area 250 Fadan, El Roubeky St, Badr City<br>Cairo, Egypt</span><br>
									</p>
									<p style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px;">
										<?php echo '<a id="email-input" class="link email" style="color: #090d85" target="_blank" href="mailto:'.$EMail.'">'.$EMail.'</a>'; ?>	
									</p>
									<p style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px;">
										<a class="link" href="http://www.etamifad.com/" style="color: #090d85">http://www.etamifad.com</a>
									</p>
									<b>
										<span style='font-size:10.0pt;line-height:115%;font-family:"Arial","sans-serif";'>
										<hr>
										</span>
									</b>
									<p id="disclaimer-input" style="font-family: Helvetica, Arial, sans-serif; color: #666; font-size: 11px; line-height: 14px;" class="txt">This e-mail message may contain confidential or legally privileged information and is intended only for the use of the intended recipient(s). Any unauthorized disclosure, dissemination, distribution, copying or the taking of any action in reliance on the information herein is prohibited. E-mails are not secure and cannot be guaranteed to be error free as they can be intercepted, amended, or contain viruses.  Anyone who communicates with us by e-mail is deemed to have accepted these risks. Company Name is not responsible for errors or omissions in this message and denies any responsibility for any damage arising from the use of e-mail.  Any opinion and other statement contained in this message and any attachment are solely those of the author and do not necessarily represent those of the company.</p>
								</p>
							</td>
						</tr>
					</table>
				</div>
				
				<div class="well">
					<p>Please Copy "Ctrl+C" the Previous Signature and Paste "Ctrl+V" it into your E-Mail</p>
				</div>

			</div>
		</div>
