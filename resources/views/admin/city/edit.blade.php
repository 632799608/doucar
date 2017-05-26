<div id="cityedithtml" class="layui-form" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form" id="cityeditreset">
            <input type="hidden" name="id" id="cityeditid">
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
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/city.model.name')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" class="layui-input" id="editname">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/city.model.key')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="key" lay-verify="required" autocomplete="off" class="layui-input" id="editkey">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="cityedit">{!!trans('admin/setting.resave')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>