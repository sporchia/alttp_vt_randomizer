@extends('layouts.default', ['title' => sprintf('%s - ', $hash)])

@section('content')
    <ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

    <Hashloader current_rom_hash="{{ $md5 }}" override-base-bps="{{ $bpsLocation }}" hash="{{ $hash }}"></Hashloader>
@overwrite
