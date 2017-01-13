
@extends('layouts.compare-layout')
@section('content')
    <div class="row result-compare">
        <div></div>
        @for($i = 0; $i < count($data); $i++)
            <div class="col-md-3 col-lg-offset-0" data-class-check="{{ $data[$i]->id }}">
                <div id="school-name">
                    <a href="#"><i class="fa fa-times-circle pull-left" style="color: #ff4d4d !important;"></i></a>
                    <h4 class="school-name" data-lng="{{ $data[$i]->lng }}" data-lat="{{ $data[$i]->lat }}">{{ ucfirst($data[$i]->name) }}</h4>
                </div>
                <hr>
                <h5 class="class-type"></span>School Type : <b>{{ ucfirst($data[$i]->school_type) ? ucfirst
                ($data[$i]->school_type) : '<i class="fa fa-question-circle" title=""></i>'}}</b></h5>
                @if(Sentry::check() && isset($permissions['guest']) && $permissions['guest'] == 1)
                    @if(in_array($data[$i]->id, $sch_id))
                        <button class="btn btn-default follow-sch" style="margin-top: 20px; padding: 6px 30px;"><i class="fa fa-heart"></i>Following</button>
                    @else
                        {{ Form::open(array('class' => 'follow', 'route' => 'guest_follows')) }}
                            <input type="hidden" name="school_id" value="{{ $data[$i]->id }}">
                            <button class="btn btn-default follow-sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Follow school</button>
                        {{ Form::close() }}
                    @endif
                @elseif(Sentry::check() && isset($permissions['user']) && $permissions['user'] == 1)
                    @if(in_array($data[$i]->id, $sch_id))
                        <button class="btn btn-default follow-sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Your School</button>
                    @else
                        <button class="btn btn-default not_follow_sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Not Allowed</button>
                    @endif
                @else
                    {{ Form::open(array('class' => 'follow', 'route' => 'guest_follows')) }}
                    <input type="hidden" name="school_id" value="{{ $data[$i]->id }}">
                    <button class="btn btn-default follow-sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Follow school</button>
                    {{ Form::close() }}
                @endif

                <button class="btn btn-default sch-profile" style="margin-top: 20px;"><i class="fa fa-eye"></i>View Full Profile</button>
                <div class="compare-details">
                    <h4 class="det"><b>Basic Information</b></h4>
                    <ul class="fa-ul">
                        <li class=""><i class="fa-li fa fa-location-arrow"></i>State <span class="pull-right">{{ $data[$i]->state ? ucfirst($data[$i]->state) : '<i class="fa fa-question-circle" title=""></i>'}}</span></li>
                        <li class=""><i class="fa-li fa fa-location-arrow"></i>LG <span class="pull-right">{{ $data[$i]->local_gov ? ucfirst($data[$i]->local_gov) : '<i class="fa fa-question-circle" title=""></i>'}}</span></li>
                        <li class=""><i class="fa-li fa fa-location-arrow"></i>Area <span class="pull-right">{{ $data[$i]->area ? ucfirst($data[$i]->area) : '<i class="fa fa-question-circle" title=""></i>'}}</span></li>
                        <li class=""><i class="fa-li fa fa-envelope"></i>Email
                            <span class="pull-right">
                                @if($data[$i]->contact == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->contact->info_email == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->contact->info_email }}">
                                       {{  mb_strimwidth($data[$i]->contact->info_email, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>

                    </ul>
                </div>

                <div class="contact">
                    <h4 class="det"><b>Contact</b></h4>
                    <ul class="fa-ul">
                        <li class=""><i class="fa-li fa fa-phone"></i>Phone
                            <span class="pull-right">
                                @if($data[$i]->contact == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->contact->phone_1 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="" data-truncate="">
                                       {{  $data[$i]->contact->phone_1 }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-mobile"></i>Mobile
                            <span class="pull-right">
                                @if($data[$i]->contact == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->contact->mobile_1 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="" data-truncate="">
                                       {{  $data[$i]->contact->mobile_1 }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-globe"></i>Website
                            <span class="pull-right">
                                @if($data[$i]->contact == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->contact->website == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="" data-truncate="">
                                       {{  $data[$i]->contact->website }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-envelope"></i>Academic email
                            <span class="pull-right">
                                @if($data[$i]->contact == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->contact->academic_email == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->contact->academic_email }}">
                                       {{  mb_strimwidth($data[$i]->contact->academic_email, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="accreditation">
                    <h4 class="det"><b>Accreditations</b></h4>
                    <ul class="fa-ul">
                        <li class=""><i class="fa-li fa fa-check-square-o"></i>Accreditation 1
                            <span class="pull-right">
                                @if($data[$i]->accreditation == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->accreditation->accreditations_1 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->accreditation->accreditations_1}}">
                                       {{  mb_strimwidth($data[$i]->accreditation->accreditations_1, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-check-square-o"></i>Accreditation 2
                            <span class="pull-right">
                                @if($data[$i]->accreditation == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->accreditation->accreditations_2 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->accreditation->accreditations_2}}">
                                       {{  mb_strimwidth($data[$i]->accreditation->accreditations_2, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-check-square-o"></i>Accreditation 3
                            <span class="pull-right">
                                @if($data[$i]->accreditation == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->accreditation->accreditations_3 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->accreditation->accreditations_3}}">
                                       {{  mb_strimwidth($data[$i]->accreditation->accreditations_3, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="affiliation">
                    <h4 class="det"><b>Affiliations</b></h4>
                    <ul class="fa-ul">
                        <li class=""><i class="fa-li fa fa-users"></i>Affiliation 1
                            <span class="pull-right">
                                @if($data[$i]->affiliation == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->affiliation->affiliations_1 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->affiliation->affiliations_1}}">
                                       {{  mb_strimwidth($data[$i]->affiliation->affiliations_1, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-users"></i>Affiliation 2
                            <span class="pull-right">
                                @if($data[$i]->affiliation == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->affiliation->affiliations_2 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->affiliation->affiliations_2}}">
                                       {{  mb_strimwidth($data[$i]->affiliation->affiliations_2, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-users"></i>Affiliation 3
                            <span class="pull-right">
                                @if($data[$i]->affiliation == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->affiliation->affiliations_3 == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span class="com-tooltip" data-truncate="{{ $data[$i]->affiliation->affiliations_3}}">
                                       {{  mb_strimwidth($data[$i]->affiliation->affiliations_3, 0, 15, "...") }}
                                    </span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="structure" style="min-height: 250px !important;">
                    <h4 class="det"><b>Sch. Structure</b></h4>
                    <ul class="fa-ul">
                        <li class=""><i class="fa-li fa fa-calendar"></i>DOB
                            <span class="pull-right">
                                @if($data[$i]->structure == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->structure->dob == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span>
                                        {{ $data[$i]->structure->dob }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-calendar"></i>Ownership
                            <span class="pull-right">
                                @if($data[$i]->structure == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->structure->ownership == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span>
                                        {{ $data[$i]->structure->ownership }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        @if($data[$i]->structure != NULL &&  $data[$i]->structure->ownership == 'Public')
                            <li class=""><i class="fa-li fa fa-calendar"></i>Public Type
                                <span class="pull-right">
                                    @if($data[$i]->structure == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->structure->public == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span class="com-tooltip" data-truncate="{{ $data[$i]->structure->public }}">
                                            {{  mb_strimwidth($data[$i]->structure->public, 0, 15, "...") }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @elseif($data[$i]->structure != NULL &&  $data[$i]->structure->ownership == 'Private')
                            <li class=""><i class="fa-li fa fa-calendar"></i>Public Type
                                <span class="pull-right">
                                    @if($data[$i]->structure == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->structure->private == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span class="com-tooltip" data-truncate="{{ $data[$i]->structure->private }}">
                                            {{  mb_strimwidth($data[$i]->structure->private, 0, 15, "...") }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @else
                        @endif
                        <li class=""><i class="fa-li fa fa-venus-mars"></i>Sex
                            <span class="pull-right">
                                @if($data[$i]->structure == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->structure->sex == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span>
                                        {{ $data[$i]->structure->sex }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-calendar"></i>Religion
                            <span class="pull-right">
                                @if($data[$i]->structure == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->structure->religion == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span>
                                        {{ $data[$i]->structure->religion }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        <li class=""><i class="fa-li fa fa-calendar"></i>School Type
                            <span class="pull-right">
                                @if($data[$i]->structure == NULL)
                                    <i class="fa fa-question-circle" title=""></i>
                                @elseif($data[$i]->structure->school_type == "")
                                    <i class="fa fa-question-circle" title=""></i>
                                @else
                                    <span>
                                        {{ $data[$i]->structure->school_type }}
                                    </span>
                                @endif
                            </span>
                        </li>
                        @if($data[$i]->structure != NULL &&  $data[$i]->structure->public == 'Military')
                            <li class=""><i class="fa-li fa fa-calendar"></i>Military
                                <span class="pull-right">
                                    @if($data[$i]->structure == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->structure->military == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->structure->military }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @else
                        @endif
                        @if($data[$i]->school_type == 'tertiary')
                            <li class=""><i class="fa-li fa fa-university"></i>Tertiary Type
                                <span class="pull-right">
                                    @if($data[$i]->structure == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->structure->tertiary == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->structure->tertiary }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @elseif($data[$i]->school_type == 'preschool')
                            <li class=""><i class="fa-li fa fa-calendar"></i>Preschool Type
                                <span class="pull-right">
                                    @if($data[$i]->structure == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->structure->preschool == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->structure->preschool }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @else
                        @endif
                    </ul>
                </div>

                <div class="extras" style="min-height: 370px !important;">
                    <h4 class="det"><b>Extras</b></h4>
                    <ul class="fa-ul">
                        @if($data[$i]->school_type == 'primary' || $data[$i]->school_type == 'secondary')
                            <li class=""><i class="fa-li fa fa-university"></i>Ave. Class Count
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->average_children_class == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->primary->average_children_class }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class=""><i class="fa-li fa fa-home"></i>Ave. Child/Boarding room
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->average_child_room == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->primary->average_child_room }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class=""><i class="fa-li fa fa-graduation-cap"></i>Teacher/Student ratio
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->teacher_student_ratio == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                           1 : {{  $data[$i]->primary->teacher_student_ratio }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="com-tooltip" data-truncate="Boarding Locker Type"><i class="fa-li fa fa-users"></i>Boarding L..
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->boarding_locker_type== "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{  $data[$i]->primary->boarding_locker_type}}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="com-tooltip" data-truncate="Admission Age Limit"><i class="fa-li fa fa-filter"></i>Admission A...
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->admission_age_limit == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{  $data[$i]->primary->admission_age_limit}}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class=""><i class="fa-li fa fa-desktop"></i>ICT Room
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->ict_room == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{  $data[$i]->primary->ict_room}}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-medkit"></i>Medical Facilities
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->medical_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->medical_facility))){
                                            foreach(unserialize($data[$i]->primary->medical_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-child"></i>DayCare Facilities
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->daycare_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->daycare_facility))){
                                            foreach(unserialize($data[$i]->primary->daycare_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-stethoscope"></i>Health Professional
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->health_prof == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->health_prof))){
                                            foreach(unserialize($data[$i]->primary->health_prof) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-trophy"></i>Sports
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->sport_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->sport_facility))){
                                            foreach(unserialize($data[$i]->primary->sport_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}f
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-graduation-cap"></i>Subjects Offered
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->subject_offered == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->subject_offered))){
                                            foreach(unserialize($data[$i]->primary->subject_offered) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-futbol-o"></i>Clubs & Society
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->clubs_societies == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->clubs_societies))){
                                            foreach(unserialize($data[$i]->primary->clubs_societies) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @elseif($data[$i]->school_type == 'preschool')
                            <li class=""><i class="fa-li fa fa-users"></i>Ave. Class Count
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->average_children_daycare == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->primary->average_children_daycare }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class=""><i class="fa-li fa fa-users"></i>Nanny/Child ratio
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->nanny_baby_ratio == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                           1 : {{  $data[$i]->primary->nanny_baby_ratio }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="com-tooltip" data-truncate="Daycare Locker Type"><i class="fa-li fa fa-users"></i>Daycare L..
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->daycare_locker_type== "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{  $data[$i]->primary->daycare_locker_type}}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="com-tooltip" data-truncate="Admission Age Limit"><i class="fa-li fa fa-users"></i>Admission A...
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->admission_age_limit == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{  $data[$i]->primary->admission_age_limit}}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-medkit"></i>Medical Facilities
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->medical_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->medical_facility))){
                                            foreach(unserialize($data[$i]->primary->medical_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-child"></i>DayCare Facilities
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->daycare_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->daycare_facility))){
                                            foreach(unserialize($data[$i]->primary->daycare_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-stethoscope"></i>Health Professional
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->health_prof == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->health_prof))){
                                            foreach(unserialize($data[$i]->primary->health_prof) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-trophy"></i>Sports
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->sport_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->sport_facility))){
                                            foreach(unserialize($data[$i]->primary->sport_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}f
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-graduation-cap"></i>Subjects Offered
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->subject_offered == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->subject_offered))){
                                            foreach(unserialize($data[$i]->primary->subject_offered) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-futbol-o"></i>Clubs & Society
                                <span class="pull-right">
                                    @if($data[$i]->primary == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->primary->clubs_societies == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->primary->clubs_societies))){
                                            foreach(unserialize($data[$i]->primary->clubs_societies) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                        @elseif($data[$i]->school_type == 'tertiary' || $data[$i]->school_type == 'vocation')
                            <li class="com-tooltip" data-truncate="Average Person Per Hostel Room"><i class="fa-li fa fa-users"></i>Ave. Perso...
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->average_student == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{$data[$i]->tertiaries->average_student }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-users"></i>Admission Age Limit
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->admission_age_limit == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <span>
                                            {{ $data[$i]->tertiaries->admission_age_limit }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-medkit"></i>Medical Facilities
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->medical_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->tertiaries->medical_facility))){
                                            foreach(unserialize($data[$i]->tertiaries->medical_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-stethoscope"></i>Health Professional
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->health_prof == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->tertiaries->health_prof))){
                                            foreach(unserialize($data[$i]->tertiaries->health_prof) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-trophy"></i>Sports
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->sport_facility == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->tertiaries->sport_facility))){
                                            foreach(unserialize($data[$i]->tertiaries->sport_facility) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}f
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li ><i class="fa-li fa fa-futbol-o"></i>Clubs & Society
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->club_society == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->tertiaries->club_society))){
                                            foreach(unserialize($data[$i]->tertiaries->club_society) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li><i class="fa-li fa fa-home"></i>Accommodation Fac.
                                <span class="pull-right">
                                    @if($data[$i]->tertiaries == NULL)
                                        <i class="fa fa-question-circle" title=""></i>
                                    @elseif($data[$i]->tertiaries->accommodation == "")
                                        <i class="fa fa-question-circle" title=""></i>
                                    @else
                                        <?php
                                        $medic = [];
                                        if(!empty(unserialize($data[$i]->tertiaries->accommodation))){
                                            foreach(unserialize($data[$i]->tertiaries->accommodation) as $med){
                                                $medic[] = ucfirst($med);
                                            }
                                        }
                                        $string = implode(',',$medic);
                                        ?>
                                        <span class="com-tooltip" data-truncate="{{ $string }}">
                                            {{ mb_strimwidth($string, 0, 10, "..."); }}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            @if($data[$i]->school_type == "vocation")
                                <li><i class="fa-li fa fa-home"></i>Vocational Fac.
                                    <span class="pull-right">
                                        @if($data[$i]->tertiaries == NULL)
                                            <i class="fa fa-question-circle" title=""></i>
                                        @elseif($data[$i]->tertiaries->vocational_facility == "")
                                            <i class="fa fa-question-circle" title=""></i>
                                        @else
                                            <?php
                                            $medic = [];
                                            if(!empty(unserialize($data[$i]->tertiaries->vocational_facility))){
                                                foreach(unserialize($data[$i]->tertiaries->vocational_facility) as $med){
                                                    $medic[] = ucfirst($med);
                                                }
                                            }
                                            $string = implode(',',$medic);
                                            ?>
                                            <span class="com-tooltip" data-truncate="{{ $string }}">
                                                {{ mb_strimwidth($string, 0, 10, "..."); }}
                                            </span>
                                        @endif
                                    </span>
                                </li>

                                <li><i class="fa-li fa fa-home"></i>Vocation Category
                                    <span class="pull-right">
                                        @if($data[$i]->tertiaries == NULL)
                                            <i class="fa fa-question-circle" title=""></i>
                                        @elseif($data[$i]->tertiaries->vocation_category == "")
                                            <i class="fa fa-question-circle" title=""></i>
                                        @else
                                            <?php
                                            $medic = [];
                                            if(!empty(unserialize($data[$i]->tertiaries->vocation_category))){
                                                foreach(unserialize($data[$i]->tertiaries->vocation_category) as $med){
                                                    $medic[] = ucfirst($med);
                                                }
                                            }
                                            $string = implode(',',$medic);
                                            ?>
                                            <span class="com-tooltip" data-truncate="{{ $string }}">
                                                {{ mb_strimwidth($string, 0, 10, "..."); }}
                                            </span>
                                        @endif
                                    </span>
                                </li>

                                <li><i class="fa-li fa fa-home"></i>Program offered
                                    <span class="pull-right">
                                        @if($data[$i]->tertiaries == NULL)
                                            <i class="fa fa-question-circle" title=""></i>
                                        @elseif($data[$i]->tertiaries->program_offered == "")
                                            <i class="fa fa-question-circle" title=""></i>
                                        @else
                                            <?php
                                            $medic = [];
                                            if(!empty(unserialize($data[$i]->tertiaries->program_offered))){
                                                foreach(unserialize($data[$i]->tertiaries->program_offered) as $med){
                                                    $medic[] = ucfirst($med);
                                                }
                                            }
                                            $string = implode(',',$medic);
                                            ?>
                                            <span class="com-tooltip" data-truncate="{{ $string }}">
                                                {{ mb_strimwidth($string, 0, 10, "..."); }}
                                            </span>
                                        @endif
                                    </span>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
                <hr>
                @if(Sentry::check() && isset($permissions['guest']) && $permissions['guest'] == 1)
                    @if(in_array($data[$i]->id, $sch_id))
                        <button class="btn btn-default follow-sch" style="margin-top: 20px; padding: 6px 30px;"><i class="fa fa-heart"></i>Following</button>
                    @else
                        {{ Form::open(array('class' => 'follow', 'route' => 'guest_follows')) }}
                        <input type="hidden" name="school_id" value="{{ $data[$i]->id }}">
                        <button class="btn btn-default follow-sch" style="margin-top: 20px; outline: none;"><i class="fa fa-heart"></i>Follow school</button>
                        {{ Form::close() }}
                    @endif
                @elseif(Sentry::check() && isset($permissions['user']) && $permissions['user'] == 1)
                    @if(in_array($data[$i]->id, $sch_id))
                        <button class="btn btn-default follow-sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Your School</button>
                    @else
                        <button class="btn btn-default not_follow_sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Not Allowed</button>
                    @endif
                @else
                    {{ Form::open(array('class' => 'follow', 'route' => 'guest_follows')) }}
                    <input type="hidden" name="school_id" value="{{ $data[$i]->id }}">
                    <button class="btn btn-default follow-sch" style="margin-top: 20px;"><i class="fa fa-heart"></i>Follow school</button>
                    {{ Form::close() }}
                @endif
                <a href="#">
                    <button class="btn btn-default sch-profile" style="margin-top: 20px;"><i class="fa fa-eye"></i>View Full Profile</button>
                </a>
            </div>
        @endfor

    </div>
@stop
