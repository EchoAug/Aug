@extends("admin.layout.main")

@section("content")
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">增加权限</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="/admin/permission/store" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <label>上级权限</label>
                                <select class="form-control select2" name="pid">
                                    <option selected="selected" value="0">顶级分类</option>
                                    @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">
                                        {{str_repeat('-',($permission->level * 4))}}
                                        {{$permission->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label >权限名</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label >权限标题</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>描述</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection