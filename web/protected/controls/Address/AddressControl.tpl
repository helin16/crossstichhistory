<com:TPanel ID="addressPanel" GroupingText="<%= $this->groupingText %>">
	<table width="100%">
		<tr>
			<td width="10%">
				Address:
			</td>
			<td>
				<com:TTextBox ID="address" />
			</td>
		</tr>
		<tr>
			<td>
				Suburb:
			</td>
			<td>
				<com:TDropDownList ID="suburb" 
					DataTextField="suburb" 
					DataValueField="suburb"
					ValidationGroup="<%= $this->validationGroup%>"/>
				<com:TRequiredFieldValidator    
					ValidationGroup="<%= $this->getValidationGroup()%>"
					ControlToValidate="suburb"
					Display="Dynamic"
					Text="* required" />
			</td>
		</tr>
		<tr>
			<td>
				State:
			</td>
			<td>
				<com:TDropDownList ID="stateList" 
					DataValueField="id"
					DataTextField="name"	
					ValidationGroup="<%= $this->validationGroup%>"	
				/>
				<com:TRequiredFieldValidator    
					ValidationGroup="<%= $this->validationGroup%>"
					ControlToValidate="stateList"
					Display="Dynamic"
					Text="* required" />
			</td>
		</tr>
		<tr>
			<td>
				Postcode:
			</td>
			<td>
				<com:TTextBox ID="postcode" ValidationGroup="<%= $this->validationGroup>"/>
				<com:TRequiredFieldValidator    
					ValidationGroup="<%= $this->getValidationGroup()%>"
					ControlToValidate="postcode"
					Display="Dynamic"
					Text="* required" />
			</td>
		</tr>
	</table>	
</com:TPanel>