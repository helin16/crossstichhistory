<com:TPanel ID="productListPanel">
	<com:TClientScript>
		function changePage_<%=$this->getID()%>(pageNo)
		{
			$('<%= $this->currentPageNo->getClientId() %>').value = pageNo;
			$('<%= $this->changePageBtn->getClientId() %>').click();
		}
	</com:TClientScript>
	<com:TActiveHiddenField ID="currentPageNo" />
	<com:TActiveHiddenField ID="categoryId" />
	<com:TActiveLabel ID="productListPanel_display" />
	<com:TButton ID="changePageBtn" OnClick="showProducts" style="display:none;"/>
</com:TPanel>