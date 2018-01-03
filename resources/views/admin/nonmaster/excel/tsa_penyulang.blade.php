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
                <td colspan="19" class="text-center">BULAN : {{$date}}</td>
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
                <td class="text-center" width="20">NAMA PENYULANG</td >
                <td class="text-center">KWH SALUR</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center" width="12">TEGANGAN UJUNG</td>
                <td class="text-center" >KWH PENYULANG BULAN LALU</td>
                <td class="text-center">NAIK/TURUN</td>
                <td></td>
                <td class="text-center" >KWH JUAL</td>
                <td colspan="2" class="text-center">SUSUT</td>
                <td class="text-center" width="20">RAYON</td >
            </tr>
            <tr class="table-header">
                <td></td>
                <td class="text-center">NAMA</td>
                <td class="text-center" >TRAFO</td>
                <td class="text-center" width="10">DAYA<br/>(MVA)</td>
                <td></td>
                <td class="text-center">LWBP1</td>
                <td class="text-center">LWBP2</td>
                <td class="text-center" >WBP</td>
                <td class="text-center" >TOTAL KWH</td>
                <td class="text-center" width="10">KVARH</td>
                <td class="text-center" >KW</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td rowspan="2" class="text-center" >KWH SUSUT</td>
                <td rowspan="2" class="text-center" >LOSSES(%)</td>
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
                <td class="text-center" >KWH</td>
                <td class="text-center" >%</td>
            </tr>
            @if($tipe=="rayon")

            @if($data_gi)
            <tbody>
                @for($j=0;$j<count($data_gi);$j++)
                @for($k=0;$k<count($data_gi[$j]['trafo']);$k++)
                <div style="display: none;">{{$flag=true}}</div>
                @for($i=0;$i<count($data_gi[$j]['data_gi']);$i++)
               
                    @if($data_gi[$j]['data_gi'][$i]['id_trafo']==$data_gi[$j]['trafo'][$k]['id'])
                     <tr class="text-right">
                    @if($flag==1)
                    <td class="text-center">{{$j+1}}</td>
                    <td class="text-left">{{$data_gi[$j]['gi']}}</td>
                    <td class="text-center">{{$data_gi[$j]['trafo'][$k]['nama_trafo_gi']}}</td>
                    <td class="text-center">40</td>
                    <div style="display: none;">{{$flag=false}}</div>
                    @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @endif
                    <td class="text-center">{{$data_gi[$j]['data_gi'][$i]['nama_p']}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['lwbp1'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['lwbp2'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['wbp'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['total_kwh'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['Kvarh'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['KW'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['ujung'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['KWH_lalu'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['KWH'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['persen'],2)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['jual'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['susut'],0)}}</td>
                    <td>{{number_format($data_gi[$j]['data_gi'][$i]['losses'],2)}}</td>
                    <td class="text-left">{{$data_gi[$j]['data_gi'][$i]['rayon']}}</td>
                    </tr>
                    @endif
                
                @endfor
                @endfor
            </tbody>
                <tr>
                    <td colspan="5" class="text-center"><b>JUMLAH</b></td>
                    {{--{{dd($data_gi[$j]['total_jumlah'])}}--}}
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['lwbp1'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['lwbp2'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['wbp'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['total_kwh'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['Kvarh'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['KW'],0)}}</b></td>
                    <td class="text-center"><b></b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['KWH_lalu'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['KWH'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['persen'],2)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['jual'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['susut'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($data_gi[$j]['total_jumlah']['losses'],2)}}</b></td>
                    <td><b></b></td>
                </tr>
            @endfor
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
                        <td>{{number_format($data_gi[$gi][$py]['lwbp1'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['lwbp2'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['wbp'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['total_kwh'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['Kvarh'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['KW'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['ujung'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['KWH_lalu'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['KWH'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['persen'],2)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['jual'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['susut'],0)}}</td>
                        <td>{{number_format($data_gi[$gi][$py]['losses'],2)}}</td>
                        <td class="text-left">{{$data_gi[$gi][$py]['rayon']}}</td>
                </tr>
                @endif
                @endfor
                <tr class="text-right">
                    <td class="text-center"></td>
                    <td colspan="4" class="text-center"><b>JUMLAH</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['lwbp1'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['lwbp2'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['wbp'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['total_kwh'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['Kvarh'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['KW'],0)}}</b></td>
                    <td class="text-left"><b></b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['KWH_lalu'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['KWH'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['persen'],2)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['jual'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['susut'],0)}}</b></td>
                    <td><b>{{number_format($data_jumlah[$gi][$tr]['losses'],2)}}</b></td>
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
                    <th class="text-right"><b>{{number_format($total_jumlah['lwbp1'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['lwbp2'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['wbp'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['total_kwh'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['Kvarh'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['KW'],0)}}</b></th>
                    <th class="text-center"><b></b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['KWH_lalu'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['KWH'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['persen'],2)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['jual'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['susut'],0)}}</b></th>
                    <th class="text-right"><b>{{number_format($total_jumlah['losses'],2)}}</b></th>
                    <td>-</td>
                </tr>
            </thead>
            @endif

            @endif
        </div>
    </table>
</body>
</html>