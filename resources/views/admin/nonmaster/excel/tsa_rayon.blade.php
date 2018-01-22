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
            <td><i>AREA {{Auth::user()->nama_organisasi}}</i></td>
        </tr>
    </table>

    <table>
        <tdead>
            <tr>
                <td colspan="19"><br/></td>
            </tr>
            <tr>
                <td colspan="19" class="text-center">KWH SALUR PER RAYON</td>
            </tr>
            <tr>
                <td colspan="19" class="text-center">BULAN : {{$date}}</td>
            </tr>
        </tdead>
    </table>
    <table>
        <div class="border-kotak">
            <tr class="table-header">
                <td class="text-center">NO</td>
                <td class="text-center">SUB UNIT</td>
                <td class="text-center" width="5">NO.TRF</td >
                <td class="text-center">KWH SALUR</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">TSA BULAN LALU</td>
                <td class="text-center">NAIK/TURUN</td>
                <td></td>
                <td class="text-center">KWH JUAL</td>
                <td class="text-center">SUSUT</td>
                <td></td>
            </tr>
            <tr class="table-header">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">TOTAL</td>
                <td class="text-center">WBP</td>
                <td class="text-center">LWBP1</td>
                <td class="text-center">LWBP2</td>
                <td class="text-center">KEL. KVARH<br/>(KVARH)</td>
                <td class="text-center">KAPASITAS<br/>(KW)</td>
                <td></td>
                <td class="text-center">KWH</td>
                <td class="text-center">%</td>
                <td></td>
                <td class="text-center">KWH SUSUT</td>
                <td class="text-center">LOSSES(%)</td>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">2</td>
                <td class="text-center">3</td>
                <td class="text-center">4=5+6+7</td>
                <td class="text-center">5</td>
                <td class="text-center">6</td>
                <td class="text-center">7</td>
                <td class="text-center">13</td>
                <td class="text-center">14</td>
                <td class="text-center">16</td>
                <td class="text-center">17=9-16</td>
                <td class="text-center">18=17/16*100</td>
                <td class="text-center">19</td>
                <td class="text-center">20</td>
                <td class="text-center">21</td>
            </tr>
        <tbody>
            @for($i=0;$i<count($rayon);$i++)
            <tr class="text-right">
                <td class="text-center">{{$i+1}}</td>
                <td class="text-left">{{$rayon[$i]['nama_rayon']}}</td>
                <td class="text-center">I</td>
                <td>{{number_format($rayon[$i]['total_kwh'])}}</td>
                <td>{{number_format($rayon[$i]['wbp'])}}</td>
                <td>{{number_format($rayon[$i]['lwbp1'])}}</td>
                <td>{{number_format($rayon[$i]['lwbp2'])}}</td>
                <td>{{number_format($rayon[$i]['Kvarh'])}}</td>
                <td>{{number_format($rayon[$i]['KW'])}}</td>
                <td>{{number_format($rayon[$i]['KWH_lalu'])}}</td>
                <td>{{number_format($rayon[$i]['KWH'])}}</td>
                <td>{{number_format($rayon[$i]['persen'])}}</td>
                <td>{{number_format($rayon[$i]['jual'])}}</td>
                <td>{{number_format($rayon[$i]['susut'])}}</td>
                <td>{{number_format($rayon[$i]['losses'])}}</td>
            </tr>
            @endfor

        </tbody>
        {{--JUMLAH--}}
            <tr>
                <td colspan="3" class="text-center"><b>JUMLAH</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['total_kwh'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['wbp'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['lwbp1'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['lwbp2'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['Kvarh'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['KW'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['KWH_lalu'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['KWH'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['persen'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['jual'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['susut'])}}</b></td>
                <td class="text-right"><b>{{number_format($total_jumlah['losses'])}}</b></td>
            </tr>
        </div>
    </table>
    <tr>
        @for($i=0;$i<13;$i++)
            <td></td>
        @endfor
        <td colspan="3" style="text-align: center">{{Auth::user()->nama_organisasi}}, 4 {{date('F Y')}} </td>
    </tr>
    <tr>
        @for($i=0;$i<13;$i++)
            <td></td>
        @endfor
        <td colspan="3" style="text-align: center">ASMAN TRANSAKSI ENERGI, </td>
    </tr>
</body>
</html>