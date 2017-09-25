@extends('manage.layouts.app')

@section('title', '添加/管理商品')

@section('style')
    @parent
    {{--编辑器--}}
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.all.min.js') }}"> </script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理专区</a></li>
    <li navValue="nav_0_3"><a href="#">添加/管理商品</a></li>
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
                添加/管理商品
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">商品名称</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 col-sm-2 control-label">价格</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="price" name="price" value="{{ $old_input['price'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-sm-2 col-sm-2 control-label">积分</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="score" name="score" value="{{ $old_input['score'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 col-sm-2 control-label">介绍</label>
                        <div class="col-sm-10">
                            <script id="editor" type="text/plain" name="description">
                                {!! $old_input['description'] or '' !!}
                            </script>
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
            });

            //开启编辑器
            UE.getEditor('editor')
        })
    </script>
@endsection
