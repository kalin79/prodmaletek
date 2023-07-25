@extends('layouts.frontend.master')
@section('meta_tags')
    <title>Maletek</title>
    <meta name="title" content="Maletek"  />
    <meta name="description" content="Descubre nuestra amplia gama de productos diseñados" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Maletek" >
    <meta itemprop="description" content="Descubre nuestra amplia gama de productos diseñados">
    <meta itemprop="image" content="https://www.maletek.com.pe/frontend/images/share.png">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Maletek" >
    <meta name="twitter:description" content="Descubre nuestra amplia gama de productos diseñados">
    <meta name="twitter:creator" content="@author_handle">
    <!-- Twitter Summary card images must be at least 120x120px  -->
    <meta name="twitter:image" content="https://www.maletek.com.pe/frontend/images/share.png">

    <!-- Open Graph data -->
    <meta property="og:title" content="Maletek"  />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://www.maletek.com.pe/" />
    <meta property="og:image" content="https://www.maletek.com.pe/frontend/images/share.png" />
    <meta property="og:description" content="Descubre nuestra amplia gama de productos diseñados" />
    <meta property="og:site_name" content="https://www.maletek.com.pe/, Lima Perú" />
    <meta property="article:published_time" content="2023-09-17T05:59:00+01:00" />
    <meta property="article:modified_time" content="2023-09-16T19:08:47+01:00" />
    <meta property="article:section" content="Article Section" />
    <meta property="article:tag" content="Article Tag" />
    <meta property="fb:admins" content="Facebook numberic ID" />
     
@endsection
@section('content')
    <rubro-main slug="{!! $id !!}"></rubro-main>
@endsection