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
			<td>
				<input type="text" ID="searchText" style='border:none;height:20px;width:100%;margin:0px;padding:3px 0 2px 5px;background:transparent url(/image/searchTextBg.jpg) no-repeat left top;' />
			</td>
			<td>
				<com:TImageButton ID="quickSearchBtn" ImageUrl="/image/searchBtn.jpg" Text="search" Attributes.OnClick="quickSearch();return false;"/>
			</td>
		</tr>
	</table>	
</com:TPanel>