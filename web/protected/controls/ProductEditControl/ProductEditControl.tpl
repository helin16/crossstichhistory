<com:TPanel ID="productEditPanel">
	<com:TActiveLabel id="errorMsg" style="font-weigth:bold;color:red;"/>
	<com:TActiveHiddenField id="product_Id" />
	<table style='width:100%;padding:0px;'  border='0' cellspacing="0" cellpadding="0">	
		<tr valign="top">
			<td >
				<table style='width:100%;padding:0px;'  border='0' cellspacing="0" cellpadding="0">	
					<tr>
						<td>
							<com:TPanel GroupingText="Images" >
								<table border='0' cellspacing="0" cellpadding="0">
									<tr>
										<td>
											<com:TActiveHiddenField ID="assetIds"/>
											<com:TActiveLabel ID="imageList"/>
										</td>
									</tr>
									<tr>
										<td>
											<com:TPanel ID="imageUploadPanel" >
												Upload more images: <com:TActiveFileUpload OnFileUpload="fileUploaded" />
											</com:TPanel>
										</td>
									</tr>
								</table>
							</com:TPanel>
						</td>
					</tr>
				</table>
			</td>
			<td width="35%" style="padding:0 0 0 12px;">
				<table style='width:100%;padding:0px;border:1px #cccccc solid;'   cellspacing="0" cellpadding="0">	
					<tr>
						<td width="25%">Title:</td>
						<td>
							<com:TActiveTextBox ID="title" style="width:90%;"  ValidationGroup="group1"/>
						</td>
					</tr>
					<tr valign="top">
						<td>SKU:</td>
						<td>
							<com:TActiveTextBox ID="sku" style="width:90%;"  ValidationGroup="group1"/>
						</td>
					</tr>
					<tr valign="top">
						<td>Dimension (m):</td>
						<td>
							<com:TActiveTextBox ID="length" style="width:10px;" ValidationGroup="group1"/> L x
							<com:TActiveTextBox ID="width" style="width:10px;" ValidationGroup="group1"/> W x
							<com:TActiveTextBox ID="height" style="width:10px;" ValidationGroup="group1"/> H
						</td>
					</tr>
					<tr valign="top">
						<td>Initial Visits:</td>
						<td>
							<com:TActiveTextBox ID="visits" style="width:90%;" ValidationGroup="group1"/>
						</td>
					</tr>
					<tr valign="top">
						<td>Categories:</td>
						<td>
							<com:TActiveListBox ID="categories" DataValueField="id" DataTextField="name"  style="width:90%;" AutoPostBack="false" SelectionMode="Multiple"/>
							<div style="font-size:9px;">Ctrl + click to select multiple itesm</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<b>Description: </b><br />
				<com:THtmlArea ID="description" width="100%">
					<prop:Options>
				        theme : "advanced",
				        plugins : "devkit,style,layer,table,save,advhr,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
				        theme_advanced_buttons1_add_before : "save,newdocument,separator,styleselect",
				        theme_advanced_buttons1_add : "separator,insertdate,inserttime,preview,separator,advsearchreplace",
				        theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
				        theme_advanced_buttons3 : "tablecontrols,separator,emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
				        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking",
				        theme_advanced_toolbar_location : "top",
				        theme_advanced_toolbar_align : "left",
				        theme_advanced_path_location : "bottom",
				        plugin_insertdate_dateFormat : "%Y-%m-%d",
				        plugin_insertdate_timeFormat : "%H:%M:%S",
				        theme_advanced_resize_horizontal : true,
				        theme_advanced_resizing : true,
				        nonbreaking_force_tab : true,
				        apply_source_formatting : true
				  	</prop:Options>
				</com:THtmlArea><br /><br />
			</td>
		</tr>
		<tr>
			<td>
				<br /><br />
				<com:TActiveButton Id="saveBtn" Text="Save" OnClick="save" style="width:120px;" ValidationGroup="group1"/>
			</td>
		</tr>
	</table>
</com:TPanel>