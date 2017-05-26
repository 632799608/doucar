<div id="cityaddhtml" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form" id="cityaddform">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/city.action.selectPC')!!}</label>
                <div class="layui-input-inline">
                    <select name="province" id="province" lay-filter="province">
                        <option value="">请选择省</option>
                    </select>
                </div>
                <div class="layui-input-inline city-city">
                    <select name="city" id="city" lay-filter="city">
                        <option value="">请选择市</option>
                    </select>
                </div>
                {{-- <div class="layui-input-inline">
                    <select name="province" lay-filter="org_province" id="org_province">
                        <option value="0">{!!trans('admin/city.action.selectP')!!}</option>
                        @{{#  layui.each(d.data, function(index, item){ }}
                        <option value="@{{ index+','+item.id }}">@{{ item.name }}</option>
                        @{{#  }); }}
                    </select>
                </div>
                <div class="layui-input-inline city-city" style="display: none">
                    <!-- 区域管理二级区域容器-->
                </div> --}}
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/city.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/city.model.name')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/city.model.key')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="key" lay-verify="required" placeholder="{!!trans('admin/city.model.key')!!}" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="cityadd">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>
