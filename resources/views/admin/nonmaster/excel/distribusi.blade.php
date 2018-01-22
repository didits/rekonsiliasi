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
        <tr>
            <th colspan="17" class="text-center">REKAPITULASI TRANSFER TENAGA LISTRIK (TSA TERURAI)</th>
        </tr>
        <tr>
            <th colspan="17"class="text-center">KE PT PLN (PERSERO) DISTRIBUSI JAWA TIMUR</th>
        </tr>
        <tr>
            <th colspan="17" class="text-center">BULAN : {{$date}}</th>
        </tr>
    </table>
        <div class="border-kotak">
            <tr  class="table-header">
                <td class="text-center">NO</td>
                <td class="text-center">GI</td>
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
                <td class="text-center">UTAMA VS ∑PENYULANG</td>    {{--<td rowspan="3" class="text-center">AREA</td>--}}
                <td></td>
                <td></td>
            </tr>
            <tr  class="table-header">
                <td></td>
                <td></td>
                <td class="text-center">TOTAL</td>
                <td class="text-center">WBP</td>
                <td class="text-center">LWBP1</td>
                <td class="text-center">LWBP2</td>
                <td class="text-center">KEL. KVARH (KVARH)</td>
                <td class="text-center">KAPASITAS (KW)</td>
                <td></td>
                <td class="text-center">KWH</td>
                <td class="text-center">%</td>
                <td></td>
                <td class="text-center">KWH SUSUT</td>
                <td class="text-center">LOSSES(%)</td>
                <td class="text-center">KWH</td>
                <td class="text-center">%</td>
                <td class="text-center">KETERANGAN</td>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tbody>
                @for($i=0;$i<count($data);$i++)
                    @for($j=0;$j<count($data[$i]['gi']);$j++)
                        <tr class="text-right">
                            @if($j>0)
                                <td></td>
                            @else<td class="text-center">{{$i+1}}</td>
                            @endif
                            <td class="text-center">{{$data[$i]['gi'][$j]['gi']}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['total_kwh'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['wbp'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['lwbp1'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['lwbp2'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['Kvarh'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['KW'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['KWH_lalu'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['KWH'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['persen'],2)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['jual'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['susut'],0)}}</td>
                            <td>{{number_format($data[$i]['gi'][$j]['total_jumlah']['losses'],2)}}</td>
                            <td>{{number_format($data[$i]['dev'][$j]['K'],2)}}</td>
                            <td>{{number_format($data[$i]['dev'][$j]['L'],2)}}</td>
                            @if($data[$i]['dev'][$j]['L'] > 2)
                                <td class="text-center">TIDAK NORMAL</td>
                            @elseif($data[$i]['dev'][$j]['L'] < 2)
                                <td class="text-center">NORMAL</td>
                            @endif
                        </tr>
                    @endfor
                @endfor
                <tr class="table-header">
                    <td class="text-center"  width="10" class="text-center" colspan="2" class="text-center"><b>JUMLAH</b></td>
                    <td class="text-right" ><b>{{number_format($jumlah['total_kwh'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['wbp'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['lwbp1'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['lwbp2'],0)}}</b></td>
                    <td class="text-right" width="15"><b>{{number_format($jumlah['Kvarh'],0)}}</b></td>
                    <td class="text-right" width="15"><b>{{number_format($jumlah['KW'],0)}}</b></td>
                    <td class="text-right" width="15"><b>{{number_format($jumlah['KWH_lalu'],0)}}</b></td>
                    <td class="text-right" width="15"> <b>{{number_format($jumlah['KWH'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['persen'],2)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['jual'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['susut'],0)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['losses'],2)}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['K'])}}</b></td>
                    <td class="text-right"><b>{{number_format($jumlah['L'],2)}}</b></td>
                    @if($jumlah['L'] > 2)
                        <td width="20" class="text-center">TIDAK NORMAL</td>
                    @elseif($jumlah['L'] < 2)
                        <td width="20" class="text-center">NORMAL</td>
                    @endif
                </tr>
                </tbody>

        </div>
    </table>
</body>
<tr></tr>
<tr>
    @for($i=0;$i<13;$i++)
        <td></td>
    @endfor
    <td colspan="3" style="text-align: center">SURABAYA, 4 {{date('F Y')}} </td>
</tr>
<tr>
    @for($i=0;$i<13;$i++)
        <td></td>
    @endfor
    <td colspan="3" style="text-align: center">REVAS DISTRIBUSI JATIM,</td>
</tr>

</html>