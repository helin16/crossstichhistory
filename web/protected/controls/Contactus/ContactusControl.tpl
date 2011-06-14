<com:TPanel DefaultButton="emailBtn" Id="contactUsPanel" GroupingText="<%= $this->groupingText %>">
	<table width="100%">
		<tr>
			<td colspan="2">
				<com:TLabel ID="contactusTitle" style="font-size:18px;" />
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
				<com:TTextBox ID="emailContent" TextMode="MultiLine" width="100%" height="100px"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
					<tr>
						<td width="25%">
							<%[ContactUs.spamChecking]%>: 
						</td>
						<td align="left">
							<com:TCaptcha ID="captcha" TokenFontSize='20' style="display:inline;width:100px;"/>
							<com:TTextBox ID="spamInput" style="width:80px;"/>
							<com:TCaptchaValidator CaptchaControl="captcha"
										ControlToValidate="spamInput"
							 			ErrorMessage="Invalid Text!" 
							 			ValidationGroup="Group1"
							 			Display="Dynamic"/>
							<com:TLinkButton ID="changeCaptchaBtn" Text="change image" OnClick="changeCaptcha" style="font-size:10px;display:inline;"/>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<com:TButton ID="emailBtn" Text="<%[ContactUs.submitbutton]%>" OnClick="sendEmail" ValidationGroup="Group1" />
			</td>
		</tr>
	</table>
</com:TPanel>