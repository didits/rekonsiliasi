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
<table style="width: 100%">
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
<table style="width: 100%">
    <tr>
        <td colspan="15"><br/></td>
    </tr>
    <tr>
        <td colspan="15" class="text-center">DEVIASI KWH INCOMING DAN OUT GOING GARDU INDUK</td>
    </tr>
    <tr>
        <td colspan="15" class="text-center">BULAN : {{date('M Y')}}</td>
    </tr>
</table>
<table style="width: 100%">
    <div class="border-kotak">
        <tr class="table-header">
            <td width="5" class="text-center">NO</td>
            <td class="text-center">GARDU INDUK</td>
            <td class="text-center">NO.<br>TRF</td>
            <td class="text-center">INCOMING<br>UTAMA</td>
            <td class="text-center" style="width: 20px">PEMAKAIAN<br>SENDIRI GI</td>
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
            <td class="text-center" style="width: 30px">9=(4-7)</td>
            <td class="text-center" style="width: 30px">10=9/4*100</td>
            <td class="text-center" style="width: 30px">11=(6-7)</td>
            <td class="text-center" style="width: 30px">12=11/6*100</td>
            <td class="text-center" style="width: 30px">13=(7-5-8)</td>
            <td class="text-center" style="width: 30px">14=13/(7-5)*100</td>
            <td class="text-center" style="width: 20px">15</td>
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
            <td>{{$data_GI[$i]['D']}}</td>
            <td>{{$data_GI[$i]['E']}}</td>
            <td>{{$data_GI[$i]['F']}}</td>
            <td>{{$data_GI[$i]['G']}}</td>
            <td>{{$data_GI[$i]['H']}}</td>
            <td>({{$data_GI[$i]['I']}})</td>
            <td>({{$data_GI[$i]['J']}})</td>
            <td>({{$data_GI[$i]['K']}})</td>
            <td>({{$data_GI[$i]['L']}})</td>
            <td>({{$data_GI[$i]['M']}})</td>
            <td>({{$data_GI[$i]['N']}})</td>
            @if($data_GI[$i]['N']> 2)
            <td class="text-center">TIDAK NORMAL</td>
            @elseif($data_GI[$i]['N']< 2)
            <td class="text-center">NORMAL</td>
            @endif
        </tr>
        @endfor
    </tbody>
        <tr>
            <td class="text-center" colspan="3" class="text-center">JUMLAH</td>
            <td class="text-center">{{$jumlah['D']}}</td>
            <td class="text-center">{{$jumlah['E']}}</td>
            <td class="text-center">{{$jumlah['F']}}</td>
            <td class="text-center">{{$jumlah['G']}}</td>
            <td class="text-center">{{$jumlah['H']}}</td>
            <td class="text-center">({{$jumlah['I']}})</td>
            <td class="text-center">({{$jumlah['J']}})</td>
            <td class="text-center">({{$jumlah['K']}})</td>
            <td class="text-center">({{$jumlah['L']}})</td>
            <td class="text-center">({{$jumlah['M']}})</td>
            <td class="text-center">({{$jumlah['N']}})</td>
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
            <td>{{$data_GI[$i][$j]['D']}}</td>
            <td>{{$data_GI[$i][$j]['E']}}</td>
            <td>{{$data_GI[$i][$j]['F']}}</td>
            <td>{{$data_GI[$i][$j]['G']}}</td>
            <td>{{$data_GI[$i][$j]['H']}}</td>
            <td>({{$data_GI[$i][$j]['I']}})</td>
            <td>({{$data_GI[$i][$j]['J']}})</td>
            <td>({{$data_GI[$i][$j]['K']}})</td>
            <td>({{$data_GI[$i][$j]['L']}})</td>
            <td>({{$data_GI[$i][$j]['M']}})</td>
            <td>({{$data_GI[$i][$j]['N']}})</td>
            @if($data_GI[$i][$j]['N']> 2)
            <td>TIDAK NORMAL</td>
            @elseif($data_GI[$i][$j]['N']< 2)
            <td>NORMAL</td>
            @endif
            {{--<td></td>--}}
        </tr>
        @endfor

        <tr>
            <td class="text-center" colspan="3" class="text-center">JUMLAH</td>
            <td class="text-center">{{$jumlah[$i]['D']}}</td>
            <td class="text-center">{{$jumlah[$i]['E']}}</td>
            <td class="text-center">{{$jumlah[$i]['F']}}</td>
            <td class="text-center">{{$jumlah[$i]['G']}}</td>
            <td class="text-center">{{$jumlah[$i]['H']}}</td>
            <td class="text-center">({{$jumlah[$i]['I']}})</td>
            <td class="text-center">({{$jumlah[$i]['J']}})</td>
            <td class="text-center">({{$jumlah[$i]['K']}})</td>
            <td class="text-center">({{$jumlah[$i]['L']}})</td>
            <td class="text-center">({{$jumlah[$i]['M']}})</td>
            <td class="text-center">({{$jumlah[$i]['N']}})</td>
            <td></td>
        </tr>
    @endfor
        <tdead>
        <tr>
            <td class="text-center" colspan="3" class="text-center"><b></b>JUMLAH</td>
            <td class="text-center"><b>{{$total['D']}}</b></td>
            <td class="text-center"><b>{{$total['E']}}</b></td>
            <td class="text-center"><b>{{$total['F']}}</b></td>
            <td class="text-center"><b>{{$total['G']}}</b></td>
            <td class="text-center"><b>{{$total['H']}}</b></td>
            <td class="text-center"><b>({{$total['I']}})</b></td>
            <td class="text-center"><b>({{$total['J']}})</b></td>
            <td class="text-center"><b>({{$total['K']}})</b></td>
            <td class="text-center"><b>({{$total['L']}})</b></td>
            <td class="text-center"><b>({{$total['M']}})</b></td>
            <td class="text-center"><b>({{$total['N']}})</b></td>
            <td></td>
            {{--<td></td>--}}
        </tr>
        </tdead>
    </tbody>
    @endif
    </div>
</table>
</body>
</html>
