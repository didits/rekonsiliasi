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
        <tdead>
            <tr>
                <td colspan="12"><i>PT PLN ( PERSERO )</i></td>
            </tr>
            <tr>
                <td colspan="12"><i>DISTRIBUSI JAWA TIMUR</i></td>
            </tr>
            <tr>
                <td colspan="12"><i>AREA {{Auth::user()->nama_organisasi}}</i></td>
            </tr>
        </tdead>
    </table>
    <table class="table table-hover table-striped">
        <tdead>
            <tr>
                <td colspan="12"><br/></td>
            </tr>
            <tr>
                <td colspan="12" class="text-center">TOTAL PEMAKAIAN KWH PCT/EXIM</td>
            </tr>
            <tr>
                <td colspan="12" class="text-center">BULAN : {{date('M Y')}}</td>
            </tr>
        </tdead>
    </table>

    <table>
        <div class="border-kotak">
            <tr class="table-header">
                <td rowspan="2" class="text-center" width="5">NO</td>
                <td rowspan="2" class="text-center" width="15">LOKASI</td>
                <td rowspan="2" class="text-center" width="10">GI</td>
                <td rowspan="2" class="text-center" width="20">PENYULANG</td>
                <td rowspan="2" class="text-center" width="20">ANTAR UNIT</td>
                <td rowspan="2" class="text-center" width="20">FAKTOR KALI</td>
                <td colspan="2" class="text-center">STAND EKSPOR</td>
                <td rowspan="2" class="text-center" width="20">TOTAL KWH<br/>EXPORT</td>
                <td colspan="2" class="text-center">STAND IMPOR</td>
                <td rowspan="2" class="text-center" width="20">TOTAL KWH<br/>IMPORT</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center" width="10">AWAL</td>
                <td class="text-center" width="10">AKHIR</td>
                <td></td>
                <td class="text-center" width="10">AWAL</td>
                <td class="text-center" width="10">AKHIR</td>
            </tr>
        
        <tbody>
            @for($i=0; $i<count($p_gardu) ;$i++)

            <tr class="text-right">
                <td class="text-center">{{$i+1}}</td>
                {{--{{dd(json_decode($gardu[$i]['data_master'],true)['meter']['FK']['faktorkali'])}}--}}
                <td class="text-left">{{$p_gardu[$i]['nama_gardu']}}</td>
                <td class="text-left">{{json_decode($p_gardu[$i]['rincian'],true)['gi']}}</td>
                <td class="text-left">{{json_decode($p_gardu[$i]['rincian'],true)['penyulang']}}</td>
                <td class="text-left">{{json_decode($p_gardu[$i]['rincian'],true)['antar_unit']}}</td>
                <td class="text-left">{{json_decode($p_gardu[$i]['data_master'],true)['meter']['FK']['faktorkali']}}</td>
                @if($p_gardu[$i]['tipe'])
                @if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']==0)
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['awal_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['akhir_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_visual']}}</td>
                @else
                <td>-</td>
                <td>-</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']}}</td>
                @endif
                @else
                @if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']==0)
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['awal_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['akhir_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_visual']}}</td>
                @else
                <td>-</td>
                <td>-</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']}}</td>
                @endif
                @endif

                @if($p_gardu[$i]['tipe'])
                @if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']==0)
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['awal_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['impor']['visual']['akhir_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_visual']}}</td>
                @else
                <td>-</td>
                <td>-</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']}}</td>
                @endif
                @else
                @if(json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']==0)
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['awal_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['beli']['ekspor']['visual']['akhir_visual']}}</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_visual']}}</td>
                @else
                <td>-</td>
                <td>-</td>
                <td>{{json_decode($p_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']}}</td>
                @endif
                @endif
            </tr>
            @endfor

        </tbody>
        {{-----------}}
        <tdead>
            <tr>
                @for($i=0; $i<8; $i++)

                <td class="text-right"><b></b></td>
                @endfor

                <td class="text-right"><b>{{$total_e}}</b></td>
                @for($i=0; $i<2; $i++)

                <td class="text-right"><b></b></td>
                @endfor

                <td class="text-right"><b>{{$total_i}}</b></td>
            </tr>
        </tdead>
    </table>
</div>
</body>
</html>