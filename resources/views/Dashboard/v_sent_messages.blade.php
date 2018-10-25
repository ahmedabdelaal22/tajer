@extends(DSHI.'.master')
@section('content')

       <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline inbox buttons two primary sp_color">
            <?php $count= count($messages);?>
                <h4>Sent Messages ({{$count}})</h4>

            </div>
            <!-- /HEADLINE -->

            <!-- INBOX MESSAGES PREVIEW -->
            <div class="inbox-messages-preview full">
                <!-- INBOX MESSAGE PREVIEW -->
                <div class="inbox-message-preview">
      

                    <div class="inbox-message-preview-body">
						<div class="comment-list">


                        <?php foreach($messages as $value) {?>
						
							<div class="comment-wrap">
								<!-- USER AVATAR -->
								<a href="dashboard-openmessage.php">
							



                        @if($value->r_image !='')
                     		<figure class="user-avatar medium">
										<img src="{{ asset('public/uploads/user_img')}}/{{$value->r_image}}" alt="">
									</figure>
                        @else
                        

                        		<figure class="user-avatar medium">
										<img src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" alt="">
									</figure>
                        @endif

								</a>
								<!-- /USER AVATAR -->
								<div class="comment">
									<p class="text-header">{{$value->r_name}}</p>
									<p class="timestamp">{{$value->msg_date}}</p>
								<div class="btns report">
                                    <button>  <span>  Delete </span>   </button>
                                </div>
								</div>
							</div>

							<hr class="line-separator">
		
                          <?php }?>

                            
     
						</div>
						<!-- /COMMENT LIST -->
                    </div>
                </div>
                <!-- /INBOX MESSAGE PREVIEW -->
            </div>
            <!-- /INBOX MESSAGES PREVIEW -->
        </div>
        <!-- DASHBOARD CONTENT -->
@stop