/** Custom Pricing Functions **/
function ZGD_CCC_20OFFSUBTOTAL(idx)
{
	if(zgd_price_ofitems[idx] != "STD")
	{
		zgd_subtotal["SUBTOTAL_2"] = parseInt(zgd_subtotal["SUBTOTAL_2"]) * .2;
	}
}