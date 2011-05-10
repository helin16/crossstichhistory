<table width="100%" border='0' cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border='0' cellspacing="0" cellpadding="0">
				<tr valign="bottom">
					<td width="360px">
						<a href='/' style='outline:none;border:none;padding:0px;margin:0px;'>
							<img style="border:none;padding:0px;margin:0px;" src="/Theme/<%=$this->Page->getDefaultThemeName() %>/images/logo.jpg" Title="Cross Stitch Story"/>
						</a>
					</td>
					<td width="360px">
						<table id="topMenu" width="100%" border='0' cellspacing="0" cellpadding="0" style="margin-left:30px;">
							<tr>
								<td width="102px">
									<a class='topMenuItem' href="/" <%= $this->changeId('home') %>><%[Menu.home]%></a>
								</td>
								<td width="102px">
									<a  class='topMenuItem' href="/contentlist/category/News Headlines.html" <%= $this->changeId('news') %>><%[Menu.news]%></a>
								</td>
								<td>
									<a  class='topMenuItem' href="/contactus.html" <%= $this->changeId('contactus') %>><%[Menu.contactus]%></a>
								</td>
							</tr>
						</table>
					</td>
					<td>
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border='0' cellspacing="0" cellpadding="0">
				<tr valign="bottom">
					<td width="10px" >
						<img src="/Theme/default/images/left.jpg" />
					</td>
					<td style="background:transparent url('/Theme/default/images/mid.jpg') repeat-x left bottom;">
						<table width="100%" height="67px" border='0' cellspacing="0" cellpadding="0">
							<tr>
								<td style="font-weight:bold; color:white; padding: 5px 0 5px 3px; text-align:left;">
									TopNews: fdsafsdaflasdkfjsdalfsd
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; color:white; padding 5px 0 5px 12px; text-align:left;">
									<table width="100%" border='0' cellspacing="0" cellpadding="0">
										<tr>
											<td>
												<com:Application.controls.QuickSearch.QuickSearch ID="quickSearch"/>
											</td>
											<td style="width:312px;">
												<div style="float:right;padding: 0 20px 0 0; font-weight:bold; color:#ffffff; ">
													<a style="color:#ffffff; text-decoration:none;" href="/contentlist/category/News Headlines.html" ><%[Menu.news]%></a>
													&nbsp;&nbsp; | &nbsp;&nbsp;
													<a style="color:#ffffff; text-decoration:none;" href="/contactus.html" ><%[Menu.contactus]%></a>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td width="10px" >
						<img src="/Theme/default/images/right.jpg" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>