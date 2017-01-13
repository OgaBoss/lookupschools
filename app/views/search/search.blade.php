
@extends('layouts.search-layout')
@section('content')
    <div class="row result">
        <div class="col-md-12">
            <nav class="navbar navbar-default " role="navigation">
                <div class="container-fluid">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Advanced Search</b> <span class="caret"></span></a>
                                <ul id="login-dp" class="dropdown-menu">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="ad-search" role="form" method="get" action="/search/advanced_search" accept-charset="UTF-8" id="login-nav">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                        <select class="form-control select2" id="s-state" name="state" style="width: 221px !important;">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                        <select class="form-control select2" id="s-lg" name="lg" style="width: 221px !important;">
                                                            <option></option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                        <select class="form-control select2" id="s-area" name="area" style="width: 221px !important;">
                                                            <option></option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                        <select class="form-control select2" id="s-type" name="school_type" style="width: 221px !important;">
                                                            <option></option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block advance-school">Advanced Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="ad-search" role="form" method="get" action="/search/searchByFees" accept-charset="UTF-8" id="login-nav">
                                                    <div class="form-group">
                                                        <input id="range_2" type="text" name="range_2" value="0;10000000" data-type="double" data-step="100000" data-prefix="N" data-from="100000" data-to="2000000" data-hasgrid="true" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block advance-school">Search By Fees</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="result-num">
                                <p href="#" class="dropdown-toggle" style="margin-top: 10px;">
                                    <b>{{ $data->getCurrentPage() }} of {{ $data->getLastPage() }}</b>
                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    @if($page > 1 )
                                        @if(Route::currentRouteName() == "show_results")
                                            <a href="http://{{$_SERVER['HTTP_HOST']}}/search/show_results?state={{ $param }}&page={{$page - 1}}"><span><i class="fa fa-chevron-left"></i></span></a>
                                        @else
                                            <a href="http://{{$_SERVER['HTTP_HOST']}}/search/advanced_search?state={{ $state }}&lg={{ $lg }}&area={{ $area }}&school_type={{ $school_type }}&page={{$page - 1}}"><span><i class="fa fa-chevron-left"></i></span></a>
                                        @endif
                                    @endif
                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    @if($page < $data->getLastPage())
                                        @if(Route::currentRouteName() == "show_results")
                                            <a href="http://{{$_SERVER['HTTP_HOST']}}/search/show_results?state={{ $param }}&page={{$page + 1}}"><span><i class="fa fa-chevron-right"></i></span></a>
                                        @else
                                            <a href="http://{{$_SERVER['HTTP_HOST']}}/search/advanced_search?state={{ $state }}&lg={{ $lg }}&area={{ $area }}&school_type={{ $school_type }}&page={{$page + 1}}"><span><i class="fa fa-chevron-right"></i></span></a>
                                        @endif
                                    @endif
                                </p>
                            </li>
                            <li>

                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search" method="get" action="show_results">
                            <div class="form-group">
                                <select class="form-control select2" id="search_page_search" name="state" style="width: 400px !important;">
                                    <option></option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        </form>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>

    </div>

    @if(count($data) > 0)
        @foreach(array_chunk($data->all(), 4) as $res)
            <div class="row entire-result">
                @foreach($res as $result)
                    <div class="col-md-3 each-result">
                        <div id="compare_success">
                        </div>
                        <div class="row social-link">
                            <div class="col-md-6">
                                <a href="#" class="pull-left map"  data-address-lat="{{$result->lat?$result->lat:6.5833}}" data-address-lng="{{$result->lng?$result->lng:3.3333}}"><i class="fa fa-map-marker fa-2x"></i></a>
                            </div>
                            <div class="col-md-6 ">
                                @if($result->facebook_page != "")
                                    <div class="fb-like pull-right" data-href="{{ $result->facebook_page }}" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
                                @endif
                            </div>
                        </div>
                        <div class="row school-img">
                            <div class="col-md-12 caption">
                                @if($result->url_slug != '')
                                    <img class="caption__media" src="{{ $result->url_slug }}" onerror="this.src='/img/school-icon.png'"/>
                                @else
                                    <img class="caption__media" src="/img/school-icon.png" onerror="this.src='/img/school-icon.png'" />
                                @endif
                                <div class="caption__overlay">
                                    <h1 class="caption__overlay__title">{{ ucfirst($result->name) }}</h1>
                                    <p class="caption__overlay__content">{{ $result->local_gov}} lg, {{ $result->state }}</p>
                                    <p class="caption__overlay__content">{{ ucfirst($result->school_type) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row compare-link" >
                            <div class="col-md-6">
                                <ul class="res" style="padding-left: 0;">
                                    <li class="" >
                                        <button class="btn pull-left compare" data-id="{{$result->id}}"><i class="fa fa-check pull-left"></i>Compare</button>
                                        <span class="compare_num"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <a href="/mini-site/school/{{ $result->slug }}" class=" pull-right"><i class="fa fa-home fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="row ranking">
                            <div class="col-md-12">
                                @if($result->rank != null && $result->rank > 0 )
                                    @for($i=1; $i <= $result->rank; $i++)
                                        <i class="fa fa-star text-yellow fa-fw"></i>
                                    @endfor
                                    @for($t = $result->rank+1; $t <= 5; $t++)
                                        <i class="fa fa-star fa-fw"></i>
                                    @endfor
                                @else
                                    <i class="fa fa-star  fa-fw"></i><i class="fa fa-star fa-fw"></i><i class="fa fa-star  fa-fw"></i><i class="fa fa-star  fa-fw"></i><i class="fa fa-star  fa-fw"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @else
        <div id="" class="col-md-4 col-md-offset-4" tabindex="-1" style="margin-bottom: 20px">
            <div class="md-modal md-effect-1 " id="modal-1 ">
                <div class="md-content-warning">
                    <h3><i class="fa fa-exclamation-triangle"></i> Sorry</h3>
                    <div>
                        <ul id="input_success">
                            <li>
                                No school matches your search, please search <span ><a href="/" style="color: #000 !important;"> again</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop



