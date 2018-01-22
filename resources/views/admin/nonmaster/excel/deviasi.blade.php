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
<table width= 100%">
        <tr>
            <td colspan="15" class="text-center"><i>PT PLN ( PERSERO )</i></td>
        </tr>
        <tr>
            <td colspan="15" class="text-center"><i>DISTRIBUSI JAWA TIMUR</i></td>
        </tr>
        <tr>
            @if($tipe == "area")
            <td colspan="15" class="text-center"><i>AREA {{Auth::user()->nama_organisasi}}</i></td>
            @elseif($tipe == "rayon")
            <td colspan="15" class="text-center"><i>RAYON {{$rayon}}</i></td>
            @endif
        </tr>
</table>
<table width= 100%">
    <tr>
        <td colspan="15"><br/></td>
    </tr>
    <tr>
        <td colspan="15" class="text-center">DEVIASI KWH INCOMING DAN OUT GOING GARDU INDUK</td>
    </tr>
    <tr>
        <td colspan="15" class="text-center">BULAN : {{$date}}</td>
    </tr>
</table>
<table width= 100%">
    <div class="border-kotak">
        <tr class="table-header">
            <td width="5" class="text-center">NO</td>
            <td class="text-center">GARDU INDUK</td>
            <td class="text-center">NO.<br>TRF</td>
            <td class="text-center">INCOMING<br>UTAMA</td>
            <td class="text-center">PEMAKAIAN<br>SENDIRI GI</td>
            <td class="text-center">KWH SALUR<br>KE DISTRIBUSI</td>
            <td class="text-center">INCOMING<br>PEMBANDING</td>
            <td class="text-center">TOTAL<br>PENYULANG</td>
            <td class="text-center">DEVIASI</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center">KETERANGAN</td>
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
            <td class="text-center">UTAMA VS PEMBANDING</td>
            <td></td>
            <td class="text-center">UTAMA VS ∑PENYULANG</td>
            <td></td>
            <td class="text-center">PEMBANDING VS ∑PENYULANG</td>
            <td></td>
            <td></td>
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
            <td class="text-center">KWH</td>
            <td class="text-center">%</td>
            <td class="text-center">KWH</td>
            <td class="text-center">%</td>
            <td class="text-center">KWH</td>
            <td class="text-center">%</td>
            <td></td>
        </tr>
        <tr class="table-header">
            <td class="text-center">1</td>
            <td class="text-center">2</td>
            <td class="text-center">3</td>
            <td class="text-center">4</td>
            <td class="text-center">5</td>
            <td class="text-center">6=(4-5)</td>
            <td class="text-center">7</td>
            <td class="text-center">8</td>
            <td class="text-center" width= "15">9=(4-7)</td>
            <td class="text-center" width= "15">10=9/4*100</td>
            <td class="text-center" width= "15">11=(6-7)</td>
            <td class="text-center" width= "15">12=11/6*100</td>
            <td class="text-center" width= "15">13=(7-5-8)</td>
            <td class="text-center" width= "15">14=13/(7-5)*100</td>
            <td class="text-center" width= "10">15</td>
        </tr>
    @if($area == "data")
    <tbody>
        <div style="display: none;">{{$flag=true}}</div>
        @for($i=0;$i<count($data_GI);$i++)
        <tr class="text-right">
            @if($flag)
            <td class="text-center">1</td>
            <td class="text-left">{{$data_GI[$i]['gi']}}</td>
            <div style="display: none;">{{$flag=false}}</div>
            @else
            <td class="text-center"></td>
            <td class="text-left"></td>
            @endif
            <td class="text-center">{{$data_GI[$i]['trafo']}}</td>
            <td>{{number_format($data_GI[$i]['D'],0)}}</td>
            <td>{{number_format($data_GI[$i]['E'],0)}}</td>
            <td>{{number_format($data_GI[$i]['F'],0)}}</td>
            <td>{{number_format($data_GI[$i]['G'],0)}}</td>
            <td>{{number_format($data_GI[$i]['H'],0)}}</td>
            <td>{{number_format($data_GI[$i]['I']),0}}</td>
            <td>{{number_format($data_GI[$i]['J'],2)}}</td>
            <td>{{number_format($data_GI[$i]['K'],0)}}</td>
            <td>{{number_format($data_GI[$i]['L'],2)}}</td>
            <td>{{number_format($data_GI[$i]['M'],0)}}</td>
            <td>{{number_format($data_GI[$i]['N'],2)}}</td>
            @if($data_GI[$i]['N']> 2)
            <td class="center">TIDAK NORMAL</td>
            @elseif($data_GI[$i]['N']< 2)
            <td class="center">NORMAL</td>
            @endif
        </tr>
        @endfor
    </tbody>
        <tr>
            <td class="text-center" colspan="3" class="text-center"><b>JUMLAH</b></td>
            <td class="text-right"><b>{{number_format($jumlah['D'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['E'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['F'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['G'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['H'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['I']),0}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['J'],2)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['K'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['L'],2)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['M'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($jumlah['N'],2)}}</b></td>
            @if($jumlah['N']> 2)
                <td class="center"><b>TIDAK NORMAL</b></td>
            @elseif($jumlah['N']< 2)
                <td class="center"><b>NORMAL</b></td>
            @endif
        </tr>
    @elseif($area == "area")
    <tbody>
    @for($i=0;$i<count($data_GI);$i++)
        <div style="display: none;">{{$flag=true}}</div>
        @for($j=0;$j<count($data_GI[$i]);$j++)
        <tr class="text-right">
            @if($flag)
            <td class="text-center">{{$i+1}}</td>
            <td class="text-left">{{$data_GI[$i][$j]['gi']}}</td>
            <div style="display: none;">{{$flag=false}}</div>
            @else
            <td class="text-center"></td>
            <td class="text-left"></td>
            @endif
            {{--{{dd($data_GI[$i][$j])}}--}}
            <td class="text-center">{{$data_GI[$i][$j]['trafo']}}</td>
            <td>{{number_format($data_GI[$i][$j]['D'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['E'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['F'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['G'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['H'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['I']),0}}</td>
            <td>{{number_format($data_GI[$i][$j]['J'],2)}}</td>
            <td>{{number_format($data_GI[$i][$j]['K'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['L'],2)}}</td>
            <td>{{number_format($data_GI[$i][$j]['M'],0)}}</td>
            <td>{{number_format($data_GI[$i][$j]['N'],2)}}</td>
            @if($data_GI[$i][$j]['N']> 2)
            <td class="center">TIDAK NORMAL</td>
            @elseif($data_GI[$i][$j]['N']< 2)
            <td class="center">NORMAL</td>
            @endif
            {{--<td></td>--}}
        </tr>
        @endfor

        <tr>
            <td class="text-center" colspan="3" class="text-center">JUMLAH</td>
            <td class="text-right">{{number_format($jumlah[$i]['D'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['E'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['F'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['G'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['H'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['I']),0}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['J'],2)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['K'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['L'],2)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['M'],0)}}</td>
            <td class="text-right">{{number_format($jumlah[$i]['N'],2)}}</td>
            @if($jumlah[$i]['N']> 2)
                <td class="center"><b>TIDAK NORMAL</b></td>
            @elseif($jumlah[$i]['N']< 2)
                <td class="center"><b>NORMAL</b></td>
            @endif
        </tr>
    @endfor
        <tdead>
        <tr>
            <td class="text-center" colspan="3" class="text-center"><b></b>JUMLAH</td>
            <td class="text-right"><b>{{number_format($total['D'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['E'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['F'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['G'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['H'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['I']),0}}</b></td>
            <td class="text-right"><b>{{number_format($total['J'],2)}}</b></td>
            <td class="text-right"><b>{{number_format($total['K'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['L'],2)}}</b></td>
            <td class="text-right"><b>{{number_format($total['M'],0)}}</b></td>
            <td class="text-right"><b>{{number_format($total['N'],2)}}</b></td>
            @if($total['N']> 2)
                <td class="center"><b>TIDAK NORMAL</b></td>
            @elseif($total['N']< 2)
                <td class="center"><b>NORMAL</b></td>
            @endif
            {{--<td></td>--}}
        </tr>
        </tdead>
    </tbody>
    @endif
    </div>
</table>
@if(Auth::user()->tipe_organisasi<3)
    <tr>
        @for($i=0;$i<12;$i++)
            <td></td>
        @endfor
        <td colspan="3" style="text-align: center">{{Auth::user()->nama_organisasi}}, 4 {{date('F Y')}} </td>
    </tr>
    <tr>
        @for($i=0;$i<12;$i++)
            <td></td>
        @endfor
        <td colspan="3" style="text-align: center">ASMAN TRANSAKSI ENERGI, </td>
    </tr>
@endif
</body>
</html>
