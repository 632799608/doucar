<style type="text/css" media="screen">
    .ad-upload .i-delete {
        position: absolute;
        /*left: 0;*/
        font-size: 18px;
        color: red;
        cursor: pointer;
        display: none;
    }
</style>
<div id="waypointAddhtml" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form">
            <input type="hidden" name="id" value="0">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/waypoint.category')!!}</label>
                <div class="layui-input-inline">
                    <select name="wc1Id" lay-filter="wc1Id">
                        <option value="0">{!!trans('admin/category.waypoint')!!}</option>
                    </select>
                </div>
                <div class="layui-input-inline" style="display: none">
                    <select name="wc2Id" lay-filter="wc2Id">
                        <option value="0">{!!trans('admin/category.waypoint')!!}</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/waypoint.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/waypoint.model.name')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/waypoint.model.content')!!}</label>
                <div class="layui-input-inline" style="width: 384px;">
                    <textarea id="point-content-add"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/waypoint.model.thumb')!!}</label>
                <div class="layui-input-inline">
                    <input name="thumb" class="layui-upload-file" id="point-upload" type="file" >
                    <div class="ad-upload" style="margin-top: 5px;">
                        <i class="fa fa-close i-delete" id="adadddel"></i>
                        <img id="LAY_point_upload" src="{{ asset('back/images/no-image.png') }}" style="display: none;width: 50px;height: 50px">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="waypointAdd">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>