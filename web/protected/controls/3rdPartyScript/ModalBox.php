<?php
class ModalBox extends TWebControl
{
	const JS_ROOT='/3rdPartyScript/modalBox/';
	
	/**
	 * @param THtmlWriter $writer
	 */
	public function renderContents($writer)
	{
		$writer->writeLine("<script type='text/javascript' src='".ModalBox::JS_ROOT."modalbox.js'></script>");
		$writer->writeLine("<link rel='stylesheet' href='".ModalBox::JS_ROOT."modalbox.css' type='text/css' media='screen' />");
	}
}
?>