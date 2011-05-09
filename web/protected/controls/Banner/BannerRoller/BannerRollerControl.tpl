<com:TPanel Id="rollerPanel">
	<style>
		.listItem,
		.listItem_cur
		{
			width:200px;
			padding:5px 5px 5px 10px;
			margin:5px 0 5px 0;
			display:block;
			overflow:hidden;
		}
		.listItem_cur
		{
			background:#D5C69D;
		}
		.listItem_img
		{
			display:block;
			float:left;
			margin-right:5px;
			padding:5px;
			width:50px;
			height:30px;
		}
		.listItem_title,
		.listItem_subtitle
		{
			display:block;
			float:left;
			margin:0px;
			width:130px;
			font-size:14px;
		}
		
		.listItem_title
		{
			font-weight:bold;
			margin-bottom:5px;
		}
		
		
		.showingItem_cur
		{
			margin:0; 
			padding:0px;
			width:<%= $this->width %>px;
			height:<%= $this->height %>px;
			position:relative;
			text-decoration:none;
		}
		.showingItem
		{
			display:none;
		}
		
		
		.showingItemTitle
		{
			position: relative;
			top:-30px;
			-moz-opacity: 0.7;
			opacity:.70;
			filter: alpha(opacity=70);
			background-color: #eeeeee;
			color:#000000;
			
			font-size:18px;
			height:20px;
			position:relative;
			top:-50px;
			padding:10px 0 10px 20px;
		}
	</style>
	<script type="text/javascript">
		showingId=1;
		timeOutSecs = <%=$this->timeOutSecs%> * 1000;
		maxItems = <%= $this->noOfItems%>;
		setTimeout("slideStart();",timeOutSecs);
		
		function showBanner(id)
		{
			if($('pause').value==1) return;
			
			$('link_' + id).className='listItem_cur';
			for(i=0;i<maxItems;i++)
			{
				if(i!=id)
				{
					$('showingItem_' + i).className='showingItem';
					$('link_' + i).className='listItem';
				} 
			}
			
			
			$('showingItem_' + id).appear({ duration: 0.4 }); 
			$('showingItem_' + id).className='showingItem_cur';
			showingId=id+1;
			
			if(showingId>=maxItems) 
			{showingId=0;}
		}
		
		function slideStart()
		{
			showBanner(showingId);
			setTimeout("slideStart();",timeOutSecs);
		}
	</script>
	<input type="hidden" id="pause" value="0" />
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style="width:<%= $this->width %>px;height:<%= $this->height %>px;">
				<com:TPanel Id="canvas" style="width: 100%;height:<%= $this->height %>px;" />
			</td>
			<td>
				<com:TPanel Id="list" style="width:96%;padding:2%;" />
			</td>
		</tr>
	</table>
</com:TPanel>