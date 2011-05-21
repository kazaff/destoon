//table换色
var Ptr=document.getElementById("change").getElementsByTagName("tr");
function change_tr() {
      for (i=1;i<Ptr.length+1;i++) {
      Ptr[i-1].className = (i%2>0)?"t1":"t2";
      }
}
window.onload=change_tr;
for(var i=0;i<Ptr.length;i++) {
      Ptr[i].onmouseover=function(){
      this.tmpClass=this.className;
      this.className = "list_over";   
      };
      Ptr[i].onmouseout=function(){
      this.className=this.tmpClass;
      };
}