function gdSubmitOrderOnClick(obj)
{
	document.gdOrderDataForm.submit();
	/*
	$("#gdOrderDataForm").html("");
	gd_data_holder.each(function(k, v)
	{
		$("<span/>").text(k).appendTo("#gdOrderDataForm");
		$("<input/>",
		{
			id:k + "DataHolderObj",
			name:k + "DataHolderObj",
			type:"text"
		}).val(v).appendTo("#gdOrderDataForm");
		$("<br/>").appendTo("#gdOrderDataForm");
	});
	*/
	
}