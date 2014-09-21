(function($){
	/**
	 * 管理员信息模块
	 */
	var _adminMessage = function(){
		this.init();
	};
	$.extendObject(_adminMessage, modules.baseModule, 'adminMessage');
	$.extend(_adminMessage.prototype, {
		init : function(){
			this.create();
			this.addClass('right-float admin-message');
			var a = this;
			a.userNameElement || (a.userNameElement = $('<span></span>'));
			a.roleNameElement || (a.roleNameElement = $('<span></span>'));
			a.changePasswordButton || (a.changePasswordButton = $('<a href="javascript:void(0);">修改密码</a>'));
			a.exitButton || (a.exitButton = $('<a href="javascript:void(0);">退出</a>'));
			a.homeButton || (a.homeButton = $('<a href="">网站首页</a>'));
			a.contianer.append('您好！&nbsp;');
			a.contianer.append(a.userNameElement);
			a.contianer.append('&nbsp;[');
			a.contianer.append(a.roleNameElement);
			a.contianer.append(']&nbsp;');
			a.contianer.append(a.exitButton);
			a.contianer.append(a.changePasswordButton);
			a.contianer.append(a.homeButton);
			this.listener();
		},
		setAdminMessage : function(admin){
			if($.isUndefined(admin) || null == admin) return;
			var a = this;
			if(!this.isCreated()) return;
			if(admin){
				admin.userName && a.userNameElement.append(admin.userName);
				admin.role && admin.role.name && a.roleNameElement.append(admin.role.name);
			}
		},
		listener : function(){
			var e = this;
			this.contianer.bind({
				click : function(event){
					var target = event.target || event.srcElement;
					if(target == e.exitButton[0]){
						$.ajax({
							url : 'admin!exit',
							type : 'POST',
							dataType : 'json',
							complete : function(response){
								response = $.evalJSON(response.responseText);
								response.success && (location.reload());
							}
						});
						return false;
					}
					if(target == e.changePasswordButton[0]){
						alert('changePassword');
						return false;
					}
				}
			});
		}
	});
	
	/**
	 * 标题按钮对象
	 */
	var _navButton = function(options){
		var defaults = {
			name : options.name || 'home',
			title : options.title || '首页',
			url : options.url || '',
			callback : options.callback || null,
			current : options.current || false
		};
		this.params = $.extend(defaults, options || {});
		var a = $('<a></a>');
		this.create(a);
		this.addClass('nav-button left-float');
		this.insertDom(this.params.title);
		this.contianer && this.contianer.attr({
			'href' : this.params.url
		});
		if(this.current) this.addClass('current');
		else this.removeClass('current');
		this.listener();
	};
	$.extendObject(_navButton, modules.baseModule, 'navButton');
	$.extend(_navButton.prototype, {
		getName : function(){
			return this.params.name;
		},
		/**
		 * 设置为当前选中
		 * @param a
		 */
		setCurrent : function(a){
			this.current = a || false;
			if(a) this.addClass('current');
			else this.removeClass('current');
		},
		/**
		 * 监听消息
		 */
		listener : function(){
			var e = this;
			this.contianer.bind({
				mouseover : function(){
					e.addClass('over');
				},
				mouseleave : function(){
					e.removeClass('over');
				}
			});
		}
	});
	
	var buttons = new Array();
	buttons[0] = new _navButton({
		name : 'loanManager',
		title : '贷款管理',
		url : 'admin/request!loanManager' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[1] = new _navButton({
		name : 'userManager',
		title : '用户管理',
		url : 'admin/request!userManager' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[2] = new _navButton({
		name : 'fundManager',
		title : '资金管理',
		url : 'admin/request!fundManager' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[3] = new _navButton({
		name : 'objectManager',
		title : '项目管理',
		url : 'admin/request!objectManager' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[4] = new _navButton({
		name : 'finance',
		title : '实时财务',
		url : 'admin/request!finance' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[5] = new _navButton({
		name : 'systemConfig',
		title : '系统配置',
		url : 'admin/request!systemConfig' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[6] = new _navButton({
		name : 'columnAndArticle',
		title : '栏目和文章',
		url : 'admin/request!columnAndArticle' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	buttons[7] = new _navButton({
		name : 'roleManager',
		title : '角色权限管理',
		url : 'admin/request!roleManager' + '?n=' + Math.random(),
		callback : null,
		current : false
	});
	
	/**
	 * 菜单容器
	 */
	var _menuFrame = function(){
		this.isCreated() || this.init();
	};
	$.extendObject(_menuFrame, modules.baseModule, 'menuFrame');
	$.extend(_menuFrame.prototype, {
		init : function(){
			this.create();
		},
		insertPanel : function(a){
			if($.isUndefined(a) || null == a) return;
			this.contianer.accordion('add', {
				title : a.title || '菜单',
				content : a.contianer || ''
			});
		},
		createAccordion : function(){
			this.contianer.accordion({
				fit : true
			});
		}
	});
	
	/**
	 * 菜单项
	 */
	menuNum = window.menuNum || 0;
	var _menuItem = function(options){
		this.name = options.name || 'column' + (menuNum ++);
		this.title = options.title || '菜单';
		this.init();
	};
	$.extendObject(_menuItem, modules.baseModule, 'menuItem');
	$.extend(_menuItem.prototype, {
		/**
		 * 初始化
		 */
		init : function(){
			this.create();
			this.addClass('menu-list full-horizontal');
			this.menus = [];
		},
		insertMenu : function(a){
			if($.isUndefined(a) || null == a) return;
			this.warp || (this.warp = $('<ul></ul>'));
			var b = $('<li></li>');
			b.append(a);
			this.warp.append(b);
			this.insertDom(this.warp);
		}
	});
	
	var _titleBar = new modules.baseModule;
	_titleBar.addClass('clear-float');
	var _title = new modules.baseModule;
	_title.addClass('title-bar left-float');
	_title.insertDom('恒融财富后台管理');
	var _am = new _adminMessage;
	_titleBar.insertModule(_title);
	_titleBar.insertModule(_am);
	
	var _nav = new modules.baseModule;
	_nav.addClass('nav-bar clear-float');
	for(var i in buttons)
		_nav.insertModule(buttons[i]);
	
	$(function(){
		$.ajax({
			url : 'admin!getLoginAdmin',
			type : 'POST',
			dataType : 'json',
			complete : function(response){
				response = $.evalJSON(response.responseText);
				admin = response;
				_am && _am.setAdminMessage(admin);
			}
		});
	});
	
	$.extend(window, {
		titleBar : _titleBar,
		nav : _nav,
		menuFrame : _menuFrame,
		menuItem : _menuItem
	});
})(jQuery);