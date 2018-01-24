<?php


// Home
Breadcrumbs::register('area', function($breadcrumbs, $area)
{
    $breadcrumbs->push('Area '.$area, route('area.index'));
});

//list_datamaster_rayon
Breadcrumbs::register('rayon', function($breadcrumbs, $rayon)
{
    $breadcrumbs->parent('area', $rayon['area']);
    $breadcrumbs->push('Rayon '.$rayon['rayon'], route('area.list_datamaster', $rayon['params']));
});

//list_datamaster_gi
Breadcrumbs::register('gi', function($breadcrumbs, $gi)
{
    $breadcrumbs->parent('rayon', $gi['rayon']);
    $breadcrumbs->push('GI '.$gi['gi'], route('area.lihat_gi', $gi['params']));
});

//list_datamaster_trafo_gi
Breadcrumbs::register('trafo_gi', function($breadcrumbs, $trafo_gi)
{
    $breadcrumbs->parent('gi', $trafo_gi['gi']);
    $breadcrumbs->push('Trafo GI '.$trafo_gi['trafo_gi'], route('area.lihat_trafo_gi', $trafo_gi['params']));
});

//list_datamaster_penyulang
Breadcrumbs::register('penyulang', function($breadcrumbs, $penyulang)
{
    $breadcrumbs->parent('trafo_gi', $penyulang['trafo_gi']);
    $breadcrumbs->push('Penyulang '.$penyulang['penyulang'], route('area.lihat_penyulang', $penyulang['params']));
});

//list_datamaster_pct
Breadcrumbs::register('pct', function($breadcrumbs, $gardu)
{
    $breadcrumbs->parent('penyulang', $gardu['penyulang']);
    $breadcrumbs->push('PCT '.$gardu['gardu'], route('area.lihat_pct', $gardu['params']));
});