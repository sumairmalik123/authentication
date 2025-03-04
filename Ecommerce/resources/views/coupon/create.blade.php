@extends('layouts/userlayout/app')
<!--content section-->
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
        <div class="col-sm-6">
                <h1>Create Coupon</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('coupon.list')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="col">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ Session::get('success') }}
            </div>
            @endif
            
            @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible __web-inspector-hide-shortcut__">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4> {{ Session::get('error') }}
            </div>
            @endif
                  
        </div>
        <form action="" method="post" id="discountForm" name="discountForm">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Coupon Code">
                                <p></p>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Coupon Code Name">
                                <p></p>		
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Max Uses</label>
                                <input type="number" name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">
                                <p></p>		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Max Uses User</label>
                                <input type="text" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">
                                <p></p>		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="percent">Percentage</option>
                                <option value="fixed">Fixed</option>
                                </select>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Discount Amount</label>
                                <input type="text" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                                <p></p>		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Min Amount</label>
                                <input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">
                                <p></p>		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                <option value="0">Block</option>
                                </select>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Starts At </label>
                                <input autocomplete="off" type="text" name="starts_at" id="starts_at" class="form-control" placeholder="Starts At">
                                <p></p>		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Expires At </label>
                                <input autocomplete="off" type="text" name="expires_at" id="expires_at" class="form-control" placeholder="Expires At">
                                <p></p>		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>                                <p></p>	
                            </div>
                        </div>  										
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('coupon.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
<!--custom js section-->
@section('customjs')
<script>
    $(document).ready(function() {
        $('#starts_at').datetimepicker({
            format:'    Y-m-d H:i:s',
        });
        $('#expires_at').datetimepicker({
            format:'    Y-m-d H:i:s',
        });
    });


    $(document).ready(function() {
        $("#discountForm").submit(function(event){
            event.preventDefault();
            var formData = $(this); 
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("coupon.store") }}',
                type: 'post',
                data: formData.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);
                    if(response['status'] == true){
                        window.location.href = "{{ route('coupon.list') }}";
                        //window.location.href = "{{ route('categories.list') }}";
                        $('#code').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");

                        $('#discount_amount').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                        $('#starts_at').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                        $('#expires_at').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                    } else {
                        var error = response['errors'];
                    if(error['code']){
                        $('#code').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback')
                        .html(error['code']);
                    } else {
                        $('#code').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                    }
                    if(error['discount_amount']){
                        $('#discount_amount').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback')
                        .html(error['discount_amount']);
                    } else {
                        $('#discount_amount').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                    }
                    if(error['starts_at']){
                        $('#starts_at').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback')
                        .html(error['starts_at']);
                    } else {
                        $('#starts_at').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                    }
                    if(error['expires_at']){
                        $('#expires_at').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback')
                        .html(error['expires_at']);
                    } else {
                        $('#expires_at').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback')
                        .html("");
                    }
                    } 
                }, 
                error: function(jqXHR, exception){
                    console.log("Something went wrong");
                }
            });
        });
    });
    </script>
@endsection