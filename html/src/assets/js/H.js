/*
**js基础函数H类
**黄总
**2017.6.29
*/
import axios from 'axios'
import qs from 'qs'
axios.defaults.baseURL = 'http://127.0.0.1/learn/php/index.php?s='
axios.defaults.headers['Content-Type'] = 'application/x-www-form-urlencoded'
axios.defaults.withCredentials = true

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import store from '../../store'

function H () {
	//定义路径
}

H.prototype.ajax = function(url,data,type,fun){
	const that = this
	if('get' == type){
		axios.get(url, {
			params: data
		})
		.then(function (response) {
			//在此做统一的验证
			if (response.data.needlogin && !response.data.islogin) {
				//未登录的弹出登陆框
				that.store('showlogin', true)
				// 清空localstorage和store
				that.SL('userinfo')
				that.store('userinfo', {})
				return false
			}
			fun(response.data)
		})
		.catch(function (error) {
			ElementUI.Message.error('网络错误！')
			console.log(error)
		})
	}else if('post' == type){
		axios.post(url, qs.stringify(data))
		.then(function (response) {
			//在此做统一的验证
			if (response.data.needlogin && !response.data.islogin) {
				//未登录的弹出登陆框
				that.store('showlogin', true)
				// 清空localstorage和store
				that.SL('userinfo')
				that.store('userinfo', {})
				return false
			}
			fun(response.data)
		})
		.catch(function (error) {
			ElementUI.Message.error('网络错误！')
			console.log(error)
		})
	}
}
H.prototype.SL = function (obj, ocj) {
	if (ocj) {
		localStorage.setItem(obj, JSON.stringify(ocj))
	} else {
		localStorage.removeItem(obj)
	}
}
H.prototype.GL = function (obj) {
	obj = obj.split('.')
    // 获取数据
    var data = JSON.parse(localStorage.getItem(obj[0]))
    return obj[1] ? data[obj[1]] : data
}
H.prototype.store = function (key,value) {
	store.commit('setstates', [key, value])
}
H.prototype.success = function (info) {
	ElementUI.Message({
		message: info,
		type: 'success'
	})
}
H.prototype.error = function (info) {
	ElementUI.Message.error(info)
}
const HF = new H()
export {HF, ElementUI, store} 
