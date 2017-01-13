@extends('layouts.guest-dashboard-layout')
@section('content')
    <div id="page-wrapper">
        <!--BEGIN TITLE & BREADCRUMB PAGE-->
        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
            <div class="page-header pull-left">
                <div class="page-title">
                    School Information</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="/guest/home">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">{{ ucfirst($school->name) }}</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="active">{{ ucfirst($school->name) }}</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->
        <div class="page-content">
            <div id="tab-general">
                <div class="row mbl">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12"><h2>{{ ucfirst($school->name) }}</h2>

                                <div class="row mtl">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="text-center mbl">
                                                @if(count($school->photos) > 0)
                                                    @foreach($school->photos as $img)
                                                        <img class="img-responsive" src="{{ $img['openURL'] }}" style="display: inline-block" />
                                                    @endforeach
                                                @else
                                                    <img class="img-responsive" src="/img/school-icon.png" style="display: inline-block"/>
                                                @endif
                                            </div>
                                        </div>
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td>School Type</td>
                                                <td>{{ ucfirst($school->school_type) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                  {{ empty($school->contact['info_email']) ? 'Not Available' : $school->contact['info_email'] }}
                                                    <input type="hidden" value="{{ $school->id }}" id="id">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>{{ $school->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td><span class="label label-success">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>User Rating</td>
                                                <td>
                                                    @if($rank != null && $rank > 0 )
                                                        @for($i=1; $i <= $rank; $i++)
                                                            <i class="fa fa-star text-yellow fa-fw"></i>
                                                        @endfor
                                                        @for($t = $rank+1; $t <= 5; $t++)
                                                            <i class="fa fa-star fa-fw"></i>
                                                        @endfor
                                                    @else
                                                    <i class="fa fa-star  fa-fw"></i><i class="fa fa-star fa-fw"></i><i class="fa fa-star  fa-fw"></i><i class="fa fa-star  fa-fw"></i><i class="fa fa-star  fa-fw"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Member Since</td>
                                                <td> {{date("F jS, Y",strtotime($school->created_at))}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-9">

                                        <div id="generalTabContent" class="tab-content">
                                            <div id="tab-edit" class="tab-pane fade in active">
                                                <form action="#" class="form-horizontal">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab-edit" data-toggle="tab">School Data</a></li>
                                                    </ul>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Accreditations</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    @if( count($school->accreditation) > 0 )
                                                                        <span class="label label-green mrs">{{ $school->accreditation['accreditations_1'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->accreditation['accreditations_2'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->accreditation['accreditations_3'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->accreditation['accreditations_4'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->accreditation['accreditations_5'] }}</span>
                                                                    @else
                                                                        <span class="label label-red mrs">No Accreditations</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Affiliations</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    @if( count($school->affiliation) > 0 )
                                                                        <span class="label label-green mrs">{{ $school->affiliation['affiliations_1'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->affiliation['affiliations_2'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->affiliation['affiliations_3'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->affiliation['affiliations_4'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->affiliation['affiliations_5'] }}</span>
                                                                        <span class="label label-green mrs">{{ $school->affiliation['affiliations_6'] }}</span>
                                                                    @else
                                                                        <span class="label label-red mrs">No Affiliations</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Medical Facilities</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    @if($school->school_type == 'primary-school' || $school->school_type ==  'primary' ||  $school->school_type ==  'secondary-school' || $school->school_type ==  'secondary' || $school->school_type ==  'preschool')
                                                                        @if(count($school->primary) > 0)
                                                                            @foreach(unserialize($school->primary['medical_facility']) as $t)
                                                                                <span class="label label-green mrs">{{ ucfirst($t) }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="label label-red mrs">No Medical Facility</span>
                                                                        @endif
                                                                    @elseif($school->school_type == 'vocation' || $school->school_type ==  'vocational' || $school->school_type ==  'tertiary')
                                                                        @if(count($school->tertiaries) > 0)
                                                                            @foreach(unserialize($school->tertiaries['medical_facility']) as $t)
                                                                                <span class="label label-green mrs">{{ ucfirst($t) }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="label label-red mrs">No Medical Facility</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Sport Facility</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-4">
                                                                    @if($school->school_type == 'primary-school' || $school->school_type ==  'primary' ||  $school->school_type ==  'secondary-school' || $school->school_type ==  'secondary' || $school->school_type ==  'preschool')
                                                                        @if(count($school->primary) > 0)
                                                                            @foreach(unserialize($school->primary['sport_facility']) as $t)
                                                                                <span class="label label-green mrs">{{ ucfirst($t) }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="label label-red mrs">No Sport Facility</span>
                                                                        @endif
                                                                    @elseif($school->school_type == 'vocation' || $school->school_type ==  'vocational' || $school->school_type ==  'tertiary')
                                                                        @if(count($school->tertiaries) > 0)
                                                                            @foreach(unserialize($school->tertiaries['sport_facility']) as $t)
                                                                                <span class="label label-green mrs">{{ ucfirst($t) }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="label label-red mrs">No Sport Facility</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Clubs and Society</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-4">
                                                                    @if($school->school_type == 'primary-school' || $school->school_type ==  'primary' ||  $school->school_type ==  'secondary-school' || $school->school_type ==  'secondary' || $school->school_type ==  'preschool')
                                                                        @if(count($school->primary) > 0)
                                                                            @foreach(unserialize($school->primary['clubs_societies']) as $t)
                                                                                <span class="label label-green mrs">{{ ucfirst($t) }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="label label-red mrs">No records of clubs or society</span>
                                                                        @endif
                                                                    @elseif($school->school_type == 'vocation' || $school->school_type ==  'vocational' || $school->school_type ==  'tertiary')
                                                                        @if(count($school->tertiaries) > 0)
                                                                            @foreach(unserialize($school->tertiaries['club_society']) as $t)
                                                                                <span class="label label-green mrs">{{ ucfirst($t) }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="label label-red mrs">No records of clubs or society</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Ownership</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    @if( count($school->structure) > 0 )
                                                                        <span class="label label-green mrs">{{ ucfirst($school->structure['ownership']) }}</span>
                                                                    @else
                                                                        <span class="label label-red mrs">Not Available</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Sex Orientation</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    @if( count($school->structure) > 0 )
                                                                        <span class="label label-green mrs">{{ ucfirst($school->structure['sex']) }}</span>
                                                                    @else
                                                                        <span class="label label-red mrs">Not Available</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><label class="col-sm-3 control-label">Religion</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    @if( count($school->structure) > 0 )
                                                                        <span class="label label-green mrs">{{ ucfirst($school->structure['religion']) == 'Muslim' ? 'Islam' :  ucfirst($school->structure['religion']) }}</span>
                                                                    @else
                                                                        <span class="label label-red mrs">Not Available</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab-edit" data-toggle="tab">School Ranking</a></li>
                                                        <a href="#" class="clear-rank pull-right">Clear Rank</a>
                                                    </ul>
                                                    <div class=" col-6-md col-md-offset-3 rank">
                                                        @if($user_rank > 0)
                                                            @for($i=1; $i <= $user_rank; $i++)
                                                                <i class="fa fa-star star_{{ $i }}" data-value="{{ $i }}"></i>
                                                            @endfor
                                                            @for($t = $user_rank+1; $t <= 5; $t++)
                                                                <i class="fa fa-star-o star_{{ $t }}" data-value="{{ $t }}"></i>
                                                            @endfor
                                                        @else
                                                            <i class="fa fa-star-o star_1" data-value="1"></i><i class="fa fa-star-o star_2" data-value="2"></i><i class="fa fa-star-o star_3" data-value="3"></i><i class="fa fa-star-o star_4" data-value="4"></i><i class="fa fa-star-o star_5" data-value="5"></i>
                                                        @endif
                                                    </div>
                                                    <hr/>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab-edit" data-toggle="tab">School Calendar</a></li>
                                                    </ul>
                                                    <div class=" col-6-md">
                                                        <div class="box box-primary">
                                                            <div class="box-body no-padding">
                                                                <!-- THE CALENDAR -->
                                                                <div id="calendar"></div>
                                                                <input type="hidden" value="{{$school['id']}}" id="id">
                                                            </div><!-- /.box-body -->
                                                        </div><!-- /. box -->
                                                    </div><!-- /.col -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END CONTENT-->
    </div>
    {{ HTML::script('js/guest/guest.js'); }}
@stop
