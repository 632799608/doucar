define({
  "name": "八斗API文档",
  "version": "0.0.1",
  "description": "",
  "title": "八斗API文档",
  "url": "http://res.ngrok.4kb.cn",
  "header": {
    "title": "八斗API",
    "content": "<h2>签名方式</h2>\n<ul>\n<li>\n<p>加密的key:XKA09LGjtWNjnScyAzP9FPsl9Cozj8AR0ve</p>\n</li>\n<li>\n<p>微信浏览器的clientId指定为badouId,其他的设备获取对应的clientId</p>\n</li>\n<li>\n<p>token 不参于签名</p>\n</li>\n<li>\n<p>path 请求url的地址(api/v1/ad.api)</p>\n</li>\n<li>\n<p>time 请求的时间戳</p>\n</li>\n<li>\n<p>参数按照字母顺序排序</p>\n</li>\n<li>\n<p>sign=md5(path+a=1&amp;b=2&amp;...&amp;time=11+key)的方式加密</p>\n</li>\n</ul>\n"
  },
  "footer": {
    "title": "八斗API",
    "content": "<h2>结束</h2>\n"
  },
  "template": {
    "withCompare": true,
    "withGenerator": true
  },
  "sampleUrl": false,
  "defaultVersion": "0.0.0",
  "apidoc": "0.3.0",
  "generator": {
    "name": "apidoc",
    "time": "2017-05-26T09:00:32.925Z",
    "url": "http://apidocjs.com",
    "version": "0.17.5"
  }
});
