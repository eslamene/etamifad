<script type="text/javascript"> 
function calculate()
{
	var M_01=document.getElementById('M_01');
	var M_02=document.getElementById('M_02');
	var M_03=document.getElementById('M_03');
	var M_04=document.getElementById('M_04');
	var M_05=document.getElementById('M_05');
	var M_06=document.getElementById('M_06');
	var M_07=document.getElementById('M_07');
	var M_08=document.getElementById('M_08');
	var M_09=document.getElementById('M_09');
	var M_10=document.getElementById('M_10');
	var M_11=document.getElementById('M_11');
	var M_12=document.getElementById('M_12');

	var Q_V_01=document.getElementById('Q_V_01');
	var Q_V_02=document.getElementById('Q_V_02');
	var Q_V_03=document.getElementById('Q_V_03');
	var Q_V_04=document.getElementById('Q_V_04');

	if(M_01.value=="" || M_01.value!=parseFloat(M_01.value)) M_01.value=0;
	if(M_02.value=="" || M_02.value!=parseFloat(M_02.value)) M_02.value=0;
	if(M_03.value=="" || M_03.value!=parseFloat(M_03.value)) M_03.value=0;
	if(M_04.value=="" || M_04.value!=parseFloat(M_04.value)) M_04.value=0;
	if(M_05.value=="" || M_05.value!=parseFloat(M_05.value)) M_05.value=0;
	if(M_06.value=="" || M_06.value!=parseFloat(M_06.value)) M_06.value=0;
	if(M_07.value=="" || M_07.value!=parseFloat(M_07.value)) M_07.value=0;
	if(M_08.value=="" || M_08.value!=parseFloat(M_08.value)) M_08.value=0;
	if(M_09.value=="" || M_09.value!=parseFloat(M_09.value)) M_09.value=0;
	if(M_10.value=="" || M_10.value!=parseFloat(M_10.value)) M_10.value=0;
	if(M_11.value=="" || M_11.value!=parseFloat(M_11.value)) M_11.value=0;
	if(M_12.value=="" || M_12.value!=parseFloat(M_12.value)) M_12.value=0;

	if(Q_V_01.value=="" || Q_V_01.value!=parseFloat(Q_V_01.value)) Q_V_01.value=0;
	if(Q_V_02.value=="" || Q_V_02.value!=parseFloat(Q_V_02.value)) Q_V_02.value=0;
	if(Q_V_03.value=="" || Q_V_03.value!=parseFloat(Q_V_03.value)) Q_V_03.value=0;
	if(Q_V_04.value=="" || Q_V_04.value!=parseFloat(Q_V_04.value)) Q_V_04.value=0;

	var TotalQtyresult=document.getElementById('TotalQty');
	var TotalValueresult=document.getElementById('TotalValue');

	TotalQtyresult.value=0;
	TotalValueresult.value=0;

	TotalQtyresult.value=parseInt(TotalQtyresult.value);
	TotalValueresult.value=parseFloat(TotalValueresult.value);

	TotalQtyresult.value=parseInt(TotalQtyresult.value)
	+parseInt(M_01.value)
	+parseInt(M_02.value)
	+parseInt(M_03.value)
	+parseInt(M_04.value)
	+parseInt(M_05.value)
	+parseInt(M_06.value)
	+parseInt(M_07.value)
	+parseInt(M_08.value)
	+parseInt(M_09.value)
	+parseInt(M_10.value)
	+parseInt(M_11.value)
	+parseInt(M_12.value);

	TotalValueresult.value=parseFloat(TotalValueresult.value)
	+((parseInt(M_01.value)+parseInt(M_02.value)+parseInt(M_03.value))*parseFloat(Q_V_01.value))
	+((parseInt(M_04.value)+parseInt(M_05.value)+parseInt(M_06.value))*parseFloat(Q_V_02.value))
	+((parseInt(M_07.value)+parseInt(M_08.value)+parseInt(M_09.value))*parseFloat(Q_V_03.value))
	+((parseInt(M_10.value)+parseInt(M_11.value)+parseInt(M_12.value))*parseFloat(Q_V_04.value));
}
</script>