define({ "api": [
  {
    "type": "post",
    "url": "/api/v1/ad.api",
    "title": "广告列表",
    "version": "0.0.1",
    "group": "Ad",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [\n          {'id':'1',\n          'title':'XX',\n          'thumb':'path',\n          'url':'url'}\n          ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AdController.php",
    "groupTitle": "Ad",
    "name": "PostApiV1AdApi"
  },
  {
    "type": "post",
    "url": "/api/v1/area/area.api",
    "title": "地区",
    "version": "0.0.1",
    "group": "Area",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'child':[\n              {\n              'id':'1'\n              'title':'XX'\n              child:[]\n              }\n              ...\n          ]\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AreaController.php",
    "groupTitle": "Area",
    "name": "PostApiV1AreaAreaApi"
  },
  {
    "type": "post",
    "url": "/api/v1/area/city.api",
    "title": "城市",
    "version": "0.0.1",
    "group": "Area",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'key': 'A',\n          'province':'12001',\n           'city':'11122'\n       }\n       ..\n     ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AreaController.php",
    "groupTitle": "Area",
    "name": "PostApiV1AreaCityApi"
  },
  {
    "type": "post",
    "url": "/api/v1/article/articleOne.api",
    "title": "文章详情",
    "version": "0.0.1",
    "group": "Article",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>文章Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'1'\n          'title':'XX'\n          'content':'XX'\n          'thumb':'图片'\n          'category':[\n              {\n                  'id':'1',\n                  'name':'XX',\n              }\n              ...\n          ]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/ArticleController.php",
    "groupTitle": "Article",
    "name": "PostApiV1ArticleArticleoneApi"
  },
  {
    "type": "post",
    "url": "/api/v1/article/categoryArticle.api",
    "title": "全部分类下的所有文章",
    "version": "0.0.1",
    "group": "Article",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'article':[\n              {\n              'id':'1'\n              'title':'XX'\n              'content':'XX'\n              'thumb':'图片'\n              }\n              ...\n          ]\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/ArticleController.php",
    "groupTitle": "Article",
    "name": "PostApiV1ArticleCategoryarticleApi"
  },
  {
    "type": "post",
    "url": "/api/v1/article/categoryOne.api",
    "title": "分类下的所有文章",
    "version": "0.0.1",
    "group": "Article",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>分类Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'1',\n          'name':'XX',\n          'article':[\n              {\n              'id':'1'\n              'title':'XX'\n              'content':'XX'\n              'thumb':'图片'\n              }\n              ...\n          ]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/ArticleController.php",
    "groupTitle": "Article",
    "name": "PostApiV1ArticleCategoryoneApi"
  },
  {
    "type": "post",
    "url": "/api/v1/auth/loginOpenId.api",
    "title": "第三方登录",
    "group": "Auth",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "openId",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientId",
            "description": "<p>app唯一标示</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "accountType",
            "description": "<p>登录方式 (2:QQ，3:微信)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sign",
            "description": "<p>path+(key=value&amp;key=value)+appkey的md5</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"登录成功\",\n      \"result\": {\n          \"token\": \"xxxx.xxxxxxx.xxxxxxxx\",\n          \"id\": 4,\n          \"phone\": \"182xxxxxxx\",\n          \"avatar\": \"http://xxx.jpg\",\n          \"nickname\": \"xx\",\n          \"expiryTime\": \"1471685891\", //token 过去时间\n          \"isCoach\" : '0' //1:教练，0:\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"登录失败\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 404,\n      \"message\": \"验证错误信息\"\n }",
          "type": "json"
        },
        {
          "title": "系统失败:",
          "content": "{\n      \"code\": 500\n      \"message\": \"系统信息\",'访问频繁'\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AuthController.php",
    "groupTitle": "Auth",
    "name": "PostApiV1AuthLoginopenidApi"
  },
  {
    "type": "post",
    "url": "/api/v1/auth/loginPhone.api",
    "title": "手机登录",
    "group": "Auth",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientId",
            "description": "<p>app唯一标示</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sign",
            "description": "<p>path+(key=value&amp;key=value)+appkey的md5</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"登录成功\",\n      \"result\": {\n          \"token\": \"xxxx.xxxxxxx.xxxxxxxx\",\n          \"id\": 4,\n          \"phone\": \"182xxxxxxx\",\n          \"avatar\": \"http://xxx.jpg\",\n          \"nickname\": \"xx\",\n          \"expiryTime\": \"1471685891\", //token 过去时间,\n          \"isCoach\" : '0' //1:教练，0:\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"登录失败\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 404,\n      \"message\": \"验证错误信息\"\n }",
          "type": "json"
        },
        {
          "title": "系统失败:",
          "content": "{\n      \"code\": 500\n      \"message\": \"系统信息\",'访问频繁'\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AuthController.php",
    "groupTitle": "Auth",
    "name": "PostApiV1AuthLoginphoneApi"
  },
  {
    "type": "post",
    "url": "/api/v1/auth/passwordReset.api",
    "title": "密码找回",
    "group": "Auth",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientId",
            "description": "<p>app唯一标示</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sign",
            "description": "<p>path+(key=value&amp;key=value)+appkey的md5</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"修改成功\",\n      \"result\": {}\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"修改失败\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 404,\n      \"message\": \"验证错误信息\"\n }",
          "type": "json"
        },
        {
          "title": "系统失败:",
          "content": "{\n      \"code\": 500\n      \"message\": \"系统信息\",'访问频繁'\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AuthController.php",
    "groupTitle": "Auth",
    "name": "PostApiV1AuthPasswordresetApi"
  },
  {
    "type": "post",
    "url": "/api/v1/auth/registerOpenId.api",
    "title": "第三方注册",
    "group": "Auth",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "openId",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientId",
            "description": "<p>app唯一标示</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "accountType",
            "description": "<p>注册方式 (2:QQ，3:微信)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sign",
            "description": "<p>path+(key=value&amp;key=value)+appkey的md5</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"注册成功\",\n      \"result\": {\n          \"token\": \"xxxx.xxxxxxx.xxxxxxxx\",\n          \"id\": 4,\n          \"phone\": \"182xxxxxxx\",\n          \"avatar\": \"http://xxx.jpg\",\n          \"nickname\": \"xx\",\n          \"expiryTime\": \"1471685891\", //token 过去时间\n          \"isCoach\" : '0' //1:教练，0:\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"注册失败\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 404,\n      \"message\": \"验证错误信息\"\n }",
          "type": "json"
        },
        {
          "title": "系统失败:",
          "content": "{\n      \"code\": 500\n      \"message\": \"系统信息\",'访问频繁'\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AuthController.php",
    "groupTitle": "Auth",
    "name": "PostApiV1AuthRegisteropenidApi"
  },
  {
    "type": "post",
    "url": "/api/v1/auth/registerPhone.api",
    "title": "手机注册",
    "group": "Auth",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientId",
            "description": "<p>app唯一标示</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sign",
            "description": "<p>path+(key=value&amp;key=value)+appkey的md5</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"注册成功\",\n      \"result\": {\n          \"token\": \"xxxx.xxxxxxx.xxxxxxxx\",\n          \"id\": 4,\n          \"phone\": \"182xxxxxxx\",\n          \"avatar\": \"http://xxx.jpg\",\n          \"nickname\": \"xx\",\n          \"expiryTime\": \"1471685891\", //token 过去时间,\n          \"isCoach\" : '0' //1:教练，0:\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"注册失败\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 404,\n      \"message\": \"验证错误信息\"\n }",
          "type": "json"
        },
        {
          "title": "系统失败:",
          "content": "{\n      \"code\": 500\n      \"message\": \"系统信息\",'访问频繁'\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AuthController.php",
    "groupTitle": "Auth",
    "name": "PostApiV1AuthRegisterphoneApi"
  },
  {
    "type": "post",
    "url": "/api/v1/auth/sms.api",
    "title": "发送验证码",
    "group": "Auth",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "type",
            "description": "<p>0:注册,1:找回密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientId",
            "description": "<p>app唯一标示</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sign",
            "description": "<p>path+(key=value&amp;key=value)+appkey的md5</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"验证码发送成功\",\n      \"data\": null\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"验证码发送失败\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 404,\n      \"message\": \"验证错误信息\"\n }",
          "type": "json"
        },
        {
          "title": "系统失败:",
          "content": "{\n      \"code\": 500\n      \"message\": \"系统信息\",'访问频繁'\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/AuthController.php",
    "groupTitle": "Auth",
    "name": "PostApiV1AuthSmsApi"
  },
  {
    "type": "post",
    "url": "/api/v1/cheat/category.api",
    "title": "秘籍分类",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "group": "Cheat",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'child':[\n              {\n              'id':'1'\n              'name':'XX'\n              }\n              ...\n          ]\n      }\n      ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/CheatController.php",
    "groupTitle": "Cheat",
    "name": "PostApiV1CheatCategoryApi"
  },
  {
    "type": "post",
    "url": "/api/v1/cheat/categoryCheat.api",
    "title": "秘籍分类下的秘籍",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "group": "Cheat",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'child':[\n              {\n              'id':'1'\n              'name':'XX'\n              }\n              ...\n          ]\n          'cheat':[{\n              'id':'1',\n              'name':'xxx',\n              ...,\n              gallery:[{\n                  id:'1',\n                  'thumb':url\n                  ...\n              }]\n          }]\n      }\n      ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/CheatController.php",
    "groupTitle": "Cheat",
    "name": "PostApiV1CheatCategorycheatApi"
  },
  {
    "type": "post",
    "url": "/api/v1/cheat/categoryCheatOne.api",
    "title": "获取某一个分类下的秘籍",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>秘籍分类Id</p>"
          }
        ]
      }
    },
    "group": "Cheat",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'cheat':[{\n              'id':'1',\n              'name':'xxx',\n              ...,\n              gallery:[{\n                  id:'1',\n                  'thumb':url\n                  ...\n              }]\n          }]\n      }\n      ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/CheatController.php",
    "groupTitle": "Cheat",
    "name": "PostApiV1CheatCategorycheatoneApi"
  },
  {
    "type": "post",
    "url": "/api/v1/cheat/cheat.api",
    "title": "秘籍详情",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "group": "Cheat",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>秘籍Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'1',\n          'name':'XX',\n          'gallery':[{\n              'id':'1',\n              'thumb':url\n          }]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/CheatController.php",
    "groupTitle": "Cheat",
    "name": "PostApiV1CheatCheatApi"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./public/apidoc/main.js",
    "group": "D__phpStudy_WWW_doucar_public_apidoc_main_js",
    "groupTitle": "D__phpStudy_WWW_doucar_public_apidoc_main_js",
    "name": ""
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberAmend.api",
    "title": "会员资料修改",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>会员密码</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberAmendController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberamendApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberApply.api",
    "title": "学员报名列表",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      'result':[{\n          'id':1\n          'carType':'驾驶证类型',\n          'created_at':'2017:XX:30',\n          'price':'学费金额',\n          'school':{\n              'name':'省份'\n          },\n          'coach':{\n              'name':'城市'\n          }\n      }\n      ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberApplyController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberapplyApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberApplySave.api",
    "title": "学员报名",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>报名姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "carType",
            "description": "<p>报名驾驶证类型</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>报名电话</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "schoolId",
            "description": "<p>报名的驾校id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "coachId",
            "description": "<p>报名的教练id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "price",
            "description": "<p>学费金额</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "pay",
            "description": "<p>是否支付(0:不支付,1:支付)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": '0(0:不支付,>0:订单Id)'\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberApplyController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberapplysaveApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberApprove.api",
    "title": "学员登记详情",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      'result':{\n          'id':1\n          'memberId':'1',\n          'type':'登记车型',\n          'phone':'182XXX12',\n          'address':'云南XXX12路',\n          'name':'登记姓名',\n          'province':{\n              'name':'省份'\n          },\n          'city':{\n              'name':'城市'\n          },\n          'district':{\n              'name':'地区'\n          }\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberApproveController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberapproveApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberApproveAdd.api",
    "title": "学员登记",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>登记姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "type",
            "description": "<p>登记车型</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>登记电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "province",
            "description": "<p>用户学车的省id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>用户学车的市id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "district",
            "description": "<p>用户学车的区id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>用户的地址详情</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberApproveController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberapproveaddApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberCoach.api",
    "title": "学员评论教练",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "coachId",
            "description": "<p>教练Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "comment",
            "description": "<p>评价内容</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "star",
            "description": "<p>星数</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n \"code\": 200,\n \"message\": \"XXX\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberRelationController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMembercoachApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberRelation.api",
    "title": "我的评论",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n \"code\": 200,\n \"message\": \"会员关联的驾校教练获取成功\",\n \"result\": \n  [\n      {\n        \"id\": x,\n        \"memberApplyId\": x,\n        \"purchaseId\": x,\n        \"memberId\": x,\n        \"apply\": null,\n        \"purchase\": {\n          \"id\": x,\n          \"schoolId\": x,\n          \"school\": {\n            \"id\": x,\n            \"name\": \"xxx\",\n            \"address\": \"xxxxx\",\n            \"thumb\": \"xxxxx\",\n            \"comment\":[\n                {\n                    'id':'1',\n                    'star':'星数',\n                    'comment':'评论的内容',\n                    'created_at':'时间'\n                }\n            ]\n          }\n        }\n      },\n      ...\n      {\n        \"id\": x,\n        \"memberApplyId\": x,\n        \"purchaseId\": x,\n        \"memberId\": x,\n        \"apply\": {\n          \"id\": x,\n          \"schoolId\": x,\n          \"coachId\": x,\n          \"school\": {\n            \"id\": x,\n            \"name\": \"xxx\",\n            \"address\": \"xxx\",\n            \"thumb\": \"xxxxxx\",\n            \"comment\":[\n                {\n                    'id':'1',\n                    'star':'星数',\n                    'comment':'评论的内容',\n                    'created_at':'时间'\n                }\n            ]\n          },\n          \"coach\": {\n            \"id\": x,\n            \"name\": \"x\",\n            \"avatar\": xxxx,\n            \"schoolId\": x,\n            \"school\": {\n              \"id\": x,\n             \"name\": \"xxx\"\n            },\n            \"comment\":[\n                {\n                    'id':'1',\n                    'star':'星数',\n                    'comment':'评论的内容',\n                    'created_at':'时间'\n                }\n            ]\n          }\n        },\n      \"purchase\": null\n      },\n      ...\n  ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberRelationController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberrelationApi"
  },
  {
    "type": "post",
    "url": "/api/v1/member/memberSchool.api",
    "title": "学员评论驾校",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "schoolId",
            "description": "<p>驾校Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "comment",
            "description": "<p>评价内容</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "star",
            "description": "<p>星数</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n \"code\": 200,\n \"message\": \"XXX\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/MemberRelationController.php",
    "groupTitle": "Member",
    "name": "PostApiV1MemberMemberschoolApi"
  },
  {
    "type": "post",
    "url": "/api/v1/sign/coach.api",
    "title": "教练签到签退",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "type",
            "description": "<p>类型 1：签到 2：签退,3:代签到，4：代签退</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>签到签退姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>签到签退电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "license",
            "description": "<p>签到签退车牌</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>签到签退地点</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/SignController.php",
    "groupTitle": "Member",
    "name": "PostApiV1SignCoachApi"
  },
  {
    "type": "post",
    "url": "/api/v1/sign/member.api",
    "title": "学员签到签退",
    "version": "0.0.1",
    "group": "Member",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "type",
            "description": "<p>类型 1：签到 2：签退,3:代签到，4：代签退</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>签到签退姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>签到签退电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "license",
            "description": "<p>签到签退车牌</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>签到签退地点</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/SignController.php",
    "groupTitle": "Member",
    "name": "PostApiV1SignMemberApi"
  },
  {
    "type": "post",
    "url": "/api/v1/order/order.api",
    "title": "订单详情",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>订单Id</p>"
          }
        ]
      }
    },
    "group": "Order",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n           \"id\": 1,\n           \"carType\":'驾照类型'\n           \"orderNo\": \"订单编号\",\n           \"money\": \"订单价格\",\n           \"price\": \"未支付的价格\",\n           \"apply\": { //报名的订单\n               'school':{\n                   'name': '驾校名称'\n               },\n               'coach':{\n                   'name':'教练名称'\n               }\n           },\n           \"purchase\": { //团购的订单\n               'name':\"团购名称\",\n               'school':{\n                   'name': '驾校名称'\n               }\n           }\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/OrderController.php",
    "groupTitle": "Order",
    "name": "PostApiV1OrderOrderApi"
  },
  {
    "type": "post",
    "url": "/api/v1/order/order.api",
    "title": "订单详情",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>订单Id</p>"
          }
        ]
      }
    },
    "group": "Order",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n           \"id\": 1,\n           \"carType\":'驾照类型'\n           \"orderNo\": \"订单编号\",\n           \"money\": \"订单价格\",\n           \"price\": \"未支付的价格\",\n           \"apply\": { //报名的订单\n               'school':{\n                   'name': '驾校名称'\n               },\n               'coach':{\n                   'name':'教练名称'\n               }\n           },\n           \"purchase\": { //团购的订单\n               'name':\"团购名称\",\n               'school':{\n                   'name': '驾校名称'\n               }\n           },\n           \"pay\":[{  // 支付记录\n               \"id\":1,\n               \"money\":'支付的钱',\n               'created_at':'支付的日期'\n           }]\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/OrderController.php",
    "groupTitle": "Order",
    "name": "PostApiV1OrderOrderApi"
  },
  {
    "type": "post",
    "url": "/api/v1/order/orderAliPaynotify.api",
    "title": "支付宝支付成功回调",
    "version": "0.0.1",
    "group": "Order",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {}\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/OrderController.php",
    "groupTitle": "Order",
    "name": "PostApiV1OrderOrderalipaynotifyApi"
  },
  {
    "type": "post",
    "url": "/api/v1/order/orderPay.api",
    "title": "订单支付下单",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "orderId",
            "description": "<p>订单Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "money",
            "description": "<p>支付的money</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "payType",
            "description": "<p>支付方式</p>"
          }
        ]
      }
    },
    "group": "Order",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n           \"id\": 1,\n           \"payType\":'支付方式'\n           \"orderNo\": \"订单编号\",\n           \"money\": \"订单价格\",\n           \"orderId\":'订单Id'\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/OrderController.php",
    "groupTitle": "Order",
    "name": "PostApiV1OrderOrderpayApi"
  },
  {
    "type": "post",
    "url": "/api/v1/order/orderPayDel.api",
    "title": "订单支付失败删除",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>订单支付Id</p>"
          }
        ]
      }
    },
    "group": "Order",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {}\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/OrderController.php",
    "groupTitle": "Order",
    "name": "PostApiV1OrderOrderpaydelApi"
  },
  {
    "type": "post",
    "url": "/api/v1/order/orderWxnotify.api",
    "title": "微信支付成功回调",
    "version": "0.0.1",
    "group": "Order",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {}\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/OrderController.php",
    "groupTitle": "Order",
    "name": "PostApiV1OrderOrderwxnotifyApi"
  },
  {
    "type": "post",
    "url": "/api/v1/purchase/purchase.api",
    "title": "团购详情",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>团购Id</p>"
          }
        ]
      }
    },
    "group": "Purchase",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n           \"id\": 1,\n           \"type\":'驾照类型'\n           \"title\": \"团购标题\",\n           \"price\": \"团购价格\",\n           \"number\": '团购人数',\n           \"startTime\": \"开始时间\",\n           \"endTime\": \"结束时间\",\n           \"thumb\": \"团购图形\",\n           \"content\": \"团购内容\"\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/PurchaseController.php",
    "groupTitle": "Purchase",
    "name": "PostApiV1PurchasePurchaseApi"
  },
  {
    "type": "post",
    "url": "/api/v1/purchase/purchaseList.api",
    "title": "团购列表",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "group": "Purchase",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n           \"id\": 1,\n           \"title\": \"团购标题\",\n           \"price\": \"团购价格\",\n           \"number\": '团购人数',\n           \"startTime\": \"开始时间\",\n           \"thumb\": \"团购图形\"\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXx\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/PurchaseController.php",
    "groupTitle": "Purchase",
    "name": "PostApiV1PurchasePurchaselistApi"
  },
  {
    "type": "post",
    "url": "/api/v1/purchase/purchasePay.api",
    "title": "团购报名",
    "version": "0.0.1",
    "group": "Purchase",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "purchaseId",
            "description": "<p>团购Id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>报名姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "carType",
            "description": "<p>报名驾驶证类型</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>报名电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "money",
            "description": "<p>学费金额</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": 订单Id\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/PurchaseController.php",
    "groupTitle": "Purchase",
    "name": "PostApiV1PurchasePurchasepayApi"
  },
  {
    "type": "post",
    "url": "/api/v1/question/category.api",
    "title": "试题分类",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "group": "Question",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "type",
            "description": "<p>分类类型(1:科目一,4:科目四)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'1',\n          'name':'XX',\n          'question_count':'试题总数'\n           }\n           ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"添加失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/QuestionController.php",
    "groupTitle": "Question",
    "name": "PostApiV1QuestionCategoryApi"
  },
  {
    "type": "post",
    "url": "/api/v1/question/categoryQuestion.api",
    "title": "分类下的试题",
    "version": "0.0.1",
    "group": "Question",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>分类Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'1',\n          'name':'XX',\n          'question':[{\n              'questionCategoryId':'关联分类表id',\n              'name':'试题名称',\n              'analysis':'答案解析',\n              'questionType':'1:单选题,2:判断题,3:多选题',\n              'courseType':'1:科目1,4：科目4',\n              'difficulty':'难度系数',\n              'thumb':'图片路径',\n              'answer':[\n                  {\n                  'type':'0:文字答案，1:图片答案'\n                  'isAnswer':'0:不是正确答案,1:正确答案'\n                  'content':'答案内容'\n                  'thumb':'图片'\n                  }\n                   ...\n                   ]\n          }\n          ...\n          ]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"添加失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/QuestionController.php",
    "groupTitle": "Question",
    "name": "PostApiV1QuestionCategoryquestionApi"
  },
  {
    "type": "post",
    "url": "/api/v1/question/question.api",
    "title": "试题详情",
    "version": "0.0.1",
    "group": "Question",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>试题id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'11',\n          'questionCategoryId':'关联分类表id',\n          'name':'试题名称',\n          'analysis':'答案解析',\n          'questionType':'1:单选题,2:判断题,3:多选题',\n          'courseType':'1:科目1,4：科目4',\n          'difficulty':'难度系数',\n          'thumb':'图片路径',\n          'answer':[\n              {\n              'type':'0:文字答案，1:图片答案'\n              'isAnswer':'0:不是正确答案,1:正确答案'\n              'content':'答案内容'\n              'thumb':'图片'\n              }\n              ...\n          ]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"添加失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/QuestionController.php",
    "groupTitle": "Question",
    "name": "PostApiV1QuestionQuestionApi"
  },
  {
    "type": "post",
    "url": "/api/v1/question/question.store",
    "title": "试题添加",
    "version": "0.0.1",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "group": "Question",
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"添加成功\",\n      \"result\": {\n          'questionCategoryId':'关联分类表id',\n          'name':'试题名称',\n          'analysis':'答案解析',\n          'questionType':'1:单选题,2:判断题,3:多选题',\n          'courseType':'1:科目1,4：科目4',\n          'difficulty':'难度系数',\n          'thumb':'图片路径',\n          'answer':[\n              {\n              'type':'0:文字答案，1:图片答案'\n              'isAnswer':'0:不是正确答案,1:正确答案'\n              'content':'答案内容'\n              'thumb':'图片'\n              }\n              ...\n          ]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"添加失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/QuestionController.php",
    "groupTitle": "Question",
    "name": "PostApiV1QuestionQuestionStore"
  },
  {
    "type": "post",
    "url": "/api/v1/question/questionList.api",
    "title": "试题列表",
    "version": "0.0.1",
    "group": "Question",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "courseType",
            "description": "<p>试题类型('1:科目1,4：科目4'),</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'11',\n          'questionCategoryId':'关联分类表id',\n          'name':'试题名称',\n          'analysis':'答案解析',\n          'questionType':'1:单选题,2:判断题,3:多选题',\n          'courseType':'1:科目1,4：科目4',\n          'difficulty':'难度系数',\n          'thumb':'图片路径',\n          'answer':[\n              {\n              'type':'0:文字答案，1:图片答案'\n              'isAnswer':'0:不是正确答案,1:正确答案'\n              'content':'答案内容'\n              'thumb':'图片'\n              }\n              ...\n          ]\n      }\n      ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"添加失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/QuestionController.php",
    "groupTitle": "Question",
    "name": "PostApiV1QuestionQuestionlistApi"
  },
  {
    "type": "post",
    "url": "/api/v1/school/coach.api",
    "title": "教练详情",
    "version": "0.0.1",
    "group": "School",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>教练Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'11',\n          'name':'教练名称',\n          'overview':'教练简介',\n          'avatar':'图片路径',\n          'description':'教练描述',\n          'comment':[\n              {\n                  'id':'1'\n                  'comment':'评论内容'\n                  'star':'星数'\n                  'member':{\n                      'nickname': '会员名称'\n                   }\n                   'created_at':'时间'\n              }\n              ...\n          ]\n          'gallery':[\n              {\n              'id':'1'\n              'thumb':'图片'\n              }\n              ...\n          ]\n          'schoole':{\n              'id':'11',\n              'name':'驾校名称',\n              'address':'驾校地址',\n              'score':'评分',\n              'thumb':'图片路径',\n              'description':'驾校课程描述',\n              'phone':'0876-XXX',\n              'price':[\n              {\n                  'id':'1'\n                  'type':'学校驾照类型'\n                  'price':'价格'\n                  }\n              ...\n              ]\n          }\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/CoachController.php",
    "groupTitle": "School",
    "name": "PostApiV1SchoolCoachApi"
  },
  {
    "type": "post",
    "url": "/api/v1/school/coachApprove.api",
    "title": "教练认证",
    "version": "0.0.1",
    "group": "School",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>教练名字</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>教练地址</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>教练电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "thumb",
            "description": "<p>教练头像</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "sex",
            "description": "<p>教练性别 1：男  2：女</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "school",
            "description": "<p>教练所属驾校名称</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/CoachController.php",
    "groupTitle": "School",
    "name": "PostApiV1SchoolCoachapproveApi"
  },
  {
    "type": "post",
    "url": "/api/v1/school/school.api",
    "title": "驾校详情",
    "version": "0.0.1",
    "group": "School",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "id",
            "description": "<p>驾校Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": {\n          'id':'11',\n          'name':'驾校名称',\n          'address':'驾校地址',\n          'thumb':'图片路径',\n          'description':'驾校课程描述',\n          'phone':'0876-XXX',\n          'price':[\n              {\n              'id':'1'\n              'type':'学校驾照类型'\n              'price':'价格'\n              }\n              ...\n          ]\n          'comment':[\n              {\n                  'id':'1'\n                  'comment':'评论内容'\n                  'star':'星数'\n                  'member':{\n                      'nickname': '会员名称'\n                   }\n                   'created_at':'时间'\n              }\n              ...\n          ]\n          'gallery':[\n              {\n              'id':'1'\n              'thumb':'图片'\n              }\n              ...\n          ]\n          'coach':[\n              {\n              'id':'11',\n              'name':'教练名称',\n              'score':'评分',\n              'avatar':'头像url'\n              }\n              ...\n          ]\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/SchoolController.php",
    "groupTitle": "School",
    "name": "PostApiV1SchoolSchoolApi"
  },
  {
    "type": "post",
    "url": "/api/v1/school/schoolApprove.api",
    "title": "驾校认证",
    "version": "0.0.1",
    "group": "School",
    "permission": [
      {
        "name": "签名 + token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "memberId",
            "description": "<p>会员Id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>驾校名称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>驾校地址</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>驾校电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "thumb",
            "description": "<p>驾校照片(如果是多图,用','隔开)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        },
        {
          "title": "验证失败:",
          "content": "{\n      \"code\": 422,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/SchoolController.php",
    "groupTitle": "School",
    "name": "PostApiV1SchoolSchoolapproveApi"
  },
  {
    "type": "post",
    "url": "/api/v1/school/schoolList.api",
    "title": "驾校列表",
    "version": "0.0.1",
    "group": "School",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "成功响应:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XXX\",\n      \"result\": [{\n          'id':'11',\n          'name':'驾校名称',\n          'address':'驾校地址',\n          'score':'评分',\n          'thumb':'图片路径',\n          'price':[\n              {\n              'id':'1'\n              'type':'学校驾照类型'\n              'price':'价格'\n              }\n              ...\n          ]\n      }\n      ...\n      ]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"XXX\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/SchoolController.php",
    "groupTitle": "School",
    "name": "PostApiV1SchoolSchoollistApi"
  },
  {
    "type": "post",
    "url": "/api/v1/tool/upload.delete",
    "title": "图片删除",
    "group": "Tool",
    "permission": [
      {
        "name": "token"
      }
    ],
    "version": "0.0.1",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>图片路径</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"删除成功\",\n      \"result\": null\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"删除错误\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/ToolController.php",
    "groupTitle": "Tool",
    "name": "PostApiV1ToolUploadDelete"
  },
  {
    "type": "post",
    "url": "/api/v1/tool/upload.duo",
    "title": "图片多图上传",
    "group": "Tool",
    "permission": [
      {
        "name": "token"
      }
    ],
    "version": "0.0.1",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "base64",
            "description": "<p>图片base64编码(['base1','base2'])</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "path",
            "description": "<p>七牛上的文件夹</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"上传成功\",\n      \"result\": {\n          url:\"http://xx.png\"\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"返回失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/ToolController.php",
    "groupTitle": "Tool",
    "name": "PostApiV1ToolUploadDuo"
  },
  {
    "type": "post",
    "url": "/api/v1/tool/upload.one",
    "title": "图片单图上传",
    "group": "Tool",
    "permission": [
      {
        "name": "token"
      }
    ],
    "version": "0.0.1",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "base64",
            "description": "<p>图片base64编码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "path",
            "description": "<p>七牛上的文件夹</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"上传成功\",\n      \"result\": {\n          url:\"http://xx.png\"\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"返回失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/ToolController.php",
    "groupTitle": "Tool",
    "name": "PostApiV1ToolUploadOne"
  },
  {
    "type": "post",
    "url": "/api/v1/waypoint/categoryList.api",
    "title": "路标分类",
    "group": "Waypoint",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XX\",\n      \"result\": [{\n          'id','1'\n          'name':'XXX',\n          \"point2_count\": '路标总数'\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"返回失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/WaypointController.php",
    "groupTitle": "Waypoint",
    "name": "PostApiV1WaypointCategorylistApi"
  },
  {
    "type": "post",
    "url": "/api/v1/waypoint/waypoint.api",
    "title": "路标详情",
    "group": "Waypoint",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "version": "0.0.1",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "id",
            "optional": false,
            "field": "id",
            "description": "<p>路标Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XX\",\n      \"result\": {\n          'name':'name'\n          'content':'内容',\n          'thumb':\"http://xx.png\",\n          'category1':{\n              'id':1,\n              'name':'分类名称'\n          },\n          'category2':{\n              'id':1,\n              'name':'分类名称'\n          }\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"返回失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/WaypointController.php",
    "groupTitle": "Waypoint",
    "name": "PostApiV1WaypointWaypointApi"
  },
  {
    "type": "post",
    "url": "/api/v1/waypoint/waypointCategory.api",
    "title": "路标大全",
    "group": "Waypoint",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "version": "0.0.1",
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XX\",\n      \"result\": [{\n          'id','1'\n          'name':'name',\n          'point1_count':'路标总数',\n          \"category_count\":'路标子分类总数',\n          'point1':[{\n              'id':1,\n              'name':'xx'，\n              'thumb':\"http://xx.png\"\n          }]\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"返回失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/WaypointController.php",
    "groupTitle": "Waypoint",
    "name": "PostApiV1WaypointWaypointcategoryApi"
  },
  {
    "type": "post",
    "url": "/api/v1/waypoint/waypointList.api",
    "title": "路标详情",
    "group": "Waypoint",
    "permission": [
      {
        "name": "签名"
      }
    ],
    "version": "0.0.1",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "id",
            "optional": false,
            "field": "wc1Id",
            "description": "<p>分类1Id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "响应成功:",
          "content": "{\n      \"code\": 200,\n      \"message\": \"XX\",\n      \"result\": [{\n          'id':'1',\n          'name':'name'\n          'thumb':\"http://xx.png\"\n      }]\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "响应失败:",
          "content": "{\n      \"code\": 400,\n      \"message\": \"返回失败\"\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./app/Http/Controllers/Api/V1/WaypointController.php",
    "groupTitle": "Waypoint",
    "name": "PostApiV1WaypointWaypointlistApi"
  }
] });
