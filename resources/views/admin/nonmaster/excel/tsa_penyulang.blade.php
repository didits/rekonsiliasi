<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        td {
            border: 1px #000 solid;
        }

        .header-left {
            text-align: left;
            font-style: italic;
        }

        .header-center {
            text-align: center;
        }

        tr.table-header td{
            text-align: center;
            vertical-align: middle;
            font-weight: normal;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .border-kotak td{
            border: 1px solid #000000;
        }

        #tebal-kiri {
            border-top: 2px double #000000;
            border-left: 2px double #000000;
            border-bottom: 2px double #000000;
        }
        #tebal-atas {
            border-top: 2px double #000000;
        }
        #tebal-tengah {
            border-top: 2px double #000000;
            border-bottom: 2px double #000000;
        }
        #tebal-bawah {
            border-bottom: 2px double #000000;
        }
        #tebal-kanan {
            border-top: 2px double #000000;
            border-right: 2px double #000000;
            border-bottom: 2px double #000000;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td colspan="19"><i>PT PLN ( PERSERO )</i></td>
    </tr>
    <tr>
        <td colspan="19"><i>DISTRIBUSI JAWA TIMUR</i></td>
    </tr>
    <tr>
        @if($tipe == "rayon")
        <td colspan="19"><i>RAYON {{$area}}</i></td>
        @elseif($tipe == "area")
        <td colspan="19"><i>AREA {{Auth::user()->nama_organisasi}}</i></td>
        @endif
    </tr>
</table>

<table>
    <thead>
        <tr>
            <td colspan="19"><br/></td>
        </tr>
        <tr>
            <td colspan="19" class="text-center">KWH SALUR PER PENYULANG</td>
        </tr>
        <tr>
            <td colspan="19" class="text-center">BULAN : {{date('M Y')}}</td>
        </tr>
    </thead>
</table>

