@extends("admin.layout.main")

@section("content")
    <!-- Main content -->
    <section class="content-header">
        <h1>
            后台管理员
            <small>后台管理员数据表</small>
        </h1>
        <ol class="breadcrumb left">
            <li><a href="#"><i class="fa fa-dashboard"></i> 系统管理</a></li>
            <li><a href="#">用户管理</a></li>
            <li class="active">管理员列表</li>
        </ol>
    </section>

    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">创建用户</button>
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
                                <th>ID</th>
                                <th>用户名称</th>
                                <th>reason</th>
                                <th>Status</th>
                                <th>操作</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}.</td>
                                    <td>{{$user->name}}</td>
                                    <td><span class="label label-success">Approved</span></td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    <td>
                                        <div class="btn-group-xs">
                                            <button type="button" class="btn btn-default"
                                                    onclick="query('/admin/user/{{$user->id}}')">修改信息</button>
                                            <a type="button" class="btn btn-default btn-xs"
                                               href="/admin/user/{{$user->id}}/role">角色管理</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <!-- 创建用户模态框 -->
                    <div class="example-modal">
                        <div class="modal modal-primary fade" id="modal-default">
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
                                                        <label for="exampleInputEmail1">用户名</label>
                                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">密码</label>
                                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="reset" class="btn btn-yahoo">重填</button>
                                                    <button type="submit" class="btn btn-primary">创建</button>
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

                    <!--修改用户信息模态框-->
                    <div class="example-modal">
                        <div class="modal modal-primary fade" id="modal-edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">修改信息</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box box-primary">
                                            <!-- form start -->
                                            <form role="form" action="/admin/user/update" method="POST">
                                                {{csrf_field()}}
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">用户名</label>
                                                        <input type="text" class="form-control" name="name" id="name">
                                                    </div>
                                                </div>
                                                <input type="hidden" value="" name="uid" id="uid">
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="reset" class="btn btn-yahoo">重填</button>
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
                    <!-- modal-end -->

                </div>
                <!-- /.box -->
            </div>
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
                    $("#uid").val(data.id);
                    //显示模态框
                    $("#modal-edit").modal('show');
                };
            </script>
        </div>
    </section>
@endsection