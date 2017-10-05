<html>
<style type="text/css">
	td{
		border: 1px #000 solid;
	}
</style>
<table>
	<?php $colspan = 10 + 2*count($dt_trafo[$tr])?>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold" >PT PLN ( PERSERO )</td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold" >DISTRIBUSI JAWA TIMUR</td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold"  >AREA {{$area}}</td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold" >PEMBACAAN kWh METER {{$gi->nama_gi}}</td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold" >{{$data_master[$tr]['nama']}} 150 / 20 KV. 30 MVA</td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold">BULAN : {{date('M Y')}}</td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold"></td>
	</tr>
	<tr>
		<td colspan="{{$colspan}}" style=" text-align: center; font-weight: bold"></td>
	</tr>

	<tr>
		<td style=" text-align: center; font-weight: bold" >CELL 20 kV INCOMING / OUT GOING</td>
		<td></td>
		<td style=" text-align: center; font-weight: bold" >kWh Utama INCOMING M - E</td>
		<td></td>
		<td style=" text-align: center; font-weight: bold" >kWh Pembanding INCOMING</td>
		<td></td>
		<td style=" text-align: center; font-weight: bold" >PEMAKAIAN SENDIRI</td>
		<td style=" text-align: center; font-weight: bold" >TOTAL PENYULANG</td>
		<td></td>
		<td colspan="{{2*count($dt_trafo[$tr])}}" rowspan="1" style=" text-align: center; font-weight: bold" >PENYULANG</td>
		<td colspan="1" rowspan="3" style=" text-align: center; font-weight: bold" >KETERANGAN</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
		<td colspan="2" style=" text-align: center; font-weight: bold">{{$dt_trafo[$tr][$j]['nama']}}</td>
		@endfor
	</tr>
	<tr>
		<td style=" text-align: center; font-weight: bold">VISUAL</td>
		<td style=" text-align: center; font-weight: bold">DOWNLOAD</td>
		<td style=" text-align: center; font-weight: bold">VISUAL</td>
		<td style=" text-align: center; font-weight: bold">AMR</td>
		<td style=" text-align: center; font-weight: bold">VISUAL</td>
		<td style=" text-align: center; font-weight: bold">AMR</td>
		@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
		<td style=" text-align: center; font-weight: bold">VISUAL</td>
		<td style=" text-align: center; font-weight: bold">AMR</td>
		@endfor
	</tr>
		<tr>
			<td>kWh METER</td>
			<td>NOMOR</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['KWH']['nomorseri']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['KWH']['nomorseri']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['KWH']['nomorseri']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['KWH']['nomorseri']}}</td>
			<td></td>
			@endfor
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>KONSTANTE</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['KWH']['konstanta']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['KWH']['konstanta']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['KWH']['konstanta']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['KWH']['konstanta']}}</td>
			<td></td>
			@endfor
			<td></td>
		</tr>
		<tr >
			<td ></td>
			<td>TEGANGAN / ARUS</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['KWH']['teganganarus']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['KWH']['teganganarus']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['KWH']['teganganarus']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		<tr class="text-center">
			<td class="text-left">TRAFO ARUS</td>
			<td class="text-left">RATED</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TA']['ratioct']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TA']['ratioct']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TA']['ratioct']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['TA']['ratioct']}}</td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		<tr class="text-center">
			<td class="text-left"></td>
			<td class="text-left">BURDEN ( VA )</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TA']['burdenct']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TA']['burdenct']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TA']['burdenct']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		<tr class="text-center">
			<td class="text-left">TRAFO TEGANGAN</td>
			<td class="text-left">RATED</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TT']['ratiopt']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TT']['ratiopt']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TT']['ratiopt']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{json_decode($dt_trafo[$tr][$j]['data_master'],true)['TT']['ratiopt']}}</td>
			<td></td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-center">
			<td class="text-left"></td>
			<td class="text-left">BURDEN ( VA )</td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['utama']['TT']['burdenpt']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['pembanding']['TT']['burdenpt']}}</td>
			<td></td>
			<td>{{json_decode($data_master[$tr]['data_master'],true)['ps']['TT']['burdenpt']}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		<tr>
			<td colspan="2">PENUNJUKAN STAND kWh METER</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		{{--LWBP 1--}}
		<tr class="text-right">
			<td class="text-left">STAND AWAL</td>
			<td class="text-left">LWBP 1</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp1_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp1_visual'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp1_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td class="text-left">STAND AKHIR</td>
			<td class="text-left">LWBP 1</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp1_visual'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp1_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'], 2)}}</td>
			<td></td>
			{{--<td>{{(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp1_download'])}}</td>--}}
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['download']['lwbp1_download'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp1_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp1_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp1_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">FAKTOR KALI METER</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'], 2)}}</td>
			<td></td>
			{{--<td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>--}}
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($penyulang); $j++)
			@if($penyulang[$j]['id_trafo']== $data_master[$tr]['id_trafo'])
			<td>{{number_format(json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali'], 2)}}</td>
			@endif
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 1 ( kWh )</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['lwbp1_visual'], 2)}}</td>
			<td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['lwbp1_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format($pemakaian[$tr]['pemakaian_lwbp1_'], 2)}}</td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['lwbp1_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['lwbp1_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		{{--LWBP 2--}}
		<tr class="text-right">
			<td class="text-left">STAND AWAL</td>
			<td class="text-left">LWBP 2</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp2_visual'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp2_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp2_visual'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp2_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td class="text-left">STAND AKHIR</td>
			<td class="text-left">LWBP 2</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp2_visual'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp2_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp2_visual'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp2_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp2_visual'], 2)}}</td>
			<td></td>
			{{--<td>{{(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp2_download'])}}</td>--}}
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp2_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['download']['lwbp2_download'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp2_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp2_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp2_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">FAKTOR KALI METER</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'], 2)}}</td>
			<td></td>
			{{--<td>{{json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali']}}</td>--}}
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_master'],true)['FK']['faktorkali'], 2)}}</td>
			<td></td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 2 ( kWh )</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['lwbp2_visual'], 2)}}</td>
			<td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp2_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['lwbp2_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format($pemakaian[$tr]['pemakaian_lwbp2_'], 2)}}</td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['lwbp2_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['lwbp2_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		{{--WBP--}}
		<tr class="text-right">
			<td class="text-left">STAND AWAL</td>
			<td class="text-left">WBP</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['wbp_visual'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['wbp_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['wbp_visual'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['wbp_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td class="text-left">STAND AKHIR</td>
			<td class="text-left">WBP</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['wbp_visual'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['wbp_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['wbp_visual'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['wbp_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['wbp_visual'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['wbp_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['wbp_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['wbp_download']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['download']['wbp_download'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['wbp_visual']-json_decode($dt_trafo[0][$j]['data'],true)['beli']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['wbp_download']-json_decode($dt_trafo[0][$j]['data'],true)['beli']['download']['wbp_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">FAKTOR KALI METER</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'], 2)}}</td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'], 2)}}</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_master'],true)['FK']['faktorkali'], 2)}}</td>
			<td></td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">PEMAKAIAN ENERGI WBP ( kWh )</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['wbp_visual'], 2)}}</td>
			<td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['wbp_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['wbp_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format($pemakaian[$tr]['pemakaian_wbp_'], 2)}}</td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['wbp_visual'], 2)}}</td>
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['wbp_download'], 2)}}</td>
			@endfor
			<td></td>
		</tr>
		{{----}}
		<tr class="text-right">
			<td colspan="2" class="text-left">TOTAL PEMAKAIAN ENERGI (LWBP+WBP)</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>{{number_format($pemakaian[$tr]['total_pemakaian_energi_'], 2)}}</td>
			<td>-</td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>-</td>
			@endfor
			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
			<td></td>
			<td class="warning">-</td>
			<td></td>
			<td></td>
			<td>13,685</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		<tr class="text-right">
			<td colspan="2" class="text-left">DAYA KONSINDEN</td>
			<td></td>
			<td class="warning">17,097</td>
			<td></td>
			<td></td>
			<td>18</td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		{{----}}
		<tr class="text-right">
			<td class="text-left">SELISIH kWh INCOMING</td>
			<td class="text-left">PEMBANDING</td>
			<td></td>
			<td></td>
			<td><i>({{number_format($data_master[$tr]['s_pembanding']*10000, 2)}})</i></td>
			<td>{{number_format($data_master[$tr]['p_pembanding']*10000, 2)}}</td>
			<td class="text-left"><i>%</i></td>
			<td class="text-left"><i>% (inc >&ltout AMR)</i></td>
			<td></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		<tr class="text-right">
			<td class="text-left">SELISIH kWh INCOMING</td>
			<td class="text-left">OUT GOING</td>
			<td></td>
			<td></td>
			<td><i>({{number_format($data_master[$tr]['s_out']*10000, 2)}})</i></td>
			<td>{{number_format($data_master[$tr]['p_out']*10000, 2)}}</td>
			<td class="text-left"><i>%</i></td>
			<td><i>100.00</i></td>
			<td class="text-left"><i>% (visual >&lt AMR)</i></td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td></td>
			<td></td>
			@endfor

			<td></td>
		</tr>
		{{----}}
		<tr class="text-right">
			{{--                                            {{dd(json_decode($data_master[$tr]['data'],true))}}--}}
			<td colspan="2" class="text-left">PEMAKAIAN ENERGI BULAN LALU</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'], 2)}}</td>
			<td>{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>{{$sum}}</td>
			<td>-</td>
			@for ($j=0; $j < count($dt_trafo[$tr]); $j++)
			<td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td>-</td>
			@endfor
			<td></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td></td>
			<td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'] -json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'], 2)}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			@for ($j=0; $j < count($penyulang); $j++)
			@if($deviasi[$j]['id_trafo']== $data_master[$tr]['id_trafo'])
			<td>{{number_format($deviasi[$j]['deviasi'], 2)}}</td>
			<td>-</td>
			@endif
			@endfor
			<td>{{number_format($sum_[$tr], 2)}}</td>
		</tr>
</table>
</html>