<table>
    <div class="border-kotak">
        <tr class="table-header">
            <td class="text-center" width="5">NO</td>
            <td class="text-center">GARDU INDUK (GI)</td>
            <td></td>
            <td></td>
            <td class="text-center" width="30">NAMA PENYULANG</td >
            <td class="text-center">KWH SALUR</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center" width="20">TEGANGAN UJUNG</td>
            <td class="text-center" width="30">KWH PENYULANG BULAN LALU</td>
            <td class="text-center">NAIK/TURUN</td>
            <td></td>
            <td class="text-center" width="15">KWH JUAL</td>
            <td colspan="2" class="text-center">SUSUT</td>
            <td class="text-center" width="20">RAYON</td >
        </tr>
        <tr class="table-header">
            <td></td>
            <td class="text-center">NAMA</td>
            <td class="text-center" width="15">TRAFO</td>
            <td class="text-center" width="15">DAYA<br/>(MVA)</td>
            <td></td>
            <td class="text-center" width="10">LWBP1</td>
            <td class="text-center">LWBP2</td>
            <td class="text-center" width="10">WBP</td>
            <td class="text-center" width="10">TOTAL KWH</td>
            <td class="text-center" width="10">KVARH</td>
            <td class="text-center" width="10">KW</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td rowspan="2" class="text-center" width="15">KWH SUSUT</td>
            <td rowspan="2" class="text-center" width="15">LOSSES(%)</td>
        </tr>
        <tr class="table-header">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center" width="10">KWH</td>
            <td class="text-center" width="10">%</td>
        </tr>
    @if($tipe=="rayon")

    @if($trafo)
        @for($j=0;$j<count($trafo);$j++)
        <div style="display: none;">{{$flag=true}}</div>
        @for($i=0;$i<count($data_gi);$i++)
        <tr class="text-right">
            @if($data_gi[$i]['id_trafo']==$trafo[$j]['id'])
            @if($flag==1)
            <td class="text-center">{{$j+1}}</td>
            <td class="text-left">{{$gi}}</td>
            <td class="text-center">{{$trafo[$j]['nama_trafo_gi']}}</td>
            <td class="text-center">40</td>
            <div style="display: none;">{{$flag=false}}</div>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif
            <td class="text-center">{{$data_gi[$i]['nama_p']}}</td>
            <td>{{$data_gi[$i]['lwbp1']}}</td>
            <td>{{$data_gi[$i]['lwbp2']}}</td>
            <td>{{$data_gi[$i]['wbp']}}</td>
            <td>{{$data_gi[$i]['total_kwh']}}</td>
            <td>{{$data_gi[$i]['Kvarh']}}</td>
            <td>{{$data_gi[$i]['KW']}}</td>
            <td>{{$data_gi[$i]['ujung']}}</td>
            <td>{{$data_gi[$i]['KWH_lalu']}}</td>
            <td>{{$data_gi[$i]['KWH']}}</td>
            <td>{{$data_gi[$i]['persen']}}</td>
            <td>{{$data_gi[$i]['jual']}}</td>
            <td>{{$data_gi[$i]['susut']}}</td>
            <td>{{$data_gi[$i]['losses']}}</td>
            <td class="text-left">{{$data_gi[$i]['rayon']}}</td>
            @endif
        </tr>
        @endfor
        <tr class="text-right">
            <td class="text-center"></td>
            <td colspan="4" class="text-center"><b>JUMLAH</b></td>
            <td><b>{{$data_jumlah[$j]['lwbp1']}}</b></td>
            <td><b>{{$data_jumlah[$j]['lwbp2']}}</b></td>
            <td><b>{{$data_jumlah[$j]['wbp']}}</b></td>
            <td><b>{{$data_jumlah[$j]['total_kwh']}}</b></td>
            <td><b>{{$data_jumlah[$j]['Kvarh']}}</b></td>
            <td><b>{{$data_jumlah[$j]['KW']}}</b></td>
            <td class="text-left"><b></b></td>
            <td><b>{{$data_jumlah[$j]['KWH_lalu']}}</b></td>
            <td><b>{{$data_jumlah[$j]['KWH']}}</b></td>
            <td><b>{{$data_jumlah[$j]['persen']}}</b></td>
            <td><b>{{$data_jumlah[$j]['jual']}}</b></td>
            <td><b>{{$data_jumlah[$j]['susut']}}</b></td>
            <td><b>{{$data_jumlah[$j]['losses']}}</b></td>
            <td><b></b></td>
        </tr>
        @endfor
        <tr>
            <td colspan="5" class="text-center"><b>JUMLAH</b></td>
            <td class="text-right"><b>{{$total_jumlah['lwbp1']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['lwbp2']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['wbp']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['total_kwh']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['Kvarh']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['KW']}}</b></td>
            <td class="text-center"><b></b></td>
            <td class="text-right"><b>{{$total_jumlah['KWH_lalu']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['KWH']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['persen']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['jual']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['susut']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['losses']}}</b></td>
            <td><b></b></td>
        </tr>
    @endif

    @elseif($tipe=="area")
    @if($trafo)
    <tbody>
        <div style="display: none;">{{$py=0}}</div>
        @for($gi=0;$gi<count($trafo);$gi++)
        <div style="display: none;">{{$flag=true}}</div>
        @for($tr=0;$tr<count($trafo[$gi]);$tr++)
        <div style="display: none;">{{$flag=true}}</div>
        @for($py=0;$py<count($data_gi[$gi]);$py++)
        @if($data_gi[$gi][$py]['id_trafo']==$trafo[$gi][$tr]['id'])
        <tr class="text-right">
            @if($flag==1)
            <td class="text-center">{{$gi+1}}</td>
            <td class="text-left">{{$nama_gi[$gi]['nama_gi']}}</td>
            <td class="text-center">{{$trafo[$gi][$tr]['nama_trafo_gi']}}</td>
            <td class="text-center">40</td>
            <div style="display: none;">{{$flag=false}}</div>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif
            <td class="text-center">{{$data_gi[$gi][$py]['nama_p']}}</td>
            <td>{{$data_gi[$gi][$py]['lwbp1']}}</td>
            <td>{{$data_gi[$gi][$py]['lwbp2']}}</td>
            <td>{{$data_gi[$gi][$py]['wbp']}}</td>
            <td>{{$data_gi[$gi][$py]['total_kwh']}}</td>
            <td>{{$data_gi[$gi][$py]['Kvarh']}}</td>
            <td>{{$data_gi[$gi][$py]['KW']}}</td>
            <td>{{$data_gi[$gi][$py]['ujung']}}</td>
            <td>{{$data_gi[$gi][$py]['KWH_lalu']}}</td>
            <td>{{$data_gi[$gi][$py]['KWH']}}</td>
            <td>{{$data_gi[$gi][$py]['persen']}}</td>
            <td>{{$data_gi[$gi][$py]['jual']}}</td>
            <td>{{$data_gi[$gi][$py]['susut']}}</td>
            <td>{{$data_gi[$gi][$py]['losses']}}</td>
            <td class="text-left">{{$data_gi[$gi][$py]['rayon']}}</td>
        </tr>
        @endif
        @endfor
        <tr class="text-right">
            <td class="text-center"></td>
            <td colspan="4" class="text-center"><b>JUMLAH</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['lwbp1']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['lwbp2']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['wbp']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['total_kwh']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['Kvarh']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['KW']}}</b></td>
            <td class="text-left"><b></b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['KWH_lalu']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['KWH']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['persen']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['jual']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['susut']}}</b></td>
            <td><b>{{$data_jumlah[$gi][$tr]['losses']}}</b></td>
            <td>-</td>
        </tr>
        @endfor
        @endfor
        {{--JUMLAH--}}
    </tbody>
    {{-----------}}
    <thead>
        <tr>
            <td colspan="5" class="text-center">JUMLAH</td>
            <td class="text-right"><b>{{$total_jumlah['lwbp1']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['lwbp2']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['wbp']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['total_kwh']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['Kvarh']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['KW']}}</b></td>
            <td class="text-center"><b></b></td>
            <td class="text-right"><b>{{$total_jumlah['KWH_lalu']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['KWH']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['persen']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['jual']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['susut']}}</b></td>
            <td class="text-right"><b>{{$total_jumlah['losses']}}</b></td>
            <td>-</td>
        </tr>
    </thead>
    @endif

    @endif
</div>
</table>
</body>
</html>