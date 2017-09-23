@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
@include('admin.master.navbar')

    <div class="main-panel">
    @include('admin.master.top_navbar', ['navbartitle' => "LAPORAN "])

        <div class="content"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th><i>PT PLN ( PERSERO )</i></th>
                                        </tr>
                                        <tr>
                                            <th><i>DISTRIBUSI JAWA TIMUR</i></th>
                                        </tr>
                                        <tr>
                                            <th><i>AREA PASURUAN</i></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <div class="card">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">PEMBACAAN kWh METER GARDU INDUK PANDAAN</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">TRAFO I 150 / 20 KV. 30 MVA</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">BULAN : JULI 2017</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card" style="white-space: nowrap; overflow-x: auto;">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-bordered" style="white-space: nowrap; overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" colspan="2" class="text-center">CELL 20 kV INCOMING / OUT GOING</th>
                                            <th rowspan="2" colspan="2" class="text-center">kWh Utama INCOMING<br>M - E</th>
                                            <th rowspan="2" colspan="2" class="text-center">kWh Pembanding INCOMING</th>
                                            <th rowspan="3" class="text-center">PEMAKAIAN<br>SENDIRI</th>
                                            <th rowspan="2" colspan="2" class="text-center">TOTAL PENYULANG</th>
                                            <th colspan="8" class="text-center">PENYULANG</th>
                                            <th rowspan="3" class="text-center">KETERANGAN</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center">TRISTATE</th>
                                            <th colspan="2" class="text-center">TAWANGREJO</th>
                                            <th colspan="2" class="text-center">RANDU PITU</th>
                                            <th colspan="2" class="text-center">KUNCORO WESI</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">DOWNLOAD</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                            <th class="text-center">VISUAL</th>
                                            <th class="text-center">AMR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td class="text-left">kWh METER</td>
                                            <td class="text-left">NOMOR</td>
                                            <td></td>
                                            <td></td>
                                            <td>95B 824485</td>
                                            <td></td>
                                            <td>92B 749226</td>
                                            <td></td>
                                            <td></td>
                                            <td>92B 749219</td>
                                            <td></td>
                                            <td>92B 749220</td>
                                            <td></td>
                                            <td>92B 749221</td>
                                            <td></td>
                                            <td>92B 749222</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">KONSTANTE</td>
                                            <td></td>
                                            <td></td>
                                            <td>5555 rev / kWh</td>
                                            <td></td>
                                            <td>25 / 5000</td>
                                            <td></td>
                                            <td></td>
                                            <td>25 / 5000</td>
                                            <td></td>
                                            <td>25 / 5000</td>
                                            <td></td>
                                            <td>25 / 5000</td>
                                            <td></td>
                                            <td>25 / 5000</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">TEGANGAN / ARUS</td>
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
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left">TRAFO ARUS</td>
                                            <td class="text-left">RATED</td>
                                            <td></td>
                                            <td></td>
                                            <td>1250 / 1 A</td>
                                            <td></td>
                                            <td>200 / 1 A</td>
                                            <td></td>
                                            <td></td>
                                            <td>200 / 1 A</td>
                                            <td></td>
                                            <td>200 / 1 A</td>
                                            <td></td>
                                            <td>200 / 1 A</td>
                                            <td></td>
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">BURDEN ( VA )</td>
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
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left">TRAFO TEGANGAN</td>
                                            <td class="text-left">RATED</td>
                                            <td></td>
                                            <td></td>
                                            <td>22000/110 V</td>
                                            <td></td>
                                            <td>22000/100V</td>
                                            <td></td>
                                            <td></td>
                                            <td>22000/100V</td>
                                            <td></td>
                                            <td>22000/100V</td>
                                            <td></td>
                                            <td>22000/100V</td>
                                            <td></td>
                                            <td>22000/100V</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-left"></td>
                                            <td class="text-left">BURDEN ( VA )</td>
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
                                            <td></td>
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
                                        {{--LWBP 1--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">LWBP 1</td>
                                            <td>8,552.45</td>
                                            <td></td>
                                            <td>340,700.40</td>
                                            <td>112,719.32</td>
                                            <td>64,717</td>
                                            <td></td>
                                            <td></td>
                                            <td>62,854.80</td>
                                            <td>24,363.82</td>
                                            <td>80,352.20</td>
                                            <td>59,765.03</td>
                                            <td>126,263.93</td>
                                            <td>56,641.04</td>
                                            <td>148,132.33</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">LWBP 1</td>
                                            <td>11,942.97</td>
                                            <td></td>
                                            <td>344,095.95</td>
                                            <td>112,719.32</td>
                                            <td>64,717</td>
                                            <td></td>
                                            <td></td>
                                            <td>63,769.36</td>
                                            <td>24,363.82</td>
                                            <td>80,619.31</td>
                                            <td>59,765.03</td>
                                            <td>127,101.93</td>
                                            <td>56,641.04</td>
                                            <td>149,526.38</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>3,390.53</td>
                                            <td></td>
                                            <td>3,395.55</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td></td>
                                            <td></td>
                                            <td>914.56</td>
                                            <td>-</td>
                                            <td>267.11</td>
                                            <td>-</td>
                                            <td>838.00</td>
                                            <td>-</td>
                                            <td>1,394.05</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>1,000</td>
                                            <td></td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 1 ( kWh )</td>
                                            <td>3,390,528</td>
                                            <td class="danger">3,390,528</td>
                                            <td>3,395,550.00</td>
                                            <td>-</td>
                                            <td>4,332</td>
                                            <td>3,413,720</td>
                                            <td></td>
                                            <td>914,560</td>
                                            <td>-</td>
                                            <td>267,110</td>
                                            <td>-</td>
                                            <td>838,000</td>
                                            <td>-</td>
                                            <td>1,394,050</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        {{--LWBP 2--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">LWBP 2</td>
                                            <td>14,027.49</td>
                                            <td></td>
                                            <td>551,700.45</td>
                                            <td>180,414.06</td>
                                            <td>108,345</td>
                                            <td></td>
                                            <td></td>
                                            <td>96,859.10</td>
                                            <td>35,858.24</td>
                                            <td>146717.3</td>
                                            <td>98,947.99</td>
                                            <td>204,116.80</td>
                                            <td>95,197.84</td>
                                            <td>230,976.28</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">LWBP 2</td>
                                            <td>19,680.70</td>
                                            <td></td>
                                            <td>557,361.76</td>
                                            <td>180,414.06</td>
                                            <td>108,345</td>
                                            <td></td>
                                            <td></td>
                                            <td>98,307.69</td>
                                            <td>35,858.24</td>
                                            <td>147512.74</td>
                                            <td>98,947.99</td>
                                            <td>205,433.64</td>
                                            <td>95,197.84</td>
                                            <td>233,097.73</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>5,653.20</td>
                                            <td></td>
                                            <td>5,661</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td></td>
                                            <td></td>
                                            <td>1,448.59</td>
                                            <td>-</td>
                                            <td>795.44</td>
                                            <td>-</td>
                                            <td>1,316.84</td>
                                            <td>-</td>
                                            <td>2,121.45</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>1,000</td>
                                            <td></td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI LWBP 2 ( kWh )</td>
                                            <td>5,653,204</td>
                                            <td class="danger">5,653,847</td>
                                            <td>5,661,310</td>
                                            <td>-</td>
                                            <td>7,025</td>
                                            <td>5,682,320</td>
                                            <td></td>
                                            <td>1,448,590</td>
                                            <td>-</td>
                                            <td>795,440</td>
                                            <td>-</td>
                                            <td>1,316,840</td>
                                            <td>-</td>
                                            <td>2,121,450</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        {{--WBP--}}
                                        <tr class="text-right">
                                            <td class="text-left">STAND AWAL</td>
                                            <td class="text-left">WBP</td>
                                            <td>4,498.89</td>
                                            <td></td>
                                            <td>178,887.66</td>
                                            <td>58,623.91</td>
                                            <td>41,674</td>
                                            <td></td>
                                            <td></td>
                                            <td>31,097.28</td>
                                            <td>11,157.49</td>
                                            <td>48,020.49</td>
                                            <td>34,105.52</td>
                                            <td>64,454.51</td>
                                            <td>28,789.44</td>
                                            <td>76,386.66</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td class="text-left">STAND AKHIR</td>
                                            <td class="text-left">WBP</td>
                                            <td>6,311.03</td>
                                            <td></td>
                                            <td>180,702.69</td>
                                            <td>58,623.91</td>
                                            <td>41,674</td>
                                            <td></td>
                                            <td></td>
                                            <td>31,590.32</td>
                                            <td>11,157.49</td>
                                            <td>48,215.55</td>
                                            <td>34,105.52</td>
                                            <td>64,888.47</td>
                                            <td>28,789.44</td>
                                            <td>77,087.32</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">SELISIH PEMBACAAN</td>
                                            <td>1,812.14</td>
                                            <td></td>
                                            <td>1,815</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td></td>
                                            <td></td>
                                            <td>493.04</td>
                                            <td>-</td>
                                            <td>195.06</td>
                                            <td>-</td>
                                            <td>433.96</td>
                                            <td>-</td>
                                            <td>700.66</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">FAKTOR KALI METER</td>
                                            <td>1,000</td>
                                            <td></td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td>1,000</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI WBP ( kWh )</td>
                                            <td>1,812,139</td>
                                            <td class="danger">1,812,139</td>
                                            <td>1,815,210.00</td>
                                            <td>-</td>
                                            <td>2,326</td>
                                            <td>1,822,720</td>
                                            <td></td>
                                            <td>493,040</td>
                                            <td>-</td>
                                            <td>195,060</td>
                                            <td>-</td>
                                            <td>433,960</td>
                                            <td>-</td>
                                            <td>700,660</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        {{----}}
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">TOTAL PEMAKAIAN ENERGI (LWBP+WBP)</td>
                                            <td>10,855,871</td>
                                            <td>10,856,514</td>
                                            <td>10,871,890</td>
                                            <td>-</td>
                                            <td>13,683</td>
                                            <td>10,918,760</td>
                                            <td>-</td>
                                            <td>2,856,190</td>
                                            <td>-</td>
                                            <td>1,257,610</td>
                                            <td>-</td>
                                            <td>2,588,800</td>
                                            <td>-</td>
                                            <td>4,216,160</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
                                            <td></td>
                                            <td class="warning">-</td>
                                            <td></td>
                                            <td></td>
                                            <td>13,685</td>
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
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN KVARH</td>
                                            <td></td>
                                            <td class="warning">17,097</td>
                                            <td></td>
                                            <td></td>
                                            <td>18</td>
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
                                        {{----}}
                                        <tr class="text-right">
                                            <td class="text-left">SELISIH kWh INCOMING</td>
                                            <td class="text-left">PEMBANDING</td>
                                            <td></td>
                                            <td></td>
                                            <td><i>(0.14)</i></td>
                                            <td><i>100.00</i></td>
                                            <td class="text-left"><i>%</i></td>
                                            <td><i>100.00</i></td>
                                            <td class="text-left"><i>% (inc >&ltout AMR)</i></td>
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
                                        <tr class="text-right">
                                            <td class="text-left">SELISIH kWh INCOMING</td>
                                            <td class="text-left">OUT GOING</td>
                                            <td></td>
                                            <td></td>
                                            <td><i>(0.70)</i></td>
                                            <td><i>100.00</i></td>
                                            <td class="text-left"><i>%</i></td>
                                            <td><i>100.00</i></td>
                                            <td class="text-left"><i>% (visual >&lt AMR)</i></td>
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
                                        {{----}}
                                        <tr class="text-right">
                                            <td colspan="2" class="text-left">PEMAKAIAN ENERGI BULAN LALU</td>
                                            <td>9,304,476</td>
                                            <td>9,304,021</td>
                                            <td>9,317,840</td>
                                            <td>-</td>
                                            <td>13,515</td>
                                            <td>9,462,660</td>
                                            <td>-</td>
                                            <td>2,764,990</td>
                                            <td>-</td>
                                            <td>944,840</td>
                                            <td>-</td>
                                            <td>2,127,520</td>
                                            <td>-</td>
                                            <td>3,625,310</td>
                                            <td>-</td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td>10,842,831</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>2,836,328</td>
                                            <td></td>
                                            <td>1,248,865</td>
                                            <td></td>
                                            <td>2,570,797</td>
                                            <td></td>
                                            <td>4,186,841</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.master.footer')

    </div>
</div>
@endsection