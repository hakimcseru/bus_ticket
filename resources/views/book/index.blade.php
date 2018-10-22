@extends('layouts.app')
<?php
use App\Category;
?>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Book Journal and Seminar list</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('book.create') }}"> Create</a>
            </div>
        </div>
    </div>
    <!----------------------search start-------------------------->
    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('route' => 'book.index','method'=>'GET')) !!}
            <div class="input-group">
                {!! Form::text('search', null, array('placeholder' => 'Search for...','class' => 'form-control')) !!}
                <span class="input-group-btn">
                 {!! Form::submit('Go!', ['class' => 'btn btn-default']) !!}
                </span>
            </div><!-- /input-group -->
            {!! Form::close() !!}
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <!----------------------search end-------------------------->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                @if ($message = Session::get('update_success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if ($returnData = Session::get('success'))


                        <div id="myModalOnLoad" class="modal fade" role="dialog">


                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">QR code</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div  class="media">
                                            <div id="pQrDiv" class="media-left">
                                                <a href="#">
                                                    <?php
                                                    $qrs = json_decode($returnData['Qr_DD_PRINT']);
                                                    foreach ($qrs as $qr){
                                                    ?>

                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(".$qr.")) !!} ">

                                                    <?php }?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-success" value="Print" onclick="javascript:printDiv('pQrDiv')" />
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>

                        </div>


                    <div class="alert alert-success">
                        <p>{{ $returnData['message'] }}</p>
                    </div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <!--<th>QR</th>-->
                        <th>Title</th>
                        <th>Type</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Category</th>
                        <!--<th>Tag</th>-->
                        <th>Self</th>
                        <th>Rack</th>
                        <th>Cover Photo</th>
                        <th>PDF</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <!--<td>
                                <img style="width: 100px" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(500)->generate(".$item->qr_string.")) !!} ">

                            </td>-->
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->author }}</td>
                            <td>{{ $item->publisher }}</td>
                            <td>

                                <?php
                                    $category = json_decode($item->category);
                                    foreach ($category as $sub){
                                        $sInfo = Category::where('id',$sub)->first();
                                        echo '<span style="background-color: #bb364c;" class="badge badge-light">' . $sInfo->name.'</span>',' ';
                                    }
                                ?>

                            </td>

                            <!--<td>

                                <?php
                                if($item->taggles == !null){
                                    $taggles = json_decode($item->taggles);

                                    foreach ($taggles as $key=>$val){

                                        echo '<span style="background-color: #ee4157;" class="badge badge-light">'. $val.'</span>',' ';
                                    }
                                }

                                ?>

                            </td>-->

                            <td>{{ $item->self }}</td>
                            <td>{{ $item->rack }}</td>
                            <td><img src="{{Request::root()}}/uploads/books/{{ $item->cover_photo }}" width="80" height="100"></td>


                            <td>
                                <?php
                                if( $item->file == !null){
                                ?>
                                <a class="btn btn-info" target="_blank" href="{{Request::root()}}/uploads/books/{{ $item->file }}">View</a>
                                <?php } else { echo 'Nothing Found!';}?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?php echo $item->id;?>">
                                    QR
                                </button>
                                <a class="btn btn-info" href="{{ route('book.show',$item->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('book.edit',$item->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['book.destroy', $item->id],'style'=>'display:inline', 'class'=>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <div class="modal fade" id="myModal<?php echo $item->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">QR {{ $item->title }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="home<?php echo $item->id;?>">

                                                    <div  class="media">
                                                        <div id="pQrDiv<?php echo $item->id;?>" class="media-left">
                                                            <a href="#">
                                                                <?php
                                                                $qrs = json_decode($item->qr_string);
                                                                foreach ($qrs as $qr){
                                                                ?>

                                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(".$qr.")) !!} ">

                                                                <?php }?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form>
                                            <input type="button" class="btn btn-success" value="Print" onclick="javascript:printDiv('pQrDiv<?php echo $item->id;?>')" />
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>

                    {!! $items->appends(Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

@endsection

@section('ownjs')


    <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModalOnLoad').modal('show');
        });
    </script>

    <script>
        $(".delete").on("submit", function(){
            return confirm("Do you want to delete this?");
        });
    </script>



    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
                "<body><div style='text-align:center;'><h2>Bangladesh Institute of International and Strategic Studies (BIISS)</h2><h4>Books Info For Print</h4></div>" +
                divElements + "</body>";

            //Print Page
            window.print();

            //location.reload(true);

            //Restore orignal HTML

            document.body.innerHTML = oldPage;

            var url = "{{Request::root()}}/dashboard/book";
            window.location.href = url;


        }



    </script>


@endsection