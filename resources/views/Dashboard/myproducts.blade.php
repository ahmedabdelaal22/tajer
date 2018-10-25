@extends(FEI.'.master')
@section('content')
@include("Frontend.include.subHeader")
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            <div class="btn-act">
                <button class="btn btn-block btn-add" onclick="location='{{lang_url('dashboard/items/create')}}'">أضف</button>
                <button class="btn btn-block btn-edit" onclick="edititem()">تعديل</button>
                <button class="btn btn-block btn-delete" onclick="cleare()">حذف</button>
            </div> 

            </div>
            <div class="col-lg-9">
                <div class="prodect">
                    <div class="row">
                        <div class="col-12 text-left">
                            <button class="btn  grid">
                                <i class="fa fa-th fa-2x "></i>
                            </button>
                            <button class="btn list">
                                <i class="fa fa-th-list fa-2x active "></i>
                            </button>

                        </div>
                        <div class="col-12">
                            <div class="row">
                      
                        
                                @foreach ($all_data as $row_data)
                                <div class="col-lg-12 g-l" id="row{{$row_data->id}}">
                                        <label class="box-prodect lbl-prodect">
                                            <input type="radio" name="prodect" value="{{$row_data->id}}">
                                            <span class="input-span"><span>
                                                <div class="row">
                                                        <div class="col-lg-4 img-col text-center">
                                                           
                                                                <img src="{{ asset($row_data->thumbnail_image)}}" alt="{{$row_data->title}}">
                                                          
                                                            <span class="sell">{{@$row_data->ratio}}%</span>
                                                            <i class="fa fa-heart-o"></i>
                                                        </div>
                                                        <div class="col-lg-8 col-info">
                                                           <div class="info">
                                                                <p class="text-lg-right text-sm-center">{{$row_data->title}}</p>
                                                            <span class="price text-lg-right text-sm-center d-lg-inline-block d-sm-block">{{ $row_data->discount_price }}</span>
                                                            <span class="old-price text-lg-right text-sm-center d-lg-inline-block d-sm-block">{{ $row_data->fixed_price }}</span>
                                                           <a href="{{lang_url('dashboard/items/'.$row_data->id)}}" class="btn btn-info mr-lg-0 ml-lg-0 mr-sm-auto ml-sm-auto">{{trans('cpanel.view')}}</a>
                                                           </div>
                                                        </div>
                                                 </div>
                                         </label>
                                </div>
                                @endforeach
                           
                               

                              
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function cleare(){
        var row=$("input[name='prodect']:checked").val();
        var answer = confirm("Are you sure you want to delete from this item?");
        if (answer && row)
        {
            $.ajax({
                type: "Get",
                url: "<?php echo url('ar/delete'); ?>",
                data: {row: row},
                dataType: 'text', // Define data type will be JSON
                success: function (data) {
        
               $('#row'+row).hide();
        

                },
                error: function (err) {
                    console.log(err.error);
                }
            });
        }
    
    }

      function edititem(){
        var row=$("input[name='prodect']:checked").val();
        if(row){

            
window.location = "{{lang_url('dashboard/items')}}"+'/'+ row +'/edit/';
}
}
 
    
</script>
@stop




