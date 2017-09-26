@extends('manage.layouts.app')

@section('title', '添加/管理门店')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理专区</a></li>
    <li navValue="nav_0_5"><a href="#">添加/管理门店</a></li>
@endsection

@section('body')
    <div class="col-md-12">

        <!--错误输出-->
        <div class="form-group">
            <div class="alert alert-danger fade in @if(!count($errors) > 0) hidden @endif" id="alert_error">
                <a href="#" class="close" data-dismiss="alert">×</a>
                <span>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </span>
            </div>
        </div>

        <section class="panel">
            <header class="panel-heading">
                添加/管理门店
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" enctype="multipart/form-data" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">名称</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 col-sm-2 control-label">头像</label>
                        <div class="col-sm-3">
                            <input type="file" id="avatar" name="avatar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 col-sm-2 control-label">地址</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="address" name="address" value="{{ $old_input['address'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">电话</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $old_input['phone'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 col-sm-2 control-label">介绍</label>
                        <div class="col-sm-3">
                            <textarea class="form-control" id="description" name="description" required>{{ $old_input['description'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div  class="col-sm-2 col-sm-2 control-label">
                            <button class="btn btn-success" type="submit"><i class="fa fa-cloud-upload"></i> 确认提交</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {
            $('#password').bind('input propertychange', function() {
                $(this).attr('name', 'password')
            })
        })
    </script>
@endsection
