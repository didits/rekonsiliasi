<html>
<head>
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
    {{$colspan = 10 + 2 * count($dt_trafo[$tr])}}
    <tr>
        <td class="header-left">PT PLN ( PERSERO )</td>
    </tr>
    <tr>
        <td class="header-left">DISTRIBUSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td class="header-left">AREA {{$area}}</td>
    </tr>
    <tr>
        <td colspan="{{$colspan}}" class="header-center">PEMBACAAN kWh METER GARDU INDUK {{$gi->nama_gi}}</td>
    </tr>
    <tr>
        <td colspan="{{$colspan}}" class="header-center">{{$data_master[$tr]['nama']}} {{(json_decode($data_master[$tr]["data_master"],true)['kapasitas']['tegangan'])}} KV. {{(json_decode($data_master[$tr]["data_master"],true)['kapasitas']['kapasitas'])}} MVA</td>
    </tr>
    <tr>
        <td colspan="{{$colspan}}" class="header-center">BULAN : {{$date}}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <div class="border-kotak">
        <tr class="table-header">
            <td colspan="2" id="tebal-kiri">CELL 20 kV INCOMING / OUT GOING</td>
            <td colspan="2" id="tebal-atas">kWh Utama INCOMING               M - E</td>
            <td colspan="2" id="tebal-atas">kWh Pembanding                   INCOMING</td>
            <td rowspan="3" id="tebal-tengah">PEMAKAIAN                      SENDIRI</td>
            <td colspan="2" id="tebal-atas">TOTAL PENYULANG</td>
            <td colspan="{{2*count($dt_trafo[$tr])}}" id="tebal-atas">PENYULANG</td>
            <td width="15" rowspan="3" id="tebal-kanan">KETERANGAN</td>
        </tr>
        <tr class="table-header">
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="2"></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)

            <td colspan="2">{{$dt_trafo[$tr][$j]['nama']}}</td>
            @endfor

        </tr>
        <tr class="table-header">
            <td colspan="2"></td>
            <td width="15"  id="tebal-bawah">VISUAL</td>
            <td width="15"  id="tebal-bawah">DOWNLOAD</td>
            <td width="15"  id="tebal-bawah">VISUAL</td>
            <td width="15"  id="tebal-bawah">AMR</td>
            <td width="15"  id="tebal-bawah"></td>
            <td width="15"  id="tebal-bawah">VISUAL</td>
            <td width="15"  id="tebal-bawah">AMR</td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
            <td width="15"  id="tebal-bawah">VISUAL</td>
            <td width="15"  id="tebal-bawah">AMR</td>
            @endfor
        </tr>
        <tr class="text-center">
            <td class="text-left">kWh METER</td>
            <td class="text-left">NOMOR</td>
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
        <tr class="text-center">
            <td class="text-left"></td>
            <td class="text-left">KONSTANTE</td>
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
        <tr class="text-center">
            <td class="text-left"></td>
            <td class="text-left">TEGANGAN / ARUS</td>
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
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp1_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp1_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp1_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp1_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td class="text-left">STAND AKHIR</td>
            <td class="text-left">LWBP 1</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp1_visual'],2)}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp1_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp1_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp1_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp1_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp1_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp1_visual'],2)}}</td>
            <td></td>
            {{--<td>{{(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp1_download'])}}</td>--}}
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp1_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp1_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp1_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp1_visual']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp1_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp1_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp1_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp1_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp1_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'])}}</td>
            <td></td>
            {{--<td>{{number_format(json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali'])}}</td>--}}
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'])}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($penyulang); $j++)
                @if($penyulang[$j]['id_trafo']== $data_master[$tr]['id_trafo'])
                    <td>{{number_format(json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali'])}}</td>
                    <td>{{number_format(json_decode($data->penyulang[$j]->data_master,true)['FK']['faktorkali'])}}</td>
                @endif
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 1 ( kWh )</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['lwbp1_visual'])}}</td>
            <td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp1_download'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['lwbp1_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['lwbp1_download'])}}</td>
            @if($visual == 1)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual'])}}</td>
            @elseif($visual == 0)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['lwbp1_download'])}}</td>
            @endif
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['lwbp1_visual'])}}</td>
            <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['lwbp1_download'])}}</td>
            @endfor
            <td></td>
        </tr>
        {{--LWBP 2--}}
        <tr class="text-right">
            <td class="text-left">STAND AWAL</td>
            <td class="text-left">LWBP 2</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp2_visual'],2)}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp2_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp2_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp2_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp2_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp2_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td class="text-left">STAND AKHIR</td>
            <td class="text-left">LWBP 2</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp2_visual'],2)}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp2_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp2_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp2_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp2_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp2_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['lwbp2_visual'],2)}}</td>
            <td></td>
            {{--<td>{{(number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['download']['lwbp2_download'])}}</td>--}}
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['lwbp2_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['lwbp2_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['lwbp2_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['lwbp2_visual']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['lwbp2_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['lwbp2_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['lwbp2_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['lwbp2_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['lwbp2_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'])}}</td>
            <td></td>
            {{--<td>{{number_format(json_decode($data->trafo[0]->data_master,true)['utama']['FK']['faktorkali'])}}</td>--}}
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'])}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_master'],true)['FK']['faktorkali'])}}</td>
                <td></td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 2 ( kWh )</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['lwbp2_visual'])}}</td>
            <td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['lwbp2_download'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['lwbp2_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['lwbp2_download'])}}</td>
            @if($visual == 1)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual'])}}</td>
            @elseif($visual == 0)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['lwbp2_download'])}}</td>
            @endif
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['lwbp2_visual'])}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['lwbp2_download'])}}</td>
            @endfor
            <td></td>
        </tr>
        {{--WBP--}}
        <tr class="text-right">
            <td class="text-left">STAND AWAL</td>
            <td class="text-left">WBP</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['wbp_visual'],2)}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['wbp_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['wbp_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['wbp_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['wbp_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['wbp_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td class="text-left">STAND AKHIR</td>
            <td class="text-left">WBP</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['wbp_visual'],2)}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['wbp_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['wbp_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['wbp_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['wbp_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['wbp_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['utama']['visual']['wbp_visual'],2)}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['visual']['wbp_visual'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['wbp_download']-json_decode($data_master[$tr]['data'],true)['beli']['pembanding']['download']['wbp_download'],2)}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['wbp_visual']-json_decode($data_master[$tr]['data'],true)['beli']['ps']['visual']['wbp_visual'],2)}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['visual']['wbp_visual']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['visual']['wbp_visual'],2)}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['beli']['download']['wbp_download']-json_decode($dt_trafo[$tr][$j]['data'],true)['beli']['download']['wbp_download'],2)}}</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['utama']['FK']['faktorkali'])}}</td>
            <td></td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['pembanding']['FK']['faktorkali'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_master'],true)['ps']['FK']['faktorkali'])}}</td>
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_master'],true)['FK']['faktorkali'])}}</td>
                <td></td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">PEMAKAIAN ENERGI WBP ( kWh )</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['wbp_visual'])}}</td>
            <td class="danger">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['wbp_download'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['wbp_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['wbp_download'])}}</td>
            @if($visual == 1)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['wbp_visual'])}}</td>
            @elseif($visual == 0)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['wbp_download'])}}</td>
            @endif
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['wbp_visual'])}}</td>
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['download']['wbp_download'])}}</td>
            @endfor
            <td></td>
        </tr>
        {{----}}
        <tr class="text-right">
            <td colspan="2" class="text-left">TOTAL PEMAKAIAN ENERGI (LWBP+WBP)</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])}}</td>
            @if($visual == 1)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'], 0)}}</td>
            @elseif($visual == 0)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download'], 0)}}</td>
            @endif
            <td>{{number_format($pemakaian[$tr]['total_pemakaian_energi_'])}}</td>
            <td>-</td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td>{{number_format(json_decode($dt_trafo[$tr][$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])}}</td>
                <td>-</td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['kvarh_visual'])}}</td>
            <td class="warning">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['kvarh_download'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['kvarh_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['kvarh_download'])}}</td>
            @if($visual == 1)
                <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['kvarh_visual'])}}</td>
            @elseif($visual == 0)
                <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['kvarh_download'])}}</td>
            @endif
            <td></td>
            <td></td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
            <td></td>
            <td></td>
            @endfor
            <td></td>
        </tr>
        <tr class="text-right">
            <td colspan="2" class="text-left">DAYA KONSIDEN</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['visual']['konsiden_visual'])}}</td>
            <td class="warning">{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['utama']['download']['konsiden_download'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['visual']['konsiden_visual'])}}</td>
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['pembanding']['download']['konsiden_download'])}}</td>
            @if($visual == 1)
                <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['visual']['konsiden_visual'])}}</td>
            @elseif($visual == 0)
                <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['beli']['ps']['download']['konsiden_download'])}}</td>
            @endif
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
            <td class="text-left" id="tebal-atas">SELISIH kWh INCOMING</td>
            <td class="text-left" id="tebal-atas">PEMBANDING</td>
            <td id="tebal-atas"></td>
            <td id="tebal-atas"></td>
            <td id="tebal-atas"><i>{{number_format($data_master[$tr]['s_pembanding'],2)}}</i></td>
            <td id="tebal-atas">{{number_format($data_master[$tr]['p_pembanding'],2)}}</td>
            <td class="text-left" id="tebal-atas"><i>%</i></td>
            <td id="tebal-atas">{{number_format($data_master[$tr]['s_ps'],2)}}</td>
            <td colspan="{{$colspan-9}}" class="text-left" id="tebal-atas">% (inc >&ltout AMR)</td>

            <td id="tebal-atas"></td>
        </tr>
        <tr class="text-right">
            <td class="text-left">SELISIH kWh INCOMING</td>
            <td class="text-left">OUT GOING</td>
            <td></td>
            <td></td>
            <td><i>{{number_format($data_master[$tr]['s_out'],2)}}</i></td>
            <td>{{number_format($data_master[$tr]['p_out'],2)}}</td>
            <td colspan="{{$colspan-7}}" class="text-left">% (visual >&lt AMR)</td>

            <td></td>
        </tr>
        {{----}}
        <tr class="text-right">
            {{--{{dd(json_decode($data_master[$tr]['data'],true))}}--}}
            <td colspan="2" class="text-left" id="tebal-atas">PEMAKAIAN ENERGI BULAN LALU</td>
            <td id="tebal-atas">{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual'])}}</td>
            <td id="tebal-atas">{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'])}}</td>
            <td id="tebal-atas">{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])}}</td>
            <td id="tebal-atas">{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])}}</td>
            @if($visual == 1)
                <td id="tebal-atas">{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])}}</td>
            @elseif($visual == 0)
                <td id="tebal-atas">{{number_format(json_decode($data_master[$tr]['data'],true)['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download'])}}</td>
            @endif
            <td id="tebal-atas">{{number_format($sum[$tr])}}</td>
            <td id="tebal-atas">-</td>
            @for ($j=0; $j < count($dt_trafo[$tr]); $j++)
                <td id="tebal-atas">{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])}}</td>
                <td id="tebal-atas">{{number_format(json_decode($dt_trafo[$tr][$j]['data'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download'])}}</td>
            @endfor
            <td id="tebal-atas"></td>
        </tr>
    </div>
    <tr>
        <td colspan="2"></td>
        <td></td>
        @if($visual == 1)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'] -json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])}}</td>
        @elseif($visual == 0)
            <td>{{number_format(json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'] -json_decode($data_master[$tr]['data_'],true)['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download'])}}</td>
        @endif
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        @for ($j=0; $j < count($penyulang); $j++)
            @if($deviasi[$j]['id_trafo']== $data_master[$tr]['id_trafo'])
                <td>{{number_format($deviasi[$j]['deviasi'])}}</td>
                <td>-</td>
            @endif
        @endfor
        <td>{{number_format($sum_[$tr])}}</td>
    </tr>
</table>
</body>
</html>