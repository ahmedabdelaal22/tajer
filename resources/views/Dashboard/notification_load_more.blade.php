@foreach($data['notificatins'] as $row)
<?php
//Carbon::setLocale($locale);
?>
<div class="profile-notification"id="row{{$row->id}}">

    <div class="notification-close" onclick="delte_notfication('{{$row->id}}')"></div>

    <div class="profile-notification-date">
        <p>{{$row->created_at->diffForHumans()}}</p>
    </div>
    <div class="profile-notification-body">
        <figure class="user-avatar">

            @if($row->User->image !='')
            <img  id="blah" src="{{ asset('public/uploads/user_img')}}/{{$row->User->image}}"alt="{{$row->User->name}}" />
            @else
            <img id="blah" src="{{ asset('public/assets/'.DSH .'/images/dashboard/profile-default-image.png')}}" alt="{{$row->User->name}}">
            @endif


        </figure>
        <p>
            <span>{{$row->User->name}}</span> {{trans('cpanel.'.$row->notification)}} <span>{{$row->price}}</span> {{trans('cpanel.on')}}
            <a href="{{lang_url('dashboard/items/'.$row->Items->id)}}">{{$row->Items->title}}</a> </p>
    </div>
    <div class="profile-notification-type">
        <?php
        if ($row->Items->type == 2) {
            if ($row->Items->bids_id == 0) {
                ?>

 <button type="button" class="button medium secondary" onclick="accept_price('{{$row->Items->id}}','{{$row->sender_id}}','{{$row->price}}')">
                    {{trans('cpanel.acpet')}}
    </button>
                
            <?php } elseif ($row->Items->bids_id == $row->delete) { ?>
                <span class="ok button medium btn btn-success "> {{trans('cpanel.Accepted')}}</span>
            <?php } else { ?>
                <span class="notok button medium btn btn-danger">{{trans('cpanel.Not_Accepted')}}</span>
            <?php } ?>
        <?php } ?>



<!--        <span class="type-icon icon-star primary"></span>-->
    </div>
</div>
@endforeach
