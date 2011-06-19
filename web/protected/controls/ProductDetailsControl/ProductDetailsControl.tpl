<com:TPanel ID="productEditPanel">
	<com:TClientScript>
	</com:TClientScript>
	<com:TActiveLabel id="errorMsg" style="font-weigth:bold;color:red;"/>
	<com:TActiveHiddenField id="product_Id" />
	<table style='width:100%;padding:0px;'  border='0' cellspacing="0" cellpadding="0">	
		<tr valign="top">
			<td >
				<table style='width:100%;padding:0px;'  border='0' cellspacing="0" cellpadding="0">	
					<tr>
						<td>
							<com:TPanel style="border:1px #cccccc solid; margin: 1%; width:98%; display:block;">
								<com:TActiveHiddenField ID="assetIds"/>
								<com:TActiveLabel ID="imageList"/>
							</com:TPanel>
						</td>
					</tr>
				</table>
			</td>
			<td width="35%" style="padding:0 0 0 12px;">
				<table style='width:100%;padding:0px;'   cellspacing="0" cellpadding="0">	
					<tr height='25px;'>
						<td colspan='2' style='font-size: 16px;font-weight:bold; color: #810e11; padding: 5px 0 5px 0;'><com:TActiveLabel ID="title" style="width:90%;"  /></td>
					</tr>
					<tr valign="top" width="5%"  height='15px;'>
						<td>SKU:</td>
						<td>
							<com:TActiveLabel ID="sku" style="width:90%;" />
						</td>
					</tr>
					<tr valign="top" height='15px;'>
						<td>Dimension (m):</td>
						<td>
							<ul style="marign:0px;padding:0px;">
								<li>Length: <com:TActiveLabel ID="length" /> (cm)</li>
								<li>Width: <com:TActiveLabel ID="width"/> (cm)</li>
								<li>Height: <com:TActiveLabel ID="height" /> (cm)</li>
							</ul>
						</td>
					</tr>
					<tr valign="top">
						<td colspan='2'>
							<com:TActiveLabel ID="unitPrice" style="font-size:14px;"/>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-top: 10px;height:300px;vertical-align:top;">
				<b>Description: </b><br />
				<div style="width:90%; padding: 10px;">
					<com:TActiveLabel id="description" />
				</div>
			</td>
		</tr>
	</table>
</com:TPanel>