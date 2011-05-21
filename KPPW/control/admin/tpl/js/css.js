$(function() {

	$(":submit").mouseover(function() {

		$(this).attr("class", "input_but_over");
	})
	$(":submit").mouseout(function() {
		$(this).attr('class', "input_but");
	})
	$(":submit").click(function(){
		return checkForm(this.form,true);
	})
	$(":reset").mouseover(function() {

		$(this).attr("class", "input_but_over");
	})
	$(":reset").mouseout(function() {
		$(this).attr('class', "input_but");
	})
	$(":button").mouseover(function() {

		$(this).attr("class", "input_but_over");
	})
	$(":button").mouseout(function() {
		$(this).attr('class', "input_but");
	})
	$(":text").focus(function() {

		$(this).attr("class", "input_t_h");
	})
	$(":text").blur(function() {
		$(this).attr('class', "input_t");
	})
	$(":password").focus(function() {

		$(this).attr("class", "input_t_h");
	})
	$(":password").blur(function() {
		$(this).attr('class', "input_t");
	})
	$("textarea").focus(function() {

		$(this).attr("class", "textarea_h");
	})
	$("textarea").blur(function() {
		$(this).attr('class', "textarea");
	})
	
   $("#change tr").mousemove(function(){
	   $(this).attr('class','list_over');
   })
   $("#change tr").mouseout(function(){
	   $(this).attr('class','');
   })

     
   

})
