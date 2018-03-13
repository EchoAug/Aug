@extends("admin.layout.main")

@section("content")
    <!-- Main content -->
    <section class="content-header">
        <h1>
            后台角色
            <small>角色列表</small>
        </h1>
        <ol class="breadcrumb left">
            <li><a href="#"><i class="fa fa-dashboard"></i> 系统管理</a></li>
            <li><a href="#">角色管理</a></li>
            <li class="active">角色列表</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <a type="button" class="btn btn-info" href="/admin/user/create">创建角色</a>
                        </h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>角色名称</th>
                                <th>角色描述</th>
                                <th>操作</th>
                            </tr>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}.</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <div class="btn-group-xs">
                                            <button type="button" class="btn btn-default" href="">权限编辑</button>
                                            <button type="button" class="btn btn-default">权限删除</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection