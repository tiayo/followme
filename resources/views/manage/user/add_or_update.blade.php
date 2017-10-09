@extends('manage.layouts.app')

@section('title', '添加/管理理发师')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理专区</a></li>
    <li navValue="nav_0_1"><a href="#">添加/管理理发师</a></li>
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
                添加/管理理发师
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-sm-2 control-label">登录账号</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="email" placeholder="填写邮箱"
                                   name="email" value="{{ $old_input['email'] }}"
                                   @if($sign == 'update') readonly @elseif($sign == 'add') required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">姓名</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}"
                                   @if($sign == 'update') readonly @elseif($sign == 'add') required @endif>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">手机</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="phone" name="phone" value="{{ $old_input['phone'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-2 col-sm-2 control-label">类型</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="type" name="type">
                                @foreach(config('site.manager_group') as $key => $group)
                                    {{--不允许添加管理员--}}
                                    @if($key != 99)
                                        <option value="{{ $key }}">{{ $group }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="introduce" class="col-sm-2 col-sm-2 control-label">介绍</label>
                        <div class="col-sm-3">
                            <textarea class="form-control" id="introduce" name="introduce" required>{{ $old_input['introduce'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 col-sm-2 control-label">密码</label>
                        <div class="col-sm-3">
                            {{--避免自动填充--}}
                            <input type="password" id="old_password" name="password" class="hidden" disabled>
                            {{--有输入时才填入name--}}
                            <input type="password" class="form-control" id="password" autoComplete="off" placeholder="放空则使用默认值或不做修改">
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
