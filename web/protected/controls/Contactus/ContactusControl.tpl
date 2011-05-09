<com:TPanel DefaultButton="email" Id="contactUsPanel">
	<table width="100%">
		<tr>
			<td colspan="2">
				<com:TLabel ID="contactusTitle" style="font-size:18px;" Text="<%[ContactUs.title]%>" />
				<br />
				<br />
				<b><com:TLabel ID="result" ForeColor="green" Text="<%[ContactUs.successfullSent]%>"/></b>
			</td>
		</tr>
		<tr>
			<td width="15%"><%[ContactUs.yourname]%>:</td>
			<td>
				<com:TTextBox ID="name" /> 
				<com:TRequiredFieldValidator    
					ValidationGroup="Group1"
					ControlToValidate="name"
					Display="Dynamic"
					Text="* Field required." />
			</td>
		</tr>
		<tr>
			<td><%[ContactUs.youremail]%>:</td>
			<td>
				<com:TTextBox ID="emailAddr" />
				<com:TRequiredFieldValidator    
					ValidationGroup="Group1"
					ControlToValidate="emailAddr"
					Display="Dynamic"
					Text="* Field required." />
				<com:TEmailAddressValidator   
					ValidationGroup="Group1"
					ControlToValidate="emailAddr"
					Display="Dynamic"
					Text="Invalid email address." />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<%[ContactUs.emailcontent]%>: 
				<com:TRequiredFieldValidator    
					ValidationGroup="Group1"
					Display="Dynamic"
					ControlToValidate="emailContent"
					Text="* Field required." />
				<br />
				<com:TTextBox ID="emailContent" TextMode="MultiLine" width="100%" height="100px" Text="<%= $this->content %>"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
					<tr>
						<td width="35%">
							<%[ContactUs.spamChecking]%>: 
						</td>
						<td align="left">
							<com:TTextBox ID="spamInput" style="width:80px;"/>
							<com:TActiveImageButton Id="captcha" Tooltip="Can't see it clearly? click here to change code." OnClick="changeCaptcha" >
								<prop:ClientSide
							        OnLoading="$('<%= $this->captcha->getClientId() %>').src='';Element.hide('<%= $this->captcha->getClientId() %>');Element.show('loading');"
							        OnComplete="Element.hide('loading');Element.show('<%= $this->captcha->getClientId() %>');" />
							</com:TActiveImageButton>
							<img id="loading" src="/image/ajax-loader.gif" style="display:none;"/>
							
						</td>
						<td align="left" width="40%">
							<com:TRequiredFieldValidator    
								ValidationGroup="Group1"
								ControlToValidate="spamInput"
								Display="Dynamic"
								Text="* Field required." />
							<com:TLabel ID="spamError" style="width:100%; color:red;" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<com:TButton ID="email" Text="<%[ContactUs.submitbutton]%>"
					OnClick="sendEmail"
					ValidationGroup="Group1"/>
			</td>
		</tr>
	</table>
</com:TPanel>