var pageBanner;
var App = function () {

    var slider = function (element,options) {
    	pageBanner = $(element).bxSlider(options);
    }

    var placeholder = function(element){
    	$(element).placeholder();
    }

    var mask = function(element, validation){
    	$(element).mask(validation);
    }

    var validate = function(element, rules, messages){
        $(element).validate({
            rules: rules,
            messages: messages
        });
    }

    return{
    	getSlider: function(element, options){
    		slider(element,options);
    	},

    	getPlaceholder: function(element){
    		placeholder(element);
    	},

    	getMask: function(element, validation){
    		mask(element, validation);
    	},

        getValidate: function(element, rules, messages){
            validate(element, rules, messages);
        },

        setPage: function(page){
            pageBanner.goToSlide(page);
        },
    }

}();