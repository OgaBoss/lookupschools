@extends('layouts.guest-dashboard-layout')
@section('content')
        <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Schools you follow.
            </div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="/guest/home">Home</a></li>
        </ol>
        <div class="clearfix">
        </div>
    </div>

    <div class="row guest_school">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if(count($schools) > 0)
                @foreach(array_chunk($schools->all(),2) as $row)
                    <div class="row">
                        @foreach($row as $school)
                            <div class="col-lg-6 col-md-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="profile">
                                            <div style="margin-bottom: 15px" class="row">
                                                <div class="col-xs-12 col-sm-8">
                                                    <h2><a href="/guest/{{ $school->slug }}/school_information">{{ ucfirst($school->name) }}</a></h2>
                                                    <p>
                                                        <strong>Type:</strong>
                                                        {{ ucfirst($school->school_type) }}
                                                    </p>
                                                    <p>
                                                        <strong>Address:</strong>
                                                        {{ ucfirst($school->address) }}
                                                    </p>
                                                    <p>
                                                        <strong class="mrs">Sports:</strong>
                                                        @if($school->school_type == ('primary' || 'primary-school' ||  'preschool' || 'seconday-school')  )
                                                            @if(!empty(unserialize($school->primary['sport_facility'])))
                                                                @foreach(unserialize($school->primary['sport_facility']) as $t)
                                                                    <span class="label label-green mrs">{{ $t }}</span>
                                                                @endforeach
                                                            @else
                                                                <span class="label label-green mrs">---</span>
                                                            @endif
                                                        @elseif($school->school_type == ('vocation' || 'vocational' || 'tertiary'))
                                                            @if(!empty(unserialize($school->tertiaries['sport_facility'])))
                                                                @foreach(unserialize($school->tertiaries['sport_facility']) as $t)
                                                                    <span class="label label-green mrs">{{ $t }}</span>
                                                                @endforeach
                                                            @else
                                                                <span class="label label-green mrs">---</span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 text-center">
                                                    <figure>
                                                        @if(count($school->photos) > 0)
                                                            @foreach($school->photos as $img)
                                                                <img class="img-responsive img-circle" src="{{ $img['openURL'] }}" style="display: inline-block" />
                                                            @endforeach
                                                        @else
                                                            <img class="img-responsive img-circle" src="/img/school-icon.png" style="display: inline-block"/>
                                                        @endif
                                                        <figcaption class="ratings"><p><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star-o"></span></a></p></figcaption>
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="row text-center divider">
                                                <div class="col-xs-12 col-sm-4 emphasis">
                                                    <h2>
                                                        <strong>
                                                            <?=
                                                                count($school->user()->where('type','=','guest'));
                                                            ?>
                                                        </strong>
                                                    </h2>
                                                    <p>&nbsp;&nbsp;</p>
                                                    <button class="btn btn-yellow btn-block">
                                                        <span class="fa fa-plus-circle"></span>&nbsp; Followers
                                                    </button>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 emphasis">
                                                    <h2>
                                                        <strong>{{ $school->schoolRank()->sum('count') }}</strong>
                                                    </h2>
                                                    <p>&nbsp;&nbsp;</p>
                                                    <button class="btn btn-blue btn-block">
                                                        <span class="fa fa-user"></span>&nbsp; No of times Rank
                                                    </button>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 emphasis">
                                                    <h2>
                                                        <strong>{{$school->schoolRank['rank'] > 0 ? $school->schoolRank['rank'] : 0}}/5</strong>
                                                    </h2>
                                                    <p>&nbsp;&nbsp;</p>
                                                    <div class="btn-group dropup">
                                                        <button type="button" data-toggle="dropdown" class="btn btn-orange dropdown-toggle">
                                                            <span class="fa fa-gear"></span>&nbsp; Overall Ranking
                                                        </button>
                                                        <ul role="menu" class="dropdown-menu pull-right text-left">
                                                            <li><a href="#"><span class="fa fa-envelope"></span>&nbsp; Send an email</a></li>
                                                            <li><a href="#"><span class="fa fa-list"></span>&nbsp; Add or remove from a list</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><span class="fa fa-warning"></span>&nbsp; Report this user for spam</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" role="button" class="btn disabled">Unfollow</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <h2>You currently follow no school, <span><h4>Check out schools <a href="/">here</a>.</h4></span></h2>
            @endif
        </div>
        <div class="col-md-2"></div>
    </div>
@stop