## 签名方式 ##
* 加密的key:XKA09LGjtWNjnScyAzP9FPsl9Cozj8AR0ve

* 微信浏览器的clientId指定为badouId,其他的设备获取对应的clientId 

* token 不参于签名

* path 请求url的地址(api/v1/ad.api)

* time 请求的时间戳

* 参数按照字母顺序排序

* sign=md5(path+a=1&b=2&...&time=11+key)的方式加密