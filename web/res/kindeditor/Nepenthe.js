/**
 * jQuery Nepenthe 1.0.1
 * 
 * Copyright (c) biboheart.
 * 
 * email : biboheart@yeah.net
 * 
 */
var Nepenthe = Nepenthe || {};
Nepenthe._version = 'Nepenthe V1.0.1';
Nepenthe._startTime = new Date().getTime();

$.extend(Nepenthe, {
	/**
	 * 取当前版本
	 * 
	 * @returns nepenthe 版本号
	 */
	getVersion : function() {
		return Nepenthe._version;
	}
});

(function($) {
	/***************************************************************************
	 * 扩展JQuery工具
	 */
	var _ej = Nepenthe.ExtendJQuery = Nepenthe.Util || {};
	$.extend(Nepenthe.ExtendJQuery, {
		/**
		 * 对象继承，能够继承属性和方法
		 * 
		 * @param a
		 *            子对象
		 * @param b
		 *            父对象
		 * @param c
		 *            对象名称
		 */
		extendObject : function(a, b, c) {
			var e, f = a.prototype;
			e = new Function;
			e.prototype = b.prototype;
			e = a.prototype = new e;
			for ( var d in f)
				e[d] = f[d];
			a.prototype.constructor = a;
			if ('string' == typeof c)
				e.objectName = c;
		},
		/**
		 * 是否是未定义的对象
		 * 
		 * @param a
		 *            判断的对象
		 * @returns boolean
		 */
		isUndefined : function(a) {
			return 'undefined' == typeof a;
		},
		/**
		 * 判断对象是不是字符串
		 * 
		 * @param a
		 *            判断的对象
		 * @returns boolean
		 */
		isString : function(a) {
			return 'string' == typeof a;
		},
		/**
		 * 取当前时间
		 * 
		 * @returns 返回当前时间戳
		 */
		getCurrentTime : function() {
			return new Date().getTime();
		},
		/**
		 * 日期字符串转时间戳
		 * 
		 * @param a
		 *            时间字符串('2014-03-13 23:23:23'|'2014年03月13日
		 *            23:23:23'|'2014年03月13日 23年23月23日')
		 * @@returns 返回时间戳
		 */
		dateToMillis : function(a) {
			if ($.isUndefined(a))
				return new Date().getTime();
			a = a.replace(/:/g, '-');
			a = a.replace(/年|月/g, '-');
			a = a.replace(/点|分/g, '-');
			a = a.replace(/日/g, '');
			a = a.replace(/秒/g, '');
			a = a.replace(/ /g, '-');
			a = a.split("-");
			a = Date.UTC(a[0], a[1] - 1, a[2], a[3] - 8, a[4], a[5], 0);
			return a;
		},
		/**
		 * 格式化时间
		 * 
		 * @param a
		 *            格式化模型 像：'yyyy-MM-dd HH:mm:ss'
		 * @param b
		 *            时间戳或空，空时为当前时间
		 * @returns 格式化后的字符串
		 */
		formatDate : function(a, b) {
			var datetime = null;
			a || (a = 'yyyy-MM-dd HH:mm:ss');
			if ($.isUndefined(b) || 0 >= parseInt(b))
				datetime = new Date();
			else
				datetime = new Date(b);
			var o = {
				'M+' : datetime.getMonth() + 1, // 月份
				'd+' : datetime.getDate(), // 日
				'h+' : datetime.getHours() % 12 == 0 ? 12
						: datetime.getHours() % 12, // 小时
				'H+' : datetime.getHours(), // 小时
				'm+' : datetime.getMinutes(), // 分
				's+' : datetime.getSeconds(), // 秒
				'q+' : Math.floor((datetime.getMonth() + 3) / 3), // 季度
				'S' : datetime.getMilliseconds()	// 毫秒
			};
			var week = {
				'0' : '日',
				'1' : '一',
				'2' : '二',
				'3' : '三',
				'4' : '四',
				'5' : '五',
				'6' : '六'
			};
			if (/(y+)/.test(a)) {
				a = a.replace(RegExp.$1, (datetime.getFullYear() + '')
						.substr(4 - RegExp.$1.length));
			}
			if (/(E+)/.test(a)) {
				a = a.replace(RegExp.$1,
						((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? '星期'
								: '周') : '')
								+ week[datetime.getDay() + '']);
			}
			for ( var k in o) {
				if (new RegExp('(' + k + ')').test(a)) {
					a = a.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k])
							: (('00' + o[k]).substr(('' + o[k]).length)));
				}
			}
			return a;
		},
		/**
		 * jquery-nepentheAudioPlay
		 */
		nepentheAudioPlay : function(options) {
			var defaults = {
				name : "nepentheAudioPlay",
				url : "",
				callback : null
			};
			var params = $.extend(defaults, options || {}), audioHtml = "";
			var strIdRoot = params.name, i = 0;
			while(0 < $('#' + strIdRoot + i).length){
				i ++;
			};
			strIdRoot = strIdRoot + i + '';
			audioHtml = '<embed id="' + strIdRoot + '" src="' + params.url + '" width="0" height="0" loop="false" autostart="true" hidden="true"></embed>';
			$("body").append(audioHtml);
			var emb = $('#' + strIdRoot)[0];
			if(emb){
				setTimeout(function(){
					$(emb).remove();
					if(null != params.callback) params.callback();
				}, 5000);
			};
		}
	});
	/**
	 * 环境判断
	 */
	// 判断浏览器
	_ej.browser = _ej.browser || {};
	// ie
	/msie (\d+\.\d)/i.test(navigator.userAgent)
			&& (_ej.browser.IE = _ej.IE = document.documentMode || +RegExp.$1);
	// opera
	/opera\/(\d+\.\d)/i.test(navigator.userAgent)
			&& (_ej.browser.opera = +RegExp.$1);
	// firefox
	/firefox\/(\d+\.\d)/i.test(navigator.userAgent)
			&& (_ej.browser.firefox = +RegExp.$1);
	// safari
	/(\d+\.\d)?(?:\.\d)?\s+safari\/?(\d+\.\d+)?/i.test(navigator.userAgent)
			&& !/chrome/i.test(navigator.userAgent)
			&& (_ej.browser.safari = +(RegExp.$1 || RegExp.$2));
	// chrome
	/chrome\/(\d+\.\d)/i.test(navigator.userAgent)
			&& (_ej.browser.chrome = +RegExp.$1);
	// webkit
	_ej.browser.webkit = /webkit/i.test(navigator.userAgent);
	// gecko
	_ej.browser.gecko = /gecko/i.test(navigator.userAgent)
			&& !/like gecko/i.test(navigator.userAgent);
	// 判断文档是否加了标准声明
	_ej.browser.compatMode = "CSS1Compat" == document.compatMode;
	// 判断客户端平台
	_ej.platform = _ej.platform || {};
	// Mac
	_ej.platform.macintosh = /macintosh/i.test(navigator.userAgent);
	// windows
	_ej.platform.windows = /windows/i.test(navigator.userAgent);
	// x11
	_ej.platform.x11 = /x11/i.test(navigator.userAgent);
	// android
	_ej.platform.android = /android/i.test(navigator.userAgent);
	/android (\d+\.\d)/i.test(navigator.userAgent)
			&& (_ej.platform.android = _ej.android = RegExp.$1);
	// ipad
	_ej.platform.ipad = /ipad/i.test(navigator.userAgent);
	// iphone
	_ej.platform.iphone = /iphone/i.test(navigator.userAgent);

	$.extend(_ej);
	/***************************************************************************
	 * end
	 **************************************************************************/

})(jQuery);

