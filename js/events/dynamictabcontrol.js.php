////////////THIS IS HIGHLY CUSTOMIZED CODE//////////////////////
var tabCounter=2;
var tbindex=1;
var allowAdd=0;
var usr="0";
function getTabCount()
          {
            $(function(){
                  tbindex= $("#alltab li").length;
            });
          }
function id2Index(tabsId, srcId)
          {
          	var index=-1;
          	var i = 0, tbH = $(tabsId).find("li a");
          	var lntb=tbH.length;
          	if(lntb>0){
          		for(i=0;i<lntb;i++){
          			o=tbH[i];
          			if(o.href.search(srcId)>0){
          				index=i;
          			}
          		}
          	}
          	return index;
          }
      
function setMenuClick(idx,title,url,gusr)
          {
          $(function()
            {   
            usr=gusr;
                
                var tabTitle = $( "#tab_title" ),
                tabContent = $( "#tab_content" ),
                tabTemplate = "<li style='padding-right:10px'><a href='#{href}'>#{label}</a> <span role='presentation' class='ui-icon ui-icon-close' style='margin-bottom:0px;position:absolute;top:-1px;right:-1px'></span></li>";
          
                var tabs = $( "#tabs" ).tabs();
          
          
                var label = title || "Tab " + tabCounter,
                  id = idx,
                  li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
                  tabContentHtml = tabContent.val() || "Tab " + tabCounter + " content.";
          
                if(!$('#'+idx).length)
                    {
                    tabs.find( ".ui-tabs-nav" ).append( li );
                    tabs.append( "<div id='" + id + "'>" + url + "</div>" );
                    tabs.tabs( "refresh" );
                    getTabCount();
                    $( "#tabs" ).tabs({ active: tbindex});
                    //alert(gusr);
                    $("#"+id).empty().load(url+"/"+gusr);
                    

                    } 
                else 
                    {
                    $("#tabs").tabs("option","active", id2Index("#tabs","#"+idx));
                    } 
            });
          } 

$(function(){

var tabs = $( "#tabs" ).tabs(); 

    // close icon: removing the tab on click
    tabs.delegate( "span.ui-icon-close", "click", function() {
      var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
      $( "#" + panelId ).empty().remove();
       getTabCount();
      tabs.tabs( "refresh" );
    });
 
    tabs.bind( "keyup", function( event ) {
      if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
        var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
        $( "#" + panelId ).empty().remove();
        tabs.tabs( "refresh" );
      }
    });
});
