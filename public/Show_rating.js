;(function($){
	
	
	$.rating = function(e, o){
		
		this.options = $.extend({
		    fx: 'float',
            image: '/images/stars.png',
			stars: 5,
            minimal: 0,
			titles: ['голос','голоса','голосов'],
			readOnly: false,
			url: '',
            type: 'post',
            loader: '/images/ajax-loader.gif',			
			click: function(){},
            callback: function(){}
		}, o || {});
		
		this.el = $(e);
        this.left = 0;
        this.width = 0;
        this.height = 0;
        this._data = {};
        
        var self = this;
        
        this.el.find(':hidden').each(function(){
            
            var $this = $(this);
            self._data[$this.attr('name')] = $this.val();
            
        });
        
        this._data.val = parseFloat(this._data.val) || 0;
        this._data.votes = parseFloat(this._data.votes) || '';

        
        if(this._data.val > this.options.stars) this._data.val = this.options.stars;
        if(this._data.val < 0) this._data.val = 0;
        
        this.old = this._data.val;

		this.vote_wrap = $('<div class="vote-wrap"></div>');
		this.vote_block = $('<div class="vote-block"></div>');
        this.vote_hover = $('<div class="vote-hover"></div>');
		this.vote_stars = $('<div class="vote-stars"></div>');
		this.vote_active = $('<div class="vote-active"></div>');
		this.vote_result = $('<div class="vote-result"></div>');
		this.vote_success = $('<div class="vote-success"></div>');
        this.loader = $('<img src="'+this.options.loader+'" alt="load...">');

        this.el.html(this.loader);

        //Загружаем изображение звезд и высчитываем ширину и высоту одной звезды
        var img = new Image();
        img.src = this.options.image;
        img.onload = function() {
            self.width = this.width; //Ширина одной звезды
            self.height = this.height/3; //Высота одной звезды
            self.init();
        };
		
	};
	
	
	var $r = $.rating;

	$r.fn = $r.prototype = {
		rating: '2.0'
    };})(jQuery);// JavaScript Document