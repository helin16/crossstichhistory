<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<meta name="description" content="Welcome to Australian Cross Stitch Story. Completed Products are Great Gifts and Wall Decorations. The Store Owner Is a Cross Stitch Lover. Let's Stitch Up The World With Peace, Joyfulness and Storyline! " />
	<meta name="keywords" content="Cross stich, Completed Products,Melbourne, Australia" />
	<link rel="stylesheet" type="text/css" href="/Theme/<%=$this->Page->getDefaultThemeName() %>/default.css" />
	<com:TClientScript PradoScripts="effects" />
</com:THead>
<body>
	<center>
		<com:TForm>
	<com:Application.controls.3rdPartyScript.ModalBox ID="modalBox" />
	<com:TClientScript>
		function showMap()
		{
			Modalbox.show('<iframe width=\"100%\" height=\"420\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src="http://maps.google.com.au/maps?hl=en&amp;q='+ "<%= $this->getStoreLocation('+')%>" + '&amp;ie=UTF8&amp;hq=&amp;hnear='+ "<%= $this->getStoreLocation('+')%>" + '&amp;z=14&amp;ll=-37.853025,145.042632&amp;output=embed\"></iframe><br /><small><a href=\"http://maps.google.com.au/maps?hl=en&amp;q='+ "<%= $this->getStoreLocation('+')%>" + '&amp;ie=UTF8&amp;hq=&amp;hnear='+ "<%= $this->getStoreLocation('+')%>" + '&amp;z=14&amp;ll=-37.853025,145.042632&amp;source=embed\" style=\"color:#0000FF;text-align:left\">View Larger Map</a></small>', {title: 'We are at: '+ "<%= $this->getStoreLocation()%>" + '', width: 600});
		}
	</com:TClientScript>
			<br />
			<div style="width:910px;text-align: center;">
				<div id="topMenu" style="width:100%;">
					<div class="innerWrapper">
						<com:Application.controls.Module.Menu.MenuModule ID="topMenu"/>
					</div>
				</div>
				<div id="body" style="width:100%;">
					<div class="innerWrapper">
						<table width="100%">
							<tr>
								<td valign="top" width="230px" style="padding: 10px 0 10px 0;height:500px; ">
									<com:Application.controls.ProductCategoryList.ProductCategoryListControl ID="categoryList" />
									<br />
									<%= $this->getRoundCornerHead()%>
										<h3 style='background:#0084C8; color: white;font-size:14px; margin:0 0 10px 0; padding: 3px 0 3px 0;' >Where To Find Us?</h3>
										<table border='0' cellspacing="0" cellpadding="0" width="100%" >
											<tr valign='top'>
												<td>
													<a href="javascript:void(0);" OnClick="showMap();return false;">
														<img src="/image/map.png" width="210px" style="border:none;"/>
													</a>
												</td>
											</tr>
											<tr>
												<td align='left'>
													<a href="javascript:void(0);" style="padding: 0;Margin:0px;font-size:11px;text-decoration:none;" OnClick="showMap();return false;">
														<%= $this->getStoreLocation()%>
													</a>
												</td>
											</tr>
										</table>
									<%= $this->getRoundCornerFooter()%>
								</td>
								<td valign="top" >
									<com:TPanel ID="cotentSpace" style="margin: 7px 0 7px 7px; padding:10px; text-align:left; border: 1px #cccccc solid;">
										<com:TLabel ID="infoMsg" style="font-weight:bold;font-size:18px;color:green;"/>
										<com:TLabel ID="errorMsg" style="font-weight:bold;font-size:18px;color:#ff0000;"/>
										<com:TContentPlaceHolder ID="MainContent" />
									</com:TPanel>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<com:TPanel ID="footerPanel" style="width:100%;">
					<div class="innerWrapper">
						<%= $this->getRoundCornerHead()%>
							<table border='0' cellspacing="0" cellpadding="0" width="100%" style="margin: 5px 10px 5px 10px;">
								<tr valign='top'>
									<td width='23%'>
										<com:Application.classes.Content.ContentListControl ID="activityList" CategoryName="<%[content.activities]%>" />
									</td>
									<td width='1%'>&nbsp;</td>
									<td width='23%'>
										<com:Application.classes.Content.ContentListControl ID="serviceList" CategoryName="<%[content.popularServices]%>" />
									</td>
									<td width='1%'>&nbsp;</td>
									<td width='23%'>
										<com:Application.classes.Content.ContentListControl ID="projectList" CategoryName="<%[content.projects]%>" />
									</td>
									<td width='1%'>&nbsp;</td>
									<td>
										<com:Application.classes.Content.ContentListControl ID="linksList" CategoryName="<%[content.usefullinks]%>" />
									</td>
								</tr>
							</table>
						<%= $this->getRoundCornerFooter()%>
					</div>
				</com:TPanel>
				<div id="copyright" style="width:100%;margin-top: 15px;">
					<div class="innerWrapper">
						<div>Cross Stitch Story (CSS) &copy; <%= $this->getYear()%> <%= $this->getFooterSeparator()%> <a href="/content/privacy_policy.html">Privacy Policy</a><div>
						<div>Address: <%= $this->getStoreLocation()%></div>
						<div>Tel: <%= $this->getPhone()%> <%= $this->getFooterSeparator()%> Fax: <%= $this->getFax()%> <%= $this->getFooterSeparator()%> Email: <%= $this->getEmail()%></div>
					</div>
				</div>
			</div>
		</com:TForm>
	<center>
	<com:Application.controls.GoogleAnalytics.GoogleAnalyticsControl ID="analytics"/>
</body>
</html>