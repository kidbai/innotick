(function($){
	var _ms = window.modules || {};
	var _page = function(){};
	$.extend(_page.prototype, {
		/**
		 * 是否已经初始化
		 * @returns boolean
		 */
		isCreated : function(){
			var p = this;
			if($.isUndefined(p.created) || null == p.created) return false;
			return p.created;
		},
		/**
		 * 创建页面
		 */
		createPage : function(){
			var p = this;
			if(p.isCreated()) return;
			p.contianer || (p.contianer = $('<div></div>'));
			p.contianer.empty();
			p.contianer.addClass('full-horizontal-vertical');
			p.layoutObj = $('<div></div>');
			p.northObj = $('<div></div>');
			p.westObj = $('<div></div>');
			p.centerObj = $('<div></div>');
			p.layoutObj.addClass('full-horizontal-vertical');
			p.northObj.addClass('full-horizontal-vertical').css('background', '#95b8e7');
			p.westObj.addClass('full-horizontal-vertical');
			p.centerObj.addClass('full-horizontal-vertical');
			p.contianer.append(p.layoutObj);
			$('body').append(p.contianer);
			p.layoutObj.layout();
			p.layoutObj.layout('add', {
				region : 'north',
				height : 120,
				content : p.northObj
			});
			p.layoutObj.layout('add', {
				region : 'west',
				width : 220,
				content : p.westObj
			});
			p.layoutObj.layout('add', {
				region : 'center',
				minHeight : 800,
				content : p.centerObj
			});
			this.created = true;
		},
		/**
		 * 尺寸变化
		 */
		resize : function(){
			var a = this.modules;
			if($.isUndefined(a) || null == a) return;
			for(var i in a)
				a[i].resize && a[i].resize();
			for(var i in this.northModules)
				this.northModules[i].resize && this.northModules[i].resize();
			for(var i in this.westModules)
				this.westModules[i].resize && this.westModules[i].resize();
			for(var i in this.centerModules)
				this.centerModules[i].resize && this.centerModules[i].resize();
		},
		/**
		 * 向页面标题插入模块
		 * @param a 模块对象
		 */
		insertModuleToNorth : function(a){
			var p = this;
			p.northModules || (p.northModules = new Array());
			p.northModules.push(a);
			if($.isUndefined(a.contianer) || null == a.contianer) return;
			p.northObj.append(a.contianer);
		},
		/**
		 * 向页面左侧插入模块
		 * @param a 模块对象
		 */
		insertModuleToWest : function(a){
			var p = this;
			p.westModules || (p.westModules = new Array());
			p.westModules.push(a);
			if($.isUndefined(a.contianer) || null == a.contianer) return;
			p.westObj.append(a.contianer);
		},
		/**
		 * 向页面正文插入模块
		 * @param a 模块对象
		 */
		insertModuleToCenter : function(a){
			var p = this;
			p.centerModules || (p.centerModules = new Array());
			p.centerModules.push(a);
			if($.isUndefined(a.contianer) || null == a.contianer) return;
			p.centerObj.append(a.contianer);
		},
		/**
		 * 清除正文
		 */
		clearCenter : function(){
			var p = this;
			for(var i in this.centerModules)
				this.centerModules[i].remove && this.centerModules[i].remove();
			p.centerModules && (p.centerModules.splice(0, p.centerModules.length), p.centerModules = []);
			p.centerObj.empty();
		}
	});
	/**
	 * 模块父类
	 */
	var _baseModule = function(dom){
		this.create(dom);
	};
	$.extend(_baseModule.prototype, {
		/**
		 * 模块是否已经创建
		 * @returns boolean
		 */
		isCreated : function(){
			var m = this;
			if($.isUndefined(m.created) || null == m.created) return false;
			return m.create;
		},
		/**
		 * 创建模块
		 * @param dom
		 * @returns DOM
		 */
		create : function(dom){
			if(this.isCreated()) return;
			dom = dom || $('<div></div>');
			this.contianer = dom;
			this.created = true;
			return this.contianer;
		},
		/**
		 * 清除模块
		 */
		clear : function(){
			if(!this.isCreated()) return;
			this.contianer && this.contianer.empty();
			if(this.modules){
				var ms = this.modules;
				for(var i in ms)
					ms[i].remove && ms[i].remove();
				ms.splice(0, ms.length);
				ms = null;
			}
		},
		/**
		 * 移除模块
		 */
		remove : function(){
			if(!this.isCreated()) return;
			this.clear();
			this.contianer && this.contianer.empty();
			this.contianer.remove();
			this.created = false;
		},
		/**
		 * 向模块添加样式
		 * @param classes 样式
		 */
		addClass : function(classes){
			if(!this.isCreated()) return;
			this.contianer && this.contianer.addClass(classes);
		},
		/**
		 * 移除样式
		 * @param classes
		 */
		removeClass : function(classes){
			if(!this.isCreated()) return;
			this.contianer && this.contianer.removeClass(classes);
		},
		/**
		 * 向模块中插入模块
		 * @param module 模块对象
		 */
		insertModule : function(module){
			if(!this.isCreated()) return;
			this.modules || (this.modules = new Array());
			var ms = this.modules;
			ms.push(module);
			this.contianer.append(module.contianer);
		},
		/**
		 * 向模块中插入元素
		 * @param dom
		 */
		insertDom : function(dom){
			if(!this.isCreated()) return;
			for(var i = 0, l = arguments.length; i < l; i ++){
				this.contianer.append(arguments[i]);
		    }
		}
	});
	$.extend(_ms, {
		page : _page,
		baseModule : _baseModule
	});
	$.extend(window, {
		modules : _ms
	});
})(jQuery);