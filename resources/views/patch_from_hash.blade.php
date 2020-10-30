@extends('layouts.default', ['title' => sprintf('%s - ', $hash)])

@section('content')
    <Hashloader current_rom_hash="{{ $md5 }}" override-base-bps="{{ $bpsLocation }}" hash="{{ $hash }}"></Hashloader>
@overwrite
