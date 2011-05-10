<com:TPanel ID="langChangerPanel">
	<style>
		.changeLanguageBtn
		{
			color:#BF3A17;
			text-decoration:none;
			outline:none;
		}
		.changeLanguageBtn:hover
		{
			text-decoration:underline;
		}
	</style>
	<table>
		<tr>
			<td>
				<com:TLinkButton CssClass="changeLanguageBtn" OnCommand="changeLanguage" CommandParameter="en" Text='English'/>
			</td>
			<td>
				&nbsp;&nbsp;|&nbsp;&nbsp;
			</td>
			<td>
				<com:TLinkButton CssClass="changeLanguageBtn" OnCommand="changeLanguage" CommandParameter="zh" Text='简体中文'/>
			</td>
			<td>
				&nbsp;&nbsp;|&nbsp;&nbsp;
			</td>
			<td>
				<com:TLinkButton CssClass="changeLanguageBtn" OnCommand="changeLanguage" CommandParameter="zh_TW" Text='繁体中文'/>
			</td>
		</tr>
	</table>	
</com:TPanel>