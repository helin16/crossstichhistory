<com:TPanel ID="addressPanel" GroupingText="<%= $this->groupingText %>">
	<table width="100%" style="font-size:12px;">
		<tr>
			<td width="60px">
				New Time:
			</td>
			<td>
				<com:TActiveDatePicker ID="newTime" 
					DateFormat="yyyy-MM-dd 10:00:00"/>
				<com:TActiveButton Text="add" OnClick="addTime" style="font-size:12px;"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<com:TActiveListBox ID="inspectTimes" 
					DataTextField="1" 
					DataValueField="0"
					Rows="4"
					width="80%" style="font-size:12px;"/>
				<com:TActiveButton Text="remove" OnClick="removeTime" style="font-size:12px;"/>
			</td>
		</tr>
	</table>	
</com:TPanel>