<script type="text/javascript">
	function loadSubscriptionMsg()
	{
		if($('<%= $this->subscripionErrorMsg->getClientId()%>').value!='')
			alert($('<%= $this->subscripionErrorMsg->getClientId()%>').value);
	}
</script>
<com:TActiveHiddenField ID="subscripionErrorMsg" />
<com:TPanel ID="newLetterPanel" DefaultButton="subscribeBtn">
	<table style='width:100%;padding:0px;margin:20px 0 0 0px;height:110px;'  border='1' cellspacing="0" cellpadding="0">
		<tr valign='top'>
			<td style="width:6px;background:transparent url(<%=$this->imageRootPath%>images/newsletter_left.png) no-repeat right top;">&nbsp;</td>
			<td style="background:transparent url(<%=$this->imageRootPath%>images/newsletter_mid.png) repeat-x left top;">
				<table border='0' cellspacing="0" cellpadding="0" style='padding: 10px 0 0 20px;'>
					<tr>
						<td style='color:#ffffff;font-size:24px;padding: 0 0 5px 0;'><%[NewsLetter.newsletter]%></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<com:TActiveTextBox ID="subscribe_email" 
									style='border:none;height:20px;width:200px;margin:0px;padding:2px 0 2px 5px;background:transparent url(<%=$this->imageRootPath%>images/newsletter_input.png) no-repeat left top;' />
						</td>
						<td>
							<com:TActiveImageButton ID="subscribeBtn" style='padding:0 5px 2px 0;outline:none;' OnClick="subscribe" 
									ImageUrl="/Theme/<%=$this->Page->getDefaultThemeName()%>/images/newsletter_button.png">
								<prop:ClientSide OnLoading="$('<%= $this->subscribeBtn->getClientId()%>').hide();$('subscribe_loading').show();"
											OnComplete="$('<%= $this->subscribeBtn->getClientId()%>').show();$('subscribe_loading').hide();loadSubscriptionMsg();" />
							</com:TActiveImageButton>
							<img id='subscribe_loading' src='/image/ajax-loader.gif' style='display:none;'/>
						</td>
					</tr>
					<tr>
						<td style='padding-top:5px;'>
							<a href='/newsletter/unsubscribe.html' style='color:#ffffff;'><%[NewsLetter.unsubscribe]%></a>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td style="width:6px;background:transparent url(<%=$this->imageRootPath%>images/newsletter_right.png) no-repeat left top;">&nbsp;</td>
		</tr>
	</table>
</com:TPanel>