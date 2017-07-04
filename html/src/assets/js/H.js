/*
**js基础函数H类
**黄总
**2017.6.29
*/
import axios from 'axios'
import qs from 'qs'
axios.defaults.baseURL = 'http://127.0.0.1/learn/php/index.php?s='
axios.defaults.headers['Content-Type'] = 'application/x-www-form-urlencoded'
function H () {
	//定义路径
}

H.prototype.ajax = function(url,data,type,fun){
	if('get' == type){
		axios.get(url, {
			params: data
		})
		.then(function (response) {
			fun(response)
		})
		.catch(function (error) {
			alert('网络错误！');
			console.log(error)
		})
	}else if('post' == type){
		axios.post(url, qs.stringify(data))
		.then(function (response) {
			fun(response)
		})
		.catch(function (error) {
			alert('网络错误！');
			console.log(error)
		})
	}
}
H.prototype.set_localStorage = function (obj, ocj) {
	if (ocj) {
		localStorage.setItem(obj, JSON.stringify(ocj))
	} else {
		localStorage.removeItem(obj)
	}
}
H.prototype.get_localStorage = function (obj) {
	obj = obj.split('.')
    // 获取数据
    var data = JSON.parse(localStorage.getItem(obj[0]))
    return obj[1] ? data[obj[1]] : data
}
H.prototype.ceshi = function () {

}
export default new H()
