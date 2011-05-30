<com:TPanel ID="productEditPanel">
	<com:TClientScript>
		function deleteImage_<%= $this->getId()%>(assetId)
		{
			var ids = $('<%= $this->assetIds->getClientId()%>').value.split(',');
			var idx = ids.indexOf(assetId);
			
			if(idx!=-1) ids.splice(idx, 1);
			
			$('<%= $this->assetIds->getClientId()%>').value=ids.join(',');
			$('imageShow_' + assetId).hide();
		}
		
		function makeDefault_<%= $this->getId()%>(assetId)
		{
			var ids = $('<%= $this->assetIds->getClientId()%>').value.split(',');
			var newArray = new Array();
			newArray[0]=assetId;
			
			var idx = ids.indexOf(assetId);
			if(idx!=-1) ids.splice(idx, 1);
			
			$('<%= $this->assetIds->getClientId()%>').value=newArray.concat(ids).join(',');
			$('<%= $this->loadImageBtn->getClientId()%>').click();
		}
	</com:TClientScript>
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
											<com:TActiveButton ID="loadImageBtn" OnClick="loadImages" style="display:none;"/>
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
				<table style='width:100%;padding:0px;'   cellspacing="0" cellpadding="0">	
					<tr>
						<td width="25%">Title:</td>
						<td>
							<com:TTextBox ID="title" style="width:90%;" ValidationGroup="<%= $this->validationGroup %>"/>
							<com:TRequiredFieldValidator ControlToValidate="title"
									ErrorMessage="title Required" ValidationGroup="<%= $this->validationGroup %>" EnableClientScript="true" 
									Display="Dynamic"/>
						</td>
					</tr>
					<tr valign="top">
						<td>SKU:</td>
						<td>
							<com:TTextBox ID="sku" style="width:90%;"  ValidationGroup="<%= $this->validationGroup %>"/>
							<com:TRequiredFieldValidator ControlToValidate="title"
									ErrorMessage="sku Required" ValidationGroup="<%= $this->validationGroup %>" EnableClientScript="true" 
									Display="Dynamic"/>
						</td>
					</tr>
					<tr valign="top">
						<td>Dimension (cm):</td>
						<td>
							<com:TTextBox ID="length" style="width:40px;" /> L x
							<com:TTextBox ID="width" style="width:40px;" /> W x
							<com:TTextBox ID="height" style="width:40px;" /> H
						</td>
					</tr>
					<tr valign="top">
						<td>Initial Visits:</td>
						<td>
							<com:TTextBox ID="visits" style="width:90%;" ValidationGroup="<%= $this->validationGroup %>"/>
							<com:TRequiredFieldValidator ControlToValidate="title"
									ErrorMessage="visits Required" ValidationGroup="<%= $this->validationGroup %>" EnableClientScript="true" 
									Display="Dynamic"/>
						</td>
					</tr>
					<tr valign="top">
						<td>Categories:</td>
						<td>
							<com:TListBox ID="categoryList" DataValueField="id" DataTextField="name"  style="width:90%;" AutoPostBack="false" SelectionMode="Multiple"/>
							<div style="font-size:9px;">Ctrl + click to select multiple itesm</div>
							<com:TListControlValidator
									ControlToValidate="categoryList"
									ErrorMessage="You must select a Category" 
									MinSelection="1"
									EnableClientScript="true" 
									ValidationGroup="<%= $this->validationGroup %>"
									Display="Dynamic"
									/>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style='font-weight:bold;'>Description: </div>
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
				</com:THtmlArea>
			</td>
		</tr>
		<tr>
			<td>
				<com:TButton Id="saveBtn" Text="Save" OnClick="save" ValidationGroup="<%= $this->validationGroup %>"/>
				<com:TButton Id="cancelBtn" Text="Cancel" OnClick="cancel" />
			</td>
		</tr>
	</table>
</com:TPanel>