
function calculateCash(id)
{
	//calculate next
	var pieces = numeral().unformat($('#pieces_'+id).val() );
	var number = numeral().unformat($('#number_'+id).val() );
	var amount = pieces * number;
	$('#amount_'+id).val( numeral(amount).format('0,0.00') );

	//calculate total
	var total = 0;
    $('.amount').each(function(i,obj){
        if (obj.value){
            var x = numeral().unformat(obj.value);
            total += x;
        }
    });

    $('#total').val( numeral(total).format('0,0.00') );

}

