jQuery(document).ready(function() {
	//var slider = { auto: true, autoControls: false, pager: false, controls: false, onSlideAfter: nextSlider }
	//App.getSlider('#slider',slider);

	App.getPlaceholder('input, textarea');

	App.getMask('.data','99/99/9999');
	App.getMask('.telefone','(99) 9999-9999');
	App.getMask('.celular','(99) 9999-9999?9');
	App.getMask('.cep','99999-999');

	//$("select").chosen({disable_search: true});
	//$(".fancybox").fancybox();

});

function nextSlider($slideElement, oldIndex, newIndex){

}