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
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#role-create">创建权限</button>
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
                                            <button type="button" class="btn btn-default" onclick="query('/admin/role/{{$role->id}}')">权限编辑</button>
                                            <button type="button" class="btn btn-default">权限删除</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <!-- 创建角色态框 -->
                    <div class="example-modal">
                        <div class="modal modal-default fade" id="role-create">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">创建管理员</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box box-primary">
                                            <!-- form start -->
                                            <form role="form" action="/admin/user/store" method="POST">
                                                {{csrf_field()}}
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">角色名</label>
                                                        <input type="text" class="form-control" name="name">
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">描述</label>
                                                        <input type="text" class="form-control" name="description">
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="reset" class="btn btn-primary">重填</button>
                                                    <button type="submit" class="btn btn-primary">提交</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!-- /.example-modal -->

                    <!-- 创建角色模态框 -->
                    <div class="example-modal">
                        <div class="modal modal-default fade" id="role-edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">创建管理员</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box box-primary">
                                            <!-- form start -->
                                            <form role="form" action="/admin/role/update" method="POST">
                                                {{csrf_field()}}
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">角色名</label>
                                                        <input type="text" class="form-control" name="name" id="name">
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">描述</label>
                                                        <input type="text" class="form-control" name="description" id="description">
                                                    </div>
                                                </div>
                                                <input type="hidden" value="" name="id" id="id">
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="reset" class="btn btn-primary">重填</button>
                                                    <button type="submit" class="btn btn-primary">提交</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!-- /.example-modal -->

                </div>
                <!-- /.box -->

                <script>
                    var query = function(url){
                        $.ajax({
                            url:url,
                            async:false,
                            type:'GET',
                            success: showQuery,
                            error : function () {
                                alert("请求失败");
                            },
                            dataType : "json"
                        });
                    };

                    var showQuery = function(data){
                        $("#name").val(data.name);
                        $("#id").val(data.id);
                        $("#description").val(data.description);
                        //显示模态框
                        $("#role-edit").modal('show');
                    };
                </script>

            </div>
        </div>
    </section>
@endsection