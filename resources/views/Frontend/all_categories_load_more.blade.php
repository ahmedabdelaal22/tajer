@foreach($data['categories'] as $row)
<?php $title = $data['locale'].'_title'; ?>

                <a href="{{lang_url('categories/'.$row->id)}}" class="col-lg-3">
                    <div class="box-img box-catagory">
                        <img src="{{ asset($row->image)}}">
                        
                        <h3 class="text-center"> {{$row->$title}}</h3>
                    </div>
                </a>
  

<!-- asset('public/assets/'.FE .'/Images/Demo/brand_1.png')
    -->

@endforeach