(function($) {
	var _b1 = Nepenthe.Base = function() {
	};
	$.extend(_b1.prototype, {
		/**
		 * 取当前版本
		 * 
		 * @returns nepenthe 版本号
		 */
		getVersion : function() {
			return Nepenthe._version;
		}
	});

	/**
	 * nepenthe 基类
	 */
	var _no1 = Nepenthe.Object = function() {
	};
	$.extendObject(_no1, _b1, 'object');
	$.extend(_no1.prototype, {

	});

	/**
	 * 自定义对象，继承它的对象拥有自定义事件的能力
	 */
	var _neo = Nepenthe.EventObject = function() {
	};
	$.extendObject(_neo, _no1, 'object');
	$.extend(_neo.prototype, {
		/**
		 * 添加事件监听
		 * 
		 * @param a
		 *            事件类型
		 * @param b
		 *            回调函数
		 * @param c
		 *            事件对象
		 */
		addEventListener : function(a, b, c) {
			if ($.isFunction(b)) {
				!this._events && (this._events = {});
				var d = this._events;
				!d[a] && (d[a] = []);
				d[a].push(b);
			}
		},
		/**
		 * 移除事件监听
		 * 
		 * @param a
		 *            事件类型
		 * @param b
		 *            回调函数
		 */
		removeEventListener : function(a, b) {
			!this._events && (this._events = {});
			var c = this._events[a];
			if (!c || !c.length) {
				return;
			}
			b || delete this._events[a];
			if ($.isFunction(b)) {
				for ( var i = c.length - 1; i >= 0; i--) {
					c[i] == b && c.splice(i, 1);
				}
			}
		},
		/**
		 * 事件分发
		 * 
		 * @param a
		 *            事件类型
		 */
		dispatchEvent : function(a) {
			!this._events && (this._events = {});
			var b = this._events[a];
			if (!b || !b.length) {
				return;
			}
			var args = Array.prototype.slice.call(arguments, 0);
			args.shift();
			for ( var i = 0, l = b.length; i < l; i++) {
				b[i].apply(this, args);
			}
		}
	});

	/**
	 * nepenthe 带自定义对象的基类,继承它的对象拥有自定义事件的能力(元素对象)
	 */
	/**
	 * 消息属性
	 */
	var _ne = Nepenthe.EventAttr = function(a, b) {
		this.type = a;
		this.returnValue = true;
		this.target = b || null;
		this.currentTarget = null;
	};
	var _neeo = Nepenthe.EventElementObject = function() {
	};
	$.extendObject(_neeo, _no1, 'object');
	$.extend(_neeo.prototype, {
		/**
		 * 添加监听事件
		 * 
		 * @param a:string
		 *            事件名称
		 * @param b:function
		 *            回调函数
		 * @param c:string
		 *            对象标识，标识监听事件的对象, 移除事件是可以通过此标识移除此对象的些事件的监听
		 */
		addEventListener : function(a, b, c) {
			if ($.isFunction(b)) {
				!this.callbacks && (this.callbacks = {});
				var d = this.callbacks, e = null;
				if ($.type(c) === 'string' && c) {
					if (/[^\w\-]/.test(c))
						throw 'nonstandard key:' + c;
					e = b.objectName = c;
				}
				a.indexOf('on') != 0 && (a = 'on' + a);
				$.type(d[a]) != 'object' && (d[a] = {});
				e = e || 'bhInstance';
				b.objectName = e;
				d[a][e] = b;
			}
		},
		/**
		 * 移除对象中正在监听的某个事件
		 * 
		 * @param a
		 *            事件名称
		 * @param b
		 *            对象标识
		 */
		removeEventListener : function(a, b) {
			if ($.isFunction(b))
				b = b.objectName;
			else if (!$.type(b) === 'string')
				return;
			!this.callbacks && (this.callbacks = {});
			a.indexOf('on') != 0 && (a = 'on' + a);
			var c = this.callbacks;
			c[a] && c[a][b] && delete c[a][b];
		},
		/**
		 * 发出一个自定义事件
		 * 
		 * @param a:Nepenthe.Event
		 *            事件属性对象
		 * @param b:object
		 *            事件传参
		 */
		dispatchEvent : function(a, b) {
			$.type(a) === 'string' && (a = new _ne(a));
			!this.callbacks && (this.callbacks = {});
			b = b || {};
			for ( var c in b)
				a[c] = b[c];
			var d = this.callbacks, e = a.type;
			a.target = a.target || this;
			a.currentTarget = this;
			e.indexOf('on') != 0 && (e = 'on' + e);
			$.isFunction(this[e]) && this[e].apply(this, arguments);
			if (typeof d[e] == "object")
				for ( var c in d[e])
					d[e][c].apply(this, arguments);
			return a.returnValue;
		}
	});
})(jQuery);
