# vue-cli脚手架搭建的前端

> 前台html构建步骤

# 安装步骤


-  安装依赖
> npm install

- 开始
> npm start

- 本地环境调试开发（效果同上）
> npm run dev

- 打包上线
> npm run build

 > 打包后会在本目录build文件夹下生成html和js，css文件可以直接部署到静态服务器上即可

# 其他

- build for production and view the bundle analyzer report
> npm run build --report

- run unit tests
> npm run unit

- run e2e tests
> npm run e2e

- run all tests
> npm test

# 注意事项

> 说明如果安装成功但是提示网络请求错误，请修改/html/src/assets/js/H.js下的axios.defaults.baseURL为你php文件所在的http请求地址
