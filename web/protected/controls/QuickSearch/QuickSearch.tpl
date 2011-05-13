<com:TPanel ID="quickSearchPanel" DefaultButton="quickSearchBtn">
	<script type="text/javascript">
		function quickSearch()
		{
			var searchValue =$('searchText').value;
			window.location='/search/'+searchValue;
		}
	</script>
	<table width="100%"">
		<tr>
			<td width="80px">
				Quick Search: 
			</td>
			<td>
				<input type="text" ID="searchText" style='border:1px #732f01 solid;height:15px;width:95%;margin:0px 5px 0 0;padding:3px 0 2px 5px;' />
			</td>
			<td>
				<com:TButton ID="quickSearchBtn" style="border:none;display:block; width:105px; height:23px; padding: 0; font-weight:bold; color: #008dd6;background:transparent url(/Theme/default/images/search_bg.png) no-repeat left top;" Text="search" Attributes.OnClick="quickSearch();return false;"/>
			</td>
		</tr>
	</table>	
</com:TPanel>