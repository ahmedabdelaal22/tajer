@extends(DSHI.'.master')
@section('content')

       <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline inbox buttons two primary sp_color">
            <?php $count= count($messages);?>
                <h4>Inbox Messages ({{$count}})</h4>

            </div>
    
            <div class="inbox-messages-preview full">
             
                <div class="inbox-message-preview">
      

                    <div class="inbox-message-preview-body">
						<div class="comment-list">


                        <?php foreach($messages as $value) {?>
						
							<div class="comment-wrap">
						
								<a href="dashboard-openmessage.php">
				
                        @if($value->s_image !='')
                     		<figure class="user-avatar medium">
										<img src="{{ asset('public/uploads/user_img')}}/{{$value->s_image}}" alt="">
				            </figure>
                        @else
                        

                        		<figure class="user-avatar medium">
										<img src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" alt="">
									</figure>
                        @endif

								</a>
							
							
								<div class="comment">
									<p class="text-header">{{$value->s_name}}</p>
									<p class="timestamp">{{$value->msg_date}}</p>
									
																		<p class="mytext">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

									
								<div class="btns report">
                                       <button type="button" class="cancle" data-target="#deletrow{{$value->id}}" data-toggle="modal" data-whatever="@mdo">
                                                        <span>  {{ trans('cpanel.Delete') }} </span>
                                                    </button>
                                </div>
								</div>
								
								
							</div>

                      
                        
                          
 
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
							<hr class="line-separator">
                                                        
                                                        
                    <div class="modal fade" id="deletrow{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog dashboard" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    {{trans('Are_you_sure_delete_this_message_?')}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Close')}}</button>
                                    <a href="{{lang_url('delete_mesage').'/'.$value->id}}">
                                        <button type="button" class="btn btn-primary">{{trans('Save changes')}}</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
		
                          <?php }?>

                            
     
						</div>
						
                    </div>
                </div>
                <!-- /INBOX MESSAGE PREVIEW -->
            </div>
            <!-- /INBOX MESSAGES PREVIEW -->
        </div>
        <!-- DASHBOARD CONTENT -->
@stop