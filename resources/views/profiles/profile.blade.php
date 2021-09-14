@extends('layouts.app')

@section('content')
      <div class="container">
            <div class="col-lg-4">
                  <div class="card">
                        <div class="card-header">                              
                              <p class="text-center">
                                    {{ $user->name }}'s Profile.
                              </p>
                        </div>
                        
                        <div class="card-body">
                              <center>
                                    <img src="{{ asset($user->avatar) }}" width="140px" height="140px" style="border-radius: 50%;" alt="">
                              </center>
                              <br><br>

                              <p class="text-center">
                                    {{ $user->profile->location }}
                              </p>
                              <br>
                              <p class="text-center">
                                    @if(Auth::id() == $user->id)
                                          <a href="{{ route('profile.edit',$user->slug) }}" class="btn btn-info">Edit your profile</a>
                                    @endif
                              </p>

                        </div>
                  </div>

                  @if(Auth::id() !== $user->id)
                        <div class="card">
                              <div class="card-body">
                                    <friend :profile_user_id="{{ $user->id }}"></friend>
                              </div>
                        </div>
                  @endif

                  <div class="card">
                        <div class="card-header">
                              <p class="text-center">
                                    About me .
                              </p>
                        </div>
                        <div class="card-body">
                              <p class="text-center">
                                    {{ $user->profile->about }}
                              </p>
                        </div>
                  </div>

            </div>
      </div>
@stop
