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
    
    {{--Laporan PCT Terurai Pemakaian Rayon--}}
    <table class="table table-hover table-striped">
        <tdead>
            <tr>
                <td colspan="11"><i>PT PLN ( PERSERO )</i></td>
            </tr>
            <tr>
                <td colspan="11"><i>DISTRIBUSI JAWA TIMUR</i></td>
            </tr>
            <tr>
                <td colspan="11"><i>AREA {{Auth::user()->nama_organisasi}}</i></td>
            </tr>
        </tdead>
    </table>
     
    <table class="table table-hover table-striped">
        <tdead>
            <tr>
                <td colspan="11" class="text-center">TOTAL PEMAKAIAN KWH PCT/EXIM</td>
            </tr>
            <tr>
                <td colspan="11" class="text-center">PEMAKAIAN RAYON</td>
            </tr>
            <tr>
                <td colspan="11" class="text-center">BULAN : {{date('M Y')}}</td>
            </tr>
        </tdead>
    </table>
    
    <table class="table table-hover table-bordered" style="white-space: nowrap; overflow-x: auto;">
        <div class="border-kotak">
            <tr class="table-header">
                <td rowspan="2" class="text-center">RAYON</td>
                <td colspan="5" class="text-center">EKSPOR</td>
                <td colspan="5" class="text-center">IMPOR</td>
            </tr>
            <tr>
                <td></td>
                @for($i=0; $i<2; $i++)

                <td class="text-center" width="10">WBP</td>
                <td class="text-center" width="10">LWBP1</td>
                <td class="text-center" width="10">LWBP2</td>
                <td class="text-center" width="10">KVARH</td>
                <td class="text-center" width="10">KW</td>
                @endfor

            </tr>
        <tbody>
            @for($i=0; $i<count($dt_rayon) ;$i++)

            <tr class="text-right">
                <td class="text-left">{{$dt_rayon[$i]['nama_rayon']}}</td>
                {{--EKSPOR--}}
                <td>{{$dt_rayon[$i]['wbp_e']}}</td>
                <td>{{$dt_rayon[$i]['lwbp1_e']}}</td>
                <td>{{$dt_rayon[$i]['lwbp2_e']}}</td>
                <td>{{$dt_rayon[$i]['kvar_e']}}</td>
                <td>{{$dt_rayon[$i]['kw_e']}}</td>
                {{--IMPOR--}}
                <td>{{$dt_rayon[$i]['wbp_i']}}</td>
                <td>{{$dt_rayon[$i]['lwbp1_i']}}</td>
                <td>{{$dt_rayon[$i]['lwbp2_i']}}</td>
                <td>{{$dt_rayon[$i]['kvar_i']}}</td>
                <td>{{$dt_rayon[$i]['kw_i']}}</td>
            </tr>
            @endfor

        </tbody>
        {{-----------}}
        <tdead>
            <tr></tr>
        </tdead>
        </div>
    </table>
</body>
</html>