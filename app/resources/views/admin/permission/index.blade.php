@extends("admin.layout.main")

@section("content")
    <!-- Main content -->
    <section class="content-header">
        <h1>
            管理员权限
            <small>权限列表</small>
        </h1>
        <ol class="breadcrumb left">
            <li><a href="#"><i class="fa fa-dashboard"></i> 系统管理</a></li>
            <li><a href="#">权限管理</a></li>
            <li class="active">权限列表</li>
        </ol>
    </section>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#permission-create">创建权限</button>
                        </h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                       placeholder="Search">

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
                                <th>name</th>
                                <th>权限名称</th>
                                <th>描述</th>
                                <th>操作</th>
                            </tr>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}.</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->title}}</td>
                                    <td>{{$permission->description}}</td>
                                    <td>
                                        <div class="btn-group-xs">
                                            <button type="button" class="btn btn-default"
                                                    onclick="query('/admin/permission/{{$permission->id}}')">权限编辑</button>
                                            <button type="button" class="btn btn-default">权限删除</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <!-- 创建权限模态框 -->
                    <div class="example-modal">
                        <div class="modal modal-default fade" id="permission-create">
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
                                            <form role="form" action="/admin/permission/store" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label>上级菜单</label>
                                                <select class="form-control select2" name="pid">
                                                    <option selected="selected" value="0">顶级分类</option>
                                                    @foreach($permissions as $permission)
                                                        <option value="{{$permission->id}}">
                                                            {{str_repeat('-',($permission->level * 4))}}
                                                            {{$permission->title}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>权限名</label>
                                                    <input type="text" placeholder="权限名:(路由)" class="form-control"
                                                           name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label>权限标题</label>
                                                    <input type="text" placeholder="权限标题" class="form-control"
                                                           name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label>描述</label>
                                                    <input type="text" placeholder="描述" class="form-control"
                                                           name="description">
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

                    <!-- 修改权限模态框 -->
                    <div class="example-modal">
                        <div class="modal modal-default fade" id="permission-edit">
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
                                            <form role="form" action="/admin/permission/update" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label>上级菜单</label>
                                                    <select class="form-control select2" name="pid" id="pid">
                                                        <option selected="selected" value="0">顶级分类</option>
                                                        @foreach($permissions as $permission)
                                                            <option value="{{$permission->id}}">
                                                                {{str_repeat('-',($permission->level * 4))}}
                                                                {{$permission->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>权限名</label>
                                                    <input type="text" placeholder="权限名:(路由)" class="form-control"
                                                           name="name" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label>权限标题</label>
                                                    <input type="text" placeholder="权限标题" class="form-control"
                                                           name="title" id="title">
                                                </div>
                                                <div class="form-group">
                                                    <label>描述</label>
                                                    <input type="text" placeholder="描述" class="form-control"
                                                           name="description" id="description">
                                                </div>
                                                <input type="hidden" name="id" id="id" value="">
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

                    <!-- /.box-body -->
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
                        $("#pid").val(data.pid);
                        $("#name").val(data.name);
                        $("#id").val(data.id);
                        $("#title").val(data.title);
                        $("#description").val(data.description);
                        //显示模态框
                        $("#permission-edit").modal('show');
                    };
                </script>
            </div>
        </div>
    </section>
@endsection