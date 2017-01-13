<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 2/27/16
     * Time: 9:15 PM
     */
    class MessageController extends \BaseController {

        public function getSchoolInboxPage(){
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $schools = $new->schools;
            $message = $this->getMessageReceive();
            $message_s = $this->getMessageSent();
            return View::make('school-admin.inbox')
                ->with('schools', $schools)
                ->with('messages', $message)
                ->with('message_s', $message_s);
        }

        public function getSchoolComposePage($slug){
            $school = School::findBySlug($slug);
            $receiver =  Input::get('receiver');
            $subject = Input::get('subject');
            $subject = 'Re: '.$subject;
            $message = $this->getMessageSent();
            $message_r = $this->getMessageReceive();
            if(isset($receiver) && !empty($receiver) && !empty($subject) && isset($subject)){
                $user = User::find($receiver);
                $to = $user->first_name." ".$user->last_name." (Follower)";
                return View::make('school-admin.compose')
                    ->with('school', $school)
                    ->with('to', $to)
                    ->with('subject', $subject)
                    ->with('id', $receiver)
                    ->with('message', $message)
                    ->with('message_r', $message_r);
            }
            return View::make('school-admin.compose')
                ->with('school', $school)
                ->with('message', $message)
                ->with('message_r', $message_r);
        }

        public function getGuestInboxPage(){
            $message_r = $this->getMessageReceive();
            $message_s = $this->getMessageSent();
            return View::make('guest.inbox')
                ->with('messages', $message_r)
                ->with('message_s', $message_s);
        }

        public function getGuestComposePage($slug){
            $message = $this->getMessageSent();
            $message_r = $this->getMessageReceive();
            $school = School::findBySlug($slug);
            $school_owner_id = $school->user()->first()->id;
            $msg_to = User::find($school_owner_id)->first_name." ".User::find($school_owner_id)->last_name;
            $receiver =  Input::get('receiver');
            $subject = Input::get('subject');
            $subject = 'Re: '.$subject;

            if(isset($receiver) && !empty($receiver) && !empty($subject) && isset($subject)){
                $usr = User::find($receiver);
                $to = $usr->first_name." ".$usr->last_name;
                return View::make('guest.compose')
                    ->with('school', $school)
                    ->with('to', ucfirst($to))
                    ->with('subject', $subject)
                    ->with('message', $message)
                    ->with('message_r', $message_r)
                    ->with('school_owner_id', $school_owner_id);
            }
            return View::make('guest.compose')
                ->with('school', $school)
                ->with('message', $message)
                ->with('message_r', $message_r)
                ->with('school_owner_id', $school_owner_id)
                ->with('msg_to', $msg_to);
        }

        public function sentMessage(){
            $message = $this->getMessageSent();
            $message_r = $this->getMessageReceive();
            return View::make('guest.sent')
                ->with('messages', $message)
                ->with('message_r', $message_r);
        }

        public function sentSchoolMessage(){
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $schools = $new->schools;
            $message = $this->getMessageSent();
            $message_r = $this->getMessageReceive();
            return View::make('school-admin.sent')
                ->with('messages', $message)
                ->with('message_r', $message_r)
                ->with('schools', $schools);
        }

        public function postMessage(){
            if ( Session::token () !== Input::get ( '_token' ) && Input::get ( 'id' ) == '' )
            {
                return Response::json ( [
                    'error_msg' => 'Unauthorized attempt to create setting'
                ] );
            }

            if(Input::get('receiver') != '' &&
                Input::get('slug') != '' &&
                Input::get('subject') != '' &&
                Input::get('body') != '' &&
                Input::get('id') != ''
            ){
                //Get current loggedin in user
                $user = Sentry::getUser();
                $per = $user->getPermissions();
                if(isset($per['user'])){
                    $message = new Message([
                        'sender' => $user->id,
                        'sender_identity' => $user->first_name." ".$user->last_name." (School Admin)",
                        'receiver' => Input::get('id'),
                        'receiver_identity' => User::find(Input::get('id'))->first_name." ".User::find(Input::get('id'))->last_name,
                        'subject' => Input::get('subject'),
                        'body' => Input::get('body'),
                        'school_slug' => Input::get('slug'),
                        'read' => 1
                    ]);

                    if($user->messageSent()->save($message)){
                        return Response::json ( [
                            'save' => 'Email Sent to School Follower'
                        ] );
                    }else{
                        return Response::json ( [
                            'error_msg' => 'Something went wrong!, try again'
                        ] );
                    }

                }elseif(isset($per['guest'])){
                    $message = new Message([
                        'sender' => $user->id,
                        'sender_identity' => $user->first_name." ".$user->last_name." (Follower)",
                        'receiver' => Input::get('id'),
                        'receiver_identity' => User::find(Input::get('id'))->first_name." ".User::find(Input::get('id'))->last_name,
                        'subject' => Input::get('subject'),
                        'school_slug' => Input::get('slug'),
                        'body' => Input::get('body'),
                        'read' => 1
                    ]);

                    if($user->messageSent()->save($message)){
                        return Response::json ( [
                            'save' => 'Email Sent to School'
                        ] );
                    }else{
                        return Response::json ( [
                            'error_msg' => 'Something went wrong!, try again'
                        ] );
                    }
                }
            }else{
                return Response::json ( [
                    'error_msg' => 'Please Make sure all the fields are filled.'
                ] );
            }
        }

        public function readSchoolMessage($id){
            $msg = Message::find($id);
            $msg->read = 0;
            $msg->save();
            $user = Sentry::getUser();
            $id = $user->id;
            $new = User::find ( $id );
            $schools = $new->schools;
            $message = $this->getMessageReceive();
            $message_sent = $this->getMessageSent();

            $per = $user->getPermissions();
            if(isset($per['guest'])){
                return View::make('guest.read')
                    ->with('schools', $schools)
                    ->with('messages', $message)
                    ->with('message', $msg)
                    ->with('message_sent', $message_sent);
            }elseif(isset($per['user'])){
                return View::make('school-admin.read')
                    ->with('schools', $schools)
                    ->with('messages', $message)
                    ->with('message', $msg)
                    ->with('message_sent', $message_sent);
            }
        }

        public function unReadSchoolMessage(){
            $user = Sentry::getUser();
            $id = $user->id;
            $msg = new Message;
            $msg = $msg->where('receiver', '=', $id)
                ->where('read','=',1)
                ->get();
            return Response::json ( [
                'data' => $msg
            ] );
        }

        protected function getMessageSent(){
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $message_sent = $new->messageSent;
            return $message_sent;
        }

        protected function getMessageReceive(){
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $message = $new->messageReceive;
            return $message;
        }
    }