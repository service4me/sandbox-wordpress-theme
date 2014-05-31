// Custom page actions

var netzgestaltung = {};


;(function($, ng){

  var configuration = {

    secureWebsite: 'www.uebermorgen.at',
    modules: {

    } 

  };

  $.extend(true, ng || {}, {

    enable: function(){

      this.setConfig();

    },
    disable: function(){

    },
    getConfig: function(){

      var config = $.isPlainObject(configuration) ? configuration : this.noConfig();

      return config;

    },
    setConfig: function(){

      var config = this.getConfig();

      this.config = config;
      this.utilities.config = config;

    },
    noConfig: function(){

      return {};

    },
    utilities: {

      getConfig: function(){

        return this.config;

      },
      isFront: function(){

        return $('body').is('.home');

      },
      getViewportSize: function(){

        var size = {

            width: $('html').innerWidth(),

            height: $('html').innerHeight()

        }

        return size;

      }

    },
    modules: {

    }

  });

  ng.mobile = {
    
    resizeTimeout: null,
    cookie: null,
    sweetSpot: 987,
    checkIfMobile: function(){
      
      var size = ng.utilities.getViewportSize();
    
      if ( size.width <= ng.mobile.sweetSpot ) {
        
        return true;
        
      }
      
      return false;
      
    },
    desktopModeModule: {
      
      enable: function() {},
      disable: function() {},
      enableMobile: function() {

        ng.mobile.desktopModeModule.enableMobileCSS();
        ng.mobile.desktopModeModule.removeBackToLink();
        ng.mobile.enableMobileLogic();
          
      },
      disableMobile: function() {

        ng.mobile.desktopModeModule.disableMobileCSS();
        ng.mobile.desktopModeModule.addBackToLink();
        ng.mobile.disableMobileLogic();
          
      },
      disableMobileCSS: function() {
        
        var link = $('link[href$="style_mobile.css"]'),
            href = link.attr('href');

        href = href.replace('style_mobile.css', 'style.css');
        link.attr('href', href);
          
      },
      enableMobileCSS: function() {
        
        var link = $('link[href$="style.css"]:last'),
            href = link.attr('href');

        href = href.replace('style.css', 'style_mobile.css');
        link.attr('href', href);
          
      },
      addBackToLink: function() {},
      removeBackToLink: function() {},
      setCookie: function() {},
      getCookie: function() {},
      deleteCookie: function() {}
      
    },
    imagehandling: {

      isDifferntSize: function($image){

        return ( $image.outerWidth() != $image.parent().outerWidth() );

      },
      enable: function(){

        var self = this;

        $('#page img').not('no-mobile').each(function(){
          
          $(this).parent().css({'display' : 'block'});

          var width = $(this).parent().outerWidth(),
              imageSize = $(this).data('image') || {width: false, height: false},
              newImageHeight;

          imageSize.width = imageSize.width ? imageSize.width : $(this).outerWidth();
          imageSize.height = imageSize.height ? imageSize.height : $(this).outerHeight();

          if ( self.isDifferntSize($(this)) && !$('.view-aktuelles-angebot').has('img').length > 0 ) {

            newImageHeight = imageSize.height / (imageSize.width / width);

            if ( $.type($(this).data('image')) == 'undefined' ) {

              $(this).data('image', {width: imageSize.width, height: imageSize.height});

            }

            $(this).css({'width': width, 'height': newImageHeight});

          }

        });

      },
      disable: function(){

        $('#page img').removeAttr('style');

      },
      resize: function(){

        this.enable();

      }

    },
    logoModule: {

      getconfig: function(){

        var $title = $('#blog-title a'),
            titleWidth = $title.width(),
            logoSrc = $title.css('background-image'),
            $logo;

        logoSrc = logoSrc.replace(/url\((['"])?(.*?)\1\)/gi, '$2');
        
        $logo = $('<img src="' + logoSrc + '" />').css({height:'auto'});

        return {

          title: $title,
          titleWidth: titleWidth,
          logo: $logo,

        };

      },
      enable: function(){

        var config = this.getconfig(),
            titleHeight;

        config.logo.appendTo('body').width(config.titleWidth);
        titleHeight = config.logo.height();
        config.title.height(titleHeight);
        config.logo.remove();

      },
      disable: function(){

        var config = this.getconfig();
          
        config.title.removeAttr('style');

      },
      resize: function(){

        this.enable();

      }

    },
    navigationModule: {

      config: {

        navId: 'top',
        menuId: 'menu-main',
        togglerId: 'menu-toggle',
        toggleText: 'Toggle Menu',
        activeClass: 'active'

      },
      enable: function () {

        var config = $.extend(true, {}, this.config),
            $toggler = $('<a href="' + config.menuId + '" id="' + config.togglerId + '">' + config.toggleText + '</a>');

        $toggler.on({

          click: function(event){

            var $target = $('#' + $(this).attr('href'));

            if ( $target.is('.' + config.activeClass) ) {

              $target.toggleClass(config.activeClass).find('a').eq(0).trigger('focus');

            } else {

              $target.toggleClass(config.activeClass).next().trigger('focus');

            }

            $(this).toggleClass(config.activeClass);

            event.preventDefault();

          }

        });

        $('#' + config.menuId).before($toggler);


      },
      disable: function () {

        var config = $.extend(true, {}, this.config);

        $('#' + config.togglerId).remove();
        $('#' + config.menuId).removeAttr('style').removeClass('active');

      }
        
    },
    searchModule: {

      config: {

        navId: 'top',
        searchId: 'searchform',
        inputId: 's',
        togglerId: 'search-toggle',
        toggleText: 'Toggle Search',
        activeClass: 'active'

      },
      enable: function () {

        var config = $.extend(true, {}, this.config),
            $toggler = $('<a href="' + config.searchId + '" id="' + config.togglerId + '">' + config.toggleText + '</a>'),
            size = ng.utilities.getViewportSize(),
            searchWidth,
            togglerWidth = 82;

        $toggler.on({

          click: function(event){

            var $target = $('#' + $(this).attr('href'));

            if ( $target.is('.' + config.activeClass) ) {

              $target.animate({top:-40}, 500, $.easing.easeOutCubic()).toggleClass(config.activeClass);

              $(this).trigger('focus');

            } else {

              $target.animate({top:0}, 300, $.easing.easeOutCubic()).toggleClass(config.activeClass)

              $('#' + config.inputId).trigger('focus');

            }

            $(this).toggleClass(config.activeClass);

            event.preventDefault();

          }

        });

        $('#' + config.searchId).before($toggler);

        searchWidth = size.width - togglerWidth;

        $('#' + config.searchId).width(searchWidth);

      },
      disable: function () {

        var config = $.extend(true, {}, this.config);

        $('#' + config.togglerId).remove();
        $('#' + config.searchId).removeAttr('style').removeClass('active');

      },
      resize: function(){

        var config = $.extend(true, {}, this.config),
            size = ng.utilities.getViewportSize(),
            searchWidth,
            togglerWidth = 82;

        searchWidth = size.width - togglerWidth;

        $('#' + config.searchId).width(searchWidth);

      }
        
    },
    enableMobileLogic: function () {

      // Disable desktop elements.
      // ng.tabsModule.disable();
      // ng.iframeModule.disable();

      // Enable mobile elements.
      // ng.mobile.imagehandling.enable();
      ng.mobile.logoModule.enable();
      ng.mobile.navigationModule.enable();
      ng.mobile.searchModule.enable();
      
    },
    disableMobileLogic: function () {

      // Disable mobile elements.
      // ng.mobile.imagehandling.disable();
      ng.mobile.logoModule.disable();
      ng.mobile.navigationModule.disable();
      ng.mobile.searchModule.disable();

      // Enable desktop elements.
      // ng.tabsModule.enable();
      ng.iframeModule.enable();
      
    },
    addResizeEvent: function () {

      $(window).resize( function(e) {

        // Set timeout to avoid constant execution.
        clearTimeout(ng.mobile.resizeTimeout);
        ng.mobile.resizeTimeout = setTimeout(ng.mobile.doneResizing, 10);
        
      });
      
    },
    doneResizing: function () {
      
      var wasMobile = ng.isMobile,
          isMobile = ng.mobile.checkIfMobile();


      // ng.newsModule.resize();

      // In mobile all the time.
      if ( wasMobile === true && isMobile === true ) {
        
        // Reload to fix width.
        ng.mobile.logoModule.resize();
        ng.mobile.searchModule.resize();
        
      }
      
      // Switched to mobile.
      if ( isMobile === true && wasMobile === false ) {
        
        ng.isMobile = true;

        ng.mobile.enableMobileLogic();
        
      }

      // Switched to desktop.
      if ( isMobile === false && wasMobile === true ) {

        ng.isMobile = false;

        ng.mobile.disableMobileLogic();
        
      }
      
    },
    checkIfIphone: function () {

      if ( navigator.userAgent.match(/iPhone/i) ) {
        
        return true;
        
      }
      
      return false;
      
    },
    iphoneViewportFix: function() {

      var metas = $('meta[name=viewport]');

      if ( ng.mobile.checkIfIphone() === false ) {
        
        return;
        
      };

      // Fix the scale on init.
      metas.attr('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0');

      metas.attr('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0');

      $('body').bind('orientationchange', function(event) {

        // Fix the scale on orientation change.
        metas.attr('content','width=device-width, initial-scale=1.0, maximum-scale=1.0');
        
      });

      $('body').bind('gesturestart', function(event) {

          // Extend the scale on gesture start.
          metas.attr('content', 'width=device-width, initial-scale=1.0, maximum-scale=3.0');
          
      });
      
    }
    
  };

  $(document).ready(function(){


    ng.enable();

    if ( $.type(window.console) != 'undefined') {

      console.log( ng );

    }

    ng.isMobile = ng.mobile.checkIfMobile();

    if ( $('html').is('.lt-ie10') ) {

      return;
        
    }

    if ( ng.isMobile === true ) {
      
      ng.mobile.enableMobileLogic();
        
    }

    ng.mobile.addResizeEvent();
    ng.mobile.iphoneViewportFix();
    
    $('#menu-main > li').on('mouseenter.dropdown focusin.dropdown', function(){

      $(this).addClass('dropdown');

    }).on('mouseleave.dropdown focusout.dropdown', function(){

      $(this).removeClass('dropdown');

    });

    var tagWahrnemung = function(){

      var $activeMenuElement = $('#menu-main > li.current-menu-item, #menu-main > li.current-menu-parent'),
          objectiveClass = 'objective',
          subjectiveClass = 'subjective',
          isObjective = $activeMenuElement.is('.' + objectiveClass),
          isSubjective = $activeMenuElement.is('.' + subjectiveClass);

      if ( isObjective ) {

        $('#mainContent .page-title, #mainContent .description').addClass(objectiveClass);

      } else if ( isSubjective ) {

        $('#mainContent .page-title, #mainContent .description').addClass(subjectiveClass);

      }


    }

    tagWahrnemung();

    var singleMenuClass = function(){

      var bodyClass,
          bodyClasses,
          tags = [];

      if ( $('body').is('.single') ) {

        bodyClass = $('body').attr('class');
        bodyClasses = bodyClass.split(' ');

        $.each(bodyClasses, function(index, bodyClass){

          if ( bodyClass.match('s-tag') !== null ) {

            tags.push(bodyClass.substring(bodyClass.lastIndexOf('-')+1));

          }

        });

        $('#menu-main > li > a').each(function(index){

          var $this = $(this),
              text = $this.text();

          $.each(tags, function(index, tag){

            if ( tag == text.toLowerCase() ) {

              $this.parent().addClass('current-menu-parent');

            }

          });

        });

      }

    }

    singleMenuClass();


    $('#commentform').hide();

    $('#respond > h3 > a').on('click.commentform', function(event){

      $($(this).attr('href')).trigger('focusin.commentform').slideDown(600, 'swing', function(){

        var $this = $(this);

        $('html, body').animate({'scrollTop' : $this.offset().top}, 600, 'swing', function(){

          window.location.hash = $this.attr('id');

        });

      });

      event.preventDefault();

    });

    $('#mainContent > .meta .comments a').on('click.commentscroll', function(event){

      var comementsLink = $(this).attr('href'),
          commentsId = comementsLink.substring(comementsLink.lastIndexOf('#')),
          commentsOffset = $(commentsId).offset();

      $('html, body').animate({'scrollTop' : commentsOffset.top}, 600, 'swing', function(){

        if ( $(this).is('body') ) {

          $('#respond > h3 > a').trigger('click.commentform');

        }

      });

      event.preventDefault();

    });

    menu = {

      defaults: {},
      init: function(){

        var config = $.extend(true, {}, this.defaults || {});

        this.setConfig(config);

      },
      setConfig: function(config){

        this._config = $.type(config) == 'object' ? config : {};

      },
      getConfig: function(){

        return $.type(this._config) == 'object' ? this._config : {};

      },
      enable: function(){

        var config = this.getConfig();

      },
      disable: function(){

        var config = this.getConfig();

      },
      decorate: function(){

        var config = this.getConfig();

      },
      undecorate: function(){

        var config = this.getConfig();

      },
      change: function(){

        var config = this.getConfig();

      }

    };


  });

})(jQuery, netzgestaltung);
