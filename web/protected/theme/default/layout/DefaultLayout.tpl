<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<meta name="description" content="Welcome to Australian Cross Stitch Story. Completed Products are Great Gifts and Wall Decorations. The Store Owner Is a Cross Stitch Lover. Let's Stitch Up The World With Peace, Joyfulness and Storyline! ">
	<meta name="keywords" content="Cross stich, Completed Products,Melbourne, Australia">
	<link rel="stylesheet" type="text/css" href="/Theme/<%=$this->Page->getDefaultThemeName() %>/default.css" />
</com:THead>
<body>
	<center>
		<com:TForm>
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
									<%= $this->getRoundCornerHead()%>
										fdsfdsa
										<!--<com:Application.controls.NewsLetter.NewsLetterControl ID="newsletter" ImageRootPath="/Theme/<%=$this->Page->getDefaultThemeName()%>/"/> -->
									<%= $this->getRoundCornerFooter()%>
								</td>
								<td valign="top" >
									<div style="margin: 7px 0 7px 7px; padding:10px; text-align:left; border: 1px #cccccc solid;">
										<com:TLabel ID="infoMsg" style="font-weight:bold;font-size:18px;color:green;"/>
										<com:TLabel ID="errorMsg" style="font-weight:bold;font-size:18px;color:#ff0000;"/>
										<com:TContentPlaceHolder ID="MainContent" />
									</div>
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
						Cross Stitch Story (CSS) &copy; 2010 | <a href="/content/privacy_policy.html">Privacy Policy</a>
					</div>
				</div>
			</div>
		</com:TForm>
	<center>
	<com:Application.controls.GoogleAnalytics.GoogleAnalyticsControl ID="analytics"/>
</body>
</html>