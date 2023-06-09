@extends('layouts.template')

@section('title','Profile')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('app.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('app.profile')}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item shadow mb-3 mr-2">
                        <a class="nav-link active" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">{{__('app.account_details')}}</a>
                      </li>
                      <li class="nav-item shadow mb-3 mr-2">
                        <a class="nav-link" id="login-details-tab" data-toggle="tab" href="#login-details" role="tab" aria-controls="login-details" aria-selected="false">{{__('app.login_details')}}</a>
                      </li>
                      @if(setting('2fa'))
                      <li class="nav-item shadow mb-3 mr-2">
                        <a class="nav-link" id="tfa-settings-tab" data-toggle="tab" href="#tfa-settings" role="tab" aria-controls="tfa-settings" aria-selected="false">{{__('app.two_factor_auth')}}</a>
                      </li>
                      @endif
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content mt-3 mx-0">
                        <div class="tab-pane active" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                              <form class="form-horizontal" method="POST" action="{{route('profile.update',$user->id)}}">
                                  @csrf
                                  @method('put')
                                  <div class="row form-group">
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.role')}}</label></div>
                                      <input type="text" name="role" value="{{($role)? $role->name:'Role Not Set'}}" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.status')}}</label></div>
                                      <select class="form-control" name="status" disabled>
                                        <option value="active" {{($user->status == 'active')? 'SELECTED':''}}>{{$user->status}}</option>
                                        <option value="active" {{($user->status == 'banned')? 'SELECTED':''}}>{{$user->status}}</option>
                                      </select>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.lastname')}}</label></div>
                                      <input type="text" name="lastname" value="{{ $user->lastname }}" class="form-control" >
                                        @if ($errors->has('lastname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.address')}}</label></div>
                                      <input type="text" name="address" value="{{$user->address}}" class="form-control" placeholder="Address" >
                                      @if ($errors->has('address'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('address') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.firstname')}}</label></div>
                                      <input type="text" name="firstname" value="{{ $user->firstname }}" class="form-control" >
                                        @if ($errors->has('firstname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.zipcode')}}</label></div>
                                      <input type="text" name="zipcode" value="{{$user->zipcode}}" class="form-control" placeholder="Zip Code" >
                                      @if ($errors->has('zipcode'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('zipcode') }}</strong>
                                          </span>
                                      @endif
                                    </div>

                                    <div class="col-md-6 mt-1">
                                      <label for="mobile">{{__('app.gender')}}</label>
                                      <select name="gender" class="form-control form-control-inline-block">
                                        
                                          <option value="Male" {{ ($user->gender == 'Male')? 'selected':'' }}>Male</option>
                                          <option value="Female" {{ ($user->gender == 'Female')? 'selected':'' }}>Female</option>
                                        
                                          @if ($errors->has('gender'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('gender') }}</strong>
                                          </span>
                                          @endif
                                      </select>
                                    </div>

                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.pass_country')}}</label></div>
                                      <input type="text" name="pass_country" value="{{$user->pass_country}}" class="form-control" placeholder="{{__('app.pass_country')}}" >
                                      @if ($errors->has('pass_country'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('pass_country') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                    
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.birthday')}}</label></div>
                                      <input type="date" name="birth_date" value="{{$user->birth_date}}" class="form-control" placeholder="Birthday" >
                                      @if ($errors->has('birth_date'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('birth_date') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.pass_number')}}</label></div>
                                      <input type="text" name="pass_number" value="{{$user->pass_number}}" class="form-control" placeholder="Passport No." >
                                      @if ($errors->has('pass_number'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('pass_number') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mt-1">
                                      <div><label class="label-block">{{__('app.phone')}}</label></div>
                                      <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Phone" >
                                      @if ($errors->has('phone'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('phone') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                    
                                    <div class="col-md-6 mt-1">
                                      <label for="mobile">{{__('app.ethnicity')}}</label>
                                      <select name="ethnicity" class="form-control form-control-inline-block">
                                          <option value="white" {{ ($user->ethnicity == 'white')? 'selected':'' }}> White / Caucasian </option>
                                          <option value="hispanic" {{ ($user->ethnicity == 'hispanic')? 'selected':'' }}> Hispanic or Latino </option>
                                          <option value="indian" {{ ($user->ethnicity == 'indian')? 'selected':'' }}> American Indian or Alaska Native </option>
                                          <option value="asian" {{ ($user->ethnicity == 'asian')? 'selected':'' }}> Asian </option>
                                          <option value="black" {{ ($user->ethnicity == 'black')? 'selected':'' }}> Black or African American </option>
                                          <option value="islander" {{ ($user->ethnicity == 'islander')? 'selected':'' }}> Native Hawaiian or Other Pacific Islander </option>
                                          <option value="other" {{ ($user->ethnicity == 'other')? 'selected':'' }}> Other </option>
                                        
                                          @if ($errors->has('ethnicity'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('ethnicity') }}</strong>
                                          </span>
                                          @endif
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-8 mx-auto">
                                    <button type="submit" class="btn btn-primary col-sm-12">{{__('app.update_account')}}</button>
                                  </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="login-details" role="tabpanel" aria-labelledby="login-details-tab">
                          <form class="form-horizontal" method="POST" action="{{route('update-login',$user->id)}}">
                              @csrf
                                  <div class="row form-group">
                                        <div class="col-md-6">
                                          <div><label class="label-block">{{__('app.email')}}</label></div>
                                          <input type="text" name="email" value="{{$user->email}}" class="form-control" >
                                          @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-6">
                                          <div><label class="label-block">{{__('app.username')}}</label></div>
                                          <input type="text" name="username" value="{{$user->username}}" class="form-control" autocomplete="off">
                                          @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-6 my-1">
                                          <div><label class="label-block">{{__('app.password')}}</label></div>
                                          <input type="password" name="password" value="" placeholder="{{__('app.leave_blank')}}" class="form-control" autocomplete="off">
                                          @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-6 my-1">
                                          <div><label class="label-block">{{__('app.confirm_password')}}</label></div>
                                          <input type="password" name="password_confirmation" value="" placeholder="{{__('app.leave_blank')}}" class="form-control" autocomplete="off">
                                          @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-8 mx-auto">
                                  <button type="submit" class="btn btn-primary col-sm-12">{{__('app.update_login')}}</button>
                                </div>
                          </form>
                        </div>
                        @if(setting('2fa'))
                        <div class="tab-pane" id="tfa-settings" role="tabpanel" aria-labelledby="tfa-settings-tab">
                          <!--Google Two Factor Authentication card-->
                          <div class="col-md-12">
                            @include('layouts.includes.alerts')
                            @if(empty(auth()->user()->google2fa))
                            <!--=============Generate QRCode for Google 2FA Authentication=============-->
                                  <div class="row p-0">
                                    <div class="col-md-12">
                                          <p>{{__('app.to_activate_2fa')}}</p>
                                    </div>
                                  <div class="col-md-12">
                                    <form class="" action="{{route('activate-2fa')}}" method="post">
                                      @csrf
                                      <button class="btn btn-primary col-md-6">{{__('app.activate_2fa')}}</button>
                                      <a class="btn btn-secondary col-md-5" data-toggle="collapse" href="#collapseExample"
                                      role="button" aria-expanded="false" aria-controls="collapseExample">{{__('app.setup_instruction')}}</a>
                                    </form>
                                  </div>
                                  <div class="col-md-12 mt-3 collapse" id="collapseExample">
                                    <hr>
                                    <h3 class="">{{__('app.2fa_instruction_1')}}</h3>
                                    <hr>
                                   <div class="mt-4">
                                          <h4>{{__('app.2fa_instruction_2')}}</h4>
                                          <p><label>{{__('app.step_1')}}:</label> {{__('app.download')}} <strong>{{__('app.google_auth')}}</strong> {{__('app.app_for_andriod_or_ios')}}</p>
                                          <p class="text-center">
                                            <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"
                                            class="btn btn-success">{{__('app.download_for_android')}}<i class="fa fa-android fa-2x ml-2"></i></a>
                                            <a href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_blank"
                                            class="btn btn-dark ml-2">{{__('app.download_for_iPhones')}}<i class="fa fa-apple fa-2x ml-2"></i></a></p>
                                          <p><label>{{__('app.step_2')}}:</label> {{__('app.click_on_generate_secret')}}</p>
                                          <p><label>{{__('app.step_3')}}:</label> {{__('app.open_the')}} <strong>{{__('app.google_auth')}}</strong> {{__('app.and_click_on')}} <strong>{{__('app.begin')}}</strong> {{__('app.on_the_mobile_app')}}</p>
                                          <p><label>{{__('app.step_4')}}:</label> {{__('app.after_which_click_on')}} <strong>{{__('app.scan_a_QRcode')}}</strong></p>
                                          <p><label>{{__('app.step_5')}}:</label> {{__('app.then_scan_the_barcode_on')}}</p>
                                          <p><label>{{__('app.step_6')}}:</label> {{__('app.enter_the_verification_code')}}</p>
                                          <hr>
                                          <p><label>{{__('app.note')}}:</label> {{__('app.to_diasable_2fa_enter')}}</p>
                                   </div>
                                  </div>
                                </div>
                            <!--=============Generate QRCode for Google 2FA Authentication=============-->
                            @elseif(!auth()->user()->google2fa->google2fa_enable)
                            <!--=============Enable Google 2FA Authentication=============-->
                              <form class="form-horizontal" method="POST" action="{{route('enable-2fa')}}">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12"><p><strong>{{__('app.scan_the_qrcode_with')}} <dfn>{{__('app.google_auth')}}</dfn> {{__('app.and_enter_the_generated_code_below')}}</strong></p></div>
                                        <div class="col-md-12"><img src="{{$generated}}" /></div>
                                        <div class="col-md-12">
                                        <p>{{__('app.to_enable_2fa_auth_verify_qrcode')}}</p>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="address" class="control-label">{{__('app.verification_code')}}</label>
                                          <input type="text" name="code" class="form-control" id="code" placeholder="{{__('app.enter_verification_code')}}">
                                          @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                      </div>
                                    <div class="col-md-8 mx-auto m-2">
                                      <button type="submit" class="btn btn-primary col-sm-12">{{__('app.enable_2fa')}}</button>
                                    </div>
                              </form>
                            <!--=============Enable Google 2FA Authentication=============-->
                            @elseif(auth()->user()->google2fa->google2fa_enable)
                            <!--=============Disable Google 2FA Authentication=============-->
                              <form class="form-horizontal" method="POST" action="{{route('disable-2fa')}}">
                                @csrf
                                    <div class="row">
                                          <div class="col-md-12"><img src="{{$generated}}" /></div>
                                          <div class="col-md-12">
                                               <p>{{__('app.to_disable_2fa_auth_verify_qrcode')}}</p>
                                          </div>
                                          <div class="col-sm-12">
                                              <label for="address" class="control-label">{{__('app.verification_code')}}</label>
                                              <input type="text" name="code" class="form-control" id="code" placeholder="{{__('app.enter_verification_code')}}">
                                              @if ($errors->has('code'))
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                              @endif
                                          </div>
                                          <div class="col-sm-12">
                                                <label for="address" class="control-label">{{__('app.current_password')}}</label>
                                                <input id="password" type="password" placeholder="{{ __('Current Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error('password')}}</strong>
                                                  </span>
                                                @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-8 mx-auto m-2">
                                        <button type="submit" class="btn btn-danger col-sm-12">{{__('app.disable_2fa')}}</button>
                                      </div>
                              </form>
                            <!--=============Disable Google 2FA Authentication=============-->
                            @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          </div>

    </section>
          <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
