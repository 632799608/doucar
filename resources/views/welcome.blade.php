<!DOCTYPE html>
<html>
    <head>
        <title>badou</title>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body id="captcha">
        <div class="container">
            <div class="content">
                <div onclick="pay()" class="visible-print text-center">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->margin(1)->merge('/public/back/images/QrCode.png', .15)->generate('{id:1}')) !!} ">
                </div>
                <span id="pay">系统开车中。。。</span>
            </div>
        </div>
    </body>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('back/axios.min.js') }}" charset="utf-8"></script>
    <script>
    wx.config(<?php echo $js->config(array('chooseWXPay'), true) ?>);
    wx.ready(function(){
        alert('成功')
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
    });
    function pay(){
        axios.post('api/v1/pay/wxPay.api')
        .then(function(response) {
            console.log(response);
            // wx.chooseWXPay({
            //     timestamp: response.data.result.timestamp,
            //     nonceStr: response.data.result.nonceStr,
            //     package: response.data.result.package,
            //     signType: response.data.result.signType,
            //     paySign: response.data.result.paySign, // 支付签名
            //     success: function (res) {
            //         alert('ddd');
            //         // 支付成功后的回调函数
            //     },
            //     cencel:function(res){// 支付取消回调函数
            //         alert('cencel pay');
            //     },
            //     fail: function(res){// 支付失败回调函数
            //         alert('pay fail');
            //         alert(JSON.stringify(res));
            //     }
            // });
        });
    }
    </script>
</html>
