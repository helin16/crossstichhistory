<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<com:THead ID="titleHeader" Title="<%$ AppTitle %>">
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="content-language" content="en"/>
</com:THead>
<body>
	<style>
		div#menu div ul
		{
			list-style:none;
			margin:0px;
			padding:0px;
		}
		div#menu div ul li
		{
			float:left;
		}
		div#menu div ul li a,
		div#menu div ul li a:link
		{
			padding:0 15px 0 15px;
			text-decoration: none;
			font-size:14px;
			color:#ffffff;
			outline:none;
		}
		
		div#menu div ul li a:hover
		{
			color:#000000;
		}
	</style>
	<center>
		<com:TForm>
			<div style="width:910px;border: 15px #2D3444 solid;">
				<div style="background:#2D3444;width:100%">
					<table width="100%" border='0' cellspacing="0" cellpadding="0" >
						<tr>
							<td align="left">
								<img src="/Theme/<%=$this->getDefaultThemeName() %>/images/logo.jpg"/>
							</td>
							<td align="right" width="20%" valign="bottom">
								<a href="/" target="_blank" style="text-align:right;color:#ffffff; font-size:12px;">Preview Website</a>
							</td>
							<td width="30%" valign="bottom" style="text-align:right;color:#ffffff;">
								<br />
								Welcome,&nbsp;&nbsp;<com:TLinkButton ID="usernameBtn" style="color:#ffffff;"/>
							</td>
						</tr>
					</table>
				</div>
				<div id="menu" style="background:#A40404;text-align:left;color:#ffffff;width:100%">
					<table width="100%">
						<tr>
							<td>
								<div style="display:block;width:100%;height:25px;">
									<ul>
										<li>
											<a href="/admin/" <%= $this->changeId('home') %>>Admin Home</a>
										</li>
										<li>
											<a href="/admin/list/contacts.html" <%= $this->changeId('contacts') %>>Contacts</a>
										</li>
										<li>
											<a href="/admin/list/content.html" <%= $this->changeId('contents') %>>Contents</a>
										</li>
										<li>
											<a href="/admin/list/contentcategory.html" <%= $this->changeId('contentcategory') %>>Content Categories</a>
										</li>
										<li>
											<a href="/admin/list/product.html" <%= $this->changeId('products') %>>Products</a>
										</li>
										<li>
											<a href="/admin/list/productcategory.html" <%= $this->changeId('productcategory') %>>Product Categories</a>
										</li>
										<li>
											<a href="/admin/list/subscriber.html" <%= $this->changeId('subscribers') %>>Subscribers</a>
										</li>
										<li>
											<a href="/admin/list/banners.html" <%= $this->changeId('banners') %>>Banners</a>
										</li>
										<li>
											<com:TLinkButton ID="logout" OnClick="logout" Text="Logout"/>
										</li>
									</ul>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div style="min-height:400px;padding:15px;text-align:left; width:100%;">
					<com:TActiveLabel ID="infoLabel" style="color:green;font-weight:bold; padding: 5px;"/>
					<com:TActiveLabel ID="errorLabel" style="color:red;font-weight:bold; padding: 5px;"/>
					<com:TContentPlaceHolder ID="MainContent" />
				</div>
			</div>
		</com:TForm>
	<center>
</body>
</html>