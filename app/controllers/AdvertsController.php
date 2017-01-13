<?php
    use Kamaln7\Toastr\Facades\Toastr;
    use GuzzleHttp\Client;
    use OAuth\Common\Exception\Exception;

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/5/16
     * Time: 7:06 PM
     */
    class AdvertsController extends \BaseController {
        public function index($slug){
            $adverts = Advert::all();
            $school = School::findBySlug($slug);
            $ad_signed = new AdvertSchool;
            $id = [];
            $data = $ad_signed
                ->where('school_id', '=', $school->id)
                ->where('canceled','=', 0)
                ->get();
            foreach($data as $d){
                $id[] = $d['advert_id'];
            }
            return View::make('school-admin.advert')
                ->with('school', $school)
                ->with('adverts', $adverts)
                ->with('data', $id);
        }

        public function getAdminAdvert(){
            $ads  = Advert::all();
            return View::make('site-admin.adverts.create')->with('ads', $ads);
        }

        public function adminBilling(){
            $bills = Billing::all();
            $canceled = Billing::onlyTrashed()->get();
            return View::make('site-admin.adverts.billing')
                ->with('bills', $bills)
                ->with('dels', $canceled);
        }

        public function createAdvert(){
            if(Input::get('name') != "" && Input::get('description') != "" && Input::get('price') != "" && Input::get('name') != "type"){
                $ad = Advert::where('name','=', Input::get('name'))->get();
                if(count($ad) > 0){
                    Toastr::error('There is already an Advert by this name', $title = 'Advert Exist');
                    return Redirect::route('admin_advert');
                }else{
                    $new_ad = new Advert(array(
                        'name' => Input::get('name'),
                        'description' => Input::get('description'),
                        'validity' => 30,
                        'price' => Input::get('price'),
                        'type' => Input::get('type'),
                    ));

                    if($new_ad->save()){
                        Toastr::success('Advert Created', $title = 'Success');
                        return Redirect::route('admin_advert');
                    }else{
                        Toastr::error('Something went wrong, please try again', $title = 'Error');
                        return Redirect::route('admin_advert');
                    }
                }
            }else{
                Toastr::error('Please fill in all the field and try again', $title = 'Error');
                return Redirect::route('admin_advert');
            }
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function advertSignUp(){
            $id = Input::get('id');
            $aid = Input::get('aid');
            if(Input::get('type') == 'video' && Input::get('video_url') == ""){
                return Response::json( [
                    'error_msg' => 'Please provide a youtube video url'
                ] );
            }else{
                return $this->typeSignUp( $id, $aid, Input::get('video_url'));
            }

            if(Input::get('type') == 'image'){
                return $this->typeSignUp( $id, $aid );
            }
        }

        public function advertCancel(){
            $id = Input::get('id');
            $aid = Input::get('aid');
            $count = 0;

            if(isset($id) && isset($aid)){
                $ad_signed = new AdvertSchool;
                $data = $ad_signed
                    ->where('school_id', '=', $id)
                    ->where('advert_id', '=', $aid)
                    ->get();
                foreach($data as $d){
                    $d->delete();
                    $count++;
                }
                $billing = new Billing;
                $bill_data = $billing
                    ->where('school_id', '=', $id)
                    ->where('advert_id', '=', $aid)
                    ->get();
                foreach($bill_data as $bill){
                    $bill->delete();
                    $count++;
                }
                if($count == 2){
                    return Response::json ( [
                        'save' => 'Your Subscription to '.Advert::find($aid)->name." has been canceled at your request"
                    ] );
                }else
                {
                    return Response::json( [
                        'error_msg' => 'Ooops! something went wrong'
                    ] );
                }
            }
        }

        /**
         * @param $id
         * @param $aid
         * @param $url
         * @return \Illuminate\Http\JsonResponse
         */
        protected function typeSignUp( $id, $aid, $url = null )
        {
            // create reference
            $school = School::find($id);
            $reference = $school->slug;
            $email = is_null($school->contact) ? Sentry::getUser()->email : $school->contact->info_email ;
            if(Input::get('qty') == 'monthly'){
                $payment = Input::get('price');
            }else{
                $payment = Input::get('price') * 12;
            }
            // Initialize Transaction using Curl
            // create base uri
//            $data_body = [
//                'reference' => $reference,
//                'amount' => $payment,
//                'email' => $email
//            ];
//            $data_body = json_encode($data_body);
//
//            try{
//                $ch = curl_init('https://api.paystack.co/transaction/initialize');
//
//                if(FALSE === $ch){
//                    throw new Exception('Failed to initialize');
//                }
//
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_body);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                    'Content-Type: application/json',
//                    'Content-Length: ' . strlen($data_body),
//                    'Authorization: ' .getenv('PAY_STACK_TEST_SECRET_KEY')
//                ));
//                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//
//                //execute post
////                curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
////                curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
//                curl_setopt($ch, CURLOPT_CAINFO, public_path().'/cacert.pem');
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                $result = curl_exec($ch);
//
//                if(false === $result){
//                    throw new Exception(curl_error($ch), curl_errno($ch));
//                }
//
//                //close connection
//                curl_close($ch);
//                dd($result, 'hello');
//            }catch(Exception $e){
//                trigger_error(sprintf(
//                    'Curl failed with error #%d: %s',
//                    $e->getCode(), $e->getMessage()),
//                    E_USER_ERROR);
//            }



            $client = new Client(
                [
                    'base_uri' => getenv('PAY_STACK_BASE_URI'),
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => getenv('PAY_STACK_TEST_SECRET_KEY')
                    ]
                ]
            );
            //Create data body
            $data_body = [
                'reference' => $reference,
                'amount' => $payment,
                'email' => $email
            ];
            $response = $client->post( getenv('PAY_STACK_BASE_URI').'/transaction/initialize', ['body' => json_encode($data_body)]);

            $body = $response->getBody();
            dd($body);




            //Redirect to payment page
            //comeback to callback url
            //Verify transaction
            //save data to AdvertSchool
            //save data to Billing
            //save data to PaymentDetails

            //change this based in the qty chosen
//            $numbers_of_days = Input::get( 'qty' ) * 30;
//            $ad_signed = new AdvertSchool;
//            $data = $ad_signed
//                ->where( 'school_id', '=', $id )
//                ->where( 'advert_id', '=', $aid )
//                ->get();
//            if ( count( $data ) > 0 )
//            {
//                return Response::json( [
//                    'error_msg' => 'You already subscribed to this advert'
//                ] );
//            } else
//            {
//                if ( isset($id) && isset($aid) )
//                {
//                    $new_ad = new AdvertSchool( [
//                        'advert_id'   => $aid,
//                        'school_id'   => $id,
//                        'video_url'   => $url,
//                        'qty'         => Input::get( 'qty' ),
//                        'name'        => Input::get( 'name' ),
//                        'type'        => Input::get( 'type' ),
//                        'payment'     => $payment,
//                        'duration'    => Input::get( 'qty' ) * 30,
//                        'expiry_date' => date( 'Y-m-d', strtotime( "+" . $numbers_of_days . "days" ) ),
//                        'canceled'    => 0
//                    ] );
//
//                    $new_billing = new Billing( [
//                        'school_id'   => $id,
//                        'advert_id'   => $aid,
//                        'school_slug' => School::find( $id )->slug,
//                        'advert_name' => Advert::find( $aid )->name,
//                        'payments'    => Input::get( 'qty' ) * Input::get( 'price' ),
//                        'duration'    => Input::get( 'qty' ) * 30,
//                        'qty'         => Input::get( 'qty' ),
//                        'date_end'    => date( 'Y-m-d', strtotime( "+" . $numbers_of_days . "days" ) )
//                    ] );
//
//                    if ( $new_ad->save() && $new_billing->save() )
//                    {
//                        return Response::json( [
//                            'save' => 'You have signed up for the ' . Advert::find( $aid )->name
//                        ] );
//                    } else
//                    {
//                        return Response::json( [
//                            'error_msg' => 'Ooops! something went wrong'
//                        ] );
//                    }
//                }
//            }
        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function suspendAdvert(){
            $ad_id = Input::get('uid');
            $advert = Advert::find($ad_id);
            $advert->status = 0;

            if($advert->save()){
                return Response::json( [
                    'save' =>  Advert::find( $ad_id )->name . ' has been suspended'
                ] );
            }else{
                return Response::json( [
                    'error_msg' => 'Ooops! something went wrong'
                ] );
            }

        }

        /**
         * @return \Illuminate\Http\JsonResponse
         */
        public function approveAdvert(){
            $ad_id = Input::get('uid');
            $advert = Advert::find($ad_id);
            $advert->status = 1;

            if($advert->save()){
                return Response::json( [
                    'save' =>  Advert::find( $ad_id )->name . ' has been Approved'
                ] );
            }else{
                return Response::json( [
                    'error_msg' => 'Ooops! something went wrong'
                ] );
            }
        }

        public function advertVerification(){

        }
    }