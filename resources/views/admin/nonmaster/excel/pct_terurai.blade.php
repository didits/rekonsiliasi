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
    
    {{--Laporan PCT Terurai--}}
    <table>
            <tr>
                <td colspan="15"><i>PT PLN ( PERSERO )</i></td>
            </tr>
            <tr>
                <td colspan="15"><i>DISTRIBUSI JAWA TIMUR</i></td>
            </tr>
            <tr>
                <td colspan="15"><i>AREA {{Auth::user()->nama_organisasi}}</i></td>
            </tr>
    </table>
    <table class="table table-hover table-striped">
    
            <tr>
                <td colspan="15" class="text-center">TOTAL PEMAKAIAN KWH PCT/EXIM</td>
            </tr>
            <tr>
                <td colspan="15" class="text-center">TERURAI</td>
            </tr>
            <tr>
                <td colspan="15" class="text-center">BULAN : {{$date}}</td>
            </tr>

    </table>
    
    <table>
        <div class="border-kotak">
            <tr class="table-header">
                <td rowspan="2" class="text-center">NO</td>
                <td rowspan="2" class="text-center">LOKASI</td>
                <td rowspan="2" class="text-center">GI</td>
                <td rowspan="2" class="text-center" width="20">PENYULANG</td>
                <td rowspan="2" class="text-center" width="20">ANTAR UNIT</td>
                <td colspan="5" class="text-center">EKSPOR</td>
                <td colspan="5" class="text-center">IMPOR</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @for($i=0; $i<2; $i++)

                <td class="text-center" width="10">WBP</td>
                <td class="text-center" width="10">LWBP1</td>
                <td class="text-center" width="10">LWBP2</td>
                <td class="text-center" width="10">KVARH</td>
                <td class="text-center" width="10">KW</td>
                @endfor

            </tr>
            @for($i=0; $i<count($dt_urai) ;$i++)

            <tr class="text-right">
                <td class="text-center">{{$i+1}}</td>
                <td class="text-left">{{$dt_urai[$i]['pct']}}</td>
                <td class="text-left">{{json_decode($dt_urai[$i]['rincian'],true)['gi']}}</td>
                <td class="text-left">{{json_decode($dt_urai[$i]['rincian'],true)['penyulang']}}</td>
                <td class="text-left">{{json_decode($dt_urai[$i]['rincian'],true)['antar_unit']}}</td>
                {{--EKSPOR--}}
                <td>{{$dt_urai[$i]['wbp_e']}}</td>
                <td>{{$dt_urai[$i]['lwbp1_e']}}</td>
                <td>{{$dt_urai[$i]['lwbp2_e']}}</td>
                <td>{{$dt_urai[$i]['kvar_e']}}</td>
                <td>{{$dt_urai[$i]['kw_e']}}</td>
                {{--IMPOR--}}
                <td>{{$dt_urai[$i]['wbp_i']}}</td>
                <td>{{$dt_urai[$i]['lwbp1_i']}}</td>
                <td>{{$dt_urai[$i]['lwbp2_i']}}</td>
                <td>{{$dt_urai[$i]['kvar_i']}}</td>
                <td>{{$dt_urai[$i]['kw_i']}}</td>
            </tr>
            @endfor

    </div>
    </table>
    
</body>
</html>