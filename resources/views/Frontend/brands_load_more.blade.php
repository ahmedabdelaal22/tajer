@foreach($data['Brands'] as $row)
                <div class="col-lg-3">
                    <div class="box-img">
                        <img src="{{ asset($row->image)}}">
                    </div>
                </div>
  
  
   
<!-- asset('public/assets/'.FE .'/Images/Demo/brand_1.png')
    -->

@endforeach