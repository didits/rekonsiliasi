<div class="content" id="kwhmeter">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">KWH Meter</h4>
                    {{--<p class="category">Data KWH Meter</p>--}}
                </div>
                <div class="content">
                    <form action="{{route('input_datamaster.store')}}" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="tipe" value="KWH">
                        <input type="hidden" name="idgardu" value="{{$gardu->id}}">
                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                        {{--{{dd($gardu)}}--}}
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Seri</label>
                                    <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Konstanta</label>
                                    <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['KWH']['konstanta']}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tegangan Arus</label>
                                    <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['KWH']['teganganarus']}}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content" id="trafoarus">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Trafo Arus (CT)</h4>
                    {{--<p class="category">Data KWH Meter</p>--}}
                </div>
                {{--{{dd($decoded)}}--}}
                <div class="content">
                    <form action="{{route('input_datamaster.store')}}" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="tipe" value="TA">
                        <input type="hidden" name="idgardu" value="{{$gardu->id}}">
                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ratio</label>
                                    <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['TA']['ratioct']}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Burden (VA)</label>
                                    <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TA']['burdenct']}}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content" id="trafotegangan">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Trafo Tegangan (PT)</h4>
                    {{--<p class="category">Data KWH Meter</p>--}}
                </div>
                <div class="content">
                    <form action="{{route('input_datamaster.store')}}" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="tipe" value="TT">
                        <input type="hidden" name="idgardu" value="{{$gardu->id}}">
                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ratio</label>
                                    <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['TT']['ratiopt']}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Burden (VA)</label>
                                    <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TT']['burdenpt']}}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content" id="faktorkalimeter">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Faktor Kali Meter</h4>
                    {{--<p class="category">Data KWH Meter</p>--}}
                </div>

                <div class="content">
                    <form action="{{route('input_datamaster.store')}}" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="tipe" value="FK">
                        <input type="hidden" name="idgardu" value="{{$gardu->id}}">
                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Faktor Kali Meter</label>
                                    <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['FK']['faktorkali']}}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>