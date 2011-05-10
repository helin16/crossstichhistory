<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
	<meta name="description" content="Managed by a team of expertise with over 10 years of experience in this industry, ARG has built its profile from nothing to well over thousand happy investors ever since its establishment in Oct 2008.A team that believes in customer orientated, ARG offers what is suitable investment portfolio for their customer. These services include investment strategies, market research, overseas investment and funding management.ARG has been actively promoting the importance of investment for their customers� retirement planning through seminars and workshop">
	<meta name="keywords" content="Real,Estate,for,sale,Australia,property,real estate,for sale by owner,real estate online,Australian real estate,Property,real estate,For sale by owner,real estate in Australia,No commission,Sydney real estate,real estate in Sydney,Melbourne real estate,real estate in Melbourne,Australia Realty,Brisbane real estate,real estate in Brisbane,Adelaide real estate,real estate in Adelaide,Perth real estate,real estate for sale by owner,property,for sale by owner,real estate in Perth,Hobart real estate,real estate in Hobart,Gold coast real estate,real estate Gold Coast,real estate for sale by owner,Newcastle real estate,real estate in Newcastle,Northern Territory real estate,for sale by owner,real estate in Northern Territory,www.australiarealty.com,victoria real estate,queensland real estate, wa real estate,tasmania real estate,sa real estate,for sale by owner,www.australiarealty.com,www.australiarealty.com.au,victoria real estate,queensland real estate,real estate for sale by owner,farms for sale,properties for sale,australian properties for sale,sydney real estate,brisbane real estate, melbourne real estate,brisbane property, melbourne property,sydney property, real estate for sale,australian real estate">
	<link rel="stylesheet" type="text/css" href="/Theme/<%=$this->Page->getDefaultThemeName() %>/default.css" />
</com:THead>
<body>
	<center>
		<com:TForm>
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
								<td valign="top" width="230px" style="padding: 10px 0 10px 0;">
									<!--<com:Application.controls.NewsLetter.NewsLetterControl ID="newsletter" ImageRootPath="/Theme/<%=$this->Page->getDefaultThemeName()%>/"/> -->
								</td>
								<td valign="top" style="padding: 15px; height:500px; text-align:left;">
									<com:TLabel ID="infoMsg" style="font-weight:bold;font-size:18px;color:green;"/>
									<com:TLabel ID="errorMsg" style="font-weight:bold;font-size:18px;color:#ff0000;"/>
									<com:TContentPlaceHolder ID="MainContent" />
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